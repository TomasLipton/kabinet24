<footer class="bg-gray-800 text-white pt-8 pb-24">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-2xl font-bold mb-4">Кабинет24</h3>
                <p class="text-gray-400">Почасовая аренда уютных кабинетов и залов в центре Минска</p>
                <p class="text-gray-400 mt-2">Рядом с метро Академия наук</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Быстрые ссылки</h4>
                <ul class="space-y-2">
                    <li><a href="/#about" class="text-gray-400 hover:text-white transition">О нас</a></li>
                    <li><a href="/#offices" class="text-gray-400 hover:text-white transition">Кабинеты</a></li>
                    <li><a href="/#amenities" class="text-gray-400 hover:text-white transition">Удобства</a></li>
                    <li><a href="/pravila-arendy" class="text-gray-400 hover:text-white transition">Правила аренды</a></li>
                    <li>
                        <a href="/assets/price-list-2026-from-may-1.pdf" target="_blank" rel="noopener" class="text-gray-400 hover:text-white transition inline-flex items-center gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Прейскурант (PDF)
                        </a>
                    </li>
                    <li>
                        <a href="/assets/rental-agreement.pdf" target="_blank" rel="noopener" class="text-gray-400 hover:text-white transition inline-flex items-center gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Договор аренды (публичная оферта) (PDF)
                        </a>
                    </li>
                    <li>
                        <a href="/assets/privacy-policy.pdf" target="_blank" rel="noopener" class="text-gray-400 hover:text-white transition inline-flex items-center gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Политика конфиденциальности (PDF)
                        </a>
                    </li>
                    <li>
                        <a href="/assets/cookie-policy.pdf" target="_blank" rel="noopener" class="text-gray-400 hover:text-white transition inline-flex items-center gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Политика обработки cookie (PDF)
                        </a>
                    </li>
                    <li><a href="/#contact" class="text-gray-400 hover:text-white transition">Контакты</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Контакты</h4>
                <ul class="space-y-2 text-gray-400">
                    <li>+375 (29) 191-63-11</li>
                    <li>
                        <a href="viber://chat?number=%2B375291916311" class="text-gray-300 underline hover:text-white transition">Viber</a>
                        <span aria-hidden="true"> / </span>
                        <a href="https://t.me/psychoanalitik_by" target="_blank" rel="noopener" class="text-gray-300 underline hover:text-white transition">Telegram</a>
                    </li>
                    <li>ул. Якуба Коласа, 37, МЦ «Айсберг»</li>
                    <li>м. Академия наук</li>
                    <li>Ежедневно <?= e(openingHoursText()) ?></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; <?= date('Y') ?> Кабинет24. Все права защищены.</p>
            <p class="mt-4 text-xs text-gray-500">
                ИП Яковенко С.В. УНП 693307597 · Свидетельство № 0936061 от 6 января 2026 года<br>
                Адрес: Минская обл. Смолевический район д. Ляды, пер. 1-й Первомайский 5 · Время работы: <?= e(openingHoursText()) ?>
            </p>
        </div>
    </div>
</footer>
