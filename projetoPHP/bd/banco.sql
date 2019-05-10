CREATE TABLE tbl_fale_conosco(
    codigo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    celular VARCHAR(15) NOT NULL,
    telefone VARCHAR(15),
    sexo CHAR NOT NULL,
    email VARCHAR(100) NOT NULL,
    profissao VARCHAR(100) NOT NULL,
    home_page VARCHAR(150),
    facebook VARCHAR(150),
    cod_assunto INT NOT NULL,
    mensagem TEXT NOT NULL,
    FOREIGN KEY (cod_assunto) REFERENCES tbl_assunto(cod_assunto)
);

CREATE TABLE tbl_assunto(
    cod_assunto INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    assunto VARCHAR(50) NOT NULL
);
ALTER TABLE tbl_fale_conosco ADD COLUMN cod_assunto INT NOT NULL AFTER facebook, FOREIGN KEY (cod_assunto) REFERENCES tbl_assunto(cod_assunto);

SELECT codigo AS Código,
nome AS Nome,
c.cod_assunto AS Código_do_Assunto,
a.assunto AS Assunto, 
celular AS Celular, 
telefone AS Telefone, 
sexo AS Sexo, 
email AS E_mail, 
profissao AS Profissão, 
home_page AS Home_Page, 
facebook AS Facebook,
mensagem AS Mensagem
    FROM tbl_fale_conosco AS c 
        JOIN tbl_assunto AS a
    ON c.cod_assunto = a.cod_assunto
    ORDER BY nome;

INSERT INTO tbl_assunto (assunto) VALUES ('info_produto');
INSERT INTO tbl_assunto (assunto) VALUES ('sugestao_critica');
INSERT INTO tbl_assunto (assunto) VALUES ('geral');