const { test, before, after } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const net = require('node:net');
const { spawn } = require('node:child_process');
const root = path.resolve(__dirname, '..');
const config = JSON.parse(fs.readFileSync(path.join(root, 'data/site.json')));
const catalog = fs.readdirSync(path.join(root, 'data/cabinets')).filter(f => f.endsWith('.json')).map(f => JSON.parse(fs.readFileSync(path.join(root, 'data/cabinets', f))));
const active = catalog.filter(c => c.enabled !== false);
let server, base, serverErrors = '';

before(async () => {
    const probe = net.createServer();
    await new Promise(resolve => probe.listen(0, '127.0.0.1', resolve));
    const port = probe.address().port;
    await new Promise(resolve => probe.close(resolve));
    base = `http://127.0.0.1:${port}`;
    server = spawn(process.env.PHP_BINARY || 'php', ['-S', `127.0.0.1:${port}`, 'scripts/router.php'], { cwd: root, windowsHide: true });
    let spawnError;
    server.on('error', error => { spawnError = error; });
    server.stderr.on('data', data => { serverErrors += data; });
    for (let attempt = 0; attempt < 100; attempt++) {
        if (spawnError) throw spawnError;
        try { await fetch(base); return; } catch { await new Promise(resolve => setTimeout(resolve, 50)); }
    }
    throw new Error('PHP server did not start: ' + serverErrors);
});
after(async () => {
    if (server && server.exitCode === null) {
        const closed = new Promise(resolve => server.once('exit', resolve));
        server.kill();
        await closed;
    }
});
const schemas = html => [...html.matchAll(/<script type="application\/ld\+json">([\s\S]*?)<\/script>/g)].map(m => JSON.parse(m[1]));
const checkCommon = html => {
    assert.match(html, /50% стоимости аренды/);
    assert.ok(html.includes(`с ${config.opening_time} до ${config.closing_time}`));
    assert.doesNotMatch(html, /cdn\.tailwindcss\.com|Warning:|Fatal error:|с 7:00|до 22:00/);
    assert.match(html, /href="\/assets\/css\/site\.css\?v=[a-f0-9]{12}"/);
};

test('catalog and every public room page expose the correct prices, hours, cancellation and booking links', async () => {
    const response = await fetch(base);
    assert.equal(response.status, 200);
    const home = await response.text();
    checkCommon(home);
    assert.equal((home.match(/class="office-card /g) || []).length, active.length);
    for (const c of active) assert.ok(home.includes(`/cabinet/${c.slug}`));
    for (const c of catalog.filter(c => c.enabled === false)) assert.ok(!home.includes(`/cabinet/${c.slug}`));
    const hours = schemas(home).find(s => s['@type'] === 'LocalBusiness').openingHoursSpecification;
    assert.equal(hours.opens, '08:00');
    assert.equal(hours.closes, '00:00');
    for (const c of active) {
        const response = await fetch(`${base}/cabinet/${c.slug}`);
        assert.equal(response.status, 200, c.slug);
        const html = await response.text();
        checkCommon(html);
        assert.ok(html.includes(`href="${c.booking_url || config.booking_url}"`), c.slug + ': booking');
        assert.ok(html.includes(`src="/${c.images.main}"`), c.slug + ': photograph');
        const structured = schemas(html);
        assert.equal(structured.find(s => s['@type'] === 'Product').offers.price, Math.min(...Object.values(c.pricing).flat().map(p => p.price)));
        assert.deepEqual(structured.find(s => s['@type'] === 'LocalBusiness').openingHoursSpecification, hours);
        for (const price of Object.values(c.pricing).flat()) {
            assert.ok(html.includes(price.label), c.slug + ': missing tariff label');
            assert.ok(html.includes(`>${price.price}BYN`), c.slug + ': missing price');
        }
    }
});

test('disabled rooms, missing pages and malformed slug values return 404 instead of PHP errors', async () => {
    const routes = ['/cabinet/not-a-room', '/missing-page', '/cabinet.php?slug[]=bad', '/cabinet.php?slug=../bad', '/cabinet.php'];
    routes.push(...catalog.filter(c => c.enabled === false).map(c => '/cabinet/' + c.slug));
    for (const route of routes) {
        const response = await fetch(base + route);
        assert.equal(response.status, 404, route);
        const html = await response.text();
        assert.match(html, /noindex/);
        assert.doesNotMatch(html, /Fatal error|Warning:/);
    }
});

test('rental rules and every public document are delivered', async () => {
    const rules = await fetch(base + '/pravila-arendy');
    assert.equal(rules.status, 200);
    checkCommon(await rules.text());
    for (const file of ['price-list-2026-from-may-1.pdf', 'rental-agreement.pdf', 'privacy-policy.pdf', 'cookie-policy.pdf']) {
        const response = await fetch(base + '/assets/' + file);
        assert.equal(response.status, 200);
        assert.equal((await response.text()).slice(0, 5), '%PDF-');
    }
    assert.equal((await fetch(base + '/assets/css/site.css')).status, 200);
    const generator = await fetch(base + '/generate-sitemap.php');
    assert.equal(generator.status, 403);
});

test('the cabinet in the URL path has priority over conflicting query parameters', async () => {
    for (const query of ['slug=kabinet-9', 'slug[]=kabinet-9']) {
        const response = await fetch(base + '/cabinet/kabinet-37-vip?' + query);
        assert.equal(response.status, 200);
        const product = schemas(await response.text()).find(item => item['@type'] === 'Product');
        assert.equal(product.name, 'Кабинет 37');
    }
});

test('all nine active tariffs match the supplied price list', () => {
    // Standard individual, evening, group, happy hour, weekly individual/group.
    const expected = {
        '9': [18, 20, 22, 14, 16, 20], '27': [18, 20, 22, 14, 16, 20],
        '28': [20, 22, 25, null, null, null], '37': [22, 22, 30, null, null, null],
        '24.1': [18, 20, 22, 14, 16, 20], '24.2': [18, 20, 24, 14, 16, 22],
        '24.3': [18, 18, 20, 14, 16, 18], '24.4': [18, 18, 20, 14, 16, 18],
        '43': [18, 18, 24, 14, 16, 22],
    };
    assert.equal(active.length, Object.keys(expected).length);
    assert.equal(active.find(c => c.number === '43').size, 38);
    const find = (prices, label) => prices.find(p => p.label === label)?.price ?? null;
    for (const c of active) {
        const i = c.pricing.individual, g = c.pricing.group;
        assert.deepEqual([i[0].price, find(i, '18:00-20:00') ?? i[0].price, g[0].price, find(i, '11:00-16:00'), find(i, 'более 10 ч/нед'), find(g, 'более 10 ч/нед')], expected[c.number], c.number);
    }
});

test('internal PHP templates and tooling cannot be opened as public pages', async () => {
    for (const route of ['/templates/footer.php', '/lib/site.php', '/scripts/build-documents.py', '/styles/site.css', '/tests/site.test.cjs']) {
        assert.equal((await fetch(base + route)).status, 403, route);
    }
});

test('sitemap contains exactly the public routes', () => {
    const xml = fs.readFileSync(path.join(root, 'sitemap.xml'), 'utf8');
    const actual = [...xml.matchAll(/<loc>(.*?)<\/loc>/g)].map(m => m[1]).sort();
    const expected = ['https://kabinet24.by/', 'https://kabinet24.by/pravila-arendy', ...active.map(c => 'https://kabinet24.by/cabinet/' + c.slug)].sort();
    assert.deepEqual(actual, expected);
});
