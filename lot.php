<?php
session_start();
require_once 'init.php';
require_once 'data.php';
require_once 'functions.php';
require_once 'user_init.php';

$menu_block = render('templates/menu.php', ['categories' => $categories]);

if (isset($_GET['id'])) {
  $id = clearInt($_GET['id']);
  // Выводим из БД историю последних 10 ставок
  // 19.03.17 в 13:20
  $query = 
      "SELECT bets.date_create AS date_create, bets.price, users.name
      FROM bets
      JOIN users ON bets.user_id = users.id
      WHERE lot_id = $id ORDER BY bets.date_create DESC LIMIT 10";
  $result = mysqli_query($link, $query) or die(mysqli_error($link));
  $betsHistory = mysqli_fetch_all($result, MYSQLI_ASSOC);
  // Проверяем если в bets ставки с данным $id лота
  // Это необходимо для того чтобы отображать минимальную ставку начальная цена + шаг ставки
  // или если ставка уже есть то существующая ставка + шаг ставки
  // Если ставок на лот несколько то они сортируются по убыванию и бертся первая ставка + шаг
  $query = "SELECT price FROM bets WHERE lot_id = $id ORDER BY price DESC";
  $result = mysqli_query($link, $query) or die(mysqli_error($link));
  $bets = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Делаем выборку из таблицы lots по id, а категорию берем из таблицы categories по lots.category_id
  if (!$bets) {
    // если в bets еще нет ставки на данный лот то min_price = lots.price + lots.step
    $query =
        "SELECT lots.id, title, description, img, lots.price AS curr_price, date_expire, step, (lots.price + step) AS min_price, categories.name AS cat_name
        FROM lots
        JOIN categories ON lots.category_id = categories.id
        WHERE lots.id = $id AND date_expire > CURRENT_TIME()";
  } else {
    // если в bets уже есть ставка на данный лот то min_price = bets.price + lots.step
      $maxBet = $bets[0]['price'];
      $query =
          "SELECT lots.id, title, description, img, $maxBet AS curr_price, date_expire, step, ($maxBet + step) AS min_price, categories.name AS cat_name
          FROM lots
          JOIN categories ON lots.category_id = categories.id
          JOIN bets ON lots.id = bets.lot_id
          WHERE lots.id = $id AND date_expire > CURRENT_TIME()";
    }
  $result = mysqli_query($link, $query) or die(mysqli_error($link));
  $lots = mysqli_fetch_assoc($result);

  // если в бд нет лота с переданным id то 404.php
  if (!$lots) {
    http_response_code(404);
    $title = '404: Страница не найдена';
    $content_page = render('templates/404.php', ['menu' => $menu_block]);
  } else {
  //Сохраняем id просмотренного лота в cookies для history.php
    if (empty($_COOKIE['lots-id'])) {
      $ids[] = $id;
    } else {
        $ids = json_decode($_COOKIE['lots-id']);
        if (!in_array($id, $ids)) {
          $ids[] = $id;
        }
  }
      setcookie('lots-id', json_encode($ids));
      /// ********************************************************

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (
            $_POST['cost'] !== '' and
            filter_var($_POST['cost'], FILTER_VALIDATE_INT) and
            $_POST['cost'] >= $lots['min_price']
          ) {
          $price = clearInt($_POST['cost']);
          $user_id = $user_data['id'];
          $lot_id = $lots['id'];
          $query = "INSERT INTO bets (price, user_id, lot_id) VALUES ('$price', '$user_id', '$lot_id')";
          mysqli_query($link, $query) or die(mysqli_error($link));
          // После сохранения ставки выполняем переадресацию на страницу просмотра лота,
          // чтобы избежать повторного добавления при обновлении страницы.
          // "Location: /lot.php?id=5"
          header("Location: {$_SERVER['PHP_SELF']}?id=$lot_id");
        }
      }

      $title = $lots['title'];
      $content_page = render('templates/lot.php',
        [
          'user_data' => $user_data,
          'menu' => $menu_block,
          'lots' => $lots,
          'betsHistory' => $betsHistory
        ]
      );
  }
}

$layout_page = render('templates/layout.php',
  [
    'title' => $title,
    'user_data' => $user_data,
    'content' => $content_page,
    'menu' => $menu_block
  ]
);

echo $layout_page;