<?php
session_start();
require_once 'init.php';
require_once 'data.php';
require_once 'functions.php';

$menu_block = render('templates/menu.php', ['categories' => $categories]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $requierd = ['email', 'password'];
  $errors = [];
  if (empty($_POST['email']) or empty($_POST['password'])) {
    foreach ($requierd as $field) {
      if (empty($_POST[$field])) {
        if ($field === 'email') {
          $errors['email'] = 'Введите e-mail';
        }
        if ($field === 'password') {
          $errors['password'] = 'Введите пароль';
        }
      }
    }
  } else {
      $email = clearStr(mysqli_real_escape_string($link, $_POST['email']));
      $query = "SELECT id, email, name, password, avatar FROM users WHERE email = '$email'";
      $result = mysqli_query($link, $query) or die(mysqli_error($link));
      $user = mysqli_fetch_assoc($result);
      // если в бд нет email то $user вернет null
      if ($user) {
        if (password_verify($_POST['password'], $user['password'])) {
          $token = rand(1, 10000000);
          $query = "UPDATE users SET token = '$token' WHERE id = {$user['id']}";
          mysqli_query($link, $query);
          $_SESSION['token'] = $token;
          /* */
          if (isset($_COOKIE['ref'])) {
            $ref = $_COOKIE['ref'];
          } else {
              $ref = 'index.php';
          }
          header("Location: $ref");
          // удаляем cookie['ref']
          setcookie('ref', 'delete', time() - 3600);
          exit();
          // ***
        } else {
            $errors['password'] = 'Пользователь или пароль указан не верно';
            $errors['email'] = 'Пользователь или пароль указан не верно';
        }
      } else {
          $errors['password'] = 'Пользователь или пароль указан не верно';
          $errors['email'] = 'Пользователь или пароль указан не верно';
      }
  }

  if (count($errors)) {
    $login_page = render('templates/login.php',
      [
        'menu' => $menu_block,
        'form' => $_POST,
        'errors' => $errors
      ]);
  } 
} else {
    $login_page = render('templates/login.php', ['menu' => $menu_block]);
}

$layout_page = render('templates/layout.php',
  [
    'title' => 'Вход - Yeticave',
    'content' => $login_page,
    'menu' => $menu_block
  ]
);

echo $layout_page;