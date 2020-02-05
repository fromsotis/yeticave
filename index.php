<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

date_default_timezone_set('Asia/Vladivostok');

require_once 'data.php';
require_once 'functions.php';

$main = render('templates/main.php', ['lots' => $lots]);
$layout = render('templates/layout.php',
  [
    'title' => 'Главная - Yeticave',
    'is_auth' => $is_auth,
    'user_avatar' => $user_avatar,
    'user_name' => $user_name,
    'content' => $main,
    'categories' => $categories,
  ]
);

echo $layout;