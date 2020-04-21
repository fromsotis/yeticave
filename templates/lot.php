<main>

  <?= $menu;?>
  
  <section class="lot-item container">
    <h2><?= $lots['title'];?></h2>
    <div class="lot-item__content">
      <div class="lot-item__left">
        <div class="lot-item__image">
          <img src="<?= $lots['img'];?>" width="730" height="548" alt="<?= $lots['title'];?>">
        </div>
        <p class="lot-item__category">Категория: <span><?= $lots['cat_name'];?></span></p>
        <p class="lot-item__description"><?= $lots['description'];?></p>
      </div>
      <div class="lot-item__right">
        <div class="lot-item__state">
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
          <div class="lot-item__cost-state">
            <div class="lot-item__rate">
              <span class="lot-item__amount">Текущая цена</span>
              <span class="lot-item__cost"><?= formatPrice($lots['curr_price']);?></span>
            </div>
            <div class="lot-item__min-cost">
              Мин. ставка <span><?= formatPrice($lots['min_price']);?></span>
            </div>
          </div>

          <!-- Сделать ставку может только auth user -->
          <?php if (isset($user_data['id'])):?>
          <form class="lot-item__form" action="" method="post">
            <p class="lot-item__form-item">
              <label for="cost">Ваша ставка</label>
              <input id="cost" type="number" name="cost" placeholder="<?= number_format($lots['min_price'], 0, '', ' ');?>">
            </p>
            <button type="submit" class="button">Сделать ставку</button>
          </form>
          <?php endif;?>
        </div>
        <div class="history">
          <?php if(!$betsHistory):?>
            <h3>История ставок (0)</h3>
          <?php else:?>
            <h3>История ставок (<span><?= count($betsHistory);?></span>)</h3>
            <table class="history__list">
              <?php foreach($betsHistory as $key => $value):?>
                <tr class="history__item">
                  <td class="history__name"><?= $betsHistory[$key]['name'];?></td>
                  <td class="history__price"><?= number_format($betsHistory[$key]['price'], 0, '', ' ');?> р</td>
                  <td class="history__time"><?= showBetDate($betsHistory[$key]['date_create']);?></td>
                </tr>
              <?php endforeach;?>
            </table>
          <?php endif;?>
        </div>
      </div>
    </div>
  </section>
</main>