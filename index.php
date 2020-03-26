<?php
require_once 'init.php';
require_once 'data.php';
require_once 'functions.php';

session_start();
require_once 'user_init.php';

$menu_block = render('templates/menu.php', ['categories' => $categories]);
$main_page = render('templates/main.php', ['lots' => $lots]);
$layout_page = render('templates/layout.php',
  [
    'title' => 'Главная - Yeticave',
    'user_data' => $user_data,
    'content' => $main_page,
    'menu' => $menu_block
  ]
);

echo $layout_page;