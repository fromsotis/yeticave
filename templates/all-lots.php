<main>
  <?= $menu;?>
  <div class="container">
    <section class="lots">
      <?php if (count($lots)):?>
        <h2>Все лоты в категории <span>«<?=$lots[0]['name'];?>»</span></h2>
        <ul class="lots__list">
        <?php foreach($lots as $key => $lot):?>
          <li class="lots__item lot">
            <div class="lot__image">
              <img src="<?= $lot['img'];?>" width="350" height="260" alt="<?= $lot['title'];?>">
            </div>
            <div class="lot__info">
              <span class="lot__category"><?= $lot['name'];?></span>
              <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?= $lot['id'];?>"><?= $lot['title'];?></a></h3>
              <div class="lot__state">
                <div class="lot__rate">
                  <span class="lot__amount">Стартовая цена</span>
                  <span class="lot__cost"><?= formatPrice($lot['price']);?></span>
                </div>
                <?php
                  $date = intval(floor(strtotime($lot['date_expire']) - strtotime('tomorrow')) / 3600);
                  if ($date === 0) {
                    $dateExpire = showDaysExpire($lot['date_expire']);
                    $timer = "<div class=\"lot__timer timer timer--finishing\">$dateExpire</div>";
                  } elseif ($date < 0) {
                      $timer = "<div class=\"lot__timer timer timer--end\">Торги окончены</div>";
                  } else {
                      $dateExpire = showDaysExpire($lot['date_expire']);
                      $timer = "<div class=\"lot__timer timer\">$dateExpire</div>";
                  }
                  echo $timer;
                ?>
              </div>
            </div>
          </li>
        <?php endforeach;?>
        </ul>
      <?php endif;?>
    </section>
      <?php if ($pageCount > 1):?>
        <ul class="pagination-list">
          <li class="pagination-item pagination-item-prev">
            <?php
              $prev = $curPage -1;
              if ($curPage != 1) {
                // $lots[0]['category_id'] формирует GET['id категории'],
                // без нее пагинация при переходе на следующую стр. даст ошибку
                // так как в GET будет только GET['page']
                echo "<a href=\"?id={$lots[0]['category_id']}&page=$prev\">Назад</a>";
              } else {
                  echo "<a>Назад</a>";
              }
            ?>
          </li>
            <?php foreach($pages as $page):?>
              <li class="pagination-item<?php if ($curPage == $page): ?> pagination-item-active<?php endif;?>">
                <a href="?id=<?=$lots[0]['category_id'];?>&page=<?=$page;?>"><?=$page;?></a>
              </li>
            <?php endforeach;?>
          <li class="pagination-item pagination-item-next">
            <?php
              $next = $curPage + 1;
              if ($curPage < $pageCount) {
                echo "<a href=\"?id={$lots[0]['category_id']}&page=$next\">Вперед</a>";
              } else {
                  echo "<a>Вперед</a>";
              }
            ?>
          </li>
        </ul>
      <?php endif;?>
  </div>
</main>