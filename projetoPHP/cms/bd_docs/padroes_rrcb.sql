DESC tbl_assunto;
DESC tbl_cidade;
DESC tbl_endereco;
DESC tbl_estado;
DESC tbl_evento;
DESC tbl_fale_conosco;
DESC tbl_loja;
DESC tbl_noticia;
DESC tbl_noticia_principal;
DESC tbl_sobre;
DESC tbl_nivel_usuario;
DESC tbl_usuario;
DESC tbl_destaque_noticia_principal;
DESC tbl_produto;
DESC tbl_promocao;
DESC tbl_produto_subcategoria_categoria;
DESC tbl_categoria_subcategoria;
DESC tbl_subcategoria;
DESC tbl_categoria;

DROP DATABASE db_rrcb;

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
SELECT * FROM tbl_produto_subcategoria_categoria;
SELECT * FROM tbl_categoria_subcategoria;
SELECT * FROM tbl_subcategoria;
SELECT * FROM tbl_categoria;

UPDATE tbl_produto SET status = 'ativado' WHERE cod_produto > 0;

#TRAZER PRODUTOS ALEATÓRIAMENTE
SELECT * FROM tbl_produto WHERE status = 'ativado' ORDER BY RAND();
UPDATE tbl_subcategoria SET status = 'ativado' WHERE cod_subcategoria > 0;

#CAIXA DE PESQUISA
SELECT DISTINCT p.nome, p.*, pr.*, pr.status AS status_promocao FROM tbl_produto AS p
LEFT JOIN tbl_promocao AS pr
ON p.cod_produto = pr.cod_produto
WHERE nome LIKE '%luvas%de%' OR
descricao LIKE '%luvas%de%'
GROUP BY p.nome;

SELECT p.*, pr.*, pr.status AS status_promocao FROM tbl_produto AS p
LEFT JOIN tbl_promocao AS pr
ON p.cod_produto = pr.cod_produto
WHERE p.nome LIKE '%bike%' OR
p.descricao LIKE '%bike%'
GROUP BY p.nome;

#TRAZER PRODUTOS DE DETERMINADA CATEGORIA OU/E SUB CATEGORIA
SELECT * FROM tbl_produto AS p
INNER JOIN tbl_produto_subcategoria_categoria AS tpsc
ON p.cod_produto = tpsc.cod_produto
INNER JOIN tbl_subcategoria AS s
ON tpsc.cod_subcategoria = s.cod_subcategoria
INNER JOIN tbl_categoria AS c
ON tpsc.cod_categoria = c.cod_categoria;
WHERE c.cod_categoria = 1 AND s.cod_subcategoria = 7
AND c.status = 'ativado' AND s.status = 'ativado';

SELECT p.*, pr.*, c.*, s.*
FROM tbl_promocao AS pr
RIGHT JOIN tbl_produto AS p
ON pr.cod_produto = p.cod_produto
INNER JOIN tbl_produto_subcategoria_categoria AS tpsc
ON p.cod_produto = tpsc.cod_produto
INNER JOIN tbl_subcategoria AS s
ON tpsc.cod_subcategoria = s.cod_subcategoria
INNER JOIN tbl_categoria AS c
ON tpsc.cod_categoria = c.cod_categoria
WHERE p.cod_produto = 6;

SELECT DISTINCT p.nome, p.preco, p.cod_produto, p.imagem,
pr.cod_promocao, pr.percentual_desconto,
pr.preco_desconto, pr.status AS status_promocao, 
pr.numero_parcelas, pr.metodo_pagamento, pr.preco_parcelas,
c.cod_categoria
FROM tbl_promocao AS pr
INNER JOIN tbl_produto AS p
ON pr.cod_produto = p.cod_produto
INNER JOIN tbl_produto_subcategoria_categoria AS tpsc
ON p.cod_produto = tpsc.cod_produto
INNER JOIN tbl_subcategoria AS s
ON tpsc.cod_subcategoria = s.cod_subcategoria
INNER JOIN tbl_categoria AS c
ON tpsc.cod_categoria = c.cod_categoria
WHERE p.status = 'ativado' 
AND s.status = 'ativado' 
AND c.status = 'ativado' 
AND pr.status = 'ativado';

#SUBCATEGORIAS DE UM CATEGORIA PARA MENU DO INICIO
SELECT distinct s.subcategoria,s.cod_subcategoria
FROM tbl_categoria AS c
INNER JOIN tbl_produto_subcategoria_categoria AS tpsc
ON c.cod_categoria = tpsc.cod_categoria
INNER JOIN tbl_subcategoria AS s
ON tpsc.cod_subcategoria = s.cod_subcategoria
WHERE c.cod_categoria = 1;

#SUBCATEGORIAS DE UM CATEGORIA
SELECT s.subcategoria, s.cod_subcategoria, 
c.cod_categoria, c.categoria
FROM tbl_categoria AS c
INNER JOIN tbl_categoria_subcategoria AS cs
ON c.cod_categoria = cs.cod_categoria
INNER JOIN tbl_subcategoria AS s
ON cs.cod_subcategoria = s.cod_subcategoria
WHERE c.cod_categoria = 1;


SELECT distinct c.cod_categoria, c.categoria
FROM tbl_categoria AS c
INNER JOIN tbl_produto_subcategoria_categoria AS tpsc
ON c.cod_categoria = tpsc.cod_categoria
INNER JOIN tbl_subcategoria AS s
ON tpsc.cod_subcategoria = s.cod_subcategoria
WHERE tpsc.cod_categoria <> 2 ;

SELECT s.subcategoria, s.cod_subcategoria,
c.cod_categoria, group_concat(' ',c.categoria) AS categorias
FROM tbl_categoria AS c
INNER JOIN tbl_categoria_subcategoria AS cs
ON c.cod_categoria = cs.cod_categoria
INNER JOIN tbl_subcategoria AS s
ON cs.cod_subcategoria = s.cod_subcategoria
GROUP BY s.cod_subcategoria;

#BUSCAR PROMOCOES ATIVADAS DE PRODUTOS ATIVADOS
SELECT  distinct promo.cod_promocao, s.cod_subcategoria, c.cod_categoria, promo.cod_promocao
FROM tbl_promocao AS promo
INNER JOIN tbl_produto AS produto
ON promo.cod_produto = produto.cod_produto
INNER JOIN tbl_produto_subcategoria_categoria AS tpsc
ON produto.cod_produto = tpsc.cod_produto
INNER JOIN tbl_subcategoria AS s
ON tpsc.cod_subcategoria = s.cod_subcategoria
INNER JOIN tbl_categoria AS c
ON tpsc.cod_categoria = c.cod_categoria
WHERE c.cod_categoria = 1 AND s.cod_subcategoria > 0;

#------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
INSERT INTO tbl_nivel_usuario VALUES(1, 'master', 'ativado', 'ativado', 'ativado', 'ativado', 'ativado');
INSERT INTO tbl_usuario
VALUES(1, 'master', 'MASTER', 'user@master.com',
'3C9909AFEC25354D551DAE21590BB26E38D53F2173B8D3DC3EEE4C047E7AB1C1EB8B85103E3BE7BA613B31BB5C9C36214DC9F14A42FD7A2FDB84856BCA5C44C2', 'ativado', 1);

INSERT INTO tbl_assunto (cod_assunto, assunto) VALUES (1, 'Sobre Produtos');
INSERT INTO tbl_assunto (cod_assunto, assunto) VALUES (2, 'Sugestão/Crítica');
INSERT INTO tbl_assunto (cod_assunto, assunto) VALUES (3, 'Geral');

INSERT INTO tbl_destaque_noticia_principal (cod_destaque, destaque) VALUES (1, 'Alto Destaque');
INSERT INTO tbl_destaque_noticia_principal (cod_destaque, destaque) VALUES (2, 'Médio Destaque');
INSERT INTO tbl_destaque_noticia_principal (cod_destaque, destaque) VALUES (3, 'Baixo Destaque');

INSERT INTO tbl_categoria (cod_categoria, categoria) VALUES(1, 'Caloi');
INSERT INTO tbl_categoria (cod_categoria, categoria) VALUES(2, 'Mormaii');

INSERT INTO tbl_subcategoria (cod_subcategoria, subcategoria) VALUES(1, 'Bicicleta de Lazer');
INSERT INTO tbl_subcategoria (cod_subcategoria, subcategoria) VALUES(2, 'Bicicleta Esportiva');
INSERT INTO tbl_subcategoria (cod_subcategoria, subcategoria) VALUES(3, 'Bicicleta Elétrica');
INSERT INTO tbl_subcategoria (cod_subcategoria, subcategoria) VALUES(4, 'Bicicleta Ergométrica');
INSERT INTO tbl_subcategoria (cod_subcategoria, subcategoria) VALUES(5, 'Luvas');
INSERT INTO tbl_subcategoria (cod_subcategoria, subcategoria) VALUES(6, 'Banco');
INSERT INTO tbl_subcategoria (cod_subcategoria, subcategoria) VALUES(7, 'Chave de Quadro');

INSERT INTO tbl_produto (cod_produto, nome, descricao, preco, imagem)
VALUES (6, 'BIKE 1', 'BICILCETA ESPORTIVA LAZER', 762.44, 'bike.jpg');
INSERT INTO tbl_produto (cod_produto, nome, descricao, preco, imagem)
VALUES (7, 'BIKE 2', 'BICILCETA ELÉTRICA LAZER', 6326.23, 'bike2.jpg');
INSERT INTO tbl_produto (cod_produto, nome, descricao, preco, imagem)
VALUES (8, 'BIKE 3', 'BICILCETA LAZER ESPORTIVA', 632.85, 'bike3.jpg');
INSERT INTO tbl_produto (cod_produto, nome, descricao, preco, imagem)
VALUES (9, 'BIKE 4', 'BICILCETA ERGOMÉTRICA ESPORTIVA', 63432.85, 'bike4.jpg');
INSERT INTO tbl_produto (cod_produto, nome, descricao, preco, imagem)
VALUES (10, 'BIKE 5', 'BICICLETA ELÉTRICA', 7482.93, 'bike5.jpg');
INSERT INTO tbl_produto (cod_produto, nome, descricao, preco, imagem)
VALUES (11, 'Luvas de Ciclismo', 'Luvas M de tectel para ciclistas', 743.92, 'luvas.jpg');
INSERT INTO tbl_produto (cod_produto, nome, descricao, preco, imagem)
VALUES (12, 'Banco de Bike', 'Banco de Bicicleta de couro preto e detalhes vermelhos', 873.90, 'banco.jpg');
INSERT INTO tbl_produto (cod_produto, nome, descricao, preco, imagem)
VALUES (13, 'Chave de Quadro', 'Kit de Manutenção de Quadro', 13673.35, 'chave_de_quadro.jpg');

#INSERIR RELAÇÃO ENTRE CATEGORIA  SUBCATEGORIAS
INSERT INTO tbl_categoria_subcategoria (cod_subcategoria, cod_categoria) VALUES (1, 1);
INSERT INTO tbl_categoria_subcategoria (cod_subcategoria, cod_categoria) VALUES (2, 1);
INSERT INTO tbl_categoria_subcategoria (cod_subcategoria, cod_categoria) VALUES (3, 1);
INSERT INTO tbl_categoria_subcategoria (cod_subcategoria, cod_categoria) VALUES (5, 1);
INSERT INTO tbl_categoria_subcategoria (cod_subcategoria, cod_categoria) VALUES (7, 1);

INSERT INTO tbl_categoria_subcategoria (cod_subcategoria, cod_categoria) VALUES (3, 2);
INSERT INTO tbl_categoria_subcategoria (cod_subcategoria, cod_categoria) VALUES (1, 2);
INSERT INTO tbl_categoria_subcategoria (cod_subcategoria, cod_categoria) VALUES (4, 2);
INSERT INTO tbl_categoria_subcategoria (cod_subcategoria, cod_categoria) VALUES (2, 2);
INSERT INTO tbl_categoria_subcategoria (cod_subcategoria, cod_categoria) VALUES (6, 2);

#INSERIR RELAÇÕES DE PRODUTO COM SUBCATEGORIA COM CATEGORIA
INSERT INTO tbl_produto_subcategoria_categoria (cod_subcategoria, cod_categoria, cod_produto) VALUES (2, 1, 6);
INSERT INTO tbl_produto_subcategoria_categoria (cod_subcategoria, cod_categoria, cod_produto) VALUES (1, 1, 6);
INSERT INTO tbl_produto_subcategoria_categoria (cod_subcategoria, cod_categoria, cod_produto) VALUES (3, 2, 7);
INSERT INTO tbl_produto_subcategoria_categoria (cod_subcategoria, cod_categoria, cod_produto) VALUES (1, 2, 7);
INSERT INTO tbl_produto_subcategoria_categoria (cod_subcategoria, cod_categoria, cod_produto) VALUES (1, 1, 8);
INSERT INTO tbl_produto_subcategoria_categoria (cod_subcategoria, cod_categoria, cod_produto) VALUES (2, 1, 8);
INSERT INTO tbl_produto_subcategoria_categoria (cod_subcategoria, cod_categoria, cod_produto) VALUES (4, 2, 9);
INSERT INTO tbl_produto_subcategoria_categoria (cod_subcategoria, cod_categoria, cod_produto) VALUES (2, 2, 9);
INSERT INTO tbl_produto_subcategoria_categoria (cod_subcategoria, cod_categoria, cod_produto) VALUES (3, 1, 10);
INSERT INTO tbl_produto_subcategoria_categoria (cod_subcategoria, cod_categoria, cod_produto) VALUES (5, 1, 11);
INSERT INTO tbl_produto_subcategoria_categoria (cod_subcategoria, cod_categoria, cod_produto) VALUES (6, 2, 12);
INSERT INTO tbl_produto_subcategoria_categoria (cod_subcategoria, cod_categoria, cod_produto) VALUES (7, 1, 13);
#------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


SELECT distinct p.nome, p.* FROM tbl_produto AS p
INNER JOIN tbl_produto_subcategoria_categoria AS tpsc
ON p.cod_produto = tpsc.cod_produto
INNER JOIN tbl_subcategoria AS s
ON tpsc.cod_subcategoria = s.cod_subcategoria
INNER JOIN tbl_categoria AS c
ON tpsc.cod_categoria = c.cod_categoria
WHERE c.cod_categoria = 1

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

SELECT user.nome_usuario, user.nome, user.email,
user.cod_nivel_usuario, nivel_user.nivel
FROM tbl_usuario AS user
INNER JOIN tbl_nivel_usuario AS nivel_user
ON user.cod_nivel_usuario = nivel_user.cod_nivel_usuario;
