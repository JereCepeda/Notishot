CREATE DATABASE IF NOT EXISTS laravel_master;
USE laravel_master;

CREATE TABLE IF NOT EXISTS users(
id              int(255) auto_increment not null,
role            varchar(20),
name            varchar(100),
surname         varchar(200),
nick            varchar(100),
email           varchar(255),
password        varchar(255),
image           varchar(255),
created_at      datetime,
updated_at      datetime,
remember_token  varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO users
VALUES(
    1,
    'user',
    'victorroblesweb',
    'Robles',
    'imagen',
    'Víctor',
    'victor@victor.com',
    CURTIME(),
    'pass',
    NULL,
    CURTIME(),
    CURTIME()
);
INSERT INTO users VALUES(2, 'user', 'Juan', 'Lopez', 'juanlopez', 'juan@juan.com', 'pass', null, CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES(3, 'user', 'Manolo', 'Garcia', 'manologarcia', 'manolo@manolo.com', 'pass', null, CURTIME(), CURTIME(), NULL);

CREATE TABLE IF NOT EXISTS images(
id              int(255) auto_increment not null,
user_id         int(255),
image_path      varchar(255),
description     text,
created_at      datetime,
updated_at      datetime,
CONSTRAINT pk_images PRIMARY KEY(id),
CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'user', 'Víctor', 'Robles', 'victorroblesweb', 'victor@victor.com', 'pass', null, CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES(NULL, 'user', 'Juan', 'Lopez', 'juanlopez', 'juan@juan.com', 'pass', null, CURTIME(), CURTIME(), NULL);
INSERT INTO users VALUES(NULL, 'user', 'Manolo', 'Garcia', 'manologarcia', 'manolo@manolo.com', 'pass', null, CURTIME(), CURTIME(), NULL);

INSERT INTO images VALUES(1,'descripción de prueba 1', 'test.jpg', 1,  CURTIME(), CURTIME());
INSERT INTO images VALUES(2,'descripción de prueba 2', 'playa.jpg', 1,  CURTIME(), CURTIME());
INSERT INTO images VALUES(3,'descripción de prueba 3', 'arena.jpg', 1,  CURTIME(), CURTIME());
INSERT INTO images VALUES(4,'descripción de prueba 4', 'familia.jpg', 3,  CURTIME(), CURTIME());

INSERT INTO comments VALUES(1, 1, 4, 'Buena foto de familia!!', CURTIME(), CURTIME());
INSERT INTO comments VALUES(2, 2, 1, 'Buena foto de PLAYA!!', CURTIME(), CURTIME());
INSERT INTO comments VALUES(3, 2, 4, 'que bueno!!', CURTIME(), CURTIME());

INSERT INTO likes VALUES(1, 1, 4);
INSERT INTO likes VALUES(2, 2, 4);
INSERT INTO likes VALUES(3, 3, 1);
INSERT INTO likes VALUES(4, 3, 2);
INSERT INTO likes VALUES(5, 2, 1);

CREATE TABLE IF NOT EXISTS comments(
id              int(255) auto_increment not null,
user_id         int(255),
image_id        int(255),
content         text,
created_at      datetime,
updated_at      datetime,
CONSTRAINT pk_comments PRIMARY KEY(id),
CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO comments VALUES(NULL, 1, 4, 'Buena foto de familia!!', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2, 1, 'Buena foto de PLAYA!!', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2, 4, 'que bueno!!', CURTIME(), CURTIME());

CREATE TABLE IF NOT EXISTS likes(
id              int(255) auto_increment not null,
user_id         int(255),
image_id        int(255),
created_at      datetime,
updated_at      datetime,
CONSTRAINT pk_likes PRIMARY KEY(id),
CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO likes VALUES(NULL, 1, 4, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 2, 4, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 1, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 2, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 2, 1, CURTIME(), CURTIME());