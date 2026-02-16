<footer class="bg-gray-800 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-2xl font-bold mb-4"><?= $t['site_name'] ?></h3>
                <p class="text-gray-400"><?= $t['footer_description'] ?></p>
                <p class="text-gray-400 mt-2"><?= $t['footer_near_metro'] ?></p>
            </div>
            <div>
                <h4 class="font-semibold mb-4"><?= $t['footer_quick_links'] ?></h4>
                <ul class="space-y-2">
                    <li><a href="<?= $langPrefix ?>/#about" class="text-gray-400 hover:text-white transition"><?= $t['nav_about'] ?></a></li>
                    <li><a href="<?= $langPrefix ?>/#offices" class="text-gray-400 hover:text-white transition"><?= $t['nav_offices'] ?></a></li>
                    <li><a href="<?= $langPrefix ?>/#amenities" class="text-gray-400 hover:text-white transition"><?= $t['nav_amenities'] ?></a></li>
                    <li><a href="<?= $langPrefix ?>/#contact" class="text-gray-400 hover:text-white transition"><?= $t['nav_contact'] ?></a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4"><?= $t['footer_contacts'] ?></h4>
                <ul class="space-y-2 text-gray-400">
                    <li>📞 +375 (29) 191-63-11</li>
                    <li><?= $t['footer_viber_telegram'] ?></li>
                    <li><?= $t['footer_address_short'] ?></li>
                    <li><?= $t['footer_metro'] ?></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; <?= date('Y') ?> <?= $t['footer_copyright'] ?></p>
            <p class="mt-4 text-xs text-gray-500">
                <?= $t['footer_legal'] ?>
            </p>
        </div>
    </div>
</footer>
