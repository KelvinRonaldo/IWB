DESC tbl_assunto;
DESC tbl_cidade;
DESC tbl_endereco;
DESC tbl_estado;
DESC tbl_evento;
DESC tbl_fale_conosco;
DESC tbl_loja;
DESC tbl_noticia;
DESC tbl_noticia_principal;
DESC tbl_sobre;;
DESC tbl_nivel_usuario;
DESC tbl_usuario;
DESC tbl_destaque_noticia_principal;
DESC tbl_produto;
DESC tbl_promocao;

SELECT * FROM tbl_assunto;
SELECT * FROM tbl_cidade;
SELECT * FROM tbl_estado;
SELECT * FROM tbl_endereco;
SELECT * FROM tbl_evento;
SELECT * FROM tbl_fale_conosco;
SELECT * FROM tbl_loja;
SELECT * FROM tbl_noticia;
SELECT * FROM tbl_noticia_principal;
SELECT * FROM tbl_sobre;
SELECT * FROM tbl_nivel_usuario;
SELECT * FROM tbl_usuario;
SELECT * FROM tbl_destaque_noticia_principal;
SELECT * FROM tbl_produto;
SELECT * FROM tbl_promocao;

ALTER TABLE tbl_usuario MODIFY senha VARCHAR(135) NOT NULL AFTER email;

UPDATE tbl_nivel_usuario SET adm_conteudo = 'desativado' WHERE cod_nivel_usuario = 2;
 
DELETE FROM tbl_promocao WHERE cod_promocao = 4;

INSERT INTO tbl_nivel_usuario VALUES(1, 'Administrador', true, true, true, true, 'ativado');
INSERT INTO tbl_usuario
VALUES(1, 'kkk', 'Kelvin Ronaldo', 'kelvin@ronaldo.com', '123', 'ativado', 1);

INSERT INTO tbl_assunto (cod_assunto, assunto) VALUES (1, 'Sobre Produtos');
INSERT INTO tbl_assunto (cod_assunto, assunto) VALUES (2, 'Sugestão/Crítica');
INSERT INTO tbl_assunto (cod_assunto, assunto) VALUES (3, 'Geral');

INSERT INTO tbl_destaque_noticia_principal (destaque) VALUES ('Alto Destaque');
INSERT INTO tbl_destaque_noticia_principal (destaque) VALUES ('Médio Destaque');
INSERT INTO tbl_destaque_noticia_principal (destaque) VALUES ('Baixo Destaque');

INSERT INTO tbl_produto (nome, descricao, preco)
VALUES ('Baituca Bauau', 'Ela é monstrona mesmo man, pode confiar que é liquigás', 8734.78);

INSERT INTO tbl_produto (nome, descricao, preco)
VALUES ('Bicicleta Koan Mahuna - Aro 29" - Alumínio - 27V',
'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat nesciunt mollitia obcaecati facilis, dolorumnW.',
7654.90);

INSERT INTO tbl_promocao (percentual_desconto, preco_desconto, cod_produto)
VALUES (50, (SELECT preco FROM tbl_produto WHERE cod_produto = 1)*50/100, 1);

SELECT preco FROM tbl_produto WHERE cod_produto = 1;

ALTER TABLE tbl_nivel_usuario MODIFY adm_usuario VARCHAR(12) NOT NULL DEFAULT 'desativado' AFTER nivel;

-- SOURCE C:/Users/KELVI/Downloads/dump.sql;

SELECT np.cod_noticia, np.titulo_noticia,
np.status, np.resumo, np.cod_destaque,
np.autor, np.cod_destaque, dnp.destaque
FROM tbl_noticia_principal AS np
INNER JOIN tbl_destaque_noticia_principal AS dnp 
ON np.cod_destaque = dnp.cod_destaque
WHERE np.cod_destaque = 1;

SELECT u.nome_usuario, u.senha,
nu.adm_conteudo, nu.adm_fale_conosco,
nu.adm_produto, nu.adm_usuario
FROM tbl_usuario AS u
INNER JOIN tbl_nivel_usuario AS nu
ON u.cod_nivel_usuario = nu.cod_nivel_usuario
WHERE u.nome_usuario = 'Kelvin Ronaldo' AND u.senha = '123';
    
SELECT tabEvent.cod_evento, tabEvent.titulo_evento, tabEvent.host, 
tabEvent.entrada, tabEvent.descricao, tabEvent.data, tabEvent.imagem,
tabEvent.status, tabEvent.cod_endereco, 
tabAddress.logradouro, tabAddress.numero,
tabAddress.bairro, tabAddress.cep,
tabCity.cidade, tabState.estado, tabCity.cod_cidade, tabState.cod_estado
FROM tbl_evento AS tabEvent
INNER JOIN tbl_endereco AS tabAddress
ON tabEvent.cod_endereco = tabAddress.cod_endereco
INNER JOIN tbl_cidade AS tabCity
ON tabAddress.cod_cidade = tabCity.cod_cidade
INNER JOIN tbl_estado AS tabState
ON tabCity.cod_estado = tabState.cod_estado;

SELECT promo.percentual_desconto, promo.status, promo.cod_produto,
produto.nome, produto.preco
FROM tbl_promocao AS promo
INNER JOIN tbl_produto AS produto
ON promo.cod_produto = produto.cod_produto;


SELECT l.cod_loja, l.status, e.logradouro, e.bairro, e.cep, cd.cidade, et.uf
FROM tbl_loja AS l INNER JOIN tbl_endereco AS e ON l.cod_endereco = e.cod_endereco
INNER JOIN tbl_cidade AS cd ON e.cod_cidade = cd.cod_cidade
INNER JOIN tbl_estado AS et ON cd.cod_estado = et.cod_estado
WHERE l.status = 'ativado';

SELECT promo.preco_produto, promo.nome, promo.preco,
produto.percentual_desconto
FROM tbl_promocao AS promo, tbl_produto AS produto 
WHERE cod_promocao = 6;

SELECT promo.percentual_desconto, promo.preco_desconto, promo.status AS status_promocao,
produto.nome, produto.preco, produto.status AS status_promocao, produto.imagem
FROM tbl_promocao AS promo
INNER JOIN tbl_produto AS produto
ON promo.cod_produto = produto.cod_produto
WHERE promo.status = 'ativado' AND produto.status = 'ativado';














