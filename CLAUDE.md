# Project guidance

Kabinet24 is a Russian-language room rental catalog in Minsk. Use BYN for prices.

## Architecture

- PHP 8.2+, DOM and mbstring; no database or application framework.
- `index.php`: homepage and fallback routing; `cabinet.php`: room pages; `rules.php`: rental rules.
- `data/cabinets/*.json`: room data and the source of truth for prices.
- `data/site.json`: shared hours, cancellation terms, default booking URL and tariff notes.
- `lib/site.php`: shared configuration, catalog loading, escaping and JSON-LD serialization.
- `templates/`: shared footer and integrations (Google Analytics, Jivo, Yclients).
- Tailwind 3.4.17 is built locally. Edit `styles/site.css` and run `npm run build`; commit `assets/css/site.css`. Include PHP and JS files in Tailwind content scanning.
- `assets/js/site.js`: pricing switches, navigation and gallery initialization.

## Content changes

Keep all visitor-facing text in Russian. Change hours and cancellation terms in `data/site.json`, not independently in templates. Keep prices in cabinet JSON and regenerate both PDFs with `scripts/build-documents.py` after price changes. Preserve unrelated terms of the offer. Never invent room-specific Yclients IDs; use the configured fallback when no verified room URL exists.

Disabled rooms must be absent from the catalog and sitemap and return 404. Use `enabled: false` rather than deleting JSON, because deployment does not delete old server files. Validate slugs as strings. Escape HTML with `e()` and generate structured data with `jsonLd()`.

## Images

Use WebP quality around 80%, width 600 px. Every image needs meaningful alt text and explicit dimensions. Use lazy loading below the fold, but load the main room photograph eagerly. Keep local originals with `_full` suffix out of new commits and deployments. Preserve attached photo content when optimizing website assets.

## Checks and deployment

See README for setup. Run `npm run build`, `npm run check`, `php generate-sitemap.php` and `npm test`. Inspect PDF rendering after edits. CI checks PHP 8.2/8.4 and whether compiled CSS is current.

cPanel deployment runs `scripts/deploy.sh` via `.cpanel.yml`. Include new runtime folders/files in the deployment script. Publishing requires an explicit user request.
