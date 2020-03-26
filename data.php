<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

date_default_timezone_set('Asia/Vladivostok');

// ставки пользователей, которыми надо заполнить таблицу
// $bets = [
//     ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
//     ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
//     ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
//     ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
// ];

//$user_avatar = 'img/user.jpg';

//$categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];

$query = "SELECT name FROM categories";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
$lots =
[
  [
    'title'=>'2014 Rossignol District Snowboard',
    'category'=>'Доски и лыжи',
    'price'=>'10999',
    'url_img'=>'img/lot-1.jpg',
    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed nisi lacus sed viverra tellus in hac habitasse platea. Urna cursus eget nunc scelerisque viverra. Sed sed risus pretium quam vulputate dignissim suspendisse. Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.'
  ],
  [
    'title'=>'DC Ply Mens 2016/2017 Snowboard',
    'category'=>'Доски и лыжи',
    'price'=>'15999',
    'url_img'=>'img/lot-2.jpg',
    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed nisi lacus sed viverra tellus in hac habitasse platea. Urna cursus eget nunc scelerisque viverra. Sed sed risus pretium quam vulputate dignissim suspendisse. Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.'

  ],
  [
    'title'=>'Крепление Union Contacts Pro 2015 года размер L/XL',
    'category'=>'Крепления',
    'price'=>'8000',
    'url_img'=>'img/lot-3.jpg',
    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed nisi lacus sed viverra tellus in hac habitasse platea. Urna cursus eget nunc scelerisque viverra. Sed sed risus pretium quam vulputate dignissim suspendisse. Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.'

  ],
  [
    'title'=>'Ботинки для сноуборда DC Mutiny Charocal',
    'category'=>'Ботинки',
    'price'=>'10999',
    'url_img'=>'img/lot-4.jpg',
    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed nisi lacus sed viverra tellus in hac habitasse platea. Urna cursus eget nunc scelerisque viverra. Sed sed risus pretium quam vulputate dignissim suspendisse. Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.'
  ],
  [
    'title'=>'Куртка для сноуборда DC Mutiny Charocal',
    'category'=>'Одежда',
    'price'=>'7500',
    'url_img'=>'img/lot-5.jpg',
    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed nisi lacus sed viverra tellus in hac habitasse platea. Urna cursus eget nunc scelerisque viverra. Sed sed risus pretium quam vulputate dignissim suspendisse. Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.'
  ],
  [
    'title'=>'Маска Oakley Canopy',
    'category'=>'Разное',
    'price'=>'5400',
    'url_img'=>'img/lot-6.jpg',
    'description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed nisi lacus sed viverra tellus in hac habitasse platea. Urna cursus eget nunc scelerisque viverra. Sed sed risus pretium quam vulputate dignissim suspendisse. Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.'
  ]
];