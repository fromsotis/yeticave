<?php
//error_reporting(E_ALL);
// error_reporting = E_ALL
// display_errors = On
// display_startup_errors = On
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

date_default_timezone_set('Asia/Vladivostok');

$db =
  [
    'host' => 'localhost',
    'user' => 'admin',
    'password' => 'Qw12345',
    'database' => 'yeticave'
  ];

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']) or die(mysqli_connect());
mysqli_set_charset($link, 'utf8');