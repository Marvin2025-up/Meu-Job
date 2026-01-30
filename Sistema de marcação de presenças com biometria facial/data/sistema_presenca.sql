CREATE DATABASE sistema_presenca;
USE sistema_presenca;

CREATE TABLE administrador (
    id_admin INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255)
);

CREATE TABLE formador (
    id_formador INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE,
    senha VARCHAR(255)
);

CREATE TABLE turma (
    id_turma INT PRIMARY KEY AUTO_INCREMENT,
    Numero_turma VARCHAR(10) NOT NULL
);

CREATE TABLE biometria_facial (
    id_biometria INT PRIMARY KEY AUTO_INCREMENT,
    codificacao_facial JSON NOT NULL, 
    data_captura DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE formando (
    id_formando INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    numero INT NOT NULL,
    email VARCHAR(255) UNIQUE,
    id_formador INT NOT NULL,
    id_turma INT NOT NULL,
    id_biometria INT NOT NULL,
    FOREIGN KEY (id_formador) REFERENCES formador(id_formador),
    FOREIGN KEY (id_turma) REFERENCES turma(id_turma),
    FOREIGN KEY (id_biometria) REFERENCES biometria_facial(id_biometria)
);


CREATE TABLE presenca (
    id_presenca INT PRIMARY KEY AUTO_INCREMENT,
    data_presenca DATETIME DEFAULT CURRENT_TIMESTAMP,
    tipo VARCHAR(50) DEFAULT 'Presente',
    id_formando INT NOT NULL,
    FOREIGN KEY (id_formando) REFERENCES formando(id_formando) ON DELETE CASCADE
);


INSERT INTO administrador(email, senha) VALUES ('admin@gmail.com', '$2y$10$iN0iowcK78/Dd6XUAnwhg.bV8ehrvYyi3tlT2IrUeQevY.7WsL5iW');
INSERT INTO turma(Numero_turma) VALUES ('T1'), ('T2');
ALTER TABLE formador
ADD genero VARCHAR(20) NOT NULL AFTER nome;
ALTER TABLE formador
ADD data_nascimento DATE NOT NULL AFTER genero;

