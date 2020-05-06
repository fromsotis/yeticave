<?php
function formatPrice($price)
{
  $rub = "<b class=\"rub\">р</b>";
  $price = ceil(abs((int)$price));
  if ($price < 1000) {
    return "$price $rub";
  }
  $price = number_format($price, 0, '', ' ');
  return "$price $rub";
}

function render($template, $vars = [])
{
  // Debug:
  if (!is_file($template) or !file_exists($template)) {
    return "<b>$template</b> - ошибочный аргумент функции render!";
    exit;
  }
  ob_start();
  extract($vars);
  require_once $template;
  return ob_get_clean();
}

function clearStr($data)
{
  //return trim(strip_tags($data))
  return trim(htmlspecialchars($data));
}

function clearInt($data)
{
  return abs((int)$data);
}

function calcTimeToMidnight()
{
  $diff = strtotime('tomorrow') - time();
  $hour = floor($diff / 3600);
  $min = 60 - date('i');
  if ($hour < 10) {
    $hour = "0$hour";
  }
  if ($min < 10) {
    $min = "0$min";
  }
  return "$hour:$min";
}

function showDaysExpire($date)
{
  $diff = strtotime($date) - time();
  $day = floor($diff / 86400);
  $timeToMidnight = calcTimeToMidnight();
  if (!$day) {
    return $timeToMidnight;
  }
  return $day.' day(s)';
}

function searchUserByEmail($email, $users)
{
  $result = null;
  foreach ($users as $user) {
    if ($user['email'] == $email) {
      $result = $user;
      break;
    }
  }
  return $result;
}

function showBetDate($date) {
  $date = strtotime($date);
  $time = time() - $date;
  if ($time < (60 * 5)) {
    return 'Только что';
  } elseif ($time >= (60 * 5) and $time < (60 * 20)) {
      return '5 минут назад';
  } elseif ($time >= (60 * 20) and $time < (60 * 60)) {
      return '20 минут назад';
  } elseif ($time >= (60 * 60) and $time < (60 * 60 * 2)) {
      return '1 час назад';
  } elseif ($time >= (60 * 60 *2) and $time < (60 * 60 * 3)) {
      return '2 часа назад';
  } elseif ($time >= (60 * 60 * 3) and (int)date("d", time()) == (int)date("d", $date)) {
      return 'Сегодня в '. date("H:i", $date);
  } elseif ($time >= (60 * 60 * 3) and (int)(date("d", time())) -1 == (int)date("d", $date)) {
      return 'Вчера в '. date("H:i", $date);
  } else {
      return date("d.m.y", $date).' в '.date("H:i", $date);
  }
}