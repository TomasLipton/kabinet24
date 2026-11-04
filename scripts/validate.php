<?php
declare(strict_types=1);
if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit;
}
require_once dirname(__DIR__) . '/lib/site.php';
$root = dirname(__DIR__);
$errors = [];
$check = static function (bool $valid, string $message) use (&$errors): void {
    if (!$valid) $errors[] = $message;
};
try {
    $config = siteConfig();
    $check(preg_match('/^(?:[01][0-9]|2[0-3]):[0-5][0-9]$/D', $config['opening_time']) === 1, 'Некорректное время открытия');
    $check(preg_match('/^(?:(?:[01][0-9]|2[0-3]):[0-5][0-9]|24:00)$/D', $config['closing_time']) === 1, 'Некорректное время закрытия');
    $check(is_int($config['late_cancellation_percent']) && $config['late_cancellation_percent'] >= 0 && $config['late_cancellation_percent'] <= 100, 'Некорректный процент отмены');
    $check(is_int($config['free_cancellation_hours']) && $config['free_cancellation_hours'] > 0, 'Некорректный срок отмены');
    $cabinets = loadCabinets(true);
    $check(count(loadCabinets()) > 0, 'Нет активных кабинетов');
    foreach ($cabinets as $cabinet) {
        $name = $cabinet['slug'];
        $check(is_numeric($cabinet['size']) && $cabinet['size'] > 0, "$name: некорректная площадь");
        $booking = bookingUrl($cabinet);
        $check(filter_var($booking, FILTER_VALIDATE_URL) !== false && parse_url($booking, PHP_URL_SCHEME) === 'https', "$name: некорректная ссылка бронирования");
        foreach (['group', 'individual'] as $type) {
            $check(!empty($cabinet['pricing'][$type]) && is_array($cabinet['pricing'][$type]), "$name: отсутствуют тарифы $type");
            foreach ($cabinet['pricing'][$type] ?? [] as $price) {
                $check(isset($price['label']) && is_string($price['label']) && $price['label'] !== '', "$name: отсутствует подпись тарифа");
                $check(isset($price['price']) && is_numeric($price['price']) && $price['price'] > 0, "$name: некорректная цена");
            }
        }
        foreach (array_merge([$cabinet['images']['main']], $cabinet['images']['gallery'] ?? []) as $image) {
            $check(is_string($image) && str_starts_with($image, 'assets/') && !str_contains($image, '..') && is_file($root . '/' . $image), "$name: отсутствует изображение $image");
        }
    }
    foreach (['assets/css/site.css', 'assets/js/site.js', 'assets/favicon.png', 'assets/logo.png', 'assets/rental-agreement.pdf', 'assets/price-list-2026-from-may-1.pdf', 'assets/privacy-policy.pdf', 'assets/cookie-policy.pdf', 'rules.php'] as $file) {
        $check(is_file($root . '/' . $file) && filesize($root . '/' . $file) > 0, "Отсутствует файл $file");
    }
} catch (Throwable $error) {
    $errors[] = $error->getMessage();
}
if ($errors) {
    fwrite(STDERR, implode(PHP_EOL, $errors) . PHP_EOL);
    exit(1);
}
echo 'Проверены настройки, ' . count($cabinets) . ' кабинетов, тарифы и файлы сайта.' . PHP_EOL;
