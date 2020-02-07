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