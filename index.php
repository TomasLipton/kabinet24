<?php require __DIR__ . '/lang/helper.php'; ?>
<!--Vova-->
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $t['meta_title'] ?></title>
    <link rel="icon" type="image/png" href="/assets/logo.png">
    <meta name="description" content="<?= $t['meta_description'] ?>">
    <meta name="keywords" content="<?= $t['meta_keywords'] ?>">
    <meta name="robots" content="index, follow">
    <meta name="author" content="<?= $t['site_name'] ?>">
    <meta name="theme-color" content="#2563eb">
    <link rel="canonical" href="https://kabinet24.by<?= $langPrefix ?>/">
    <link rel="alternate" hreflang="ru" href="https://kabinet24.by/">
    <link rel="alternate" hreflang="en" href="https://kabinet24.by/en/">
    <link rel="alternate" hreflang="x-default" href="https://kabinet24.by/">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kabinet24.by<?= $langPrefix ?>/">
    <meta property="og:title" content="<?= $t['meta_title'] ?>">
    <meta property="og:description" content="<?= $t['meta_description'] ?>">
    <meta property="og:image" content="https://kabinet24.by/assets/logo.png">
    <meta property="og:site_name" content="<?= $t['site_name'] ?>">
    <meta property="og:locale" content="<?= $ogLocale ?>">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://kabinet24.by<?= $langPrefix ?>/">
    <meta name="twitter:title" content="<?= $t['meta_title'] ?>">
    <meta name="twitter:description" content="<?= $t['meta_description'] ?>">
    <meta name="twitter:image" content="https://kabinet24.by/assets/logo.png">

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .office-card {
            transition: all 0.3s ease;
        }
        .office-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        /* Hover only for inactive tab buttons */
        .pricing-tab:not(.bg-slate-800):hover {
            background-color: rgb(243 244 246);
        }
    </style>

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "<?= $t['jsonld_brand'] ?>",
        "image": "https://kabinet24.by/assets/logo.png",
        "url": "https://kabinet24.by<?= $langPrefix ?>/",
        "description": "<?= $t['jsonld_description'] ?>",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "<?= $t['jsonld_street'] ?>",
            "addressLocality": "<?= $t['jsonld_city'] ?>",
            "addressRegion": "<?= $t['jsonld_region'] ?>",
            "postalCode": "220140",
            "addressCountry": "BY"
        },
        "priceRange": "$$",
        "amenityFeature": [
            {
                "@type": "LocationFeatureSpecification",
                "name": "Wi-Fi",
                "value": true
            },
            {
                "@type": "LocationFeatureSpecification",
                "name": "<?= $t['jsonld_amenity_tea'] ?>",
                "value": true
            },
            {
                "@type": "LocationFeatureSpecification",
                "name": "<?= $t['jsonld_amenity_parking'] ?>",
                "value": true
            }
        ],
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            "opens": "08:00",
            "closes": "22:00"
        }
    }
    </script>

    <?php include 'templates/head.php'; ?>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold text-blue-600"><?= $t['site_name'] ?></div>
                <div class="hidden md:flex space-x-8">
                    <a href="#about" class="nav-link text-gray-700 hover:text-blue-600 transition"><?= $t['nav_about'] ?></a>
                    <a href="#offices" class="nav-link text-gray-700 hover:text-blue-600 transition"><?= $t['nav_offices'] ?></a>
                    <a href="#amenities" class="nav-link text-gray-700 hover:text-blue-600 transition"><?= $t['nav_amenities'] ?></a>
                    <a href="#contact" class="nav-link text-gray-700 hover:text-blue-600 transition"><?= $t['nav_contact'] ?></a>
                    <a href="<?= $lang === 'ru' ? '/en/' : '/' ?>" class="text-gray-500 hover:text-blue-600 transition font-medium"><?= $lang === 'ru' ? 'EN' : 'RU' ?></a>
                </div>
                <a href="#" class="ms_booking bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <?= $t['nav_book_online'] ?>
                </a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white py-24 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-slate-500/5 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl">
                <div class="inline-block mb-4 px-4 py-2 bg-slate-700/40 border border-slate-600/50 rounded-full">
                    <span class="text-slate-200 text-sm font-semibold"><?= $t['hero_badge'] ?></span>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white via-slate-200 to-white bg-clip-text text-transparent"><?= $t['hero_h1'] ?></h1>
                <p class="text-xl mb-4 text-gray-300"><?= $t['hero_text'] ?></p>
                <p class="text-lg mb-8 text-slate-300"><?= $t['hero_address'] ?></p>
                <div class="flex flex-wrap gap-4">
                    <a href="#offices" class="bg-white text-slate-900 px-8 py-3 rounded-lg font-semibold hover:bg-slate-100 transition-all shadow-lg hover:shadow-xl hover:scale-105 transform">
                        <?= $t['hero_choose_office'] ?>
                    </a>
                    <a href="#contact" class="border-2 border-slate-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-slate-800/50 hover:border-slate-400 transition-all backdrop-blur-sm">
                        <?= $t['hero_contact_us'] ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800"><?= $t['about_h2'] ?></h2>

            <!-- Key Stats -->
            <div class="grid md:grid-cols-3 gap-6 max-w-4xl mx-auto mb-12">
                <div class="text-center p-8 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border border-blue-200 shadow-sm hover:shadow-md transition">
                    <div class="text-5xl font-bold text-blue-900 mb-2">11</div>
                    <div class="text-blue-700 font-semibold"><?= $t['about_stat1_label'] ?></div>
                    <div class="text-sm text-blue-600 mt-1"><?= $t['about_stat1_sub'] ?></div>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="text-5xl font-bold text-slate-900 mb-2"><?= $t['about_stat2_value'] ?></div>
                    <div class="text-slate-700 font-semibold"><?= $t['about_stat2_label'] ?></div>
                    <div class="text-sm text-slate-600 mt-1"><?= $t['about_stat2_sub'] ?></div>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl border border-emerald-200 shadow-sm hover:shadow-md transition">
                    <div class="text-5xl font-bold text-emerald-900 mb-2"><?= $t['about_stat3_value'] ?></div>
                    <div class="text-emerald-700 font-semibold"><?= $t['about_stat3_label'] ?></div>
                    <div class="text-sm text-emerald-600 mt-1"><?= $t['about_stat3_sub'] ?></div>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">

                <!-- Скидки -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800"><?= $t['feature_discounts_title'] ?></h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• <?= $t['feature_discounts_1'] ?></li>
                        <li>• <?= $t['feature_discounts_2'] ?></li>
                        <li class="text-xs text-gray-500 italic"><?= $t['feature_discounts_note'] ?></li>
                    </ul>
                </div>

                <!-- Оплата -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800"><?= $t['feature_payment_title'] ?></h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• <?= $t['feature_payment_1'] ?></li>
                        <li>• <?= $t['feature_payment_2'] ?></li>
                        <li>• <?= $t['feature_payment_3'] ?></li>
                    </ul>
                </div>

                <!-- Включено в стоимость -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800"><?= $t['feature_included_title'] ?></h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• <?= $t['feature_included_1'] ?></li>
                        <li>• <?= $t['feature_included_2'] ?></li>
                        <li>• <?= $t['feature_included_3'] ?></li>
                    </ul>
                </div>

                <!-- Парковка -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800"><?= $t['feature_parking_title'] ?></h3>
                    <p class="text-sm text-gray-600"><?= $t['feature_parking_text'] ?></p>
                </div>

                <!-- Дополнительное оборудование -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800"><?= $t['feature_equipment_title'] ?></h3>
                    <p class="text-sm text-gray-600 mb-2"><?= $t['feature_equipment_price'] ?></p>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• <?= $t['feature_equipment_1'] ?></li>
                        <li>• <?= $t['feature_equipment_2'] ?></li>
                        <li>• <?= $t['feature_equipment_3'] ?></li>
                    </ul>
                </div>

                <!-- Сервис -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800"><?= $t['feature_service_title'] ?></h3>
                    <p class="text-sm text-gray-600"><?= $t['feature_service_text'] ?></p>
                </div>

            </div>
        </div>
    </section>

    <!-- Use Cases Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800"><?= $t['usecases_h2'] ?></h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800"><?= $t['usecase1_title'] ?></h3>
                    <p class="text-gray-600"><?= $t['usecase1_text'] ?></p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800"><?= $t['usecase2_title'] ?></h3>
                    <p class="text-gray-600"><?= $t['usecase2_text'] ?></p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800"><?= $t['usecase3_title'] ?></h3>
                    <p class="text-gray-600"><?= $t['usecase3_text'] ?></p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800"><?= $t['usecase4_title'] ?></h3>
                    <p class="text-gray-600"><?= $t['usecase4_text'] ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Offices Section -->
    <section id="offices" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4 text-gray-800"><?= $t['offices_h2'] ?></h2>
            <p class="text-center text-gray-600 mb-12"><?= $t['offices_subtitle'] ?></p>

            <!-- Tabs -->
            <div class="flex justify-center mb-12">
                <div class="inline-flex bg-white rounded-lg shadow-md p-1">
                    <button onclick="switchPricing('individual')" id="tab-individual" class="pricing-tab px-8 py-3 rounded-lg font-semibold transition-all bg-slate-800 text-white">
                        <?= $t['offices_tab_individual'] ?>
                    </button>
                    <button onclick="switchPricing('group')" id="tab-group" class="pricing-tab px-8 py-3 rounded-lg font-semibold transition-all text-gray-600">
                        <?= $t['offices_tab_group'] ?>
                    </button>
                </div>
            </div>

            <!-- Offices Grid -->
            <?php
            // Load all cabinet JSON files
            $cabinets = [];
            foreach (glob($cabinetsDataDir . '*.json') as $file) {
                $data = json_decode(file_get_contents($file), true);
                if ($data) {
                    $cabinets[] = $data;
                }
            }
            // Sort by order
            usort($cabinets, fn($a, $b) => ($a['order'] ?? 99) - ($b['order'] ?? 99));

            // Badge colors by type
            function getBadgeColorIndex($type) {
                return match($type) {
                    'VIP' => 'bg-amber-500',
                    'Большой Зал', 'Large Hall' => 'bg-emerald-500',
                    'Зал', 'Hall' => 'bg-blue-500',
                    default => 'bg-slate-500'
                };
            }
            ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
                <?php foreach ($cabinets as $cab): ?>
                <a href="<?= $langPrefix ?>/cabinet/<?= htmlspecialchars($cab['slug']) ?>" class="office-card bg-white border-2 border-slate-200 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col group">
                    <div class="h-48 bg-gradient-to-br from-slate-200 to-slate-300 relative overflow-hidden">
                        <?php if ($cab['type']): ?>
                        <span class="absolute top-3 right-3 <?= getBadgeColorIndex($cab['type']) ?> text-white px-3 py-1 rounded-full text-xs font-semibold z-10"><?= htmlspecialchars($cab['type']) ?></span>
                        <?php endif; ?>
                        <img src="<?= htmlspecialchars($cab['images']['main']) ?>" alt="<?= htmlspecialchars($cab['name']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" loading="lazy" width="600" height="400" />
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($cab['name']) ?></h3>
                            <span class="inline-flex items-center px-3 py-1 bg-slate-100 rounded-full text-sm text-slate-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"></path>
                                </svg>
                                <?= htmlspecialchars($cab['size']) ?> <?= $t['offices_sqm'] ?>
                            </span>
                        </div>
                        <div class="mb-3">
                            <span class="text-sm text-gray-600 group-capacity hidden"><?= htmlspecialchars($cab['capacity']) ?></span>
                        </div>

                        <!-- Group Pricing -->
                        <div class="mb-3 pricing-group hidden">
                            <div class="space-y-2">
                                <?php foreach ($cab['pricing']['group'] as $price): ?>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-600"><?= htmlspecialchars($price['label']) ?></span>
                                    <span class="text-lg font-bold <?= isset($price['highlight']) && $price['highlight'] ? 'text-emerald-600' : 'text-slate-800' ?>"><?= $price['price'] ?><?= $t['offices_price_suffix'] ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Individual Pricing -->
                        <div class="pricing-individual">
                            <div class="space-y-2">
                                <?php foreach ($cab['pricing']['individual'] as $price): ?>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-600"><?= htmlspecialchars($price['label']) ?></span>
                                    <span class="text-lg font-bold <?= isset($price['highlight']) && $price['highlight'] ? 'text-emerald-600' : 'text-slate-800' ?>"><?= $price['price'] ?><?= $t['offices_price_suffix'] ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <span class="mt-auto w-full bg-slate-800 text-white py-2 rounded-lg group-hover:bg-slate-700 transition text-sm font-semibold text-center">
                            <?= $t['offices_details'] ?>
                        </span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>

            <div class="mt-12 bg-blue-50 border-l-4 border-blue-400 p-6 max-w-4xl mx-auto">
                <p class="text-sm text-gray-700"><?= $t['offices_notice'] ?></p>
            </div>
        </div>
    </section>

    <script>
        function switchPricing(type) {
            const groupPricing = document.querySelectorAll('.pricing-group');
            const individualPricing = document.querySelectorAll('.pricing-individual');
            const groupCapacity = document.querySelectorAll('.group-capacity');
            const tabGroup = document.getElementById('tab-group');
            const tabIndividual = document.getElementById('tab-individual');

            if (type === 'group') {
                groupPricing.forEach(el => el.classList.remove('hidden'));
                individualPricing.forEach(el => el.classList.add('hidden'));
                groupCapacity.forEach(el => el.classList.remove('hidden'));

                tabGroup.classList.add('bg-slate-800', 'text-white');
                tabGroup.classList.remove('text-gray-600');
                tabIndividual.classList.remove('bg-slate-800', 'text-white');
                tabIndividual.classList.add('text-gray-600');
            } else {
                groupPricing.forEach(el => el.classList.add('hidden'));
                individualPricing.forEach(el => el.classList.remove('hidden'));
                groupCapacity.forEach(el => el.classList.add('hidden'));

                tabIndividual.classList.add('bg-slate-800', 'text-white');
                tabIndividual.classList.remove('text-gray-600');
                tabGroup.classList.remove('bg-slate-800', 'text-white');
                tabGroup.classList.add('text-gray-600');
            }
        }

        // Highlight active menu item on scroll
        function highlightActiveSection() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');

            let current = '';
            const scrollPosition = window.scrollY + 100; // Offset for header

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;

                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('text-blue-600', 'font-semibold');
                link.classList.add('text-gray-700');

                if (link.getAttribute('href') === '#' + current) {
                    link.classList.remove('text-gray-700');
                    link.classList.add('text-blue-600', 'font-semibold');
                }
            });
        }

        // Add scroll event listener
        window.addEventListener('scroll', highlightActiveSection);
        // Run on page load
        window.addEventListener('load', highlightActiveSection);
    </script>

    <!-- Amenities Section -->
    <section id="amenities" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800"><?= $t['amenities_h2'] ?></h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <div class="flex items-start space-x-4 bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex-shrink-0">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1"><?= $t['amenity_wifi_title'] ?></h3>
                        <p class="text-gray-600 text-sm"><?= $t['amenity_wifi_text'] ?></p>
                    </div>
                </div>

                <div class="flex items-start space-x-4 bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex-shrink-0">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1"><?= $t['amenity_ac_title'] ?></h3>
                        <p class="text-gray-600 text-sm"><?= $t['amenity_ac_text'] ?></p>
                    </div>
                </div>

                <div class="flex items-start space-x-4 bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex-shrink-0">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1"><?= $t['amenity_tea_title'] ?></h3>
                        <p class="text-gray-600 text-sm"><?= $t['amenity_tea_text'] ?></p>
                    </div>
                </div>

                <div class="flex items-start space-x-4 bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex-shrink-0">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1"><?= $t['amenity_flipchart_title'] ?></h3>
                        <p class="text-gray-600 text-sm"><?= $t['amenity_flipchart_text'] ?></p>
                    </div>
                </div>

                <div class="flex items-start space-x-4 bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex-shrink-0">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1"><?= $t['amenity_yoga_title'] ?></h3>
                        <p class="text-gray-600 text-sm"><?= $t['amenity_yoga_text'] ?></p>
                    </div>
                </div>

                <div class="flex items-start space-x-4 bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex-shrink-0">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1"><?= $t['amenity_parking_title'] ?></h3>
                        <p class="text-gray-600 text-sm"><?= $t['amenity_parking_text'] ?></p>
                    </div>
                </div>

            </div>

            <div class="mt-12 max-w-4xl mx-auto bg-blue-50 p-6 rounded-lg">
                <h3 class="font-semibold text-gray-800 mb-4 text-lg"><?= $t['amenity_extra_title'] ?></h3>
                <ul class="grid md:grid-cols-3 gap-4 text-gray-700">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <?= $t['amenity_extra_1'] ?>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <?= $t['amenity_extra_2'] ?>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <?= $t['amenity_extra_3'] ?>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800"><?= $t['contact_h2'] ?></h2>
            <div class="max-w-4xl mx-auto grid md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-semibold mb-6 text-gray-800"><?= $t['contact_h3'] ?></h3>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-800"><?= $t['contact_phone_label'] ?></p>
                                <a href="tel:+375291916311" class="text-blue-600 hover:text-blue-700 text-lg">+375 (29) 191-63-11</a>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-800"><?= $t['contact_telegram_label'] ?></p>
                                <a href="https://t.me/psychoanalitik_by" target="_blank" rel="noopener" class="text-blue-600 hover:text-blue-700">@psychoanalitik_by</a>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <svg class="w-6 h-6 text-blue-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold text-gray-800"><?= $t['contact_address_label'] ?></p>
                                <p class="text-gray-600"><?= $t['contact_address_text'] ?></p>
                            </div>
                        </div>
                        <a href="#" class="ms_booking mt-2 inline-flex items-center space-x-3 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-semibold"><?= $t['contact_book_online'] ?></span>
                        </a>
                    </div>
                </div>

<!--                <div>-->
<!--                    <form class="space-y-4" method="POST" action="">-->
<!--                        <div>-->
<!--                            <label class="block text-gray-700 font-medium mb-2">Ваше имя *</label>-->
<!--                            <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="block text-gray-700 font-medium mb-2">Телефон *</label>-->
<!--                            <input type="tel" name="phone" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="+375 (29) 123-45-67">-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="block text-gray-700 font-medium mb-2">Какой кабинет интересует?</label>-->
<!--                            <select name="cabinet" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">-->
<!--                                <option value="">Выберите кабинет</option>-->
<!--                                <option value="37">VIP-1 Кабинет 37 (32 м²)</option>-->
<!--                                <option value="28">VIP-2 Кабинет 28 (21 м²)</option>-->
<!--                                <option value="27">Кабинет 27 (21 м²)</option>-->
<!--                                <option value="23">Кабинет 23 (21 м²)</option>-->
<!--                                <option value="9">Кабинет 9 (21 м²)</option>-->
<!--                                <option value="38.1">Кабинет 38.1 (13.5 м²)</option>-->
<!--                                <option value="51">Кабинет 51 - Большой зал (50 м²)</option>-->
<!--                                <option value="38">Кабинет 38 - Зал (35 м²)</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="block text-gray-700 font-medium mb-2">Желаемая дата и время</label>-->
<!--                            <input type="datetime-local" name="datetime" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent">-->
<!--                        </div>-->
<!--                        <div>-->
<!--                            <label class="block text-gray-700 font-medium mb-2">Комментарий</label>-->
<!--                            <textarea name="message" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Укажите количество человек, длительность аренды"></textarea>-->
<!--                        </div>-->
<!--                        <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">-->
<!--                            Отправить заявку-->
<!--                        </button>-->
<!--                        <p class="text-sm text-gray-600 text-center">Мы свяжемся с вами в течение 30 минут</p>-->
<!--                    </form>-->
<!--                </div>-->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include __DIR__ . '/templates/footer.php'; ?>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
<?php include 'templates/footer-scripts.php'; ?>
</body>
</html>
