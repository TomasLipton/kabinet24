<?php
$pageTitle = 'Контакты и бронирование';
$pageDescription = 'Контактная информация Кабинет24. Забронируйте кабинет или зал в Минске. Телефон, адрес, режим работы, как добраться.';
$canonicalUrl = '/contacts.php';
include $_SERVER['DOCUMENT_ROOT'] . '/components/head.php';
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/components/header.php'; ?>

<!-- Contacts Hero Section -->
<section class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Контакты и бронирование</h1>
            <p class="text-xl text-gray-300">Свяжитесь с нами удобным для вас способом</p>
        </div>
    </div>
</section>

<!-- Contacts Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 mb-16">

                <!-- Contact Information -->
                <div>
                    <h2 class="text-3xl font-bold mb-8 text-gray-800">Свяжитесь с нами</h2>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4 p-6 bg-blue-50 rounded-xl">
                            <div class="text-blue-600 mt-1">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2 text-gray-800">Телефон</h3>
                                <a href="tel:+375291916311" class="text-blue-600 hover:underline text-xl">+375 (29) 191-63-11</a>
                                <p class="text-gray-600 text-sm mt-2">Звоните с 08:00 до 22:00</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-6 bg-green-50 rounded-xl">
                            <div class="text-green-600 mt-1">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2 text-gray-800">Мессенджеры</h3>
                                <div class="space-y-2">
                                    <div>
                                        <a href="viber://chat?number=+375291916311" class="text-purple-600 hover:underline font-semibold">Viber</a>
                                    </div>
                                    <div>
                                        <a href="https://t.me/+375291916311" class="text-blue-600 hover:underline font-semibold" target="_blank">Telegram</a>
                                    </div>
                                </div>
                                <p class="text-gray-600 text-sm mt-2">Пишите нам в любое время</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-6 bg-orange-50 rounded-xl">
                            <div class="text-orange-600 mt-1">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2 text-gray-800">Адрес</h3>
                                <p class="text-gray-700 font-semibold">ул. Якуба Коласа 37</p>
                                <p class="text-gray-600">МЦ "Айсберг", Минск</p>
                                <p class="text-gray-600">🚇 м. Академия наук</p>
                                <a href="https://yandex.by/maps/-/CDd4bSHp" target="_blank" class="inline-block mt-3 text-blue-600 hover:underline font-semibold">
                                    Посмотреть на карте →
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-6 bg-slate-50 rounded-xl">
                            <div class="text-slate-600 mt-1">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg mb-2 text-gray-800">Режим работы</h3>
                                <p class="text-gray-700 font-semibold">Ежедневно: 08:00 - 22:00</p>
                                <p class="text-gray-600 text-sm mt-2">Без выходных</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Booking Form -->
                <div>
                    <h2 class="text-3xl font-bold mb-8 text-gray-800">Быстрая заявка</h2>
                    <div class="bg-gradient-to-br from-blue-50 to-slate-50 p-8 rounded-xl">
                        <p class="text-gray-700 mb-6">Оставьте заявку, и мы свяжемся с вами в ближайшее время для уточнения деталей бронирования.</p>

                        <form class="space-y-4" id="bookingForm">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Ваше имя *</label>
                                <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Иван">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Телефон *</label>
                                <input type="tel" name="phone" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="+375 (29) 123-45-67">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Предпочитаемый кабинет</label>
                                <select name="cabinet" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Пока не определился</option>
                                    <option value="37">Кабинет 37 (VIP, 32 м²)</option>
                                    <option value="28">Кабинет 28 (VIP, 21 м²)</option>
                                    <option value="51">Кабинет 51 (Большой зал, 50 м²)</option>
                                    <option value="38">Кабинет 38 (Зал, 35 м²)</option>
                                    <option value="27">Кабинет 27 (21 м²)</option>
                                    <option value="23">Кабинет 23 (21 м²)</option>
                                    <option value="9">Кабинет 9 (21 м²)</option>
                                    <option value="38-1">Кабинет 38.1 (13.5 м²)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Дата и время</label>
                                <input type="text" name="datetime" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Например: 15 декабря, 14:00-17:00">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Комментарий</label>
                                <textarea name="comment" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Дополнительные пожелания..."></textarea>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition text-lg">
                                Отправить заявку
                            </button>

                            <p class="text-sm text-gray-600 text-center">* Обязательные поля</p>
                        </form>

                        <div class="mt-6 p-4 bg-white rounded-lg border border-blue-200">
                            <p class="text-sm text-gray-600 text-center">
                                Или звоните напрямую: <a href="tel:+375291916311" class="text-blue-600 font-semibold hover:underline">+375 (29) 191-63-11</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold mb-8 text-gray-800 text-center">Как нас найти</h2>
                <div class="rounded-xl overflow-hidden shadow-lg" style="height: 450px;">
                    <iframe src="https://yandex.by/map-widget/v1/?um=constructor%3A12345&amp;source=constructor" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="mt-6 grid md:grid-cols-3 gap-6">
                    <div class="bg-blue-50 p-6 rounded-lg text-center">
                        <div class="text-3xl mb-2">🚇</div>
                        <h3 class="font-semibold text-lg mb-2">Метро</h3>
                        <p class="text-gray-600">5 минут пешком от ст. метро "Академия наук"</p>
                    </div>
                    <div class="bg-green-50 p-6 rounded-lg text-center">
                        <div class="text-3xl mb-2">🚗</div>
                        <h3 class="font-semibold text-lg mb-2">Парковка</h3>
                        <p class="text-gray-600">Бесплатная парковка для клиентов</p>
                    </div>
                    <div class="bg-orange-50 p-6 rounded-lg text-center">
                        <div class="text-3xl mb-2">🚌</div>
                        <h3 class="font-semibold text-lg mb-2">Транспорт</h3>
                        <p class="text-gray-600">Удобная транспортная развязка</p>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="bg-slate-50 p-8 rounded-xl">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Важная информация</h2>
                <div class="grid md:grid-cols-2 gap-6 text-gray-700">
                    <div>
                        <h3 class="font-semibold mb-3">✓ При бронировании</h3>
                        <ul class="space-y-2 text-sm">
                            <li>• Минимальное время аренды - 1 час</li>
                            <li>• Рекомендуем бронировать за 1-2 дня</li>
                            <li>• Возможна срочная аренда</li>
                            <li>• Гибкие условия для постоянных клиентов</li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-3">✓ В стоимость включено</h3>
                        <ul class="space-y-2 text-sm">
                            <li>• Бесплатный Wi-Fi</li>
                            <li>• Чай, кофе, вода</li>
                            <li>• Кондиционер</li>
                            <li>• Базовая мебель</li>
                        </ul>
                    </div>
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

    // Form submission handler (placeholder)
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Спасибо за заявку! Мы свяжемся с вами в ближайшее время.\n\nДля срочного бронирования звоните: +375 (29) 191-63-11');
        this.reset();
    });
</script>
</body>
</html>
