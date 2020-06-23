-- TODO: Put ALL SQL in between `BEGIN TRANSACTION` and `COMMIT`
BEGIN TRANSACTION;

-- users table
CREATE TABLE `users` (
	`id`INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`fullname`TEXT NOT NULL,
	`username`TEXT NOT NULL,
	`password`TEXT NOT NULL
);

-- images table
CREATE TABLE `images` (
	`id`INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`img_name`TEXT NOT NULL,
	`ext`TEXT NOT NULL,
	`description`TEXT,
    `user_id`INTEGER NOT NULL
);

-- tags table
CREATE TABLE `tags` (
	`id`INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`tag`TEXT NOT NULL
);

-- image_tags table
CREATE TABLE `image_tags` (
	`id`INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`tag_id`TEXT NOT NULL,
	`image_id`TEXT NOT NULL
);

-- sessions table
CREATE TABLE 'sessions' (
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	user_id INTEGER NOT NULL,
	session TEXT NOT NULL UNIQUE
);


-- initial seed data
INSERT INTO `users` (fullname, username, password) VALUES ('Shea Murphy', 'sm967', '$2y$10$Mckn/4XowF9xhq78KtZ3GewXuCOXPs/hCv2ewtVAaH4Lw4cRnR.7i');
-- pw: elixir2001
INSERT INTO `users` (fullname, username, password) VALUES ('Barbara Murphy', 'goddessofbees', '$2y$10$lZwkeuDlwIwYnQh86Q9Slu9/GAIbqvbqCF4jBVIaETlZGHEAKWShu');
-- pw: barbaralang
INSERT INTO `users` (fullname, username, password) VALUES ('David Comora', 'DavidComora', '$2y$10$XfPxeeZ/8PY3EKEcQ2myQ.4z5xYeh8IG88KgBfeblpUmtxHIUCrJC');
-- pw: ProfessionalPhotographer

INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-1', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-2', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-3', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-4', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-5', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-6', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-7', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-8', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-9', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-20', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-11', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-12', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-13', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-14', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-15', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-16', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-17', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-18', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-19', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-20', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-21', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-22', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-23', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-24', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-25', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-26', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-27', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-28', 'jpg', 3);
INSERT INTO `images` (img_name, ext, user_id) VALUES ('comora-29', 'jpg', 3);

INSERT INTO `tags` (tag) VALUES ('comora');
INSERT INTO `tags` (tag) VALUES ('black and white');
INSERT INTO `tags` (tag) VALUES ('spring 2019');
INSERT INTO `tags` (tag) VALUES ('new york');
INSERT INTO `tags` (tag) VALUES ('emily');

INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  1);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  1);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  1);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  1);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  2);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  2);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  2);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  2);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  3);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  3);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  3);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  3);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  4);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  4);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  4);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  4);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  5);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  5);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  5);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  5);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  6);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  6);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  6);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  6);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  7);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  7);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  7);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  7);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  8);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  8);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  8);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  8);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  9);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  9);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  9);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  9);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  10);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  10);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  10);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  10);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  11);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  11);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  11);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  11);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  12);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  12);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  12);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  12);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  13);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  13);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  13);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  13);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  14);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  14);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  14);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  14);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  15);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  15);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  15);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  15);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  16);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  16);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  16);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  16);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  17);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  17);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  17);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  17);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  18);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  18);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  18);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  18);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  19);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  19);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  19);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  19);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  20);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  20);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  20);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  20);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  21);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  21);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  21);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  21);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  22);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  22);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  22);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  22);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  23);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  23);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  23);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  23);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  24);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  24);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  24);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  24);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  25);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  25);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  25);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  25);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  26);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  26);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  26);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  26);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  27);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  27);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  27);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  27);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  28);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  28);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  28);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  28);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (1,  29);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (2,  29);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (3,  29);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (4,  29);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (5,  12);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (5,  14);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (5,  15);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (5,  16);
INSERT INTO `image_tags` (tag_id, image_id) VALUES (5,  17);

COMMIT;
