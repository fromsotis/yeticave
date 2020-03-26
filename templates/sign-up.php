
<main>

  <?= $menu;?>

  <?php $classname = !empty($errors)? 'form--invalid' : '';?>

  <form class="form container <?= $classname;?>" action="" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Регистрация нового аккаунта</h2>

     <?php
      $classname = (isset($errors['email'])) ? 'form__item--invalid' : '';
      $value = $user['email'] ?? '';
      $error_text = isset($errors['email']) ? "<span class=\"form__error\">{$errors['email']}</span>" : '';
    ?>
    <div class="form__item <?= $classname;?>"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" value="<?= $value;?>" placeholder="Введите e-mail">
      <?= $error_text;?>
    </div>

    <?php
      $classname = (isset($errors['password'])) ? 'form__item--invalid' : '';
      $value = $user['password'] ?? '';
      $error_text = isset($errors['password']) ? "<span class=\"form__error\">{$errors['password']}</span>" : '';
    ?>
    <div class="form__item <?= $classname;?>">
      <label for="password">Пароль*</label>
      <input id="password" type="password" name="password" value="<?= $value;?>" placeholder="Введите пароль">
      <?= $error_text;?>
    </div>

    <?php
      $classname = (isset($errors['name'])) ? 'form__item--invalid' : '';
      $value = $user['name'] ?? '';
      $error_text = isset($errors['name']) ? "<span class=\"form__error\">{$errors['name']}</span>" : '';
    ?>
    <div class="form__item <?= $classname;?>">
      <label for="name">Имя*</label>
      <input id="name" type="text" name="name" value="<?= $value;?>" placeholder="Введите имя">
      <?= $error_text;?>
    </div>

     <?php
      $classname = (isset($errors['contacts'])) ? 'form__item--invalid' : '';
      $value = $user['contacts'] ?? '';
      $error_text = isset($errors['contacts']) ? "<span class=\"form__error\">{$errors['contacts']}</span>" : '';
    ?>
    <div class="form__item <?= $classname;?>">
      <label for="message">Контактные данные*</label>
      <textarea id="message" name="contacts" placeholder="Напишите как с вами связаться"><?= $value;?></textarea>
      <?= $error_text;?>
    </div>

    <?php
      $classname = (isset($errors['file'])) ? 'form__item--invalid' : '';
      $error_text = (isset($errors['file'])) ? "<span class=\"form__error\">{$errors['file']}</span>" : '';
    ?>
    <div class="form__item form__item--file form__item--last <?= $classname;?>">
      <label>Аватар</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="avatar" id="photo2">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
       <?= $error_text;?>
    </div>

    <?= $classname = !empty($errors)? '<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>' : '';?>

    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="login.php">Уже есть аккаунт</a>
  </form>
</main>