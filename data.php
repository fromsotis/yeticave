<?php
// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

$is_auth = (bool) rand(0, 1);
$user_name = 'Алексей';
$user_avatar = 'img/user.jpg';
$categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];
$lots =
[
  [
    'title'=>'2014 Rossignol District Snowboard',
    'category'=>'Доски и лыжи',
    'price'=>'10999',
    'url_img'=>'img/lot-1.jpg'
  ],
  [
    'title'=>'DC Ply Mens 2016/2017 Snowboard',
    'category'=>'Доски и лыжи',
    'price'=>'15999',
    'url_img'=>'img/lot-2.jpg'
  ],
  [
    'title'=>'Крепление Union Contacts Pro 2015 года размер L/XL',
    'category'=>'Крепления',
    'price'=>'8000',
    'url_img'=>'img/lot-3.jpg'
  ],
  [
    'title'=>'Ботинки для сноуборда DC Mutiny Charocal',
    'category'=>'Ботинки',
    'price'=>'10999',
    'url_img'=>'img/lot-4.jpg'
  ],
  [
    'title'=>'Куртка для сноуборда DC Mutiny Charocal',
    'category'=>'Одежда',
    'price'=>'7500',
    'url_img'=>'img/lot-5.jpg'
  ],
  [
    'title'=>'Маска Oakley Canopy',
    'category'=>'Разное',
    'price'=>'5400',
    'url_img'=>'img/lot-6.jpg'
  ]
];
