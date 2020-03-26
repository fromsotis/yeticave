<main>

  <?php
    echo $menu;
    $classname = isset($errors) ? 'form--invalid' : '';
  ?>

  <form class="form container <?= $classname;?>" action="login.php" method="POST">
    <h2>Вход</h2>
    <?php
      echo isset($_SESSION['reg_user'])? '<p>Теперь вы можете войти, используя свой email и пароль</p>' : '';
      $classname = isset($errors['email']) ? 'form__item--invalid' : '';
      $value = $form['email'] ?? '';
    ?>
    <div class="form__item <?= $classname;?>">
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $value;?>">
      <?php if ($classname):?>
        <span class="form__error"><?= $errors['email'];?></span>
      <?php endif;?>
    </div>

    <?php $classname = isset($errors['password']) ? 'form__item--invalid' : '';?>
    <div class="form__item form__item--last <?= $classname;?>">
      <label for="password">Пароль*</label>
      <input id="password" type="password" name="password" placeholder="Введите пароль">
      <?php if ($classname):?>
        <span class="form__error"><?= $errors['password'];?></span>
      <?php endif;?>
    </div>

    <button type="submit" class="button">Войти</button>
  </form>
</main>