
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

SELECT n.titulo_noticia AS Titulo, n.principal AS Principal, a.se_ativo
FROM tbl_noticias AS n JOIN ativo AS a
ON n.cod_ativo = a.cod_ativo;
