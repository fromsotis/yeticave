<?php
session_start();
require_once 'init.php';
require_once 'data.php';
require_once 'functions.php';
require_once 'user_init.php';

$ids = isset($_COOKIE['lots-id']) ? json_decode($_COOKIE['lots-id']) : [];
if (!count($ids)) {
  header("Location: index.php");
} else {
    $curPage = isset($_GET['page']) ? $_GET['page'] : 1; // номер страницы, для ссылки
    $pageItems = 3; // сколько лотов отображать на странице
    $offSet = ($curPage - 1) * $pageItems; // с какого лота отображать на странице
    $ids = implode(', ',$ids);
    $query =
            "SELECT
                  lots.id,
                  date_create,
                  title,
                  img,
                  price,
                  date_expire,
                  categories.name,
                  (SELECT COUNT(*) FROM bets WHERE lot_id = lots.id) AS bets_count,
                  (SELECT price FROM bets WHERE lot_id = lots.id ORDER BY price DESC LIMIT 1) AS bets_price
            FROM lots
            INNER JOIN categories ON lots.category_id = categories.id
            WHERE lots.id IN ($ids) AND date_expire > CURRENT_TIME()
            ORDER BY date_create ASC -- ORDER BY lots.date_expire -- без ORDER BY вывод лотов рандомно дублируется, так как в бд порядка нет offset может брать повторяющийся лот
            LIMIT $pageItems
            OFFSET $offSet";

    $result = mysqli_query($link, $query);
    $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $query = "SELECT COUNT(*) AS count FROM lots WHERE lots.id IN ($ids) AND date_expire > CURRENT_TIME()";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    // получаем кол-во лотов = 6
    $count = mysqli_fetch_assoc($result)['count'];
    // кол-во страниц с лотами (ceil - округляем в большую сторону) 7 / 3 = 2.33 ceil округлит до 3
    $pageCount = ceil($count / $pageItems); // 3
    // создаем массив страниц для foreach
    $pages = range(1, $pageCount);

    $menu_block = render('templates/menu.php', ['categories' => $categories]);
    $content_page = render('templates/history.php',
      [
        'menu' => $menu_block,
        'lots' => $lots,
        'curPage' => $curPage,
        'pageCount' => $pageCount,
        'pages' => $pages
      ]);

    $layout_page = render('templates/layout.php',
      [
        'title' => 'История просмотров - Yeticave',
        'user_data' => $user_data,
        'content' => $content_page,
        'menu' => $menu_block
      ]
    );

    echo $layout_page;
}