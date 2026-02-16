<?php
// Determine language from URL prefix
$lang = (strpos($_SERVER['REQUEST_URI'], '/en/') === 0 || $_SERVER['REQUEST_URI'] === '/en') ? 'en' : 'ru';
$t = require __DIR__ . "/{$lang}.php";
$langPrefix = $lang === 'en' ? '/en' : '';
$ogLocale = $lang === 'en' ? 'en_US' : 'ru_RU';
$cabinetsDataDir = $lang === 'en' ? __DIR__ . '/../data/cabinets/en/' : __DIR__ . '/../data/cabinets/';
