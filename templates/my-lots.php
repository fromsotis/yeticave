<main>
  <?= $menu;?>
  <section class="rates container">
    <h2>Мои ставки</h2>
    <table class="rates__list">
      <?php
        foreach($lots as $key => $value):
        $date = intval(floor(strtotime($value['date_expire']) - strtotime('tomorrow')) / 3600);
        if ($date === 0) {
          $ratesItem = '<tr class="rates__item">';
          $dateExpire = showDaysExpire($value['date_expire']);
          $timer = "<div class=\"timer timer--finishing\">$dateExpire</div>";
          $contacts = '';
        } elseif ($date < 0) {
            // если id в поле winner = auth user id
            if ($value['winner'] == $user_data['id']) {
              $ratesItem = '<tr class="rates__item rates__item--win">';
              $contacts = "<p>{$value['contacts']}</p>";
              $timer = '<div class="timer timer--win">Ставка выиграла</div>';
            } else {
                $ratesItem = '<tr class="rates__item rates__item--end">';
                $timer = '<div class="timer timer--end">Торги окончены</div>';
                $contacts = '';
            }
        } else {
            $ratesItem = '<tr class="rates__item">';
            $dateExpire = showDaysExpire($value['date_expire']);
            $timer = "<div class=\"timer\">$dateExpire</div>";
            $contacts = '';
        }
      ?>
        <?= $ratesItem;?>
        <td class="rates__info">
          <div class="rates__img">
            <img src="<?= $value['img'];?>" width="54" height="40" alt="<?= $value['title'];?>">
          </div>
          <div>
            <h3 class="rates__title"><a href="lot.php?id=<?= $value['id'];?>"><?= $value['title'];?></a></h3>
            <?= $contacts;?>
          <div>
        </td>
        <td class="rates__category">
          <?= $value['name'];?>
        </td>
        <td class="rates__timer">
          <?= $timer;?>
        </td>
        <td class="rates__price">
          <?= number_format($value['price'], 0, '', ' ').' р';?>
        </td>
        <td class="rates__time">
          <?= showBetDate($value['date_create']);?>
        </td>
      </tr>
      <?php
        endforeach;
      ?>
    </table>
  </section>
</main>