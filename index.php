<?php
require_once 'init.php';
require_once 'data.php';
require_once 'functions.php';

session_start();
require_once 'user_init.php';

$query = "SELECT date_create, title, img, price, date_expire, categories.name
FROM lots
INNER JOIN categories ON lots.category_id = categories.id
WHERE date_expire > CURRENT_TIME()
ORDER BY date_create ASC";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

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