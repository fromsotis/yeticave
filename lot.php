<?php
require_once 'data.php';
require_once 'functions.php';

session_start();

$id = null;

if (isset($_GET['id'])) {
  foreach ($lots as $key => $lot) {
    if ($_GET['id'] == $key) {
      $id = $key;
      break;
    }
  }
}


$menu_block = render('templates/menu.php', ['categories' => $categories]);

if ($id === null) {
  http_response_code(404);
  $title = '404: Страница не найдена';
  $content_page = render('templates/404.php', ['menu' => $menu_block]);
} else {

    ///Сохраняем id просмотренного лота в cookies
    if (empty($_COOKIE['lots-id'])) {
      $ids[] = $id;
    } else {
        $ids = json_decode($_COOKIE['lots-id']);
        if (!in_array($id, $ids)) {
          $ids[] = $id;
        }
    }
    setcookie('lots-id', json_encode($ids));
    ///

    $title = $lots[$id]['title'];
    $content_page = render('templates/lot.php',
      [
        'id' => $id,
        'menu' => $menu_block,
        'lots' => $lots
      ]
    );
}

$layout_page = render('templates/layout.php',
  [
    'title' => $title,
    'user_avatar' => $user_avatar,
    'content' => $content_page,
    'menu' => $menu_block
  ]
);

echo $layout_page;