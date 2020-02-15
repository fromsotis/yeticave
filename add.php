<?php

require_once 'data.php';
require_once 'functions.php';

session_start();

if (empty($_SESSION['user'])) {
  header("Location: login.php");
  exit();
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
        // Warning: finfo_file(): Empty filename or path on line 53
        if (!empty($_FILES['lot-img']['type'])) {
          $finfo = finfo_open(FILEINFO_MIME_TYPE);
          $file_mime = finfo_file($finfo, $tmp_name);
        }

        $file_error = $_FILES['lot-img']['error'];
        if ($file_error !== UPLOAD_ERR_OK) {
          $errors['file'] = 'Не удалось загрузить файл, размер не должен привышат 2мб';
        } elseif ($file_mime !== 'image/jpeg') {
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
          $title = "Новый лот - Yeticave";
          $content_page = render('templates/new-lot.php',
            [
              'menu' => $menu_block,
              'lots' => $_POST
            ]);
      }
    } else {
        $title = 'Добавление лота - Yeticave';
        $content_page = render('templates/add.php', ['menu' => $menu_block]);
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
}

