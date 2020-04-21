<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set('Asia/Vladivostok');


$dateExpire = "2020-04-10"; //-24
$win = null;
$result = floor((strtotime($dateExpire) - strtotime('tomorrow')) / 3600); // если без (int) тогда float(0)
var_dump($result);
// Подсвечиваем красным date_expire если осталось меньше суток
// if ((int)floor((strtotime($dateExpire) - strtotime('tomorrow')) / 3600) === 0) {
//   echo "red";
// } elseif ((int)floor((strtotime($dateExpire) - strtotime('tomorrow')) / 3600) < 0) {
//     if ($win) {
//       echo "blue";
//     } else {
//         echo "grey";
//     }
// } else {
//     echo "green";
// }

// elseif ((int)floor((strtotime($dateExpire) - strtotime('tomorrow')) / 3600) > 0) {
//     echo "green";
// }

$date = intval(floor(strtotime($dateExpire) - strtotime('tomorrow')) / 3600);
  if ($date === 0) {
    echo "red";
  } elseif ($date < 0) {
      if ($win) {
        echo "blue";
      } else {
          echo "grey";
      }
  } else {
      echo "green";
  }