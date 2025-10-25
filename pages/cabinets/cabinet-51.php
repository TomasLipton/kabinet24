<?php
$cabinetData = [
    'number' => '51',
    'title' => 'Кабинет 51',
    'description' => 'Большой зал для масштабных мероприятий и групповых занятий',
    'category' => 'Большой Зал',
    'badge' => 'Большой Зал',
    'badgeColor' => 'emerald-500',
    'area' => '50',
    'capacity' => 'До 25 человек',
    'image' => '/assets/cabinet-51/img.png',
    'groupPricing' => [
        ['до 10 ч/нед', '27₽/ч'],
        ['более 10 ч/нед', '25₽/ч']
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
