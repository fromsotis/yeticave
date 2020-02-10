<main>
  
  <?= $menu;?>

  <?php $classname = (isset($errors)) ? 'form--invalid' : '';?>

  <form class="form form--add-lot container <?= $classname;?>" action="add.php" method="POST" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">

      <?php
        $classname = (isset($errors['lot-name'])) ? 'form__item--invalid' : '';
        $value = $lots['lot-name'] ?? '';
        $error_text = isset($errors['lot-name']) ? "<span class=\"form__error\">{$errors['lot-name']}</span>" : '';
      ?>

      <div class="form__item <?= $classname;?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" value="<?= $value;?>" placeholder="Введите наименование лота">
        <?= $error_text;?>
      </div>

      <?php
        $classname = '';
        $error_text = '';
        if (!empty($lots['category']) and $lots['category'] === 'Выберите категорию') {
          $classname = 'form__item--invalid';
          $error_text = "<span class=\"form__error\">{$errors['category']}</span>";
        }
      ?>

      <div class="form__item <?= $classname;?>">
        <label for="category">Категория</label>
        <select id="category" name="category">
          <?php
            // Вывод списка select
            $options = ['Выберите категорию', 'Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];
            foreach ($options as $option) {
              // Запомнит значение select
              if (!empty($lots['category']) and $lots['category'] === $option) {
                echo "<option selected>$option</option>";
              } else {
                  echo "<option>$option</option>";
              }
            }
          ?>
        </select>
        <?= $error_text;?>
      </div>

    </div>

    <?php
      $classname = (isset($errors['message'])) ? 'form__item--invalid' : '';
      $value = $lots['message'] ?? null;
      $error_text = isset($errors['message']) ? "<span class=\"form__error\">{$errors['message']}</span>" : '';
    ?>

    <div class="form__item form__item--wide <?= $classname;?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота"><?=$value;?></textarea>
      <?= $error_text;?>
    </div>

    <?php
      $classname = (isset($errors['file'])) ? 'form__item--invalid' : '';
      $error_text = (isset($errors['file'])) ? "<span class=\"form__error\">{$errors['file']}</span>" : '';
    ?>

    <div class="form__item form__item--file <?= $classname;?>"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="lot-img" id="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>

      <?= $error_text;?>

    </div>
    <div class="form__container-three">

      <?php
        $classname = (isset($errors['lot-rate'])) ? 'form__item--invalid' : '';
        $value = $lots['lot-rate'] ?? '';
        $error_text = (isset($errors['lot-rate'])) ? "<span class=\"form__error\">{$errors['lot-rate']}</span>" : '';
      ?>

      <div class="form__item form__item--small <?= $classname;?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="text" name="lot-rate" value="<?= $value;?>" placeholder="0">
        <?= $error_text;?>
      </div>

      <?php
        $classname = (isset($errors['lot-step'])) ? 'form__item--invalid' : '';
        $value = $lots['lot-step'] ?? '';
        $error_text = (isset($errors['lot-step'])) ? "<span class=\"form__error\">{$errors['lot-step']}</span>" : '';
      ?>

      <div class="form__item form__item--small <?= $classname;?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="text" name="lot-step" value="<?= $value;?>" placeholder="0">
        <?= $error_text;?>
      </div>

      <?php
        $classname = (isset($errors['lot-date'])) ? 'form__item--invalid' : '';
        $value = $lots['lot-date'] ?? '';
        $error_text = (isset($errors['lot-date'])) ? "<span class=\"form__error\">{$errors['lot-date']}</span>" : '';
      ?>

      <div class="form__item <?= $classname;?>">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?= $value;?>">
        <?= $error_text;?>
      </div>

    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>
</main>