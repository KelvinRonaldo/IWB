-- MySQL dump 10.13  Distrib 8.0.13, for Win64 (x86_64)
--
-- Host: localhost    Database: db_rrcb
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_assunto`
--

DROP TABLE IF EXISTS `tbl_assunto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_assunto` (
  `cod_assunto` int(11) NOT NULL AUTO_INCREMENT,
  `assunto` varchar(50) NOT NULL,
  PRIMARY KEY (`cod_assunto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_assunto`
--

LOCK TABLES `tbl_assunto` WRITE;
/*!40000 ALTER TABLE `tbl_assunto` DISABLE KEYS */;
INSERT INTO `tbl_assunto` VALUES (1,'Sobre Produtos'),(2,'Sugestão/Crítica'),(3,'Geral');
/*!40000 ALTER TABLE `tbl_assunto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_categoria` (
  `cod_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'desativado',
  PRIMARY KEY (`cod_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoria`
--

LOCK TABLES `tbl_categoria` WRITE;
/*!40000 ALTER TABLE `tbl_categoria` DISABLE KEYS */;
INSERT INTO `tbl_categoria` VALUES (1,'Caloi','desativado'),(2,'Mormaii','desativado');
/*!40000 ALTER TABLE `tbl_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categoria_subcategoria`
--

DROP TABLE IF EXISTS `tbl_categoria_subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_categoria_subcategoria` (
  `cod_categoria_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `cod_categoria` int(11) NOT NULL,
  `cod_subcategoria` int(11) NOT NULL,
  PRIMARY KEY (`cod_categoria_subcategoria`),
  KEY `fk_subcategoria_categoria_idx` (`cod_subcategoria`),
  KEY `fk_categoria_subcategoria_idx` (`cod_categoria`),
  CONSTRAINT `fk_categoria_subcategoria` FOREIGN KEY (`cod_categoria`) REFERENCES `tbl_categoria` (`cod_categoria`),
  CONSTRAINT `fk_subcategoria_categoria` FOREIGN KEY (`cod_subcategoria`) REFERENCES `tbl_subcategoria` (`cod_subcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoria_subcategoria`
--

LOCK TABLES `tbl_categoria_subcategoria` WRITE;
/*!40000 ALTER TABLE `tbl_categoria_subcategoria` DISABLE KEYS */;
INSERT INTO `tbl_categoria_subcategoria` VALUES (2,1,1),(3,1,2),(4,1,3),(5,1,5),(6,1,7),(7,2,3),(8,2,1),(9,2,4),(10,2,2),(11,2,6);
/*!40000 ALTER TABLE `tbl_categoria_subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cidade`
--

DROP TABLE IF EXISTS `tbl_cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_cidade` (
  `cod_cidade` int(11) NOT NULL AUTO_INCREMENT,
  `cod_estado` int(11) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  PRIMARY KEY (`cod_cidade`),
  KEY `cod_estado` (`cod_estado`),
  CONSTRAINT `fk_cidade_estado` FOREIGN KEY (`cod_estado`) REFERENCES `tbl_estado` (`cod_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=5598 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cidade`
--

LOCK TABLES `tbl_cidade` WRITE;
/*!40000 ALTER TABLE `tbl_cidade` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_destaque_noticia_principal`
--

DROP TABLE IF EXISTS `tbl_destaque_noticia_principal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_destaque_noticia_principal` (
  `cod_destaque` int(11) NOT NULL AUTO_INCREMENT,
  `destaque` varchar(45) NOT NULL,
  PRIMARY KEY (`cod_destaque`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_destaque_noticia_principal`
--

LOCK TABLES `tbl_destaque_noticia_principal` WRITE;
/*!40000 ALTER TABLE `tbl_destaque_noticia_principal` DISABLE KEYS */;
INSERT INTO `tbl_destaque_noticia_principal` VALUES (1,'Alto Destaque'),(2,'Médio Destaque'),(3,'Baixo Destaque');
/*!40000 ALTER TABLE `tbl_destaque_noticia_principal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_endereco`
--

DROP TABLE IF EXISTS `tbl_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_endereco` (
  `cod_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(55) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(40) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'desativado',
  `cod_cidade` int(11) NOT NULL,
  PRIMARY KEY (`cod_endereco`),
  KEY `cod_cidade_idx` (`cod_cidade`),
  CONSTRAINT `fk_endereco_cidade` FOREIGN KEY (`cod_cidade`) REFERENCES `tbl_cidade` (`cod_cidade`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_endereco`
--

LOCK TABLES `tbl_endereco` WRITE;
/*!40000 ALTER TABLE `tbl_endereco` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_estado`
--

DROP TABLE IF EXISTS `tbl_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_estado` (
  `cod_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(40) NOT NULL,
  `uf` varchar(4) NOT NULL,
  PRIMARY KEY (`cod_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estado`
--

LOCK TABLES `tbl_estado` WRITE;
/*!40000 ALTER TABLE `tbl_estado` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_evento`
--

DROP TABLE IF EXISTS `tbl_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_evento` (
  `cod_evento` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_evento` varchar(30) NOT NULL,
  `descricao` text NOT NULL,
  `data` date NOT NULL,
  `host` varchar(80) DEFAULT NULL,
  `entrada` varchar(25) DEFAULT NULL,
  `imagem` varchar(45) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'desativado',
  `cod_endereco` int(11) NOT NULL,
  PRIMARY KEY (`cod_evento`),
  KEY `cod_endereco_idx` (`cod_endereco`),
  CONSTRAINT `fk_evento_endereco` FOREIGN KEY (`cod_endereco`) REFERENCES `tbl_endereco` (`cod_endereco`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_evento`
--

LOCK TABLES `tbl_evento` WRITE;
/*!40000 ALTER TABLE `tbl_evento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fale_conosco`
--

DROP TABLE IF EXISTS `tbl_fale_conosco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_fale_conosco` (
  `cod_mensagem` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `sexo` char(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profissao` varchar(100) NOT NULL,
  `home_page` varchar(150) DEFAULT NULL,
  `facebook` varchar(150) DEFAULT NULL,
  `mensagem` text NOT NULL,
  `cod_assunto` int(11) NOT NULL,
  PRIMARY KEY (`cod_mensagem`),
  KEY `cod_assunto_idx` (`cod_assunto`),
  CONSTRAINT `fk_fale_conosco_assunto` FOREIGN KEY (`cod_assunto`) REFERENCES `tbl_assunto` (`cod_assunto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fale_conosco`
--

LOCK TABLES `tbl_fale_conosco` WRITE;
/*!40000 ALTER TABLE `tbl_fale_conosco` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_fale_conosco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_loja`
--

DROP TABLE IF EXISTS `tbl_loja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_loja` (
  `cod_loja` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(10) NOT NULL DEFAULT 'desativado',
  `cod_endereco` int(11) NOT NULL,
  PRIMARY KEY (`cod_loja`),
  KEY `cod_endereco_idx` (`cod_endereco`),
  CONSTRAINT `fk_lojas_endereco` FOREIGN KEY (`cod_endereco`) REFERENCES `tbl_endereco` (`cod_endereco`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_loja`
--

LOCK TABLES `tbl_loja` WRITE;
/*!40000 ALTER TABLE `tbl_loja` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_loja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nivel_usuario`
--

DROP TABLE IF EXISTS `tbl_nivel_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_nivel_usuario` (
  `cod_nivel_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nivel` varchar(50) NOT NULL,
  `adm_usuario` varchar(12) NOT NULL DEFAULT 'desativado',
  `adm_fale_conosco` varchar(12) NOT NULL DEFAULT 'desativado',
  `adm_conteudo` varchar(12) NOT NULL DEFAULT 'desativado',
  `adm_produto` varchar(12) NOT NULL DEFAULT 'desativado',
  `status` varchar(10) NOT NULL DEFAULT 'desativado',
  PRIMARY KEY (`cod_nivel_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nivel_usuario`
--

LOCK TABLES `tbl_nivel_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_nivel_usuario` DISABLE KEYS */;
INSERT INTO `tbl_nivel_usuario` VALUES (1,'master','ativado','ativado','ativado','ativado','ativado');
/*!40000 ALTER TABLE `tbl_nivel_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_noticia`
--

DROP TABLE IF EXISTS `tbl_noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_noticia` (
  `cod_noticia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_noticia` varchar(90) NOT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `resumo` varchar(120) NOT NULL,
  `data` date DEFAULT NULL,
  `imagem` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'desativado',
  PRIMARY KEY (`cod_noticia`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_noticia`
--

LOCK TABLES `tbl_noticia` WRITE;
/*!40000 ALTER TABLE `tbl_noticia` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_noticia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_noticia_principal`
--

DROP TABLE IF EXISTS `tbl_noticia_principal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_noticia_principal` (
  `cod_noticia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_noticia` varchar(23) NOT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `resumo` varchar(90) NOT NULL,
  `data` date DEFAULT NULL,
  `imagem` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'desativado',
  `cod_destaque` int(11) NOT NULL,
  PRIMARY KEY (`cod_noticia`),
  KEY `cod_destaque_noticial_idx` (`cod_destaque`),
  CONSTRAINT `fk_noticia_destaque` FOREIGN KEY (`cod_destaque`) REFERENCES `tbl_destaque_noticia_principal` (`cod_destaque`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_noticia_principal`
--

LOCK TABLES `tbl_noticia_principal` WRITE;
/*!40000 ALTER TABLE `tbl_noticia_principal` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_noticia_principal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto`
--

DROP TABLE IF EXISTS `tbl_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_produto` (
  `cod_produto` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `descricao` varchar(120) NOT NULL,
  `preco` double NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'desativado',
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto`
--

LOCK TABLES `tbl_produto` WRITE;
/*!40000 ALTER TABLE `tbl_produto` DISABLE KEYS */;
INSERT INTO `tbl_produto` VALUES (6,'BIKE 1','BICILCETA ESPORTIVA LAZER',762.44,'desativado','bike.jpg'),(7,'BIKE 2','BICILCETA ELÉTRICA LAZER',6326.23,'desativado','bike2.jpg'),(8,'BIKE 3','BICILCETA LAZER ESPORTIVA',632.85,'desativado','bike3.jpg'),(9,'BIKE 4','BICILCETA ERGOMÉTRICA ESPORTIVA',63432.85,'desativado','bike4.jpg'),(10,'BIKE 5','BICICLETA ELÉTRICA',7482.93,'desativado','bike5.jpg'),(11,'Luvas de Ciclismo','Luvas M de tectel para ciclistas',743.92,'desativado','luvas.jpg'),(12,'Banco de Bike','Banco de Bicicleta de couro preto e detalhes vermelhos',873.9,'desativado','banco.jpg'),(13,'Chave de Quadro','Kit de Manutenção de Quadro',13673.35,'desativado','chave_de_quadro.jpg');
/*!40000 ALTER TABLE `tbl_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto_subcategoria_categoria`
--

DROP TABLE IF EXISTS `tbl_produto_subcategoria_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_produto_subcategoria_categoria` (
  `cod_produto_subcategoria_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `cod_subcategoria` int(11) NOT NULL,
  `cod_categoria` int(11) NOT NULL,
  `cod_produto` int(11) NOT NULL,
  PRIMARY KEY (`cod_produto_subcategoria_categoria`),
  KEY `fk_subcategoria_categoria_idx` (`cod_categoria`),
  KEY `fk_subcategoria_categoria_idx1` (`cod_subcategoria`),
  KEY `fk_subcategoria_produto_idx` (`cod_produto`),
  CONSTRAINT `fk_categoria_subcategoria_produto` FOREIGN KEY (`cod_produto`) REFERENCES `tbl_produto` (`cod_produto`),
  CONSTRAINT `fk_produto_categoria_subcategoria` FOREIGN KEY (`cod_subcategoria`) REFERENCES `tbl_subcategoria` (`cod_subcategoria`),
  CONSTRAINT `fk_produto_subcategoria_categoria` FOREIGN KEY (`cod_categoria`) REFERENCES `tbl_categoria` (`cod_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto_subcategoria_categoria`
--

LOCK TABLES `tbl_produto_subcategoria_categoria` WRITE;
/*!40000 ALTER TABLE `tbl_produto_subcategoria_categoria` DISABLE KEYS */;
INSERT INTO `tbl_produto_subcategoria_categoria` VALUES (1,2,1,6),(2,1,1,6),(3,3,2,7),(4,1,2,7),(5,1,1,8),(6,2,1,8),(7,4,2,9),(8,2,2,9),(9,3,1,10),(10,5,1,11),(11,6,2,12),(12,7,1,13);
/*!40000 ALTER TABLE `tbl_produto_subcategoria_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_promocao`
--

DROP TABLE IF EXISTS `tbl_promocao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_promocao` (
  `cod_promocao` int(11) NOT NULL AUTO_INCREMENT,
  `percentual_desconto` tinyint(4) NOT NULL,
  `preco_desconto` double NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'desativado',
  `numero_parcelas` int(11) DEFAULT NULL,
  `metodo_pagamento` varchar(45) DEFAULT NULL,
  `preco_parcelas` double DEFAULT NULL,
  `cod_produto` int(11) NOT NULL,
  PRIMARY KEY (`cod_promocao`),
  KEY `fk_promocao_produto_idx` (`cod_produto`),
  CONSTRAINT `fk_promocao_produto` FOREIGN KEY (`cod_produto`) REFERENCES `tbl_produto` (`cod_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_promocao`
--

LOCK TABLES `tbl_promocao` WRITE;
/*!40000 ALTER TABLE `tbl_promocao` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_promocao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sobre`
--

DROP TABLE IF EXISTS `tbl_sobre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_sobre` (
  `cod_sobre` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_sobre` varchar(25) NOT NULL,
  `sobre` text NOT NULL,
  `assinatura` varchar(50) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'desativado',
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_sobre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sobre`
--

LOCK TABLES `tbl_sobre` WRITE;
/*!40000 ALTER TABLE `tbl_sobre` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_sobre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_subcategoria`
--

DROP TABLE IF EXISTS `tbl_subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_subcategoria` (
  `cod_subcategoria` int(11) NOT NULL,
  `subcategoria` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'desativado',
  PRIMARY KEY (`cod_subcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_subcategoria`
--

LOCK TABLES `tbl_subcategoria` WRITE;
/*!40000 ALTER TABLE `tbl_subcategoria` DISABLE KEYS */;
INSERT INTO `tbl_subcategoria` VALUES (1,'Bicicleta de Lazer','desativado'),(2,'Bicicleta Esportiva','desativado'),(3,'Bicicleta Elétrica','desativado'),(4,'Bicicleta Ergométrica','desativado'),(5,'Luvas','desativado'),(6,'Banco','desativado'),(7,'Chave de Quadro','desativado');
/*!40000 ALTER TABLE `tbl_subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_usuario` (
  `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(30) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(135) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'desativado',
  `cod_nivel_usuario` int(11) NOT NULL,
  PRIMARY KEY (`cod_usuario`),
  KEY `cod_nivel_usuario_idx` (`cod_nivel_usuario`),
  CONSTRAINT `fk_usuario_nivel_usuario` FOREIGN KEY (`cod_nivel_usuario`) REFERENCES `tbl_nivel_usuario` (`cod_nivel_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (1,'master','MASTER','user@master.com','3C9909AFEC25354D551DAE21590BB26E38D53F2173B8D3DC3EEE4C047E7AB1C1EB8B85103E3BE7BA613B31BB5C9C36214DC9F14A42FD7A2FDB84856BCA5C44C2','ativado',1);
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-29 23:32:26
