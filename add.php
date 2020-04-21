<?php
session_start();
require_once 'init.php';
require_once 'data.php';
require_once 'functions.php';
require_once 'user_init.php';

if ($user_data['id'] === null) {
  // запишем в cookie адрес куда шли до login.php ('ref' => string '/add.php')
  setcookie('ref', "{$_SERVER['REQUEST_URI']}");
  header("Location: login.php");
} else {
    $menu_block = render('templates/menu.php', ['categories' => $categories]);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // *** ПРОВЕРКА ПОЛЕЙ НА ЗАПОЛНЕНОСТЬ ***
      $required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
      $errors = [];
      foreach ($_POST as $key => $value) {
        if (in_array($key, $required)) {
          if (!$value) {
            //$errors[$dict[$key]] = 'Это поле надо заполнить';
            if ($key === 'lot-name') {
              $errors[$key] = 'Введите наименование лота';
            }
            if ($key === 'message') {
              $errors[$key] = 'Напишите описание лота';
            }
            if ($key === 'lot-rate') {
              $errors[$key] = 'Введите начальную цену';
            }
            if ($key === 'lot-step') {
              $errors[$key] = 'Введите шаг ставки';
            }
            if ($key === 'lot-date') {
              $errors[$key] = 'Введите дату завершения торгов';
            }
          } else {
              // Проверка на корректность заполнения поля
              if ($key === 'lot-rate') {
                if (!filter_var($value, FILTER_VALIDATE_INT)) {
                  $errors[$key] = 'Начальная цена должна быть числом';
                }
              }
              if ($key === 'lot-step') {
                if (!filter_var($value, FILTER_VALIDATE_INT)) {
                  $errors[$key] = 'Шаг ставки должен быть числом';
                }
              }
              if ($key === 'lot-date') {
                if (strtotime($_POST['lot-date']) < time()) {
                  $errors[$key] = 'Дата окончания лота должна быть больше текущей даты';
                }
              }
            }// *** ***
        }
      }
      // *** ***
      // Отдельное условие для записи ошибки
      // т.к. по умолчанию value="Выберите категорию"
      if ($_POST['category'] === 'Выберите категорию') {
        $errors['category'] = 'Выберите категорию';
      }
      // *** ПРОВЕРКА ФАЙЛА ***
      if (!empty($_FILES['lot-img']['name'])) {
        $file_name = $_FILES['lot-img']['name'];
        $tmp_name = $_FILES['lot-img']['tmp_name'];
        $file_size = $_FILES['lot-img']['size'];
        
        // без этого условия, при загрузке файла больше 2 мб будет
        // Warning: finfo_file(): Empty filename or path on line ...
        if (!empty($_FILES['lot-img']['type'])) {
          $finfo = finfo_open(FILEINFO_MIME_TYPE);
          $file_mime = finfo_file($finfo, $tmp_name);
        }

        $file_error = $_FILES['lot-img']['error'];
        if ($file_error !== UPLOAD_ERR_OK) {
          $errors['file'] = 'Не удалось загрузить файл, размер не должен привышат 2мб';
        } elseif ($file_mime !== 'image/jpeg' and $file_mime !== 'image/jpg' and $file_mime !== 'image/png') {
            $errors['file'] = "Изображение должно быть в формате JPG";
        } else {
            move_uploaded_file($tmp_name, 'uploads/'.$file_name);
            $_POST['file_name'] = $file_name;
        }
      } else {
          $errors['file'] = 'Вы не загрузили файл';
      }
      // *** ПРОВЕРКА ФАЙЛА ***
      if (count($errors)) {
        $title = 'Добавление лота - Yeticave';
        $content_page = render('templates/add.php',
          [
            'menu' => $menu_block,
            'errors' => $errors,
            'lots' => $_POST
          ]);
      } else {
          // mysqli_real_escape_string запишет в базу \' или \r если ввести в форме!!!
          $lotName = clearStr(mysqli_real_escape_string($link, $_POST['lot-name']));
          $lotMessage = clearStr(mysqli_real_escape_string($link, $_POST['message']));
          $img = "uploads/$file_name";
          $lotRate = clearInt($_POST['lot-rate']);
          $lotDateExpire = $_POST['lot-date'];
          $lotStep = clearInt($_POST['lot-step']);
          $userId = $user_data['id']; // id текущего пользователя берем в user_init.php
         
          // Получаеи id категории по названию категории (для записи в yeticave.lots -> category_id)
          $lotCategory = $_POST['category'];
          $query = "SELECT id FROM categories WHERE name = '$lotCategory'";
          $result = mysqli_query($link, $query);
          $categoryId = mysqli_fetch_assoc($result)['id'];

          // Пишем новый лот в базу
          $query = "INSERT INTO lots (title, description, img, price, date_expire, step, user_id, category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
          $stmt = mysqli_prepare($link, $query);
          mysqli_stmt_bind_param($stmt, "sssisiii", $lotName, $lotMessage, $img, $lotRate, $lotDateExpire, $lotStep, $userId, $categoryId);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);

          ### Выбираем только что записанный новый лот из бд и передаем массив $lots в шаблон lot.php ###
          // Получаем id только что сохраненого лота в бд (работает только сразу после INSERT)
          $id = mysqli_insert_id($link);

          // Делаем выборку из таблицы lots по id, а категорию берем из таблицы categories по lots.category_id
          // $query = "
          //   SELECT title, description, img, price, date_expire, step, (price + step) AS min_price, categories.name AS cat_name
          //   FROM lots
          //   JOIN categories ON lots.category_id = categories.id
          //   WHERE lots.id = $id";
          $query =
             "SELECT lots.id, title, description, img, lots.price AS curr_price, date_expire, step, (lots.price + step) AS min_price, categories.name AS cat_name
              FROM lots
              JOIN categories ON lots.category_id = categories.id
              WHERE lots.id = $id";
          $result = mysqli_query($link, $query) or die(mysqli_error($link));
          $lots = mysqli_fetch_assoc($result);
          
          $title = "Новый лот - Yeticave";
          $content_page = render('templates/lot.php',
            [
              'menu' => $menu_block,
              'user_data' => $user_data,
              'lots' => $lots
            ]);
      }
    } else {
        $title = 'Добавление лота - Yeticave';
        $content_page = render('templates/add.php', ['menu' => $menu_block]);
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
}

