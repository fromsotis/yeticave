<?php
session_start();
require_once 'init.php';
require_once 'data.php';
require_once 'functions.php';
require_once 'user_init.php';

if (isset($user_data['id'])) {
  $query =
   "SELECT lots.id, lots.img, lots.title, users.contacts, categories.name, lots.date_expire, lots.winner, bets.price, bets.date_create
    FROM bets
    JOIN lots ON bets.lot_id = lots.id
    JOIN users ON bets.user_id = users.id
    JOIN categories ON lots.category_id = categories.id
    WHERE bets.user_id = {$user_data['id']};";
  $result = mysqli_query($link, $query) or die(mysqli_error($link));
  $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

  $menu_block = render('templates/menu.php', ['categories' => $categories]);
  $mylots_page = render('templates/my-lots.php', ['lots' => $lots, 'user_data' => $user_data, 'menu' => $menu_block]);
  $layout_page = render('templates/layout.php',
    [
      'title' => 'Мои ставки - Yeticave',
      'user_data' => $user_data,
      'content' => $mylots_page,
      'menu' => $menu_block
    ]
  );
  echo $layout_page;
} else {
    header("Location: login.php");
}

