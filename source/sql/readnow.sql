DROP DATABASE IF EXISTS readnow;
CREATE DATABASE IF NOT EXISTS readnow;
USE readnow;

CREATE TABLE IF NOT EXISTS tipo_usuario
(
cd_tipo_usuario int not null auto_increment,
nm_tipo_usuario varchar(20) not null,
CONSTRAINT pk_tipo_usuario PRIMARY KEY(cd_tipo_usuario)
);

CREATE TABLE IF NOT EXISTS usuario
(
cd_usuario int not null auto_increment,
cd_tipo_usuario int not null,
nm_usuario varchar (80) not null,
nm_senha_usuario varchar(80) not null,
nm_email_usuario varchar(150) not null,
CONSTRAINT pk_usuario PRIMARY KEY(cd_usuario),
CONSTRAINT fk_usuario_tipo_usuario FOREIGN KEY usuario(cd_tipo_usuario) REFERENCES tipo_usuario(cd_tipo_usuario)
);

CREATE TABLE IF NOT EXISTS autor
(
cd_autor int not null auto_increment,
cd_tipo_usuario int not null,
nm_autor varchar (80) not null,
ds_autor text,
nm_senha_autor varchar(80) not null,
nm_email_autor varchar(150) not null,
cd_img_autor longtext,
CONSTRAINT pk_autor PRIMARY KEY(cd_autor),
CONSTRAINT fk_autor_tipo_usuario FOREIGN KEY autor(cd_tipo_usuario) REFERENCES tipo_usuario(cd_tipo_usuario)
);

CREATE TABLE IF NOT EXISTS categoria 
(
cd_categoria int not null auto_increment,
nm_categoria varchar(80) not null,
CONSTRAINT pk_categoria PRIMARY KEY(cd_categoria)
);

CREATE TABLE IF NOT EXISTS livro
(
cd_livro int not null auto_increment,
cd_categoria int not null,
cd_autor int not null,
nm_livro varchar(150) not null,
ds_livro text not null,
dt_lancamento date not null,
vl_livro decimal(10,2),
cd_img_livro longtext not null,
CONSTRAINT pk_livro PRIMARY KEY(cd_livro),
CONSTRAINT fk_livro_autor FOREIGN KEY livro(cd_autor) REFERENCES autor(cd_autor),
CONSTRAINT fk_livro_categoria FOREIGN KEY livro(cd_categoria) REFERENCES categoria(cd_categoria)
);





CREATE TABLE IF NOT EXISTS favorito
(
cd_favorito int not null auto_increment,
cd_livro int not null,
cd_usuario int not null,
CONSTRAINT pk_favorito PRIMARY KEY(cd_favorito),
CONSTRAINT fk_favorito_livro FOREIGN KEY favorito(cd_livro) REFERENCES livro(cd_livro),
CONSTRAINT fk_favorito_usuario FOREIGN KEY favorito(cd_usuario) REFERENCES usuario(cd_usuario)
);

INSERT INTO CATEGORIA VALUES 
(DEFAULT, "Ação"),
(DEFAULT, "Aventura"),
(DEFAULT, "Fantasia"),
(DEFAULT, "Ficção"),
(DEFAULT, "Romance"),
(DEFAULT, "Suspense"),
(DEFAULT, "Terror");

insert into tipo_usuario values
(default, 'adm'),
(default, 'autor'),
(default, 'cliente');

insert into autor values
(default,2,'autor1','autor 1, nascido em tal',md5('123'),'autor@gmail.com', 'img');

insert into usuario values
(default,3,'usuario', md5('123'),'usuario@gmail.com');

insert into autor values
(default,2,'autor2','autor 1, nascido em tal',md5('123'),'autor2@gmail.com', 'img');

desc usuario;

select * from autor;

SELECT * FROM autor where nm_email_autor = "autor@gmail.com" and nm_senha_autor = md5("123");

insert into livro values
(default, 1, 1, "Harry Potter e o prisioneiro de azkaban", "ivro harry potter...", '2022-09-21',10.90,'livro1.jpg');

insert into livro values
(default,2,  2, "Jogos Vorazes", "ivro harry potter...", '2022-09-24',10.90,'livro2.jpg');

insert into livro values
(default,3, 2, "Anne de Green Gables", "ivro harry potter...", '2022-09-23',10.90,'livro3.jpg');

insert into livro values
(default,4, 1, "O labirinto do fauno", "ivro harry potter...", '2022-09-22',10.90,'livro4.jpg');

select nm_autor,cd_livro,cd_img_livro,nm_livro,dt_lancamento from livro join autor on livro.cd_autor = autor.cd_autor order by dt_lancamento desc limit 4;

select * from livro order by dt_lancamento desc limit 3;

