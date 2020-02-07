<?php
require_once 'data.php';
require_once 'functions.php';

$main_page = render('templates/main.php', ['lots' => $lots]);
$layout_page = render('templates/layout.php',
  [
    'title' => 'Главная - Yeticave',
    'is_auth' => $is_auth,
    'user_avatar' => $user_avatar,
    'user_name' => $user_name,
    'content' => $main_page,
    'categories' => $categories,
  ]
);

echo $layout_page;