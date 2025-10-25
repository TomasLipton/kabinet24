<?php
// Cabinet data structure:
// $cabinetData = [
//     'number' => '27',
//     'title' => 'Кабинет 27',
//     'description' => 'Комфортный кабинет для индивидуальной работы и небольших групп',
//     'category' => 'Стандарт',
//     'badge' => null, // or 'VIP', 'Зал', 'Большой Зал'
//     'badgeColor' => 'amber-500', // amber-500, blue-500, emerald-500
//     'area' => '21',
//     'capacity' => '10',
//     'image' => '/assets/cabinet-27/img.png',
//     'groupPricing' => [
//         ['до 10 ч/нед', '22₽/ч'],
//         ['более 10 ч/нед', '20₽/ч']
//     ],
//     'individualPricing' => [
//         ['до 10 ч/нед', '18₽/ч'],
//         ['более 10 ч/нед', '16₽/ч'],
//         ['11:00-16:00', '14₽/ч', 'emerald'],
//         ['18:00-20:00', '20₽/ч']
//     ]
// ];

$pageTitle = $cabinetData['title'];
$pageDescription = $cabinetData['title'] . ' площадью ' . $cabinetData['area'] . ' м² для аренды в Минске. Вместимость до ' . $cabinetData['capacity'] . ' человек.';
$canonicalUrl = '/pages/cabinets/cabinet-' . $cabinetData['number'] . '.php';
include $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/components/header.php'; ?>

<!-- Cabinet Hero Section -->
<section class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center gap-3 mb-4">
                <a href="/" class="text-slate-400 hover:text-white transition">Главная</a>
                <span class="text-slate-600">/</span>
                <span class="text-white"><?php echo $cabinetData['title']; ?></span>
            </div>
            <div class="flex items-center gap-4 mb-4">
                <h1 class="text-4xl md:text-5xl font-bold"><?php echo $cabinetData['title']; ?></h1>
                <?php if ($cabinetData['badge']): ?>
                <span class="bg-<?php echo $cabinetData['badgeColor']; ?> text-white px-4 py-2 rounded-full text-sm font-semibold"><?php echo $cabinetData['badge']; ?></span>
                <?php endif; ?>
            </div>
            <p class="text-xl text-gray-300"><?php echo $cabinetData['description']; ?></p>
        </div>
    </div>
</section>

<!-- Cabinet Details -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Image -->
                <div>
                    <div class="rounded-xl overflow-hidden shadow-lg">
                        <img src="<?php echo $cabinetData['image']; ?>" alt="<?php echo $cabinetData['title']; ?>" class="w-full h-auto object-cover">
                    </div>
                </div>

                <!-- Info -->
                <div>
                    <h2 class="text-3xl font-bold mb-6 text-gray-800">Характеристики</h2>
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center gap-4 p-4 bg-blue-50 rounded-lg">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5"></path>
                            </svg>
                            <div>
                                <div class="font-semibold text-gray-800">Площадь</div>
                                <div class="text-gray-600"><?php echo $cabinetData['area']; ?> м²</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-blue-50 rounded-lg">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <div>
                                <div class="font-semibold text-gray-800">Вместимость</div>
                                <div class="text-gray-600"><?php echo $cabinetData['capacity']; ?></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 bg-blue-50 rounded-lg">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                            <div>
                                <div class="font-semibold text-gray-800">Категория</div>
                                <div class="text-gray-600"><?php echo $cabinetData['category']; ?></div>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Стоимость аренды</h3>
                    <div class="bg-slate-50 p-6 rounded-xl mb-6">
                        <?php if ($cabinetData['groupPricing']): ?>
                        <div class="mb-4 pb-4 border-b border-slate-200">
                            <h4 class="font-semibold text-gray-700 mb-3">Групповая аренда</h4>
                            <div class="space-y-2">
                                <?php foreach ($cabinetData['groupPricing'] as $price): ?>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600"><?php echo $price[0]; ?></span>
                                    <span class="text-xl font-bold text-slate-800"><?php echo $price[1]; ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ($cabinetData['individualPricing']): ?>
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-3">Индивидуальная аренда</h4>
                            <div class="space-y-2">
                                <?php foreach ($cabinetData['individualPricing'] as $price): ?>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600"><?php echo $price[0]; ?></span>
                                    <span class="text-xl font-bold <?php echo isset($price[2]) && $price[2] === 'emerald' ? 'text-emerald-600' : 'text-slate-800'; ?>"><?php echo $price[1]; ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <a href="/contacts.php" class="block w-full bg-blue-600 text-white text-center px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition text-lg">
                        Забронировать кабинет
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Что входит в аренду</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="text-blue-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Бесплатный Wi-Fi</h3>
                    <p class="text-gray-600">Высокоскоростной интернет</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="text-blue-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Кондиционер</h3>
                    <p class="text-gray-600">Комфортная температура</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="text-blue-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Чай и кофе</h3>
                    <p class="text-gray-600">Бесплатно для гостей</p>
                </div>
            </div>
            <div class="mt-8 bg-blue-50 border-l-4 border-blue-400 p-6 rounded">
                <p class="text-gray-700">
                    <strong>Дополнительное оборудование:</strong> Проектор, флипчарт, кушетка - 2₽/час
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Suitable For Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Подходит для</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center p-6">
                    <div class="text-4xl mb-4">💼</div>
                    <h3 class="font-semibold text-lg mb-2">Консультаций</h3>
                    <p class="text-gray-600 text-sm">Индивидуальные сеансы</p>
                </div>
                <div class="text-center p-6">
                    <div class="text-4xl mb-4">👥</div>
                    <h3 class="font-semibold text-lg mb-2">Групповой работы</h3>
                    <p class="text-gray-600 text-sm">Командные сессии</p>
                </div>
                <div class="text-center p-6">
                    <div class="text-4xl mb-4">🎓</div>
                    <h3 class="font-semibold text-lg mb-2">Тренингов</h3>
                    <p class="text-gray-600 text-sm">Обучающие программы</p>
                </div>
                <div class="text-center p-6">
                    <div class="text-4xl mb-4">🧘</div>
                    <h3 class="font-semibold text-lg mb-2">Практик</h3>
                    <p class="text-gray-600 text-sm">Йога, медитации</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Other Cabinets Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Другие кабинеты</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <a href="/pages/cabinets/cabinet-37.php" class="office-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition block">
                    <div class="h-48 bg-gradient-to-br from-slate-200 to-slate-300 relative">
                        <span class="absolute top-3 right-3 bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-semibold">VIP</span>
                        <img src="/assets/cabinet-37/img.png" alt="Кабинет 37" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">Кабинет 37</h3>
                        <p class="text-gray-600 text-sm">32 м² • до 15 человек</p>
                        <p class="text-blue-600 font-semibold mt-2">от 25₽/ч</p>
                    </div>
                </a>
                <a href="/pages/cabinets/cabinet-51.php" class="office-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition block">
                    <div class="h-48 bg-gradient-to-br from-slate-200 to-slate-300 relative">
                        <span class="absolute top-3 right-3 bg-emerald-500 text-white px-3 py-1 rounded-full text-xs font-semibold">Большой Зал</span>
                        <img src="/assets/cabinet-51/img.png" alt="Кабинет 51" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">Кабинет 51</h3>
                        <p class="text-gray-600 text-sm">50 м² • до 25 человек</p>
                        <p class="text-blue-600 font-semibold mt-2">от 14₽/ч</p>
                    </div>
                </a>
                <a href="/pages/cabinets/cabinet-38.php" class="office-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition block">
                    <div class="h-48 bg-gradient-to-br from-slate-200 to-slate-300 relative">
                        <span class="absolute top-3 right-3 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold">Зал</span>
                        <img src="/assets/cabinet-38/img.png" alt="Кабинет 38" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2">Кабинет 38</h3>
                        <p class="text-gray-600 text-sm">35 м² • до 20 человек</p>
                        <p class="text-blue-600 font-semibold mt-2">от 14₽/ч</p>
                    </div>
                </a>
            </div>
            <div class="text-center mt-8">
                <a href="/#offices" class="inline-block bg-slate-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-slate-700 transition">
                    Посмотреть все кабинеты
                </a>
            </div>
        </div>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/components/footer.php'; ?>

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
</body>
</html>
