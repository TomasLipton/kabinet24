<?php
$pageTitle = 'Часто задаваемые вопросы (FAQ)';
$pageDescription = 'Ответы на часто задаваемые вопросы об аренде кабинетов и залов в Кабинет24. Узнайте о бронировании, оплате, условиях аренды.';
$canonicalUrl = '/faq.php';
include $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/components/header.php'; ?>

<!-- FAQ Hero Section -->
<section class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Часто задаваемые вопросы</h1>
            <p class="text-xl text-gray-300">Ответы на популярные вопросы о нашем сервисе</p>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">

            <!-- О бронировании -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">О бронировании</h2>

                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Как забронировать кабинет?</h3>
                        <p class="text-gray-600">Вы можете забронировать кабинет по телефону +375 (29) 191-63-11, через Viber или Telegram. Также вы можете оставить заявку через форму на сайте, и мы свяжемся с вами в ближайшее время.</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">За какое время нужно бронировать?</h3>
                        <p class="text-gray-600">Мы рекомендуем бронировать за 1-2 дня, но возможна и срочная аренда при наличии свободных помещений. Позвоните нам, и мы подберем для вас подходящий вариант.</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Минимальное время аренды?</h3>
                        <p class="text-gray-600">Минимальное время аренды - 1 час. Вы можете арендовать кабинет на любое количество часов в пределах нашего графика работы с 08:00 до 22:00.</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Можно ли отменить или перенести бронь?</h3>
                        <p class="text-gray-600">Да, вы можете отменить или перенести бронирование. Просим уведомлять нас об изменениях как минимум за 24 часа до начала аренды.</p>
                    </div>
                </div>
            </div>

            <!-- Об оплате -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">Об оплате</h2>

                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Какие способы оплаты принимаются?</h3>
                        <p class="text-gray-600">Мы принимаем наличные и безналичную оплату (банковский перевод, карты). Оплата производится по факту аренды или предоплата при долгосрочной аренде.</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Предоставляете ли вы документы об оплате?</h3>
                        <p class="text-gray-600">Да, мы предоставляем все необходимые документы: чеки, договоры аренды, счета-фактуры для юридических лиц.</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Есть ли скидки при долгосрочной аренде?</h3>
                        <p class="text-gray-600">Да, при аренде более 10 часов в неделю действует скидка. Также у нас есть специальные тарифы для постоянных клиентов. Подробности уточняйте по телефону.</p>
                    </div>
                </div>
            </div>

            <!-- О помещениях -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">О помещениях</h2>

                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Что входит в стоимость аренды?</h3>
                        <p class="text-gray-600 mb-3">В стоимость аренды включено:</p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>Бесплатный Wi-Fi</li>
                            <li>Кондиционер</li>
                            <li>Чай, кофе, вода</li>
                            <li>Базовая мебель (столы, стулья)</li>
                            <li>Бесплатная парковка</li>
                        </ul>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Какое дополнительное оборудование можно арендовать?</h3>
                        <p class="text-gray-600 mb-3">Дополнительное оборудование (2₽/час):</p>
                        <ul class="list-disc list-inside text-gray-600 space-y-2">
                            <li>Проектор с экраном</li>
                            <li>Флипчарт с маркерами</li>
                            <li>Массажная кушетка</li>
                            <li>Коврики для йоги</li>
                            <li>Песочница для песочной терапии</li>
                        </ul>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Можно ли принести свое оборудование?</h3>
                        <p class="text-gray-600">Да, вы можете использовать собственное оборудование. В кабинетах есть розетки и все необходимые условия для комфортной работы.</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Есть ли парковка?</h3>
                        <p class="text-gray-600">Да, рядом с МЦ "Айсберг" есть бесплатная парковка для наших клиентов. Также удобная транспортная развязка - рядом станция метро "Академия наук".</p>
                    </div>
                </div>
            </div>

            <!-- О правилах -->
            <div class="mb-12">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">О правилах использования</h2>

                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Можно ли приводить гостей?</h3>
                        <p class="text-gray-600">Да, вы можете приводить гостей в соответствии с вместимостью выбранного кабинета. Убедитесь, что количество участников соответствует указанным нормам.</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Можно ли проводить шумные мероприятия?</h3>
                        <p class="text-gray-600">Просим соблюдать комфортный уровень шума, чтобы не мешать другим арендаторам. Для мероприятий с музыкой лучше выбирать большие залы с хорошей звукоизоляцией.</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Можно ли курить в помещении?</h3>
                        <p class="text-gray-600">Нет, курение в помещениях запрещено. Для курения предусмотрены специальные зоны на улице.</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-xl font-semibold mb-3 text-gray-800">Можно ли принести еду и напитки?</h3>
                        <p class="text-gray-600">Да, вы можете приносить свои напитки и легкие закуски. Рядом с центром есть кафе и магазины.</p>
                    </div>
                </div>
            </div>

            <!-- Контакты для вопросов -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-6 rounded">
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Не нашли ответ на свой вопрос?</h3>
                <p class="text-gray-600 mb-4">Свяжитесь с нами удобным для вас способом:</p>
                <div class="space-y-2 text-gray-700">
                    <p>📞 Телефон: <a href="tel:+375291916311" class="text-blue-600 hover:underline">+375 (29) 191-63-11</a></p>
                    <p>💬 Viber / Telegram: <a href="https://t.me/+375291916311" class="text-blue-600 hover:underline">+375 (29) 191-63-11</a></p>
                    <p>📍 Адрес: ул. Якуба Коласа 37, МЦ "Айсберг", Минск</p>
                </div>
                <div class="mt-4">
                    <a href="/contacts.php" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Связаться с нами
                    </a>
                </div>
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
