<?php
$cabinetData = [
    'number' => '9',
    'title' => 'Кабинет 9',
    'description' => 'Удобный кабинет для работы и встреч',
    'category' => 'Стандарт',
    'badge' => null,
    'badgeColor' => null,
    'area' => '21',
    'capacity' => 'До 8 человек',
    'image' => '/assets/cabinet-9/img.png',
    'groupPricing' => [
        ['до 10 ч/нед', '22₽/ч'],
        ['более 10 ч/нед', '20₽/ч']
    ],
    'individualPricing' => [
        ['до 10 ч/нед', '18₽/ч'],
        ['более 10 ч/нед', '16₽/ч'],
        ['11:00-16:00', '14₽/ч', 'emerald'],
        ['18:00-20:00', '20₽/ч']
    ]
];
include $_SERVER['DOCUMENT_ROOT'] . '/components/cabinet-template.php';
?>
