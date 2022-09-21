DROP DATABASE readnow;
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

CREATE TABLE IF NOT EXISTS AUTOR
(
cd_autor int not null auto_increment,
cd_tipo_usuario int not null,
nm_autor varchar (80) not null,
nm_senha_autor varchar(80) not null,
nm_email_autor varchar(150) not null,
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
cd_autor int not null,
nm_livro varchar(150) not null,
ds_livro text not null,
dt_lancamento date not null,
vl_livro decimal(10,2) not null,
CONSTRAINT pk_livro PRIMARY KEY(cd_livro),
CONSTRAINT fk_livro_autor FOREIGN KEY livro(cd_autor) REFERENCES autor(cd_autor)
);

CREATE TABLE IF NOT EXISTS livroCategoria
(
cd_livro_categoria int not null auto_increment,
cd_livro int not null,
cd_categoria int not null,
CONSTRAINT pk_livroCategoria PRIMARY KEY(cd_livro_categoria),
CONSTRAINT fk_livroCategoria FOREIGN KEY livroCategoria(cd_livro) REFERENCES livro(cd_livro),
CONSTRAINT fk_categoriaLivro FOREIGN KEY livroCategoria(cd_categoria) REFERENCES categoria(cd_categoria)
);

desc livro;