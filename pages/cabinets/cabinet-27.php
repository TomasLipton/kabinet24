<?php
$cabinetData = [
    'number' => '27',
    'title' => 'Кабинет 27',
    'description' => 'Комфортный кабинет для индивидуальной работы и небольших групп',
    'category' => 'Стандарт',
    'badge' => null,
    'badgeColor' => null,
    'area' => '21',
    'capacity' => 'До 10 человек',
    'image' => '/assets/cabinet-27/img.png',
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
