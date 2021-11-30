DROP DATABASE EtecStudy;
CREATE DATABASE EtecStudy;
CREATE TABLE usuario (
    id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    sobrenome VARCHAR(100) NOT NULL,
    telefone VARCHAR(25) NOT NULL,
    escolaridade INT NOT NULL,
    senha VARCHAR (60) NOT NULL,
    admin BOOLEAN NOT NULL,
    estudante_etec BOOLEAN NOT NULL,
    id_professor int,
    nascimento date,
    last_view varchar(5000),
    imagem varchar(100),
    temp_imagem varchar(100)
);
CREATE TABLE materia (
    id_materia INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    descricao VARCHAR(500),
    data VARCHAR(20),
    url VARCHAR(110),
    id_disc int,
    visitas INT,
    materia VARCHAR(10000),
    imagem varchar(100),
    temp_imagem varchar(100),
    id_usuario_inclusao int,
    pdf varchar(100),
    temp_pdf varchar(100),
    foreign key (id_disc) references disciplinas(id_disc),
    foreign key (id_usuario_inclusao) references usuario(id_usuario)
);

 CREATE TABLE disciplinas (
    id_disc INT NOT NULL PRIMARY KEY,
    disciplina varchar(50)
)
