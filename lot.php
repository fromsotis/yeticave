<?php
require_once 'data.php';
require_once 'functions.php';

$id = null;

if (isset($_GET['id'])) {
  foreach ($lots as $key => $lot) {
    if ($_GET['id'] == $key) {
      $id = $key;
      break;
    }
  }
}

if ($id === null) {
  http_response_code(404);
  $error_page = render('templates/404.php', ['categories' => $categories]);
  $layout_page = render('templates/layout.php',
    [
      'title' => '404: Страница не найдена',
      'is_auth' => $is_auth,
      'user_avatar' => $user_avatar,
      'user_name' => $user_name,
      'content' => $error_page,
      'categories' => $categories,
    ]
  );
} else {
    $lot_page = render('templates/lot.php',
      [
        'id' => $id,
        'categories' => $categories,
        'lots' => $lots
      ]
    );

    $layout_page = render('templates/layout.php',
      [
        'title' => $lots[$id]['title'],
        'is_auth' => $is_auth,
        'user_avatar' => $user_avatar,
        'user_name' => $user_name,
        'content' => $lot_page,
        'categories' => $categories,
      ]
    );
}

echo $layout_page;