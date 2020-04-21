USE `yeticave`;

INSERT INTO categories (name)
VALUES ('Доски и лыжи'), ('Крепления'), ('Ботинки'), ('Одежда'), ('Инструменты'), ('Разное');

INSERT INTO users (email, name, password, contacts) VALUES
  -- Qw12345
  ('alsvol@mail.ru', 'Алексей', '$2y$10$HrX3J8FE/0xITiNrYNnu0.LW3wZ7E8o5zHIm4FD.g3KqU7jrQ/wq2', '+7(999)898-98-89 звоните с 09:00 - 18:00'),
  -- Qw12345
  ('2@mail.ru', 'Иван', '$2y$10$HrX3J8FE/0xITiNrYNnu0.LW3wZ7E8o5zHIm4FD.g3KqU7jrQ/wq2', '+7(888)999-88-99 звоните с 09:00 - 18:00'),
  -- Qw12345
  ('3@mail.ru', 'Дмитрий', '$2y$10$HrX3J8FE/0xITiNrYNnu0.LW3wZ7E8o5zHIm4FD.g3KqU7jrQ/wq2', '+7(898)888-99-88 звоните с 09:00 - 18:00');

INSERT INTO lots (title, description, img, price, date_expire, step, user_id, category_id) VALUES
  ('2014 Rossignol District Snowboard',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
     Sed nisi lacus sed viverra tellus in hac habitasse platea.',
    'uploads/lot-1.jpg',
    10000,
    '2020-04-30',
    500,
    3,
    1),
  ('DC Ply Mens 2016/2017 Snowboard',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
     Sed nisi lacus sed viverra tellus in hac habitasse platea.',
    'uploads/lot-2.jpg',
    15000,
    '2020-04-30',
    500,
    3,
    1),
  ('Крепление Union Contacts Pro 2015 года размер L/XL',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
     Sed nisi lacus sed viverra tellus in hac habitasse platea.',
    'uploads/lot-3.jpg',
    8000,
    '2020-04-30',
    500,
    3,
    2),
  ('Ботинки для сноуборда DC Mutiny Charocal',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
     Sed nisi lacus sed viverra tellus in hac habitasse platea.',
    'uploads/lot-4.jpg',
    10999,
    '2020-04-30',
    500,
    3,
    3),
  ('Куртка для сноуборда DC Mutiny Charocal',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
     Sed nisi lacus sed viverra tellus in hac habitasse platea.',
    'uploads/lot-5.jpg',
    7500,
    '2020-04-30',
    500,
    3,
    4),
  ('Маска Oakley Canopy',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
     Sed nisi lacus sed viverra tellus in hac habitasse platea.',
    'uploads/lot-6.jpg',
    5400,
    '2020-04-30',
    500,
    3,
    6);

INSERT INTO bets (price, user_id, lot_id) VALUES (10500, 2, 1), (15500, 1, 2), (11000, 1, 1);

-- -- 1) получите все категории:
-- SELECT name FROM category;

-- -- 2) Получить самые новые, открытые лоты.
-- -- SELECT * FROM lots WHERE date_expire > NOW() ORDER BY date_create DESC;
-- -- Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, кол-во ставок, название кат.
-- SELECT
--   lots.title,
--   lots.price,
--   lots.img,
--   categories.name,
--   (SELECT MAX(price) FROM bets WHERE lots.id = bets.lot_id),
--   (SELECT COUNT(*) FROM bets WHERE lots.id = bets.lot_id)
-- FROM lots
-- LEFT JOIN categories ON lots.category_id = categories.id
-- -- LEFT JOIN bets ON lots.id = bets.lot_id
-- WHERE date_expire > NOW()
-- ORDER BY lots.date_create DESC;

-- -- 3) Показать лот по его id. Получить также название категории, к которой принадлежит лот
-- SELECT lots.title, categories.name FROM lots
-- INNER JOIN categories ON lots.category_id = categories.id
-- WHERE lots.id = 1;

-- -- 4) Обновить название лота по id
-- UPDATE lots SET title = 'NEW title for lot' WHERE id = 1;

-- -- 5) Получить список самых свежих ставок для лота по его id
-- SELECT id, date_create, price, user_id, lot_id
-- FROM bets GROUP BY lot_id ORDER BY date_create DESC;