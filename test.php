<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set('Asia/Vladivostok');
?>

<?php
//Подсвечиваем красным date_expire если осталось меньше суток

if (floor((strtotime($lot['date_expire']) - strtotime('tomorrow')) / 3600)) {
  $classname = '';
} else {
    $classname = 'timer--finishing';
}
?>
<div class="lot__timer timer <?=$classname;?>">
<?= showDaysExpire($lot['date_expire']);?>
</div>

<?php
// Подсвечиваем красным date_expire если осталось меньше суток
if (floor((strtotime($lots['date_expire']) - strtotime('tomorrow')) / 3600)) {
$classname = '';
} else {
$classname = 'timer--finishing';
}
?>
<div class="lot-item__timer timer <?= $classname;?>">
<?= showDaysExpire($lots['date_expire']);?>
</div>