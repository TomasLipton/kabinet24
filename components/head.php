<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - Кабинет24' : 'Кабинет24 - Почасовая аренда уютных и современных кабинетов и залов в центре Минска'; ?></title>
    <link rel="icon" type="image/png" href="/assets/logo.png">
    <meta name="description" content="<?php echo isset($pageDescription) ? $pageDescription : 'Почасовая аренда помещений в Минске для проведения консультаций, семинаров, тренингов, лекций. Рядом с метро Академия наук. Бесплатный Wi-Fi, чай, кофе, парковка.'; ?>">
    <meta name="keywords" content="аренда кабинета Минск, аренда помещений Минск, почасовая аренда, коворкинг Минск, аренда залов Минск, кабинет для консультаций, аренда офиса почасово, помещение для семинара, тренинг зал аренда, метро Академия наук">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Кабинет24">
    <meta name="theme-color" content="#2563eb">
    <link rel="canonical" href="https://kabinet24.by<?php echo isset($canonicalUrl) ? $canonicalUrl : '/'; ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://kabinet24.by<?php echo isset($canonicalUrl) ? $canonicalUrl : '/'; ?>">
    <meta property="og:title" content="<?php echo isset($pageTitle) ? $pageTitle . ' - Кабинет24' : 'Кабинет24 - Почасовая аренда уютных и современных кабинетов и залов в центре Минска'; ?>">
    <meta property="og:description" content="<?php echo isset($pageDescription) ? $pageDescription : 'Почасовая аренда помещений в Минске для проведения консультаций, семинаров, тренингов, лекций. Рядом с метро Академия наук. Бесплатный Wi-Fi, чай, кофе, парковка.'; ?>">
    <meta property="og:image" content="https://kabinet24.by/assets/logo.png">
    <meta property="og:site_name" content="Кабинет24">
    <meta property="og:locale" content="ru_RU">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://kabinet24.by<?php echo isset($canonicalUrl) ? $canonicalUrl : '/'; ?>">
    <meta name="twitter:title" content="<?php echo isset($pageTitle) ? $pageTitle . ' - Кабинет24' : 'Кабинет24 - Почасовая аренда уютных и современных кабинетов и залов в центре Минска'; ?>">
    <meta name="twitter:description" content="<?php echo isset($pageDescription) ? $pageDescription : 'Почасовая аренда помещений в Минске для проведения консультаций, семинаров, тренингов, лекций. Рядом с метро Академия наук. Бесплатный Wi-Fi, чай, кофе, парковка.'; ?>">
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
</head>
<body class="bg-gray-50">
