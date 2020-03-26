<?php

$db =
  [
    'host' => 'localhost',
    'user' => 'admin',
    'password' => 'Qw12345',
    'database' => 'yeticave'
  ];

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']) or die(mysqli_connect());
mysqli_set_charset($link, 'utf8');