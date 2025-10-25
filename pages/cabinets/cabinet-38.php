<?php
$cabinetData = [
    'number' => '38',
    'title' => 'Кабинет 38',
    'description' => 'Просторный зал для тренингов и семинаров',
    'category' => 'Зал',
    'badge' => 'Зал',
    'badgeColor' => 'blue-500',
    'area' => '35',
    'capacity' => 'До 20 человек',
    'image' => '/assets/cabinet-38/img.png',
    'groupPricing' => [
        ['до 10 ч/нед', '24₽/ч'],
        ['более 10 ч/нед', '22₽/ч']
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
