DROP DATABASE EtecStudy;

CREATE DATABASE EtecStudy;

CREATE TABLE usuario (
id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(50) NOT NULL,
nome VARCHAR(100) NOT NULL,
telefone VARCHAR(25) NOT NULL,
escolaridade INT NOT NULL,
senha VARCHAR (60) NOT NULL,
admin BOOLEAN NOT NULL,
estudante_etec BOOLEAN NOT NULL
);

CREATE TABLE materia (
id_materia INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
titulo VARCHAR(100),
descricao VARCHAR(500),
data DATETIME,
url VARCHAR(110),
disciplina int,
visitas INT,
verificado boolean,
materia VARCHAR(10000)
)