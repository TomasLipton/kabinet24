<?php
// Получаем slug из URL
$slug = $_GET['slug'] ?? '';
$slug = preg_replace('/[^a-z0-9-]/', '', $slug);

if (empty($slug)) {
    header('Location: /#offices');
    exit;
}

// Ищем JSON файл по slug
$cabinet = null;
$cabinetsDir = __DIR__ . '/data/cabinets/';
$files = glob($cabinetsDir . '*.json');

foreach ($files as $file) {
    $data = json_decode(file_get_contents($file), true);
    if ($data && isset($data['slug']) && $data['slug'] === $slug) {
        // Отключённый кабинет отдаёт 404, как будто страницы нет
        if ($data['enabled'] ?? true) {
            $cabinet = $data;
        }
        break;
    }
}

// 404 если кабинет не найден
if (!$cabinet) {
    http_response_code(404);
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Кабинет не найден — Кабинет24</title>
        <meta name="robots" content="noindex, nofollow">
        <script src="https://cdn.tailwindcss.com"></script>
        <?php include 'templates/head.php'; ?>
    </head>
    <body class="bg-gray-50 min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-gray-300 mb-4">404</h1>
            <p class="text-xl text-gray-600 mb-8">Кабинет не найден</p>
            <a href="/#offices" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                Смотреть все кабинеты
            </a>
        </div>
    <?php include 'templates/footer-scripts.php'; ?>
    </body>
    </html>
    <?php
    exit;
}

// Функция для получения badge цвета по типу
function getBadgeColor($type) {
    switch ($type) {
        case 'VIP':
            return 'bg-amber-500';
        case 'Большой Зал':
            return 'bg-emerald-500';
        case 'Зал':
            return 'bg-blue-500';
        default:
            return 'bg-slate-500';
    }
}

$badgeColor = getBadgeColor($cabinet['type'] ?? null);

// SEO: Build rich meta data
$cabinetName = htmlspecialchars($cabinet['name']);
// Родительный падеж для title: "аренда (чего?)"
switch ($cabinet['type']) {
    case 'VIP':
        $cabinetTypeGenitive = 'VIP кабинета';
        break;
    case 'Зал':
        $cabinetTypeGenitive = 'зала';
        break;
    case 'Большой Зал':
        $cabinetTypeGenitive = 'большого зала';
        break;
    default:
        $cabinetTypeGenitive = 'кабинета';
        break;
}
$cabinetType = $cabinet['type'] ? $cabinet['type'] . ' кабинет' : 'кабинет';
$pageTitle = $cabinetName . ' — аренда ' . $cabinetTypeGenitive . ' почасово в Минске';
$pageDescription = $cabinetName . ' — ' . $cabinetType . ' для аренды в центре Минска, ' . $cabinet['size'] . ' м², ' . $cabinet['capacity'] . ' Почасовая аренда рядом с метро Академия наук. Wi-Fi, кондиционер, чай/кофе.';
$canonicalUrl = 'https://kabinet24.by/cabinet/' . $cabinet['slug'];
$mainImageUrl = 'https://kabinet24.by/' . $cabinet['images']['main'];

// Минимальная цена для мета-данных
$minPrice = null;
foreach (['group', 'individual'] as $pricingType) {
    if (!empty($cabinet['pricing'][$pricingType])) {
        foreach ($cabinet['pricing'][$pricingType] as $p) {
            if ($minPrice === null || $p['price'] < $minPrice) {
                $minPrice = $p['price'];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="icon" type="image/png" href="/assets/logo.png">
    <meta name="description" content="<?= $pageDescription ?>">
    <meta name="keywords" content="<?= $cabinetName ?>, аренда кабинета Минск, почасовая аренда, <?= htmlspecialchars(mb_strtolower($cabinetType)) ?> аренда, коворкинг Минск, аренда помещений Минск, метро Академия наук">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= $canonicalUrl ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="product">
    <meta property="og:url" content="<?= $canonicalUrl ?>">
    <meta property="og:title" content="<?= $pageTitle ?>">
    <meta property="og:description" content="<?= $pageDescription ?>">
    <meta property="og:image" content="<?= $mainImageUrl ?>">
    <meta property="og:site_name" content="Кабинет24">
    <meta property="og:locale" content="ru_RU">
    <?php if ($minPrice): ?>
    <meta property="product:price:amount" content="<?= $minPrice ?>">
    <meta property="product:price:currency" content="BYN">
    <?php endif; ?>

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $pageTitle ?>">
    <meta name="twitter:description" content="<?= $pageDescription ?>">
    <meta name="twitter:image" content="<?= $mainImageUrl ?>">

    <!-- JSON-LD: Product -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "<?= $cabinetName ?>",
        "description": "<?= htmlspecialchars($cabinet['description']) ?>",
        "image": "<?= $mainImageUrl ?>",
        "brand": {
            "@type": "Brand",
            "name": "Кабинет24"
        },
        "category": "Аренда помещений"
        <?php if ($minPrice): ?>
        ,"offers": {
            "@type": "Offer",
            "priceCurrency": "BYN",
            "price": "<?= $minPrice ?>",
            "priceSpecification": {
                "@type": "UnitPriceSpecification",
                "price": "<?= $minPrice ?>",
                "priceCurrency": "BYN",
                "unitCode": "HUR",
                "unitText": "час"
            },
            "availability": "https://schema.org/InStock",
            "url": "<?= $canonicalUrl ?>"
        }
        <?php endif; ?>
        ,"additionalProperty": [
            {
                "@type": "PropertyValue",
                "name": "Площадь",
                "value": "<?= $cabinet['size'] ?> м²"
            },
            {
                "@type": "PropertyValue",
                "name": "Вместимость",
                "value": "<?= htmlspecialchars($cabinet['capacity']) ?>"
            }
        ]
    }
    </script>

    <!-- JSON-LD: BreadcrumbList -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Главная",
                "item": "https://kabinet24.by/"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Кабинеты",
                "item": "https://kabinet24.by/#offices"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "<?= $cabinetName ?>",
                "item": "<?= $canonicalUrl ?>"
            }
        ]
    }
    </script>

    <!-- JSON-LD: LocalBusiness -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "Кабинет24",
        "url": "https://kabinet24.by",
        "telephone": "+375291916311",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "ул. Я. Коласа 37, МЦ Айсберг",
            "addressLocality": "Минск",
            "addressCountry": "BY"
        },
        "openingHours": "Mo-Su 07:00-00:00"
    }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- GLightbox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .thumbnail {
            transition: all 0.2s ease;
        }
        .thumbnail:hover {
            opacity: 0.8;
            transform: scale(1.02);
        }
    </style>
    <?php include 'templates/head.php'; ?>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="/" class="flex items-center gap-2.5 group">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center shadow-md group-hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-gray-900">Кабинет<span class="text-blue-600">24</span></span>
                </a>
                <a href="/#offices" class="text-gray-600 hover:text-blue-600 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Все кабинеты
                </a>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm" aria-label="Навигация">
            <ol class="flex items-center space-x-2 text-gray-500" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li><a href="/" class="hover:text-blue-600">Главная</a></li>
                <li><span>/</span></li>
                <li><a href="/#offices" class="hover:text-blue-600">Кабинеты</a></li>
                <li><span>/</span></li>
                <li class="text-gray-900 font-medium"><?= htmlspecialchars($cabinet['name']) ?></li>
            </ol>
        </nav>

        <article class="grid lg:grid-cols-2 gap-8" itemscope itemtype="https://schema.org/Product">
            <!-- Photo Gallery -->
            <div class="space-y-4">
                <!-- Main Photo -->
                <a href="/<?= htmlspecialchars($cabinet['images']['main']) ?>" class="glightbox block" data-gallery="cabinet-gallery">
                    <div class="aspect-[4/3] rounded-xl overflow-hidden bg-gray-200 cursor-zoom-in">
                        <img
                            id="main-photo"
                            src="/<?= htmlspecialchars($cabinet['images']['main']) ?>"
                            alt="<?= $cabinetName ?> — <?= htmlspecialchars($cabinetType) ?> для аренды в Минске, <?= $cabinet['size'] ?> м²"
                            class="w-full h-full object-cover hover:scale-105 transition duration-300"
                            loading="lazy" width="600" height="450"
                        >
                    </div>
                </a>

                <!-- Thumbnails -->
                <?php if (!empty($cabinet['images']['gallery']) && count($cabinet['images']['gallery']) > 1): ?>
                <div class="grid grid-cols-4 gap-3">
                    <?php foreach ($cabinet['images']['gallery'] as $index => $image): ?>
                    <a href="/<?= htmlspecialchars($image) ?>" class="glightbox thumbnail aspect-square rounded-lg overflow-hidden bg-gray-200 cursor-pointer" data-gallery="cabinet-gallery">
                        <img src="/<?= htmlspecialchars($image) ?>" alt="<?= $cabinetName ?> — фото интерьера <?= $index + 1 ?>" class="w-full h-full object-cover" loading="lazy" width="150" height="150">
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Cabinet Info -->
            <div class="space-y-6">
                <!-- Title & Badge -->
                <div>
                    <?php if ($cabinet['type']): ?>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="<?= $badgeColor ?> text-white px-3 py-1 rounded-full text-xs font-semibold"><?= htmlspecialchars($cabinet['type']) ?></span>
                        <span class="text-gray-500 text-sm">Кабинет для групповой и индивидуальной работы</span>
                    </div>
                    <?php endif; ?>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900"><?= htmlspecialchars($cabinet['name']) ?></h1>
                </div>

                <!-- Key Stats -->
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-2 bg-slate-100 px-4 py-2 rounded-lg">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"></path>
                        </svg>
                        <span class="font-semibold text-slate-800"><?= htmlspecialchars($cabinet['size']) ?> м²</span>
                    </div>
                    <div class="flex items-center gap-2 bg-slate-100 px-4 py-2 rounded-lg">
                        <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-semibold text-slate-800"><?= htmlspecialchars($cabinet['capacity']) ?></span>
                    </div>
                </div>

                <!-- Description -->
                <div class="prose prose-gray">
                    <p class="text-gray-600 leading-relaxed">
                        <?= htmlspecialchars($cabinet['description']) ?>
                    </p>
                </div>

                <!-- Pricing -->
                <div class="bg-white border border-gray-200 rounded-xl p-6 space-y-4">
                    <h2 class="font-semibold text-lg text-gray-900">Стоимость аренды</h2>

                    <div class="space-y-3">
                        <!-- Group Pricing -->
                        <?php if (!empty($cabinet['pricing']['group'])): ?>
                        <div class="pb-3 border-b border-gray-100">
                            <p class="font-medium text-gray-900 mb-2">Групповая аренда</p>
                            <?php foreach ($cabinet['pricing']['group'] as $price): ?>
                            <div class="flex justify-between items-center <?= isset($price['highlight']) && $price['highlight'] ? 'text-emerald-600' : '' ?>">
                                <span class="text-sm text-gray-500"><?= htmlspecialchars($price['label']) ?></span>
                                <span class="text-lg font-bold <?= isset($price['highlight']) && $price['highlight'] ? 'text-emerald-600' : 'text-slate-800' ?>"><?= $price['price'] ?>BYN<span class="text-base font-normal text-gray-500">/час</span></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Individual Pricing -->
                        <?php if (!empty($cabinet['pricing']['individual'])): ?>
                        <div class="pb-3">
                            <p class="font-medium text-gray-900 mb-2">Индивидуальная аренда</p>
                            <?php foreach ($cabinet['pricing']['individual'] as $price): ?>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500"><?= htmlspecialchars($price['label']) ?></span>
                                <span class="text-lg font-bold <?= isset($price['highlight']) && $price['highlight'] ? 'text-emerald-600' : 'text-slate-800' ?>"><?= $price['price'] ?>BYN<span class="text-base font-normal text-gray-500">/час</span></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <p class="text-sm text-gray-500">
                        * Скидка 10% при аренде более 10 ч/неделю
                    </p>
                </div>

                <!-- Условия отмены -->
                <div class="flex gap-3 bg-amber-50 border border-amber-200 rounded-xl p-5">
                    <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 21a9 9 0 110-18 9 9 0 010 18z"></path>
                    </svg>
                    <div>
                        <h2 class="font-semibold text-gray-900 mb-1">Условия отмены</h2>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Бесплатная отмена за 24 часа до начала аренды. Если Вы отменяете аренду менее чем за 24 часа, Вы должны оплатить стоимость аренды в полном объёме.
                        </p>
                        <a href="/pravila-arendy" class="inline-block mt-2 text-sm text-blue-600 font-medium hover:underline">Все правила аренды →</a>
                    </div>
                </div>

                <!-- Amenities -->
                <?php if (!empty($cabinet['amenities'])): ?>
                <div class="space-y-3">
                    <h2 class="font-semibold text-lg text-gray-900">Удобства</h2>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ($cabinet['amenities'] as $amenity): ?>
                        <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full text-sm">
                            <?= htmlspecialchars($amenity) ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- CTA -->
                <div class="flex flex-col gap-3 pt-4">
                    <?php if (!empty($cabinet['booking_url'])): ?>
                    <a href="<?= htmlspecialchars($cabinet['booking_url']) ?>" target="_blank" rel="noopener" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition text-center text-lg">
                        Записаться онлайн
                    </a>
                    <?php endif; ?>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="tel:+375291916311" class="flex-1 bg-slate-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-slate-700 transition text-center">
                            📞 Позвонить
                        </a>
                        <a href="https://t.me/psychoanalitik_by" target="_blank" rel="noopener" class="flex-1 bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-600 transition text-center">
                            Написать в Telegram
                        </a>
                    </div>
                    <p class="text-sm text-gray-500 text-center">⏰ Работаем ежедневно с 7:00 до 24:00</p>
                </div>
            </div>
        </article>

        <!-- Back to all -->
        <div class="mt-12 pt-8 border-t border-gray-200">
            <a href="/#offices" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Смотреть все кабинеты
            </a>
        </div>
    </main>

    <?php include __DIR__ . '/templates/footer.php'; ?>

    <!-- GLightbox JS -->
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        const lightbox = GLightbox({
            touchNavigation: true,
            loop: true,
            openEffect: 'zoom',
            closeEffect: 'fade'
        });
    </script>
<?php include 'templates/footer-scripts.php'; ?>
</body>
</html>
