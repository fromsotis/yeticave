<nav class="nav">
  <ul class="nav__list container">
    <?php foreach($categories as $key => $category):?>
      <li class="nav__item">
        <a href="all-lots.html"><?= $categories[$key]['name'];?></a>
      </li>
    <?php endforeach;?>
  </ul>
</nav>
