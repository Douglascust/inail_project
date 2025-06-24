-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: localhost    Database: inails
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `agenda_cliente`
--

DROP TABLE IF EXISTS `agenda_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agenda_cliente` (
  `idAgendaCliente` int NOT NULL AUTO_INCREMENT,
  `idProcedimento` int DEFAULT NULL,
  `idRecurso` int DEFAULT NULL,
  `idProfissional` int DEFAULT NULL,
  `idCliente` int DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `dtPagto` date DEFAULT NULL,
  `dtCancelamento` date DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `descr` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `autDesc` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `precofinal` decimal(10,2) DEFAULT NULL,
  `ausenciaCliente` tinyint(1) DEFAULT NULL,
  `ausenciaProfissional` tinyint(1) DEFAULT NULL,
  `obs` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idAgendaCliente`),
  KEY `idProcedimento` (`idProcedimento`),
  KEY `idRecurso` (`idRecurso`),
  KEY `idProfissional` (`idProfissional`),
  KEY `idCliente` (`idCliente`),
  CONSTRAINT `agenda_cliente_ibfk_1` FOREIGN KEY (`idProcedimento`) REFERENCES `procedimento` (`idProcedimento`),
  CONSTRAINT `agenda_cliente_ibfk_2` FOREIGN KEY (`idRecurso`) REFERENCES `recurso` (`idRecurso`),
  CONSTRAINT `agenda_cliente_ibfk_3` FOREIGN KEY (`idProfissional`) REFERENCES `profissional` (`idProfissional`),
  CONSTRAINT `agenda_cliente_ibfk_4` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agenda_cliente`
--

LOCK TABLES `agenda_cliente` WRITE;
/*!40000 ALTER TABLE `agenda_cliente` DISABLE KEYS */;
INSERT INTO `agenda_cliente` VALUES (1,1,1,1,888890,'2023-11-29','13:00:00','2023-12-30',NULL,60.00,'<descricao>[1]','<autDesc>[1]',1.00,1,0,'<obs>[1]'),(18,1,1,1,1,'2023-11-21','09:00:00',NULL,NULL,30.00,NULL,NULL,NULL,NULL,NULL,NULL),(27,1,1,1,1,'2023-11-11','17:00:00',NULL,NULL,10.00,NULL,NULL,NULL,NULL,NULL,NULL),(28,4,1,2,1,'2023-11-30','09:00:00',NULL,NULL,1.00,NULL,NULL,NULL,NULL,NULL,NULL),(31,1,1,1,888890,'2023-12-07','16:00:00',NULL,NULL,30.00,NULL,NULL,NULL,NULL,NULL,NULL),(32,2,1,1,1,'2023-12-21','13:00:00',NULL,NULL,60.00,NULL,NULL,NULL,NULL,NULL,NULL),(33,3,1,1,1,'2023-12-22','08:00:00',NULL,NULL,200.00,NULL,NULL,NULL,NULL,NULL,NULL),(34,4,1,1,1,'2023-12-22','16:00:00',NULL,NULL,120.00,NULL,NULL,NULL,NULL,NULL,NULL),(39,1,1,1,888890,'2023-12-31','10:00:00',NULL,NULL,30.00,NULL,NULL,NULL,NULL,NULL,NULL),(40,4,1,2,888889,'2023-12-18','13:00:00',NULL,NULL,60.00,NULL,NULL,NULL,NULL,NULL,NULL),(42,1,1,2,1,'2023-12-31','15:00:00',NULL,NULL,30.00,NULL,NULL,NULL,NULL,NULL,NULL),(44,1,1,2,888890,'2023-01-07','16:00:00',NULL,NULL,30.00,NULL,NULL,NULL,NULL,NULL,NULL),(46,3,1,2,1,'2023-10-25','13:00:00',NULL,NULL,200.00,NULL,NULL,NULL,NULL,NULL,NULL),(49,1,1,1,1,'2024-02-24','09:00:00',NULL,NULL,30.00,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `agenda_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agenda_instituicao`
--

DROP TABLE IF EXISTS `agenda_instituicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agenda_instituicao` (
  `idAgendaInstituicao` int NOT NULL AUTO_INCREMENT,
  `idInstituicao` int DEFAULT NULL,
  `dataIni` date DEFAULT NULL,
  `horaIni` time DEFAULT NULL,
  `dataFim` date DEFAULT NULL,
  `horaFim` time DEFAULT NULL,
  PRIMARY KEY (`idAgendaInstituicao`),
  KEY `idInstituicao` (`idInstituicao`),
  CONSTRAINT `agenda_instituicao_ibfk_1` FOREIGN KEY (`idInstituicao`) REFERENCES `instituicao` (`idInstituicao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agenda_instituicao`
--

LOCK TABLES `agenda_instituicao` WRITE;
/*!40000 ALTER TABLE `agenda_instituicao` DISABLE KEYS */;
/*!40000 ALTER TABLE `agenda_instituicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agenda_profissional`
--

DROP TABLE IF EXISTS `agenda_profissional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agenda_profissional` (
  `idAgendaProfissional` int NOT NULL AUTO_INCREMENT,
  `idInstituicao` int DEFAULT NULL,
  `idProfissional` int DEFAULT NULL,
  `dataIni` date DEFAULT NULL,
  `horaIni` time DEFAULT NULL,
  `dataFim` date DEFAULT NULL,
  `horaFim` time DEFAULT NULL,
  `obs` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idAgendaProfissional`),
  KEY `idInstituicao` (`idInstituicao`),
  KEY `idProfissional` (`idProfissional`),
  CONSTRAINT `agenda_profissional_ibfk_1` FOREIGN KEY (`idInstituicao`) REFERENCES `instituicao` (`idInstituicao`),
  CONSTRAINT `agenda_profissional_ibfk_2` FOREIGN KEY (`idProfissional`) REFERENCES `profissional` (`idProfissional`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agenda_profissional`
--

LOCK TABLES `agenda_profissional` WRITE;
/*!40000 ALTER TABLE `agenda_profissional` DISABLE KEYS */;
INSERT INTO `agenda_profissional` VALUES (1,1,1,NULL,'08:00:00',NULL,'12:00:00',NULL),(2,1,1,NULL,'13:00:00',NULL,'17:00:00',NULL),(3,1,2,NULL,'08:00:00',NULL,'12:00:00',NULL),(4,1,2,NULL,'13:00:00',NULL,'17:00:00',NULL);
/*!40000 ALTER TABLE `agenda_profissional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agenda_recurso`
--

DROP TABLE IF EXISTS `agenda_recurso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agenda_recurso` (
  `idAgendaRecurso` int NOT NULL AUTO_INCREMENT,
  `idInstituicao` int DEFAULT NULL,
  `idRecurso` int DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `tempo` int DEFAULT NULL,
  PRIMARY KEY (`idAgendaRecurso`),
  KEY `idInstituicao` (`idInstituicao`),
  KEY `idRecurso` (`idRecurso`),
  CONSTRAINT `agenda_recurso_ibfk_1` FOREIGN KEY (`idInstituicao`) REFERENCES `instituicao` (`idInstituicao`),
  CONSTRAINT `agenda_recurso_ibfk_2` FOREIGN KEY (`idRecurso`) REFERENCES `recurso` (`idRecurso`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agenda_recurso`
--

LOCK TABLES `agenda_recurso` WRITE;
/*!40000 ALTER TABLE `agenda_recurso` DISABLE KEYS */;
INSERT INTO `agenda_recurso` VALUES (1,1,1,'2023-11-25','16:00:00',60),(2,1,1,'2023-12-28','13:00:00',90),(3,1,1,'2023-12-28','13:00:00',90),(4,1,1,'2023-12-28','13:00:00',90),(5,1,1,'2023-12-28','13:00:00',60),(6,1,1,'2023-12-28','13:00:00',60),(7,1,1,'2023-12-28','13:00:00',60),(8,1,1,'2023-12-28','13:00:00',60),(9,1,1,'2023-12-20','09:00:00',60),(15,1,1,'2023-11-21','14:00:00',60),(16,1,1,'2023-11-21','09:00:00',60),(17,1,1,'2023-11-21','08:00:00',60);
/*!40000 ALTER TABLE `agenda_recurso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `idCliente` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `rg` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cpf` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idCliente`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=888891 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Matheus Junior','<rg>[1]','<telefone>[1]','matheusjr22@gmail.com','1234','256.225.440-68','Rua brasília, nº78 - Vila Carmela I'),(888889,'josias',NULL,NULL,'djadjlhjjkajdal@gshdgahjdga.com','1234','594.332.130-68',NULL),(888890,'leticia',NULL,NULL,'leticia.gabriela@gmail.com','1234','313.131.313-13',NULL);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instituicao`
--

DROP TABLE IF EXISTS `instituicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instituicao` (
  `idInstituicao` int NOT NULL AUTO_INCREMENT,
  `endereco` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `razao_social` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cnpj_cpf` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contato` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idInstituicao`)
) ENGINE=InnoDB AUTO_INCREMENT=55556 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instituicao`
--

LOCK TABLES `instituicao` WRITE;
/*!40000 ALTER TABLE `instituicao` DISABLE KEYS */;
INSERT INTO `instituicao` VALUES (1,'<endereco>','Inails','<razao_social>','<cpnj_cpf>','<telefone>','<email>','<contato>'),(55555,'55555','55555','55555','55555','555555','555555','55555');
/*!40000 ALTER TABLE `instituicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procedimento`
--

DROP TABLE IF EXISTS `procedimento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `procedimento` (
  `idProcedimento` int NOT NULL AUTO_INCREMENT,
  `tipoProcedimento` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempo` int DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idProcedimento`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procedimento`
--

LOCK TABLES `procedimento` WRITE;
/*!40000 ALTER TABLE `procedimento` DISABLE KEYS */;
INSERT INTO `procedimento` VALUES (1,'Esmaltacao normal','<descricao>[1]',60,30.00),(2,'Esmaltacao em gel','<descricao>[2]',90,60.00),(3,'Aplicação de gel','<descricao>[3]',240,200.00),(4,'Manutenção','<descricao>[4]',180,120.00);
/*!40000 ALTER TABLE `procedimento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profissional`
--

DROP TABLE IF EXISTS `profissional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profissional` (
  `idProfissional` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `funcao` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `rg` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cnpj_cpf` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idProfissional`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cnpj_cpf` (`cnpj_cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profissional`
--

LOCK TABLES `profissional` WRITE;
/*!40000 ALTER TABLE `profissional` DISABLE KEYS */;
INSERT INTO `profissional` VALUES (1,'<nome>[1]','Manicure','<rg>[1]','<email>[1]','<senha>[1]','<telefone>[1]','<endereco>[1]','<cnpj_cpf>[1]'),(2,'<nome>[2]','Pedicure','<rg>[2]','<email>[2]','<senha>[2]','<telefone>[2]','<endereco>[2]','<cnpj_cpf>[2]');
/*!40000 ALTER TABLE `profissional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurso`
--

DROP TABLE IF EXISTS `recurso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recurso` (
  `idRecurso` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dependencia_recurso` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idRecurso`)
) ENGINE=InnoDB AUTO_INCREMENT=223 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurso`
--

LOCK TABLES `recurso` WRITE;
/*!40000 ALTER TABLE `recurso` DISABLE KEYS */;
INSERT INTO `recurso` VALUES (1,'salao principal','<descricao>[1]','<dependencia>[1]');
/*!40000 ALTER TABLE `recurso` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-02 14:11:20
