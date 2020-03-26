<?php
$user_data = ['id' => null, 'avatar' => ''];
if (isset($_SESSION['token']) and strlen($_SESSION['token'])) {
  $query = "SELECT id, name, avatar FROM users WHERE token = '{$_SESSION['token']}'";
  $result = mysqli_query($link, $query) or die(mysqli_error($link));
  $row = mysqli_fetch_assoc($result);
  if (isset($row['id'])) {
    $user_data = $row;
  }
}