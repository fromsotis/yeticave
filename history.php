<?php
require_once 'init.php';
require_once 'data.php';
require_once 'functions.php';

session_start();
require_once 'user_init.php';

$ids = isset($_COOKIE['lots-id']) ? json_decode($_COOKIE['lots-id']) : [];

$menu_block = render('templates/menu.php', ['categories' => $categories]);

$history_page = render('templates/history.php',
  [
    'menu' => $menu_block,
    'ids' => $ids,
    'lots' => $lots
  ]);

$layout_page = render('templates/layout.php',
  [
    'title' => 'История просмотров - Yeticave',
    'user_data' => $user_data,
    'content' => $history_page,
    'menu' => $menu_block
  ]
);

echo $layout_page;