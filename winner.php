<?php
// Найти все лоты без победителей, дата истечения которых меньше или равна текущей дате
$query = "SELECT id FROM lots WHERE winner IS NULL AND date_expire <= CURRENT_DATE()";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$lotIds = mysqli_fetch_all($result, MYSQLI_ASSOC); // массив с просроченными лотами и NULL в поле winner

if ($lotIds) {
  foreach ($lotIds as $key => $value) {
    $query =
      "UPDATE lots
      SET lots.winner = (SELECT bets.user_id FROM bets WHERE bets.price = (SELECT MAX(bets.price) FROM bets WHERE bets.lot_id = {$value['id']}))
      WHERE lots.id = {$value['id']}";
    mysqli_query($link, $query) or die(mysqli_error($link));
  }
}