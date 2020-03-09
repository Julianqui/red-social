CREATE DATABASE IF NOT EXISTS laravel_master;
USE laravel_master;

CREATE TABLE users(
id              int(255) auto_increment not null,
role            varchar(20),
name            varchar(100),
surname         varchar(200),
nick            varchar(100),
email           varchar(200),
password        varchar(255),
image           varchar(255),
create_at       datetime,
update_at       datetime,
remember_token  varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)

)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'user', 'Victor', 'Quinteiro', 'victorroblesweb', 'victr@victor.com', 'pass', null, CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES(NULL, 'user', 'juan', 'Lopez', 'ictorroblesweb', 'victr@victor.com', 'pass', null, CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES(NULL, 'user', 'Manolo', 'Garcia', 'vitorroblesweb', 'victr@victor.com', 'pass', null, CURTIME(), CURTIME(), NULL);



CREATE TABLE IF NOT EXISTS IMAGES(
id          int(255) auto_increment not null,
user_id     int(255),
image_path  varchar(255),
description text,
create_at   datetime,
updated_at  datetime,
CONSTRAINT pk_images PRIMARY KEY(id),
CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;


INSERT INTO images VALUES(NULL, 1, 'test.jpg', 'desciripcion', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 3, 'familia.jpg', 'desciripcion', CURTIME(), CURTIME());


CREATE TABLE IF NOT EXISTS comments(
id          int(255) auto_increment not null,
user_id     int(255),
image_id    int(255),
content     text,
create_at   datetime,
updated_at  datetime,
CONSTRAINT pk_comments PRIMARY KEY(id),
CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;


INSERT INTO comments VALUES(NULL, 1, 4, 'Buena foto de familia', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2, 1, 'Buena foto de familia', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2, 4, 'Buena foto de familia', CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS likes(
id          int(255) auto_increment not null,
user_id     int(255),
image_id    int(255),
create_at   datetime,
updated_at  datetime,
CONSTRAINT pk_likes PRIMARY KEY(id),
CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO comments VALUES(NULL, 1, 2, CURTIME(), CURTIME());
