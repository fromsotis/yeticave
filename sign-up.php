<?php
require_once 'init.php';
require_once 'data.php';
require_once 'functions.php';
//require_once 'userdata.php';

session_start(); // для флэш сообщения на login.php при удачной регистрации нового пользователя


$menu_block = render('templates/menu.php', ['categories' => $categories]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $requierd = ['email', 'password', 'name', 'contacts'];
  $errors = [];
  foreach ($_POST as $field_name => $value) {
    if (in_array($field_name, $requierd)) {
      if (!$value) {
        if ($field_name === 'email') {
          $errors[$field_name] = 'Введите e-mail';
        }
        if ($field_name === 'password') {
          $errors[$field_name] = 'Введите пароль';
        }
        if ($field_name === 'name') {
          $errors[$field_name] = 'Введите ваше имя';
        }
        if ($field_name === 'contacts') {
          $errors[$field_name] = 'Напишите как с вами связаться';
        }
      } else { // Проверка на корректность заполнения поля email
          if ($field_name === 'email') {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
              $errors[$field_name] = 'email указан не корректно';
            }
          }
      }
    }
  }
  // *** ПОИСК EMAIL В ТАБЛИЦЕ USERS ***
  if (empty($errors['email'])) {
    $email = clearStr(mysqli_real_escape_string($link, $_POST['email']));
    $query = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    if (mysqli_num_rows($result) > 0) { // mysqli_num_rows($result) вернет кол-во строк с email
      $errors['email'] = 'пользователь с таким email уже зарегистрирован';
    }
  }
  // *** ПОИСК EMAIL В ТАБЛИЦЕ USERS END***

  // *** ПРОВЕРКА ФАЙЛА ***
  if (!empty($_FILES['avatar']['name'])) {
    $file_name = $_FILES['avatar']['name'];
    $tmp_name = $_FILES['avatar']['tmp_name'];
    $file_size = $_FILES['avatar']['size'];
    
    // без этого условия, при загрузке файла больше 2 мб будет
    // Warning: finfo_file(): Empty filename or path on line ...
    if (!empty($_FILES['avatar']['type'])) {
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $file_mime = finfo_file($finfo, $tmp_name);
    }

    $file_error = $_FILES['avatar']['error'];
    if ($file_error !== UPLOAD_ERR_OK) {
      $errors['file'] = 'Не удалось загрузить файл, размер не должен привышат 2мб';
      // иначе если тип файла не равен jpeg и не равен jpeg и не равен png, тогда ошибка
    } elseif ($file_mime !== 'image/jpeg' and $file_mime !== 'image/jpg' and $file_mime !== 'image/png') {
        $errors['file'] = "Изображение должно быть в формате JPEG JPG или PNG";
    } else {
        move_uploaded_file($tmp_name, 'uploads/'.$file_name);
        $_POST['file_name'] = $file_name;
    }
  }
      // *** ПРОВЕРКА ФАЙЛА END ***
  if (count($errors)) {
    $sign_page = render('templates/sign-up.php', ['menu' => $menu_block, 'user' => $_POST,'errors' => $errors]);
  } else {
      $name = clearStr($_POST['name']);
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
      $contacts = clearStr($_POST['contacts']);
      if (empty($_FILES['avatar']['name'])) {
        // $query =
        // "INSERT INTO users (email, name, password, contacts)
        //  VALUES ('$email', '$name', '$password', '$contacts')";
        $query = "INSERT INTO users (email, name, password, contacts) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ssss", $email, $name, $password, $contacts);

      } else {
          $avatar = "uploads/$file_name";
          // $query =
          //   "INSERT INTO users (email, name, password, avatar, contacts)
          //    VALUES ('$email', '$name', '$password', '$avatar', '$contacts')";
          $query = "INSERT INTO users (email, name, password, avatar, contacts) VALUES (?, ?, ?, ?, ?)";
          $stmt = mysqli_prepare($link, $query);
          mysqli_stmt_bind_param($stmt, "sssss", $email, $name, $password, $avatar, $contacts);
      }
      //mysqli_query($link, $query) or die(mysqli_error($link));
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      $_SESSION['reg_user'] = true;
      header("Location: login.php");
      exit;
  }
} else {
    $sign_page = render('templates/sign-up.php', ['menu' => $menu_block]);
}

$layout_page = render('templates/layout.php',
  [
    'title' => 'Регистрация нового пользователя - Yeticave',
    'content' => $sign_page,
    'menu' => $menu_block
  ]
);

echo $layout_page;