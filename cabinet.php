<?php
require __DIR__ . '/lang/helper.php';

// Получаем slug из URL
$slug = $_GET['slug'] ?? '';
$slug = preg_replace('/[^a-z0-9-]/', '', $slug);

if (empty($slug)) {
    header('Location: ' . $langPrefix . '/#offices');
    exit;
}

// Ищем JSON файл по slug
$cabinet = null;
$files = glob($cabinetsDataDir . '*.json');

foreach ($files as $file) {
    $data = json_decode(file_get_contents($file), true);
    if ($data && isset($data['slug']) && $data['slug'] === $slug) {
        $cabinet = $data;
        break;
    }
}

// 404 если кабинет не найден
if (!$cabinet) {
    http_response_code(404);
    ?>
    <!DOCTYPE html>
    <html lang="<?= $lang ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $t['cabinet_not_found_title'] ?></title>
        <meta name="robots" content="noindex, nofollow">
        <script src="https://cdn.tailwindcss.com"></script>
        <?php include 'templates/head.php'; ?>
    </head>
    <body class="bg-gray-50 min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-gray-300 mb-4">404</h1>
            <p class="text-xl text-gray-600 mb-8"><?= $t['cabinet_not_found'] ?></p>
            <a href="<?= $langPrefix ?>/#offices" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                <?= $t['cabinet_view_all'] ?>
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
    return match($type) {
        'VIP' => 'bg-amber-500',
        'Большой Зал', 'Large Hall' => 'bg-emerald-500',
        'Зал', 'Hall' => 'bg-blue-500',
        default => 'bg-slate-500'
    };
}

$badgeColor = getBadgeColor($cabinet['type'] ?? null);

// SEO: Build rich meta data
$cabinetName = htmlspecialchars($cabinet['name']);

switch ($cabinet['type']) {
    case 'VIP':
        $cabinetTypeGenitive = $t['cabinet_seo_type_vip_genitive'];
        $cabinetType = $t['cabinet_seo_type_vip'];
        break;
    case 'Зал':
    case 'Hall':
        $cabinetTypeGenitive = $t['cabinet_seo_type_hall_genitive'];
        $cabinetType = $t['cabinet_seo_type_hall'];
        break;
    case 'Большой Зал':
    case 'Large Hall':
        $cabinetTypeGenitive = $t['cabinet_seo_type_large_hall_genitive'];
        $cabinetType = $t['cabinet_seo_type_large_hall'];
        break;
    default:
        $cabinetTypeGenitive = $t['cabinet_seo_type_default_genitive'];
        $cabinetType = $t['cabinet_seo_type_default'];
        break;
}

$pageTitle = sprintf($t['cabinet_seo_title_pattern'], $cabinetName, $cabinetTypeGenitive);
$pageDescription = sprintf($t['cabinet_seo_desc_pattern'], $cabinetName, $cabinetType, $cabinet['size'], $cabinet['capacity']);
$canonicalUrl = 'https://kabinet24.by' . $langPrefix . '/cabinet/' . $cabinet['slug'];
$alternateRuUrl = 'https://kabinet24.by/cabinet/' . $cabinet['slug'];
$alternateEnUrl = 'https://kabinet24.by/en/cabinet/' . $cabinet['slug'];
$mainImageUrl = 'https://kabinet24.by/' . $cabinet['images']['main'];
$seoKeywords = sprintf($t['cabinet_seo_keywords_pattern'], $cabinetName, htmlspecialchars(mb_strtolower($cabinetType)));

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
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="icon" type="image/png" href="/assets/logo.png">
    <meta name="description" content="<?= $pageDescription ?>">
    <meta name="keywords" content="<?= $seoKeywords ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= $canonicalUrl ?>">
    <link rel="alternate" hreflang="ru" href="<?= $alternateRuUrl ?>">
    <link rel="alternate" hreflang="en" href="<?= $alternateEnUrl ?>">
    <link rel="alternate" hreflang="x-default" href="<?= $alternateRuUrl ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="product">
    <meta property="og:url" content="<?= $canonicalUrl ?>">
    <meta property="og:title" content="<?= $pageTitle ?>">
    <meta property="og:description" content="<?= $pageDescription ?>">
    <meta property="og:image" content="<?= $mainImageUrl ?>">
    <meta property="og:site_name" content="<?= $t['site_name'] ?>">
    <meta property="og:locale" content="<?= $ogLocale ?>">
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
            "name": "<?= $t['jsonld_brand'] ?>"
        },
        "category": "<?= $t['jsonld_category'] ?>"
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
                "unitText": "<?= $t['jsonld_unit_text'] ?>"
            },
            "availability": "https://schema.org/InStock",
            "url": "<?= $canonicalUrl ?>"
        }
        <?php endif; ?>
        ,"additionalProperty": [
            {
                "@type": "PropertyValue",
                "name": "<?= $t['jsonld_area'] ?>",
                "value": "<?= $cabinet['size'] ?> <?= $t['offices_sqm'] ?>"
            },
            {
                "@type": "PropertyValue",
                "name": "<?= $t['jsonld_capacity'] ?>",
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
                "name": "<?= $t['jsonld_home'] ?>",
                "item": "https://kabinet24.by<?= $langPrefix ?>/"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "<?= $t['jsonld_offices'] ?>",
                "item": "https://kabinet24.by<?= $langPrefix ?>/#offices"
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
        "name": "<?= $t['jsonld_brand'] ?>",
        "url": "https://kabinet24.by<?= $langPrefix ?>",
        "telephone": "+375291916311",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "<?= $t['jsonld_cabinet_street'] ?>",
            "addressLocality": "<?= $t['jsonld_cabinet_city'] ?>",
            "addressCountry": "BY"
        },
        "openingHours": "Mo-Su 09:00-22:00"
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
                <a href="<?= $langPrefix ?>/" class="text-2xl font-bold text-blue-600"><?= $t['site_name'] ?></a>
                <div class="flex items-center gap-4">
                    <a href="<?= $langPrefix ?>/" class="text-gray-600 hover:text-blue-600 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <?= $t['cabinet_all'] ?>
                    </a>
                    <a href="<?= $lang === 'ru' ? '/en/cabinet/' . $cabinet['slug'] : '/cabinet/' . $cabinet['slug'] ?>" class="text-gray-500 hover:text-blue-600 transition font-medium"><?= $lang === 'ru' ? 'EN' : 'RU' ?></a>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm" aria-label="<?= $t['cabinet_breadcrumb_aria'] ?>">
            <ol class="flex items-center space-x-2 text-gray-500" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li><a href="<?= $langPrefix ?>/" class="hover:text-blue-600"><?= $t['cabinet_breadcrumb_home'] ?></a></li>
                <li><span>/</span></li>
                <li><a href="<?= $langPrefix ?>/#offices" class="hover:text-blue-600"><?= $t['cabinet_breadcrumb_offices'] ?></a></li>
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
                            alt="<?= sprintf($t['cabinet_seo_img_alt_pattern'], $cabinetName, htmlspecialchars($cabinetType), $cabinet['size']) ?>"
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
                        <img src="/<?= htmlspecialchars($image) ?>" alt="<?= sprintf($t['cabinet_seo_gallery_alt_pattern'], $cabinetName, $index + 1) ?>" class="w-full h-full object-cover" loading="lazy" width="150" height="150">
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
                        <span class="text-gray-500 text-sm"><?= $t['cabinet_subtitle'] ?></span>
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
                        <span class="font-semibold text-slate-800"><?= htmlspecialchars($cabinet['size']) ?> <?= $t['offices_sqm'] ?></span>
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
                    <h2 class="font-semibold text-lg text-gray-900"><?= $t['cabinet_pricing_h2'] ?></h2>

                    <div class="space-y-3">
                        <!-- Group Pricing -->
                        <?php if (!empty($cabinet['pricing']['group'])): ?>
                        <div class="pb-3 border-b border-gray-100">
                            <p class="font-medium text-gray-900 mb-2"><?= $t['cabinet_pricing_group'] ?></p>
                            <?php foreach ($cabinet['pricing']['group'] as $price): ?>
                            <div class="flex justify-between items-center <?= isset($price['highlight']) && $price['highlight'] ? 'text-emerald-600' : '' ?>">
                                <span class="text-sm text-gray-500"><?= htmlspecialchars($price['label']) ?></span>
                                <span class="text-lg font-bold <?= isset($price['highlight']) && $price['highlight'] ? 'text-emerald-600' : 'text-slate-800' ?>"><?= $price['price'] ?>BYN<span class="text-base font-normal text-gray-500"><?= $t['cabinet_pricing_unit'] ?></span></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <!-- Individual Pricing -->
                        <?php if (!empty($cabinet['pricing']['individual'])): ?>
                        <div class="pb-3">
                            <p class="font-medium text-gray-900 mb-2"><?= $t['cabinet_pricing_individual'] ?></p>
                            <?php foreach ($cabinet['pricing']['individual'] as $price): ?>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500"><?= htmlspecialchars($price['label']) ?></span>
                                <span class="text-lg font-bold <?= isset($price['highlight']) && $price['highlight'] ? 'text-emerald-600' : 'text-slate-800' ?>"><?= $price['price'] ?>BYN<span class="text-base font-normal text-gray-500"><?= $t['cabinet_pricing_unit'] ?></span></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <p class="text-sm text-gray-500">
                        <?= $t['cabinet_pricing_note'] ?>
                    </p>
                </div>

                <!-- Amenities -->
                <?php if (!empty($cabinet['amenities'])): ?>
                <div class="space-y-3">
                    <h2 class="font-semibold text-lg text-gray-900"><?= $t['cabinet_amenities_h2'] ?></h2>
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
                        <?= $t['cabinet_book_online'] ?>
                    </a>
                    <?php endif; ?>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="tel:+375291916311" class="flex-1 bg-slate-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-slate-700 transition text-center">
                            <?= $t['cabinet_call'] ?>
                        </a>
                        <a href="https://t.me/psychoanalitik_by" target="_blank" rel="noopener" class="flex-1 bg-blue-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-600 transition text-center">
                            <?= $t['cabinet_telegram'] ?>
                        </a>
                    </div>
                </div>
            </div>
        </article>

        <!-- Back to all -->
        <div class="mt-12 pt-8 border-t border-gray-200">
            <a href="<?= $langPrefix ?>/#offices" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <?= $t['cabinet_view_all'] ?>
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
