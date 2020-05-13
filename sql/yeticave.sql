DROP DATABASE IF EXISTS `yeticave`;

CREATE DATABASE IF NOT EXISTS `yeticave` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `yeticave`;

CREATE TABLE IF NOT EXISTS `users`
(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  date_create DATETIME NOT NULL DEFAULT NOW(),
  email VARCHAR(64) NOT NULL,
  name VARCHAR(64) NOT NULL,
  password VARCHAR(64) NOT NULL,
  avatar VARCHAR(64) NULL DEFAULT NULL,
  contacts TEXT NOT NULL,
  token VARCHAR(255) NULL DEFAULT NULL,
  UNIQUE index_users_email (email),
  INDEX index_users_name (name)
);

CREATE TABLE IF NOT EXISTS `categories`
(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(64) NOT NULL,
  INDEX index_categories_name (name)
);

CREATE TABLE IF NOT EXISTS `bets`
(
  id INT NOT NULL AUTO_INCREMENT   PRIMARY KEY,
  date_create DATETIME NOT NULL DEFAULT NOW(),
  price DECIMAL NOT NULL,
  user_id INT NOT NULL,
  lot_id INT NOT NULL,
  INDEX index_bets_date_create (date_create),
  INDEX index_bets_price (price)
);

CREATE TABLE IF NOT EXISTS `lots`
(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  date_create DATETIME NOT NULL DEFAULT NOW(),
  title VARCHAR(64) NOT NULL,
  description TEXT NOT NULL,
  img VARCHAR(128) NOT NULL,
  price DECIMAL NOT NULL,
  date_expire DATE NOT NULL,
  step DECIMAL NOT NULL,
  user_id INT NOT NULL,
  winner INT NULL DEFAULT NULL,
  category_id INT NOT NULL,
  INDEX index_lots_title (title),
  INDEX index_lots_description (description(100)),
  INDEX index_lots_price (price),
  INDEX index_lots_date_expire (date_expire)
);

-- bets(user_id) -> users(id)
ALTER TABLE bets
ADD CONSTRAINT fk_bets_users
  FOREIGN KEY (user_id)
  REFERENCES users (id)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

-- bets(lot_id) -> lots(id)
ALTER TABLE bets
ADD CONSTRAINT fk_bets_lots
  FOREIGN KEY (lot_id)
  REFERENCES lots (id)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

-- lots(user_id) -> users(id)
ALTER TABLE lots
ADD CONSTRAINT fk_lots_users
  FOREIGN KEY (user_id)
  REFERENCES users (id)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

-- lots(winner) -> users(id)
ALTER TABLE lots
ADD CONSTRAINT fk_lots_winner_users
  FOREIGN KEY (winner)
  REFERENCES users (id)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

-- lots(category_id) -> categories(id)
ALTER TABLE lots
ADD CONSTRAINT fk_lots_categories
  FOREIGN KEY (category_id)
  REFERENCES categories(id)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

-- FULLTEXT search on lots.tile , lots.description
CREATE FULLTEXT INDEX lots_fulltext_search ON lots(title, description);

USE `yeticave`;

INSERT INTO categories (name)
VALUES ('Доски и лыжи'), ('Крепления'), ('Ботинки'), ('Одежда'), ('Инструменты'), ('Разное');

-- INSERT INTO users (email, name, password, contacts) VALUES
--   -- Qw12345
--   ('1@mail.ru', 'Алексей', '$2y$10$HrX3J8FE/0xITiNrYNnu0.LW3wZ7E8o5zHIm4FD.g3KqU7jrQ/wq2', '+7(999)898-98-89 звоните с 09:00 - 18:00'),
--   -- Qw12345
--   ('2@mail.ru', 'Иван', '$2y$10$HrX3J8FE/0xITiNrYNnu0.LW3wZ7E8o5zHIm4FD.g3KqU7jrQ/wq2', '+7(888)999-88-99 звоните с 09:00 - 18:00'),
--   -- Qw12345
--   ('3@mail.ru', 'Дмитрий', '$2y$10$HrX3J8FE/0xITiNrYNnu0.LW3wZ7E8o5zHIm4FD.g3KqU7jrQ/wq2', '+7(898)888-99-88 звоните с 09:00 - 18:00');

-- INSERT INTO lots (title, description, img, price, date_expire, step, user_id, category_id) VALUES
--   ('2014 Rossignol District Snowboard',
--     'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
--      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
--      Sed nisi lacus sed viverra tellus in hac habitasse platea.',
--     'uploads/lot-1.jpg',
--     10000,
--     '2020-12-30',
--     500,
--     3,
--     1),
--   ('DC Ply Mens 2016/2017 Snowboard',
--     'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
--      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
--      Sed nisi lacus sed viverra tellus in hac habitasse platea.',
--     'uploads/lot-2.jpg',
--     15000,
--     '2020-12-30',
--     500,
--     3,
--     1),
--   ('Крепление Union Contacts Pro 2015 года размер L/XL',
--     'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
--      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
--      Sed nisi lacus sed viverra tellus in hac habitasse platea.',
--     'uploads/lot-3.jpg',
--     8000,
--     '2020-12-30',
--     500,
--     3,
--     2),
--   ('Ботинки для сноуборда DC Mutiny Charocal',
--     'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
--      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
--      Sed nisi lacus sed viverra tellus in hac habitasse platea.',
--     'uploads/lot-4.jpg',
--     10999,
--     '2020-12-30',
--     500,
--     3,
--     3),
--   ('Куртка для сноуборда DC Mutiny Charocal',
--     'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
--      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
--      Sed nisi lacus sed viverra tellus in hac habitasse platea.',
--     'uploads/lot-5.jpg',
--     7500,
--     '2020-12-30',
--     500,
--     3,
--     4),
--   ('Маска Oakley Canopy',
--     'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
--      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
--      Sed nisi lacus sed viverra tellus in hac habitasse platea.',
--     'uploads/lot-6.jpg',
--     5400,
--     '2020-12-30',
--     500,
--     3,
--     6);

-- INSERT INTO bets (price, user_id, lot_id) VALUES (10500, 2, 1), (15500, 1, 2), (11000, 1, 1);