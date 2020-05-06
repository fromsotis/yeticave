<main>
  <?= $menu;?>
  <div class="container">
    <section class="lots">
      <h2>Результаты поиска по запросу «<span><?=$search;?></span>»</h2>
      <?php
      if (!$lots):
        echo "Ни чего не найдено по вашему запросу";
        //lots.id, date_create, title, img, price, date_expire, categories.name
      else:
      ?>
        <ul class="lots__list">
          <?php foreach ($lots as $key => $lot):?>
            <li class="lots__item lot">
              <div class="lot__image">
                <img src="<?=$lot['img'];?>" width="350" height="260" alt="<?=$lot['title'];?>">
              </div>
              <div class="lot__info">
                <span class="lot__category"><?=$lot['name'];?></span>
                <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=$lot['id'];?>"><?=$lot['title'];?></a></h3>
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
          <!-- <li class="lots__item lot">
            <div class="lot__image">
              <img src="img/lot-2.jpg" width="350" height="260" alt="Сноуборд">
            </div>
            <div class="lot__info">
              <span class="lot__category">Доски и лыжи</span>
              <h3 class="lot__title"><a class="text-link" href="lot.html">DC Ply Mens 2016/2017 Snowboard</a></h3>
              <div class="lot__state">
                <div class="lot__rate">
                  <span class="lot__amount">12 ставок</span>
                  <span class="lot__cost">15 999<b class="rub">р</b></span>
                </div>
                <div class="lot__timer timer timer--finishing">
                  00:54:12
                </div>
              </div>
            </div>
          </li>
           -->
        </ul>
      <?php endif;?>
    </section>
    <?php if ($pageCount > 1):?>
      <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev">
          <?php
            $prev = $curPage -1;
            if ($curPage != 1) {
              echo "<a href=\"?page=$prev&search=$search\">Назад</a>";
            } else {
                echo "<a>Назад</a>";
            }
          ?>
        </li>
          <?php foreach($pages as $page):?>
            <li class="pagination-item<?php if ($curPage == $page): ?> pagination-item-active<?php endif;?>">
              <a href="?page=<?=$page;?>&search=<?=$search;?>"><?=$page;?></a>
            </li>
          <?php endforeach;?>
        <li class="pagination-item pagination-item-next">
          <?php
            $next = $curPage + 1;
            if ($curPage < $pageCount) {
              echo "<a href=\"?page=$next&search=$search\">Вперед</a>";
            } else {
                echo "<a>Вперед</a>";
            }
          ?>
        </li>
      </ul>
    <?php endif;?>
  </div>
</main>