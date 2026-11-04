#!/usr/bin/env php
<?php
/**
 * Генератор sitemap.xml для kabinet24.by
 *
 * Использование: php generate-sitemap.php
 * Результат: создаёт sitemap.xml в текущей директории
 */

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit('Forbidden');
}

$baseUrl = 'https://kabinet24.by';
$dataDir = __DIR__ . '/data/cabinets';
$outputFile = __DIR__ . '/sitemap.xml';

// Главная страница
$urls = [
    [
        'loc'        => $baseUrl . '/',
        'changefreq' => 'weekly',
        'priority'   => '1.0',
    ],
];

// Статические страницы
$urls[] = [
    'loc'        => $baseUrl . '/pravila-arendy',
    'changefreq' => 'monthly',
    'priority'   => '0.5',
];

// Use the same validated catalog as the website.
require_once __DIR__ . '/lib/site.php';
foreach (loadCabinets() as $cabinet) {
    $urls[] = [
        'loc' => $baseUrl . '/cabinet/' . $cabinet['slug'],
        'changefreq' => 'weekly',
        'priority' => '0.8',
    ];
}

// Генерация XML
$xml = new DOMDocument('1.0', 'UTF-8');
$xml->formatOutput = true;

$urlset = $xml->createElement('urlset');
$urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
$xml->appendChild($urlset);

foreach ($urls as $entry) {
    $urlNode = $xml->createElement('url');

    foreach ($entry as $tag => $value) {
        $child = $xml->createElement($tag, $value);
        $urlNode->appendChild($child);
    }

    $lastmod = $xml->createElement('lastmod', date('Y-m-d'));
    $urlNode->appendChild($lastmod);

    $urlset->appendChild($urlNode);
}

$bytes = $xml->save($outputFile);

if ($bytes === false) {
    fwrite(STDERR, "Ошибка: не удалось записать $outputFile\n");
    exit(1);
}

$count = count($urls);
echo "Готово: $outputFile ($count URL)\n";
