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
) CREATE TABLE disciplinas (
    id_disc INT NOT NULL PRIMARY KEY,
    disciplina varchar(50)
)
INSERT INTO disciplinas
values (1, "Artes");
INSERT INTO disciplinas
values (2, "Biologia");
INSERT INTO disciplinas
values (12, "Ética");
INSERT INTO disciplinas
values (13, "Educação Física");
INSERT INTO disciplinas
values (3, "Física");
INSERT INTO disciplinas
values (4, "Geografia");
INSERT INTO disciplinas
values (5, "História");
INSERT INTO disciplinas
values (6, "Inglês");
INSERT INTO disciplinas
values (7, "Literatura");
INSERT INTO disciplinas
values (8, "Matemática");
INSERT INTO disciplinas
values (9, "Português");
INSERT INTO disciplinas
values (10, "Química");
INSERT INTO disciplinas
values (11, "Redação");