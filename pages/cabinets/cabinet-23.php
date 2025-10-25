<?php
$cabinetData = [
    'number' => '23',
    'title' => 'Кабинет 23',
    'description' => 'Уютный кабинет для консультаций и занятий',
    'category' => 'Стандарт',
    'badge' => null,
    'badgeColor' => null,
    'area' => '21',
    'capacity' => 'До 8 человек',
    'image' => '/assets/cabinet-23/img.png',
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
