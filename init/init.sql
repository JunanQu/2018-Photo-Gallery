/* TODO: create tables */
CREATE TABLE `accounts` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`username`	TEXT NOT NULL UNIQUE,
	`password`	TEXT NOT NULL,
	`session`	TEXT UNIQUE
);

CREATE TABLE `photos` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  `photo_name` TEXT NOT NULL,
  `photo_ext` TEXT NOT NULL,
  `photo_description` TEXT NOT NULL,
  `photo_date` DATE
);

CREATE TABLE `tags` (
  `id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  `tag_name` TEXT NOT NULL
);

CREATE TABLE `photo_tags` (
`id`  INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
`photo_id` INTEGER,
`tag_id` INTEGER
);

CREATE TABLE `photo_users` (
`id`  INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
`photo_id` INTEGER,
`user_id` INTEGER,
`user_name` TEXT NOT NULL
);

-- photo_tags
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('2', '1');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('2', '5');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('1', '2');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('1', '7');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('2', '5');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('6', '9');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('2', '1');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('10', '8');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('6', '7');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('10', '7');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('7', '3');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('7', '9');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('8', '4');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('3', '1');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('2', '9');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('5', '9');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('4', '9');
INSERT INTO `photo_tags` ( photo_id, tag_id ) VALUES ('6', '3');
-- photo_users
INSERT INTO `photo_users` ( photo_id, user_id, user_name) VALUES ('2', '2', 'Smashpotato');
INSERT INTO `photo_users` ( photo_id, user_id, user_name) VALUES ('3', '2', 'Smashpotato');
INSERT INTO `photo_users` ( photo_id, user_id, user_name) VALUES ('4', '2', 'Smashpotato');
INSERT INTO `photo_users` ( photo_id, user_id, user_name) VALUES ('5', '2', 'Smashpotato');
INSERT INTO `photo_users` ( photo_id, user_id, user_name) VALUES ('1', '2', 'Smashpotato');
INSERT INTO `photo_users` ( photo_id, user_id, user_name) VALUES ('6', '1', 'Leokerry');
INSERT INTO `photo_users` ( photo_id, user_id, user_name) VALUES ('6', '1', 'Leokerry');
INSERT INTO `photo_users` ( photo_id, user_id, user_name) VALUES ('8', '1', 'Leokerry');
INSERT INTO `photo_users` ( photo_id, user_id, user_name) VALUES ('9', '1', 'Leokerry');
INSERT INTO `photo_users` ( photo_id, user_id, user_name) VALUES ('10', '1', 'Leokerry');

-- images
INSERT INTO  `photos` (id, photo_name, photo_ext, photo_description) VALUES ( 1, '1' ,  'jpg' ,  'Grilled Lobster, Manhattan');
INSERT INTO  `photos` (id, photo_name, photo_ext, photo_description) VALUES ( 2, '2' ,  'jpg' ,  'Passionfruit Icecream, Manhattan');
INSERT INTO  `photos` (id, photo_name, photo_ext, photo_description) VALUES ( 3, '3' ,  'jpg' ,  'Cheddar Cheese with Baked Apple, Manhattan');
INSERT INTO  `photos` (id, photo_name, photo_ext, photo_description) VALUES ( 4, '4' ,  'jpg' ,  'Roasted Duck, Manhattan');
INSERT INTO  `photos` (id, photo_name, photo_ext, photo_description) VALUES ( 5, '5' ,  'jpg' ,  'Butter Poached Lobster with Potato Cake, Manhattan');
INSERT INTO  `photos` (id, photo_name, photo_ext, photo_description) VALUES ( 6, '6' ,  'jpg' ,  'Roasted Squash, Manhattan');
INSERT INTO  `photos` (id, photo_name, photo_ext, photo_description) VALUES ( 7, '7' ,  'jpg' ,  'Same Squash As Previous One');
INSERT INTO  `photos` (id, photo_name, photo_ext, photo_description) VALUES ( 8, '8' ,  'jpg' ,  'Sweet Potato Dessert, Manhattan');
INSERT INTO  `photos` (id, photo_name, photo_ext, photo_description) VALUES ( 9, '9' ,  'jpg' ,  'Cranberry, Manhattan');
INSERT INTO  `photos` (id, photo_name, photo_ext, photo_description) VALUES ( 10, '10' ,  'jpg' ,  'Empire State, Manhattan');
-- account info
INSERT INTO `accounts` (id, username, password) VALUES ( 1, 'Leokerry' ,  'cornellishard');
INSERT INTO `accounts` (id, username, password) VALUES ( 2, 'Smashpotato' ,  'info2300isharder');

--tags
INSERT INTO  `tags` (id, tag_name) VALUES ( 1, 'EGG');
INSERT INTO  `tags` (id, tag_name) VALUES ( 2,'LOBSTER');
INSERT INTO  `tags` (id, tag_name) VALUES ( 3, 'SQUASH');
INSERT INTO  `tags` (id, tag_name) VALUES ( 4, 'SWEET_POTATO');
INSERT INTO  `tags` (id, tag_name) VALUES ( 5, 'DESERT');
INSERT INTO  `tags` (id, tag_name) VALUES ( 6, 'RASPERRY');
INSERT INTO  `tags` (id, tag_name) VALUES ( 7, 'NYC');
INSERT INTO  `tags` (id, tag_name) VALUES ( 8, 'EMPIRE_STATE');
INSERT INTO  `tags` (id, tag_name) VALUES ( 9, 'ELEVEN_MADISON_PARK');
