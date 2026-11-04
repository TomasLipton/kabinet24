<?php
require_once __DIR__ . "/lib/site.php";
// Роутинг для окружений без Apache/.htaccess (например, Herd/nginx),
// где все запросы попадают на index.php.
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
if (preg_match('#^/cabinet/([a-z0-9-]+)/?$#', $path, $matches)) {
    $_GET['slug'] = $matches[1];
    require __DIR__ . '/cabinet.php';
    exit;
}
if (preg_match('#^/pravila-arendy/?$#', $path)) {
    require __DIR__ . '/rules.php';
    exit;
}
if (!in_array($path, ['/', '/index.php'], true)) {
    require __DIR__ . '/templates/not-found.php';
    exit;
}
$cabinets = loadCabinets();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кабинет24 - Почасовая аренда уютных и современных кабинетов и залов в центре Минска</title>
    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <meta name="description" content="Почасовая аренда помещений в Минске для проведения консультаций, семинаров, тренингов, лекций. Рядом с метро Академия наук. Бесплатный Wi-Fi, чай, кофе, парковка.">
    <meta name="keywords" content="аренда кабинета Минск, аренда помещений Минск, почасовая аренда, коворкинг Минск, аренда залов Минск, кабинет для консультаций, аренда офиса почасово, помещение для семинара, тренинг зал аренда, метро Академия наук">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Кабинет24">
    <meta name="theme-color" content="#2563eb">
    <link rel="canonical" href="https://kabinet24.by/">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kabinet24.by/">
    <meta property="og:title" content="Кабинет24 - Почасовая аренда уютных и современных кабинетов и залов в центре Минска">
    <meta property="og:description" content="Почасовая аренда помещений в Минске для проведения консультаций, семинаров, тренингов, лекций. Рядом с метро Академия наук. Бесплатный Wi-Fi, чай, кофе, парковка.">
    <meta property="og:image" content="https://kabinet24.by/assets/logo.png">
    <meta property="og:site_name" content="Кабинет24">
    <meta property="og:locale" content="ru_RU">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://kabinet24.by/">
    <meta name="twitter:title" content="Кабинет24 - Почасовая аренда уютных и современных кабинетов и залов в центре Минска">
    <meta name="twitter:description" content="Почасовая аренда помещений в Минске для проведения консультаций, семинаров, тренингов, лекций. Рядом с метро Академия наук. Бесплатный Wi-Fi, чай, кофе, парковка.">
    <meta name="twitter:image" content="https://kabinet24.by/assets/logo.png">

    <link rel="stylesheet" href="<?= e(stylesheetUrl()) ?>">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "Кабинет24",
        "image": "https://kabinet24.by/assets/logo.png",
        "url": "https://kabinet24.by/",
        "description": "Почасовая аренда помещений в Минске для проведения консультаций, семинаров, тренингов, лекций. Рядом с метро Академия наук. Бесплатный Wi-Fi, чай, кофе, парковка.",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "ул. Якуба Коласа 37",
            "addressLocality": "Минск",
            "addressRegion": "Минская область",
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
                "name": "Бесплатный чай и кофе",
                "value": true
            },
            {
                "@type": "LocationFeatureSpecification",
                "name": "Парковка",
                "value": true
            }
        ],
        "openingHoursSpecification": {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            "opens": "<?= e(siteConfig()['opening_time']) ?>",
            "closes": "<?= e(closingTimeSchema()) ?>"
        }
    }
    </script>

    <?php include __DIR__ . '/templates/head.php'; ?>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white/95 backdrop-blur-md border-b border-gray-200/80 sticky top-0 z-50">
        <nav class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2.5 group">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center shadow-md group-hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-gray-900">Кабинет<span class="text-blue-600">24</span></span>
                </a>
                <!-- Nav Links -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="#about" class="nav-link px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all">О нас</a>
                    <a href="#offices" class="nav-link px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all">Кабинеты</a>
                    <a href="#amenities" class="nav-link px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all">Удобства</a>
                    <a href="#contact" class="nav-link px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-all">Контакты</a>
                </div>
                <!-- CTA Button -->
                <a href="<?= e(bookingUrl()) ?>" target="_blank" rel="noopener" class="ms_booking inline-flex items-center gap-2 bg-blue-600 text-white px-3 sm:px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-blue-700 transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5 transform">
                    <svg class="hidden sm:block w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Забронировать
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
                    <span class="text-slate-200 text-sm font-semibold">Премиум локация в центре Минска</span>
                </div>
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white via-slate-200 to-white bg-clip-text text-transparent">Почасовая аренда уютных и современных кабинетов и залов</h1>
                <p class="text-xl mb-4 text-gray-300">Комфортные помещения для различных задач: индивидуальной и групповой работы, мастер-классов, фотосессий, телесных практик, йоги, тренингов, лекций и деловых встреч.</p>
                <p class="text-lg mb-2 text-slate-300">📍 ул. Я. Коласа 37, 🚇 Ст. метро Академия наук, МЦ "Айсберг"</p>
                <p class="text-lg mb-8 text-slate-300">⏰ Работаем ежедневно <?= e(openingHoursText()) ?></p>
                <div class="flex flex-wrap gap-4">
                    <a href="#offices" class="bg-white text-slate-900 px-8 py-3 rounded-lg font-semibold hover:bg-slate-100 transition-all shadow-lg hover:shadow-xl hover:scale-105 transform">
                        Прейскурант
                    </a>
                    <a href="/pravila-arendy" class="border-2 border-slate-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-slate-800/50 hover:border-slate-400 transition-all backdrop-blur-sm">
                        Правила аренды
                    </a>
                    <a href="#contact" class="border-2 border-slate-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-slate-800/50 hover:border-slate-400 transition-all backdrop-blur-sm">
                        Связаться с нами
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">Почему Кабинет24?</h2>

            <!-- Key Stats -->
            <div class="grid md:grid-cols-3 gap-6 max-w-4xl mx-auto mb-12">
                <div class="text-center p-8 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border border-blue-200 shadow-sm hover:shadow-md transition">
                    <div class="text-4xl md:text-3xl lg:text-5xl font-bold text-blue-900 mb-2"><?= count($cabinets) ?></div>
                    <div class="text-blue-700 font-semibold">Кабинетов и залов</div>
                    <div class="text-sm text-blue-600 mt-1">от <?= e(min(array_column($cabinets, 'size'))) ?> до <?= e(max(array_column($cabinets, 'size'))) ?> м²</div>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="text-4xl md:text-3xl lg:text-5xl font-bold text-slate-900 mb-2">от 14 BYN</div>
                    <div class="text-slate-700 font-semibold">Стоимость аренды</div>
                    <div class="text-sm text-slate-600 mt-1">за час</div>
                </div>
                <div class="text-center p-8 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl border border-emerald-200 shadow-sm hover:shadow-md transition">
                    <div class="text-3xl md:text-xl lg:text-3xl font-bold text-emerald-900 mb-2">Спецтарифы</div>
                    <div class="text-emerald-700 font-semibold">Скидки</div>
                    <div class="text-sm text-emerald-600 mt-1">при долгосрочной аренде</div>
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
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Система скидок</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• Специальные тарифы при аренде более 10 ч/неделю</li>
                        <li>• «Счастливый час» — специальные цены с 11:00 до 16:00</li>
                        <li class="text-xs text-gray-500 italic">*Скидки не суммируются</li>
                    </ul>
                    <a href="/pravila-arendy" class="inline-block mt-3 text-sm text-blue-600 font-medium hover:underline">Подробнее →</a>
                </div>

                <!-- Оплата -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Удобная оплата</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• Наличными</li>
                        <li>• Картой через терминал</li>
                        <li>• Безналичный расчет и оплата на сайте</li>
                    </ul>
                </div>

                <!-- Включено в стоимость -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Включено в стоимость</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• Чай, кофе, вода, печенье</li>
                        <li>• Wi-Fi, флипчарт</li>
                        <li>• Коврики для йоги</li>
                    </ul>
                </div>

                <!-- Парковка -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Бесплатный паркинг</h3>
                    <p class="text-sm text-gray-600">Удобная парковка</p>
                </div>

                <!-- Дополнительное оборудование -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Доп. оборудование</h3>
                    <p class="text-sm text-gray-600 mb-2">За 3 руб/час:</p>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• Проектор</li>
                        <li>• Юнгианская песочница</li>
                        <li>• Кушетка для практик</li>
                    </ul>
                </div>

                <!-- Сервис -->
                <div class="bg-white border border-slate-200 rounded-xl p-6 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Приветливый сервис</h3>
                    <p class="text-sm text-gray-600">Администратор всегда готов помочь и ответить на ваши вопросы</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Use Cases Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">Для кого подходит наш сервис</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Консультанты</h3>
                    <p class="text-gray-600">Психологи, терапевты, коучи, логопеды, медиаторы, юристы, бухгалтеры и другие специалисты для встреч с клиентами.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Тренеры, преподаватели, лекторы</h3>
                    <p class="text-gray-600">Проведение индивидуальных и групповых занятий, мастер-классов, лекций</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Стартапы</h3>
                    <p class="text-gray-600">Проведение встреч, переговоров и презентаций без долгосрочной аренды офиса</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800">Практики</h3>
                    <p class="text-gray-600">Йога, телесные практики, фотосессии в уютном пространстве</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Offices Section -->
    <section id="offices" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4 text-gray-800">Кабинеты и залы</h2>
            <p class="text-center text-gray-600 mb-12">Выберите подходящее помещение для ваших задач</p>

            <!-- Tabs -->
            <div class="flex justify-center mb-12">
                <div class="inline-flex flex-col sm:flex-row bg-white rounded-lg shadow-md p-1">
                    <button type="button" aria-pressed="true" id="tab-individual" class="pricing-tab px-8 py-3 rounded-lg font-semibold transition-all bg-slate-800 text-white">
                        Индивидуальная аренда
                    </button>
                    <button type="button" aria-pressed="false" id="tab-group" class="pricing-tab px-8 py-3 rounded-lg font-semibold transition-all text-gray-600">
                        Групповая аренда
                    </button>
                </div>
            </div>

            <!-- Offices Grid -->
            <?php
            // Badge colors by type
            function getBadgeColorIndex($type) {
                return match($type) {
                    'VIP' => 'bg-amber-500',
                    'Большой Зал' => 'bg-emerald-500',
                    'Зал' => 'bg-blue-500',
                    default => 'bg-slate-500'
                };
            }
            ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
                <?php foreach ($cabinets as $cab): ?>
                <a href="/cabinet/<?= htmlspecialchars($cab['slug']) ?>" class="office-card bg-white border-2 border-slate-200 rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col group">
                    <div class="h-48 bg-gradient-to-br from-slate-200 to-slate-300 relative overflow-hidden">
                        <?php if ($cab['type']): ?>
                        <span class="absolute top-3 right-3 <?= getBadgeColorIndex($cab['type']) ?> text-white px-3 py-1 rounded-full text-xs font-semibold z-10"><?= htmlspecialchars($cab['type']) ?></span>
                        <?php endif; ?>
                        <img src="/<?= e($cab['images']['main']) ?>" alt="<?= htmlspecialchars($cab['name']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" loading="lazy" width="600" height="400" />
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($cab['name']) ?></h3>
                            <span class="inline-flex items-center px-3 py-1 bg-slate-100 rounded-full text-sm text-slate-700">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"></path>
                                </svg>
                                <?= htmlspecialchars($cab['size']) ?> м²
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
                                    <span class="text-lg font-bold <?= isset($price['highlight']) && $price['highlight'] ? 'text-emerald-600' : 'text-slate-800' ?>"><?= $price['price'] ?>BYN/ч</span>
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
                                    <span class="text-lg font-bold <?= isset($price['highlight']) && $price['highlight'] ? 'text-emerald-600' : 'text-slate-800' ?>"><?= $price['price'] ?>BYN/ч</span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <span class="mt-auto w-full bg-slate-800 text-white py-2 rounded-lg group-hover:bg-slate-700 transition text-sm font-semibold text-center">
                            Подробнее
                        </span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>

            <div class="mt-12 bg-blue-50 border-l-4 border-blue-400 p-6 max-w-4xl mx-auto">
                <p class="text-sm text-gray-700"><strong>Обратите внимание:</strong> Стоимость указана за арендный час (50 минут). <?= e(siteConfig()['discount_note']) ?> Дополнительное оборудование (проектор, песочница, кушетка) - 3 руб/час.</p>
                <p class="text-sm text-gray-700 mt-3"><?= e(siteConfig()['happy_hour_note']) ?> <a href="/pravila-arendy" class="text-blue-600 font-medium hover:underline">Условия акции →</a></p>
            </div>

            <!-- Условия отмены -->
            <div class="mt-6 bg-amber-50 border-l-4 border-amber-400 p-6 max-w-4xl mx-auto">
                <p class="text-sm text-gray-700"><strong>Условия отмены:</strong> <?= e(cancellationText()) ?> <a href="/pravila-arendy" class="text-blue-600 font-medium hover:underline">Все правила аренды →</a></p>
            </div>
        </div>
    </section>

    <!-- Directions Section -->
    <section id="directions" class="py-16 bg-white" aria-labelledby="directions-heading">
        <div class="container mx-auto px-4">
            <h2 id="directions-heading" class="text-4xl font-bold text-center mb-6 text-gray-800">Как нас найти</h2>
            <div id="directions-description" class="max-w-3xl mx-auto text-center text-lg text-gray-600 mb-8 space-y-2">
                <p>Мы находимся по адресу ул. Якуба Коласа, 37.</p>
                <p>Подъезд 1, этаж 3, офис №24.</p>
                <p>Вход со стороны ул. Богдана Хмельницкого.</p>
                <p>Как нас найти от ст. м. «Академия наук» — ниже в видео.</p>
            </div>
            <video
                class="rounded-2xl bg-slate-900 shadow-lg"
                style="display: block; width: 100%; max-width: 384px; height: auto; margin: 0 auto;"
                width="720"
                height="1280"
                controls
                playsinline
                preload="none"
                poster="/assets/videos/directions-poster.webp"
                aria-label="Как пройти от станции метро «Академия наук» до Кабинет24"
                aria-describedby="directions-description"
            >
                <source src="/assets/videos/directions.mp4" type="video/mp4">
                Ваш браузер не поддерживает видео. <a href="/assets/videos/directions.mp4">Открыть видео с маршрутом</a>.
            </video>
        </div>
    </section>

    <!-- Amenities Section -->
    <section id="amenities" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">Удобства и оснащение</h2>
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
                        <h3 class="font-semibold text-gray-800 mb-1">Бесплатный Wi-Fi</h3>
                        <p class="text-gray-600 text-sm">Высокоскоростной интернет во всех помещениях</p>
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
                        <h3 class="font-semibold text-gray-800 mb-1">Кондиционер</h3>
                        <p class="text-gray-600 text-sm">Комфортная температура в любое время года</p>
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
                        <h3 class="font-semibold text-gray-800 mb-1">Чай и кофе</h3>
                        <p class="text-gray-600 text-sm">Вода, печенье, конфеты - бесплатно</p>
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
                        <h3 class="font-semibold text-gray-800 mb-1">Флипчарт</h3>
                        <p class="text-gray-600 text-sm">Для презентаций и тренингов</p>
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
                        <h3 class="font-semibold text-gray-800 mb-1">Коврики для йоги</h3>
                        <p class="text-gray-600 text-sm">Для телесных практик и занятий</p>
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
                        <h3 class="font-semibold text-gray-800 mb-1">Бесплатный паркинг</h3>
                        <p class="text-gray-600 text-sm">Удобная парковка для клиентов</p>
                    </div>
                </div>

            </div>

            <div class="mt-12 max-w-4xl mx-auto bg-blue-50 p-6 rounded-lg">
                <h3 class="font-semibold text-gray-800 mb-4 text-lg">Дополнительное оборудование за 3 руб/час:</h3>
                <ul class="grid md:grid-cols-3 gap-4 text-gray-700">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Проектор
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Юнгианская песочница
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Кушетка для практик
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4 text-gray-800">Забронировать кабинет</h2>
            <p class="text-center text-gray-500 mb-12">Свяжитесь с нами любым удобным способом</p>

            <div class="grid md:grid-cols-3 gap-6 max-w-4xl mx-auto mb-10">
                <div class="border border-gray-200 rounded-xl p-6">
                    <p class="text-sm text-gray-500 mb-1">Телефон / Viber</p>
                    <a href="tel:+375291916311" class="text-lg font-semibold text-gray-900 hover:text-blue-600 transition">+375 (29) 191-63-11</a>
                </div>
                <div class="border border-gray-200 rounded-xl p-6">
                    <p class="text-sm text-gray-500 mb-1">Telegram</p>
                    <a href="https://t.me/psychoanalitik_by" target="_blank" rel="noopener" class="text-lg font-semibold text-gray-900 hover:text-blue-600 transition">@psychoanalitik_by</a>
                </div>
                <div class="border border-gray-200 rounded-xl p-6">
                    <p class="text-sm text-gray-500 mb-1">Адрес</p>
                    <p class="font-semibold text-gray-900">ул. Я. Коласа 37</p>
                    <p class="text-sm text-gray-500">МЦ "Айсберг", 🚇 м. Академия наук</p>
                </div>
            </div>

            <div class="text-center">
                <a href="<?= e(bookingUrl()) ?>" target="_blank" rel="noopener" class="ms_booking inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3.5 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Забронировать онлайн
                </a>
                <p class="text-gray-400 text-sm mt-4">⏰ Работаем ежедневно <?= e(openingHoursText()) ?></p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include __DIR__ . '/templates/footer.php'; ?>

<?php include __DIR__ . '/templates/footer-scripts.php'; ?>
</body>
</html>
