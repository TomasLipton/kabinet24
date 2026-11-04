<?php
require_once __DIR__ . '/lib/site.php';
$pageTitle = 'Правила аренды — Кабинет24';
$pageDescription = 'Правила аренды кабинетов и залов в Минске: время аренды, продление, условия отмены и переноса записи, ответственность арендатора.';
$canonicalUrl = 'https://kabinet24.by/pravila-arendy';

// Разделы правил
$sections = [
    [
        'title' => 'Время аренды',
        'accent' => 'emerald',
        'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
        'items' => [
            'Вы можете арендовать помещение на 1 арендный час (минимум) и далее кратно 30 минутам, т.е. 1 час, 1 час 30 мин., 2 часа … и т.д. до 13 арендных часов (максимум) в день.',
            'Если Вы или Ваш клиент задержались, то Вы в любом случае должны освободить арендуемое помещение за 1 минуту до окончания арендного часа.',
            'Вы можете продлить аренду Вашего помещения непосредственно перед началом следующего часа, если за Вами нет записи.',
            'При задержке на 15 минут и более после окончания аренды взимается оплата в расчёте за 30 минут соответствующей стоимости арендуемого кабинета.',
            'В случае брони кабинета другими арендаторами до и после Вас задержки и приход заранее невозможны. Допускается прийти за 5–10 минут до времени Вашей аренды, если перед Вами в графике никого нет.',
        ],
    ],
    [
        'title' => 'Отмена и перенос записи',
        'accent' => 'amber',
        'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
        'items' => [
            cancellationText(),
            'Перенос записи по Вашей просьбе на тот же день, но на другое время, менее чем за 24 часа до самой записи происходит без дополнительной оплаты. За исключением аренды в горячие часы.',
        ],
    ],
    [
        'title' => 'Помещение и ответственность',
        'accent' => 'blue',
        'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
        'items' => [
            'Мы предоставляем Вам удобное, изолированное помещение, полностью приспособленное для ведения психологических консультаций, семинаров и тренингов.',
            'Просьба, после окончания арендного времени привести Ваш кабинет в исходный вид.',
            'Вы несёте ответственность за сохранность вещей и мебели в арендуемом Вами помещении в течение времени Вашей аренды.',
            'Свечи используются только в качестве декора. В целях пожарной безопасности запрещено их использование — может сработать пожарная сигнализация.',
            'Во время работы в кабинете рекомендуется закрываться изнутри.',
        ],
    ],
    [
        'title' => 'Атмосфера и сервис',
        'accent' => 'purple',
        'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
        'items' => [
            'Мы уважаем Ваши границы и границы Ваших клиентов, поэтому чётко соблюдаем время сессий и конфиденциальность.',
            'Просьба соблюдать тишину и уважение к работе других специалистов Центра, работающих в то же время, что и Вы.',
            'Администраторы нашего Центра встретят Вас и Ваших клиентов и помогут сделать пребывание максимально комфортным.',
        ],
    ],
];

// Цветовые классы для акцентов разделов (перечислены явно, чтобы Tailwind их не вырезал)
function accentClasses($accent) {
    return match($accent) {
        'emerald' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-600', 'dot' => 'bg-emerald-500'],
        'amber'   => ['bg' => 'bg-amber-100',   'text' => 'text-amber-600',   'dot' => 'bg-amber-500'],
        'purple'  => ['bg' => 'bg-purple-100',  'text' => 'text-purple-600',  'dot' => 'bg-purple-500'],
        default   => ['bg' => 'bg-blue-100',    'text' => 'text-blue-600',    'dot' => 'bg-blue-500'],
    };
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <meta name="description" content="<?= $pageDescription ?>">
    <meta name="keywords" content="правила аренды, аренда кабинета Минск, условия отмены, почасовая аренда, Кабинет24">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= $canonicalUrl ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?= $canonicalUrl ?>">
    <meta property="og:title" content="<?= $pageTitle ?>">
    <meta property="og:description" content="<?= $pageDescription ?>">
    <meta property="og:site_name" content="Кабинет24">
    <meta property="og:locale" content="ru_RU">

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
                "name": "Правила аренды",
                "item": "<?= $canonicalUrl ?>"
            }
        ]
    }
    </script>

    <link rel="stylesheet" href="<?= e(stylesheetUrl()) ?>">
    <?php include __DIR__ . '/templates/head.php'; ?>
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

    <!-- Hero -->
    <section class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white py-16 overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-slate-500/5 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <nav class="mb-6 text-sm" aria-label="Навигация">
                <ol class="flex items-center gap-2 text-slate-400">
                    <li><a href="/" class="hover:text-white transition">Главная</a></li>
                    <li><span>/</span></li>
                    <li class="text-slate-200 font-medium">Правила аренды</li>
                </ol>
            </nav>
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Правила аренды</h1>
                <p class="text-lg text-slate-300">Всё, что важно знать до брони: как считается арендное время, что делать при задержке и на каких условиях можно отменить или перенести запись.</p>
            </div>
        </div>
    </section>

    <main class="container mx-auto px-4 py-12">
        <!-- Как считается арендный час -->
        <div class="max-w-4xl mx-auto mb-12">
            <div class="bg-white border-2 border-blue-200 rounded-2xl p-8 shadow-sm">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Как считается арендный час</h2>
                <p class="text-gray-600 mb-6">Стоимость аренды помещения указана за 1 психотерапевтический час (50 минут).</p>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="bg-blue-50 rounded-xl p-6 text-center">
                        <div class="text-4xl font-bold text-blue-600 mb-1">50 <span class="text-2xl font-semibold">мин</span></div>
                        <p class="text-sm text-gray-600">Ваша сессия или занятие</p>
                    </div>
                    <div class="bg-emerald-50 rounded-xl p-6 text-center">
                        <div class="text-4xl font-bold text-emerald-600 mb-1">10 <span class="text-2xl font-semibold">мин</span></div>
                        <p class="text-sm text-gray-600">Время для перехода кабинета следующему арендатору</p>
                    </div>
                </div>

                <p class="text-sm text-gray-600 mt-6 leading-relaxed">
                    10 минут не оплачиваются — это время для того, чтобы Вы смогли без суеты собрать свои вещи, привести за собой кабинет в исходный вид, и следующий за Вами специалист смог спокойно зайти.
                </p>
            </div>
        </div>

        <!-- Система скидок -->
        <div class="max-w-4xl mx-auto mb-12">
            <div class="bg-white border-2 border-emerald-200 rounded-2xl p-8 shadow-sm">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Система скидок</h2>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="bg-emerald-50 rounded-xl p-6">
                        <div class="text-3xl font-bold text-emerald-600 mb-2">Спецтарифы</div>
                        <p class="text-sm text-gray-600 leading-relaxed"><?= e(siteConfig()['discount_note']) ?></p>
                    </div>
                    <div class="bg-emerald-50 rounded-xl p-6">
                        <div class="text-3xl font-bold text-emerald-600 mb-2">14 BYN<span class="text-lg font-normal text-gray-500">/час</span></div>
                        <p class="text-sm text-gray-600 leading-relaxed"><?= e(siteConfig()['happy_hour_note']) ?></p>
                    </div>
                </div>

                <p class="text-sm text-gray-500 italic mt-6">Скидки не суммируются.</p>
            </div>
        </div>

        <!-- Разделы правил -->
        <div class="max-w-4xl mx-auto space-y-6">
            <?php foreach ($sections as $section): ?>
            <?php $c = accentClasses($section['accent']); ?>
            <section class="bg-white border border-slate-200 rounded-2xl p-8 hover:shadow-lg transition">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 <?= $c['bg'] ?> rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 <?= $c['text'] ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $section['icon'] ?>"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800"><?= htmlspecialchars($section['title']) ?></h2>
                </div>

                <ul class="space-y-4">
                    <?php foreach ($section['items'] as $item): ?>
                    <li class="flex gap-3">
                        <span class="w-1.5 h-1.5 <?= $c['dot'] ?> rounded-full flex-shrink-0 mt-2"></span>
                        <p class="text-gray-600 leading-relaxed"><?= htmlspecialchars($item) ?></p>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </section>
            <?php endforeach; ?>
        </div>

        <!-- CTA -->
        <div class="max-w-4xl mx-auto mt-12">
            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl p-10 text-center text-white">
                <h2 class="text-2xl font-bold mb-3">Остались вопросы?</h2>
                <p class="text-slate-300 mb-8">Администратор ответит на любые вопросы и поможет подобрать подходящее помещение.</p>
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="<?= e(bookingUrl()) ?>" target="_blank" rel="noopener" class="ms_booking inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3.5 rounded-lg font-semibold hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Забронировать онлайн
                    </a>
                    <a href="tel:+375291916311" class="inline-flex items-center gap-2 border-2 border-slate-500 text-white px-8 py-3.5 rounded-lg font-semibold hover:bg-slate-800/50 hover:border-slate-400 transition">
                        📞 +375 (29) 191-63-11
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/templates/footer.php'; ?>
<?php include __DIR__ . '/templates/footer-scripts.php'; ?>
</body>
</html>
