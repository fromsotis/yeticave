<main class="container">
  <section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
      <?php
        foreach ($categories as $key => $category) {
          switch ($category['name']) {
            case 'Доски и лыжи':
              $classname = 'promo__item--boards';
              break;
            case 'Крепления';
              $classname = 'promo__item--attachment';
              break;
            case 'Ботинки':
              $classname = 'promo__item--boots';
              break;
            case 'Одежда':
              $classname = 'promo__item--clothing';
              break;
            case 'Инструменты':
              $classname = 'promo__item--tools';
              break;
            case 'Разное';
              $classname = 'promo__item--other';
              break;
          }

          echo "<li class=\"promo__item $classname\">";
          echo "<a class=\"promo__link\" href=\"all-lots.php?id={$category['id']}\">{$category['name']}</a>";
          echo "</li>";
        }
      ?>
    </ul>
  </section>
  <section class="lots">
    <div class="lots__header">
      <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">

      <?php foreach($lots as $key => $lot):?>
        <li class="lots__item lot">
          <div class="lot__image">
            <img src="<?= $lots[$key]['img'];?>" width="350" height="260" alt="<?= $lots[$key]['title'];?>">
          </div>
          <div class="lot__info">
            <span class="lot__category"><?= $lot['name'];?></span>
            <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?= $lot['id'];?>"><?= $lot['title'];?></a></h3>
            <div class="lot__state">
              <div class="lot__rate">
                <span class="lot__amount"><?= $lot['bets_count']? "Cтавок: {$lot['bets_count']}" : 'Стартовая цена';?></span>
                <span class="lot__cost"><?= $lot['bets_price']? formatPrice($lot['bets_price']) : formatPrice($lot['price']);?></span>
              </div>
              <?php
                // Подсвечиваем красным date_expire если осталось меньше суток
                if (floor((strtotime($lot['date_expire']) - strtotime('tomorrow')) / 3600)) {
                  $classname = '';
                } else {
                    $classname = 'timer--finishing';
                }
              ?>
              <div class="lot__timer timer <?=$classname;?>">
                <?= showDaysExpire($lot['date_expire']);?>
              </div>
            </div>
          </div>
        </li>
      <?php endforeach;?>
    </ul>
  </section>

  <?php if ($pageCount > 1):?>
    <ul class="pagination-list">
      <li class="pagination-item pagination-item-prev">
        <?php
          $prev = $curPage -1;
          if ($curPage != 1) {
            echo "<a href=\"?page=$prev\">Назад</a>";
          } else {
              echo "<a>Назад</a>";
          }
        ?>
      </li>
        <?php foreach($pages as $page):?>
          <li class="pagination-item<?php if ($curPage == $page): ?> pagination-item-active<?php endif;?>">
            <a href="?page=<?=$page;?>"><?=$page;?></a>
          </li>
        <?php endforeach;?>
      <li class="pagination-item pagination-item-next">
        <?php
          $next = $curPage + 1;
          if ($curPage < $pageCount) {
            echo "<a href=\"?page=$next\">Вперед</a>";
          } else {
              echo "<a>Вперед</a>";
          }
        ?>
      </li>
    </ul>
  <?php endif;?>
</main>