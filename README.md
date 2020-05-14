# Личный проект «YetiCave»

[Обзор готового проекта на YOUTUBE](https://www.youtube.com/watch?reload=9&v=eP-vjex0Wfw)

## Установка
- Импортируйте схему с таблицами для СУБД: /sql/yeticave.sql
```bash
например:
sudo mysql -u root -p yeticave < yeticave.sql
```
- В файл init.php внесите ваши данные для подключения к СУБД
```php
<?php

$db =
  [
    'host' => 'localhost', //адрес сервера СУБД
    'user' => 'admin', // администратор БД
    'password' => 'Qw12345', // пароль администратора БД
    'database' => 'yeticave' // название БД
  ];
```
 - установите с помощь composer SwiftMailer
 ```
 cd yeticave/
 php composer.phar install
 ```
---

<a href="https://htmlacademy.ru/intensive/adaptive"><img align="left" width="50" height="50" alt="HTML Academy" src="https://up.htmlacademy.ru/static/img/intensive/adaptive/logo-for-github.svg"></a>

Репозиторий создан для обучения на интенсивном онлайн‑курсе
«[Профессиональный PHP, уровень 1](https://htmlacademy.ru/intensive/php)» от [HTML Academy](https://htmlacademy.ru).
