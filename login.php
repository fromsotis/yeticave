<?php
require_once 'data.php';
require_once 'functions.php';
require_once 'userdata.php';

session_start();

$menu_block = render('templates/menu.php', ['categories' => $categories]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $requierd = ['email', 'password'];
  $errors = [];
  if (empty($_POST['email']) or empty($_POST['password'])) {
    foreach ($requierd as $field) {
      if (empty($_POST[$field])) {
        // $errors[$field] = 'Это поле надо заполнить';
        if ($field === 'email') {
          $errors['email'] = 'Введите e-mail';
        }
        if ($field === 'password') {
          $errors['password'] = 'Введите пароль';
        }
      }
    }
  } else {
      $user = searchUserByEmail($_POST['email'], $users);
      if (!count($errors) and $user) {
        if (password_verify($_POST['password'], $user['password'])) {
          $_SESSION['user'] = $user;

        } else {
            $errors['password'] = 'Неверный пароль';
        }
      } else {
          $errors['email'] = 'Такой пользователь не найден';
      }
  }

  if (count($errors)) {
    $login_page = render('templates/login.php',
      [
        'menu' => $menu_block,
        'form' => $_POST,
        'errors' => $errors
      ]);
  } else {
      header("Location: index.php");
      exit();
  }
} else {
    $login_page = render('templates/login.php', ['menu' => $menu_block]);
}

$layout_page = render('templates/layout.php',
  [
    'title' => 'Вход - Yeticave',
    'user_avatar' => $user_avatar,
    'content' => $login_page,
    'menu' => $menu_block
  ]
);

echo $layout_page;

var_dump($_SERVER['REQUEST_URI']);