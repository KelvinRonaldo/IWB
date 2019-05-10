USE db_rrcb;
SHOW TABLES;

SELECT * FROM ativo;
SELECT * FROM tbl_fale_conosco;
SELECT * FROM tbl_noticias_principais;
SELECT * FROM tbl_assunto;

desc tbl_noticias;
desc tbl_noticias_principais;
desc tbl_fale_conosco;
desc ativo;

DROP TABLE tbl_noticias_principais;
DROP TABLE tbl_noticias;
DROP TABLE ativo;

ALTER TABLE ativo CHANGE COLUMN ativo ativo VARCHAR(10) NOT NULL;

CREATE TABLE ativo(
cod_ativo TINYINT NOT NULL PRIMARY KEY AUTO_INCREMENT,
ativo VARCHAR(10) NOT NULL
);

CREATE TABLE tbl_noticias(
    cod_noticia INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    titulo_noticia VARCHAR(90) NOT NULL,
    autor VARCHAR(50),
    data DATE,
    resumo VARCHAR(120) NOT NULL,
    cod_ativo TINYINT NOT NULL
);


CREATE TABLE tbl_noticias_principais(
    cod_noticia INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    titulo_noticia VARCHAR(90) NOT NULL,
    autor VARCHAR(50),
    data DATE,
    resumo VARCHAR(90) NOT NULL,
    nivel CHAR NOT NULL,
    cod_ativo TINYINT NOT NULL
);

INSERT INTO ativo (ativo) VALUES ('ativado');
INSERT INTO ativo (ativo) VALUES ('desativado');