-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: nlgo
-- ------------------------------------------------------
-- Server version	8.0.41

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `vcNombre` varchar(120) NOT NULL,
  `vcDescr` text,
  `iActivo` tinyint DEFAULT '1',
  `dtFechaRegistro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comentario`
--

DROP TABLE IF EXISTS `comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentario` (
  `ID_Comentario` int NOT NULL AUTO_INCREMENT,
  `Texto` varchar(255) DEFAULT NULL,
  `Lugar` int DEFAULT NULL,
  `Usuario_C` int DEFAULT NULL,
  PRIMARY KEY (`ID_Comentario`),
  KEY `Usuario_C` (`Usuario_C`),
  KEY `Lugar` (`Lugar`),
  CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`Usuario_C`) REFERENCES `usuario` (`ID_Usuario`),
  CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`Lugar`) REFERENCES `lugar` (`ID_Lugar`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comentario_reacciones`
--

DROP TABLE IF EXISTS `comentario_reacciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentario_reacciones` (
  `id_reaccion` int NOT NULL AUTO_INCREMENT,
  `id_comentario` int NOT NULL,
  `id_usuario` int NOT NULL,
  `iTipo` tinyint NOT NULL,
  `dtFechaRegistro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_reaccion`),
  UNIQUE KEY `uk_usuario_comentario` (`id_usuario`,`id_comentario`),
  KEY `idx_reacciones_comentario` (`id_comentario`),
  CONSTRAINT `comentario_reacciones_ibfk_1` FOREIGN KEY (`id_comentario`) REFERENCES `comentarios` (`id_comentario`),
  CONSTRAINT `comentario_reacciones_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentarios` (
  `id_comentario` int NOT NULL AUTO_INCREMENT,
  `id_locacion` int NOT NULL,
  `id_usuario` int NOT NULL,
  `vcComentario` text NOT NULL,
  `iActivo` tinyint DEFAULT '1',
  `dtFechaRegistro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comentario`),
  KEY `id_usuario` (`id_usuario`),
  KEY `idx_comentarios_locacion` (`id_locacion`),
  CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_locacion`) REFERENCES `locaciones` (`id_locacion`),
  CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `estadio`
--

DROP TABLE IF EXISTS `estadio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estadio` (
  `ID_Estadio` int NOT NULL AUTO_INCREMENT,
  `Nom_Estadio` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_Estadio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `etiqueta`
--

DROP TABLE IF EXISTS `etiqueta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etiqueta` (
  `ID_Etiqueta` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Etiqueta`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `favoritos`
--

DROP TABLE IF EXISTS `favoritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favoritos` (
  `id_favorito` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_locacion` int NOT NULL,
  `dtFechaRegistro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_favorito`),
  UNIQUE KEY `uk_usuario_favorito` (`id_usuario`,`id_locacion`),
  KEY `id_locacion` (`id_locacion`),
  KEY `idx_favoritos_usuario` (`id_usuario`),
  CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`id_locacion`) REFERENCES `locaciones` (`id_locacion`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locacion_reacciones`
--

DROP TABLE IF EXISTS `locacion_reacciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locacion_reacciones` (
  `id_reaccion` int NOT NULL AUTO_INCREMENT,
  `id_locacion` int NOT NULL,
  `id_usuario` int NOT NULL,
  `iTipo` tinyint NOT NULL,
  `dtFechaRegistro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_reaccion`),
  UNIQUE KEY `uk_usuario_locacion` (`id_usuario`,`id_locacion`),
  KEY `idx_reacciones_locacion` (`id_locacion`),
  CONSTRAINT `locacion_reacciones_ibfk_1` FOREIGN KEY (`id_locacion`) REFERENCES `locaciones` (`id_locacion`),
  CONSTRAINT `locacion_reacciones_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locaciones`
--

DROP TABLE IF EXISTS `locaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locaciones` (
  `id_locacion` int NOT NULL AUTO_INCREMENT,
  `id_categoria` int NOT NULL,
  `vcNombre` varchar(150) NOT NULL,
  `vcDescr` text,
  `vcCalle` varchar(150) DEFAULT NULL,
  `vcNumeroExterior` varchar(30) DEFAULT NULL,
  `vcNumeroInterior` varchar(30) DEFAULT NULL,
  `vcColonia` varchar(120) DEFAULT NULL,
  `vcCiudad` varchar(120) DEFAULT NULL,
  `vcEstado` varchar(120) DEFAULT NULL,
  `vcPais` varchar(120) DEFAULT NULL,
  `vcCodigoPostal` varchar(20) DEFAULT NULL,
  `vcPlaceId` varchar(255) DEFAULT NULL,
  `dLatitud` decimal(10,8) DEFAULT NULL,
  `dLongitud` decimal(11,8) DEFAULT NULL,
  `imagen` longblob,
  `iActivo` tinyint DEFAULT '1',
  `dtFechaRegistro` datetime DEFAULT CURRENT_TIMESTAMP,
  `vcPhotoReference` text,
  `image_url` text,
  PRIMARY KEY (`id_locacion`),
  KEY `idx_locaciones_categoria` (`id_categoria`),
  KEY `idx_locaciones_nombre` (`vcNombre`),
  CONSTRAINT `locaciones_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lugar`
--

DROP TABLE IF EXISTS `lugar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lugar` (
  `ID_Lugar` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` varchar(255) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Latitud` decimal(10,8) DEFAULT NULL,
  `Longitud` decimal(11,8) DEFAULT NULL,
  `Imagen` longblob,
  `Etiqueta` int NOT NULL,
  PRIMARY KEY (`ID_Lugar`),
  KEY `Etiqueta` (`Etiqueta`),
  CONSTRAINT `lugar_ibfk_1` FOREIGN KEY (`Etiqueta`) REFERENCES `etiqueta` (`ID_Etiqueta`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pais` (
  `ID_Pais` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID_Pais`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `partido`
--

DROP TABLE IF EXISTS `partido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partido` (
  `ID_Partido` int NOT NULL AUTO_INCREMENT,
  `Nom_Partido` varchar(100) NOT NULL,
  `Estadio` int DEFAULT NULL,
  `Pais` int DEFAULT NULL,
  `Municipio` varchar(100) DEFAULT NULL,
  `Fecha` datetime NOT NULL,
  `Resultado` varchar(4) DEFAULT NULL,
  `Estado_Partido` enum('Primer Timepo','Segundo Timepo','Medio Timepo','Finalizado','Proximamente') NOT NULL,
  PRIMARY KEY (`ID_Partido`),
  KEY `Estadio` (`Estadio`),
  KEY `Pais` (`Pais`),
  CONSTRAINT `partido_ibfk_1` FOREIGN KEY (`Estadio`) REFERENCES `estadio` (`ID_Estadio`),
  CONSTRAINT `partido_ibfk_2` FOREIGN KEY (`Pais`) REFERENCES `pais` (`ID_Pais`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reaccion`
--

DROP TABLE IF EXISTS `reaccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reaccion` (
  `ID_Reaccion` int NOT NULL AUTO_INCREMENT,
  `Tipo_Reaccion` enum('Me_Gusta','No_Gusta','Favorito') NOT NULL,
  `id_Lugar` int DEFAULT NULL,
  `id_Usuario` int DEFAULT NULL,
  PRIMARY KEY (`ID_Reaccion`),
  KEY `id_Lugar` (`id_Lugar`),
  KEY `id_Usuario` (`id_Usuario`),
  CONSTRAINT `reaccion_ibfk_1` FOREIGN KEY (`id_Lugar`) REFERENCES `lugar` (`ID_Lugar`),
  CONSTRAINT `reaccion_ibfk_2` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `ID_Usuario` int NOT NULL AUTO_INCREMENT,
  `NombreCompleto` varchar(100) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `FechaNac` date NOT NULL,
  `mail` varchar(100) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Imagen` longblob,
  `F_Reg` datetime DEFAULT CURRENT_TIMESTAMP,
  `F_Mod` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Activo` tinyint DEFAULT '1',
  PRIMARY KEY (`ID_Usuario`),
  UNIQUE KEY `mail` (`mail`),
  UNIQUE KEY `UserName` (`UserName`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `vcNombre` varchar(120) NOT NULL,
  `vcEmail` varchar(150) NOT NULL,
  `vcNickname` varchar(80) DEFAULT NULL,
  `dtFechaNacimiento` date DEFAULT NULL,
  `vcPassword` varchar(255) NOT NULL,
  `vcTelefono` varchar(30) DEFAULT NULL,
  `imagenPerfil` longblob,
  `iActivo` tinyint DEFAULT '1',
  `dtFechaRegistro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `vcEmail` (`vcEmail`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `v_comentario`
--

DROP TABLE IF EXISTS `v_comentario`;
/*!50001 DROP VIEW IF EXISTS `v_comentario`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_comentario` AS SELECT 
 1 AS `Usuario`,
 1 AS `Comentario`,
 1 AS `Lugar`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_estadio`
--

DROP TABLE IF EXISTS `v_estadio`;
/*!50001 DROP VIEW IF EXISTS `v_estadio`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_estadio` AS SELECT 
 1 AS `Estadio`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_etiqueta`
--

DROP TABLE IF EXISTS `v_etiqueta`;
/*!50001 DROP VIEW IF EXISTS `v_etiqueta`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_etiqueta` AS SELECT 
 1 AS `Etiqueta`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_lugar`
--

DROP TABLE IF EXISTS `v_lugar`;
/*!50001 DROP VIEW IF EXISTS `v_lugar`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_lugar` AS SELECT 
 1 AS `Nombre`,
 1 AS `Descripcion`,
 1 AS `Direccion`,
 1 AS `Latitud`,
 1 AS `Longitud`,
 1 AS `Imagen`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_pais`
--

DROP TABLE IF EXISTS `v_pais`;
/*!50001 DROP VIEW IF EXISTS `v_pais`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_pais` AS SELECT 
 1 AS `Pais`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_partido`
--

DROP TABLE IF EXISTS `v_partido`;
/*!50001 DROP VIEW IF EXISTS `v_partido`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_partido` AS SELECT 
 1 AS `Titular`,
 1 AS `Fecha`,
 1 AS `Estatus`,
 1 AS `Estadio`,
 1 AS `País`,
 1 AS `Municipio`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_reaccion`
--

DROP TABLE IF EXISTS `v_reaccion`;
/*!50001 DROP VIEW IF EXISTS `v_reaccion`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_reaccion` AS SELECT 
 1 AS `Usuario`,
 1 AS `Lugar`,
 1 AS `Reacción`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_usaurio`
--

DROP TABLE IF EXISTS `v_usaurio`;
/*!50001 DROP VIEW IF EXISTS `v_usaurio`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_usaurio` AS SELECT 
 1 AS `Nombre`,
 1 AS `NombreDeUsuario`,
 1 AS `FechaNacimiento`,
 1 AS `Correo`,
 1 AS `Contra`,
 1 AS `Imagen`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `v_comentario`
--

/*!50001 DROP VIEW IF EXISTS `v_comentario`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_comentario` AS select `u`.`UserName` AS `Usuario`,`c`.`Texto` AS `Comentario`,`l`.`Nombre` AS `Lugar` from ((`comentario` `c` join `usuario` `u` on((`c`.`Usuario_C` = `u`.`ID_Usuario`))) join `lugar` `l` on((`c`.`Lugar` = `l`.`ID_Lugar`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_estadio`
--

/*!50001 DROP VIEW IF EXISTS `v_estadio`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_estadio` AS select `estadio`.`Nom_Estadio` AS `Estadio` from `estadio` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_etiqueta`
--

/*!50001 DROP VIEW IF EXISTS `v_etiqueta`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_etiqueta` AS select `etiqueta`.`Nombre` AS `Etiqueta` from `etiqueta` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_lugar`
--

/*!50001 DROP VIEW IF EXISTS `v_lugar`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_lugar` AS select `lugar`.`Nombre` AS `Nombre`,`lugar`.`Descripcion` AS `Descripcion`,`lugar`.`Direccion` AS `Direccion`,`lugar`.`Latitud` AS `Latitud`,`lugar`.`Longitud` AS `Longitud`,`lugar`.`Imagen` AS `Imagen` from `lugar` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_pais`
--

/*!50001 DROP VIEW IF EXISTS `v_pais`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_pais` AS select `pais`.`Nombre` AS `Pais` from `pais` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_partido`
--

/*!50001 DROP VIEW IF EXISTS `v_partido`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER */
/*!50001 VIEW `v_partido` AS select distinct `p`.`Nom_Partido` AS `Titular`,`p`.`Fecha` AS `Fecha`,`p`.`Estado_Partido` AS `Estatus`,`e`.`Nom_Estadio` AS `Estadio`,`pa`.`Nombre` AS `País`,`p`.`Municipio` AS `Municipio` from ((`partido` `p` join `estadio` `e` on((`p`.`Estadio` = `e`.`ID_Estadio`))) join `pais` `pa` on((`p`.`Pais` = `pa`.`ID_Pais`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_reaccion`
--

/*!50001 DROP VIEW IF EXISTS `v_reaccion`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_reaccion` AS select `u`.`UserName` AS `Usuario`,`l`.`Nombre` AS `Lugar`,`r`.`Tipo_Reaccion` AS `Reacción` from ((`reaccion` `r` join `lugar` `l` on((`r`.`id_Lugar` = `l`.`ID_Lugar`))) join `usuario` `u` on((`r`.`id_Usuario` = `u`.`ID_Usuario`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_usaurio`
--

/*!50001 DROP VIEW IF EXISTS `v_usaurio`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_usaurio` AS select `usuario`.`NombreCompleto` AS `Nombre`,`usuario`.`UserName` AS `NombreDeUsuario`,`usuario`.`FechaNac` AS `FechaNacimiento`,`usuario`.`mail` AS `Correo`,`usuario`.`Password` AS `Contra`,`usuario`.`Imagen` AS `Imagen` from `usuario` where (`usuario`.`Activo` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-23  1:05:56
