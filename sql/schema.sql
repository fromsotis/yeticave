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
  step DECIMAL NOT NULL DEFAULT 0,
  favorites INT NULL DEFAULT NULL,
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
  FOREIGN KEY (user_id)
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