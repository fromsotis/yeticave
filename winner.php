<?php
// Найти все лоты без победителей, дата истечения которых меньше или равна текущей дате
$query = "SELECT id FROM lots WHERE winner IS NULL AND date_expire <= CURRENT_DATE()";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$lotIds = mysqli_fetch_all($result, MYSQLI_ASSOC); // массив с просроченными лотами и NULL в поле winner

if ($lotIds) {
  foreach ($lotIds as $key => $value) {
    $id = (int)$value['id'];
    $query =
      "UPDATE lots
      SET winner =
                        (
                        SELECT user_id
                        FROM bets
                        WHERE price =
                                          (
                                          SELECT MAX(price)
                                          FROM bets
                                          WHERE lot_id = $id
                                          )
                        )
      WHERE id = $id";
    mysqli_query($link, $query) or die(mysqli_error($link));
  }
}