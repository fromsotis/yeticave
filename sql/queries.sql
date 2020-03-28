USE `yeticave`;

INSERT INTO categories (name)
VALUES ('Доски и лыжи'), ('Крепления'), ('Ботинки'), ('Одежда'), ('Инструменты'), ('Разное');

INSERT INTO users (email, name, password, phone) VALUES
  -- Qw12345
  ('alexey@mail.com', 'Алексей', '$2y$10$HrX3J8FE/0xITiNrYNnu0.LW3wZ7E8o5zHIm4FD.g3KqU7jrQ/wq2', '+7(999)898-98-89'),
  -- Qw123456
  ('olga@mail.com', 'Ольга', '$2y$10$DfPGYJV9KfhP6jkA1W8L/u4pVYyogiPPrfpf30vw7wL73aalLy2a.', '+7(888)999-88-99'),
  -- Qw1234567
  ('svetlana@mail.com', 'Светлана', '$2y$10$hqgBi/5OKHcaB2pafc.bsOoU9nleWb7/qjOWl4twuexxfCDFc1QQ.', '+7(898)888-99-88');

INSERT INTO lots (title, description, img, price, date_expire, user_id, category_id) VALUES
  (
    '2014 Rossignol District Snowboard',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
     Sed nisi lacus sed viverra tellus in hac habitasse platea.
     Urna cursus eget nunc scelerisque viverra.
     Sed sed risus pretium quam vulputate dignissim suspendisse.
     Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.',
    'img/lot-1.jpg',
    10999,
    '2020-03-21',
    1,
    1
  ),
  (
    'DC Ply Mens 2016/2017 Snowboard',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
     Sed nisi lacus sed viverra tellus in hac habitasse platea.
     Urna cursus eget nunc scelerisque viverra.
     Sed sed risus pretium quam vulputate dignissim suspendisse.
     Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.',
    'img/lot-2.jpg',
    15999,
    '2020-03-20',
    3,
    1
  ),
  (
    'Крепление Union Contacts Pro 2015 года размер L/XL',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
     Sed nisi lacus sed viverra tellus in hac habitasse platea.
     Urna cursus eget nunc scelerisque viverra.
     Sed sed risus pretium quam vulputate dignissim suspendisse.
     Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.',
    'img/lot-3.jpg',
    8000,
    '2020-03-18',
    1,
    2
  ),
  (
    'Ботинки для сноуборда DC Mutiny Charocal',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
     Sed nisi lacus sed viverra tellus in hac habitasse platea.
     Urna cursus eget nunc scelerisque viverra.
     Sed sed risus pretium quam vulputate dignissim suspendisse.
     Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.',
    'img/lot-4.jpg',
    10999,
    '2020-03-10',
    2,
    3
  ),
  (
    'Куртка для сноуборда DC Mutiny Charocal',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
     Sed nisi lacus sed viverra tellus in hac habitasse platea.
     Urna cursus eget nunc scelerisque viverra.
     Sed sed risus pretium quam vulputate dignissim suspendisse.
     Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.',
    'img/lot-5.jpg',
    7500,
    '2020-03-18',
    2,
    4
  ),
  (
    'Маска Oakley Canopy',
    'Lorem ipsum dolor sit amet, consectetur adipiscing elit,
     sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
     Sed nisi lacus sed viverra tellus in hac habitasse platea.
     Urna cursus eget nunc scelerisque viverra.
     Sed sed risus pretium quam vulputate dignissim suspendisse.
     Tincidunt dui ut ornare lectus. Pharetra vel turpis nunc eget lorem dolor sed.',
    'img/lot-6.jpg',
    5400,
    '2020-03-25',
    1,
    6
  );

INSERT INTO bets (price, user_id, lot_id) VALUES (11500, 2, 1), (8000, 3, 5);

-- 1) получите все категории:
SELECT name FROM category;

-- 2) Получить самые новые, открытые лоты.
-- SELECT * FROM lots WHERE date_expire > NOW() ORDER BY date_create DESC;
-- Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, кол-во ставок, название кат.
SELECT
  lots.title,
  lots.price,
  lots.img,
  categories.name,
  (SELECT MAX(price) FROM bets WHERE lots.id = bets.lot_id),
  (SELECT COUNT(*) FROM bets WHERE lots.id = bets.lot_id)
FROM lots
LEFT JOIN categories ON lots.category_id = categories.id
-- LEFT JOIN bets ON lots.id = bets.lot_id
WHERE date_expire > NOW()
ORDER BY lots.date_create DESC;

-- 3) Показать лот по его id. Получить также название категории, к которой принадлежит лот
SELECT lots.title, categories.name FROM lots
INNER JOIN categories ON lots.category_id = categories.id
WHERE lots.id = 1;

-- 4) Обновить название лота по id
UPDATE lots SET title = 'NEW title for lot' WHERE id = 1;

-- 5) Получить список самых свежих ставок для лота по его id
SELECT id, date_create, price, user_id, lot_id
FROM bets GROUP BY lot_id ORDER BY date_create DESC;