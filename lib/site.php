<?php
declare(strict_types=1);

function siteConfig(): array
{
    static $config;
    return $config ??= json_decode(file_get_contents(__DIR__ . '/../data/site.json'), true, 512, JSON_THROW_ON_ERROR);
}

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function stylesheetUrl(): string
{
    $version = substr(hash_file('sha256', __DIR__ . '/../assets/css/site.css'), 0, 12);
    return '/assets/css/site.css?v=' . $version;
}

function jsonLd(array $data): string
{
    return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR);
}

function openingHoursText(): string
{
    $config = siteConfig();
    return 'с ' . $config['opening_time'] . ' до ' . $config['closing_time'];
}

function closingTimeSchema(): string
{
    return siteConfig()['closing_time'] === '24:00' ? '00:00' : siteConfig()['closing_time'];
}

function cancellationText(): string
{
    $config = siteConfig();
    return "Бесплатная отмена за {$config['free_cancellation_hours']} часа до начала аренды. При отмене менее чем за {$config['free_cancellation_hours']} часа оплачивается {$config['late_cancellation_percent']}% стоимости аренды.";
}

function bookingUrl(array $cabinet = []): string
{
    return !empty($cabinet['booking_url']) ? $cabinet['booking_url'] : siteConfig()['booking_url'];
}

function loadCabinets(bool $includeDisabled = false): array
{
    $cabinets = [];
    $slugs = [];
    foreach (glob(__DIR__ . '/../data/cabinets/*.json') ?: [] as $file) {
        $data = json_decode(file_get_contents($file), true, 512, JSON_THROW_ON_ERROR);
        foreach (['slug', 'number', 'name', 'size', 'capacity', 'description', 'images', 'pricing'] as $key) {
            if (!isset($data[$key])) {
                throw new RuntimeException(basename($file) . ': отсутствует ' . $key);
            }
        }
        if (!is_string($data['slug']) || !preg_match('/^[a-z0-9-]+$/D', $data['slug']) || isset($slugs[$data['slug']])) {
            throw new RuntimeException(basename($file) . ': некорректный или повторяющийся slug');
        }
        $slugs[$data['slug']] = true;
        if ($includeDisabled || ($data['enabled'] ?? true)) {
            $cabinets[] = $data;
        }
    }
    usort($cabinets, fn($a, $b) => ($a['order'] ?? 99) <=> ($b['order'] ?? 99));
    return $cabinets;
}
