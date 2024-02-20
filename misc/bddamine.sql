-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum`;

-- Listage de la structure de table forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.category : ~2 rows (environ)
INSERT INTO `category` (`id_category`, `name`) VALUES
	(1, 'Bloodborne'),
	(2, 'Elden Ring'),
	(3, 'Sekiro');

-- Listage de la structure de table forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `topic_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `dateCreation` datetime DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `topic_id` (`topic_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.post : ~0 rows (environ)

-- Listage de la structure de table forum. subcategory
CREATE TABLE IF NOT EXISTS `subcategory` (
  `id_subCategory` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_subCategory`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.subcategory : ~6 rows (environ)
INSERT INTO `subcategory` (`id_subCategory`, `name`) VALUES
	(1, 'Guide'),
	(2, 'Humour'),
	(3, 'Hype'),
	(4, 'Discussion & Info'),
	(5, 'Aide'),
	(6, 'Speculation');

-- Listage de la structure de table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dateCreation` datetime DEFAULT NULL,
  `closed` tinyint(1) DEFAULT NULL,
  `subCategory_id` int NOT NULL,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `subCategory_id` (`subCategory_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `category_id` (`category_id`),
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`subCategory_id`) REFERENCES `subcategory` (`id_subCategory`),
  CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`),
  CONSTRAINT `topic_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.topic : ~1 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `dateCreation`, `closed`, `subCategory_id`, `category_id`, `user_id`) VALUES
	(15, 'TEEEEST', '2024-02-20 15:35:51', 0, 3, 1, 1);

-- Listage de la structure de table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `motDePasse` varchar(255) DEFAULT NULL,
  `inscriptionDate` datetime DEFAULT NULL,
  `profilePic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.user : ~4 rows (environ)
INSERT INTO `user` (`id_user`, `pseudo`, `mail`, `role`, `motDePasse`, `inscriptionDate`, `profilePic`) VALUES
	(1, 'Amine', 'amine@hotmail.com', '["ROLE_ADMIN"]', '$2y$10$2gkn3zL67ymiOgR..uG4ZO59hJCHlhAsNMKOd8T/1S6C9UCzJDTrO', '2024-02-15 10:49:21', 'aminePic.jpg'),
	(2, 'Enima', 'enima@hotmail.com', '["ROLE_USER"]', '$2y$10$EZpAIHF7unIZ/qKLeuZQfOEe5IA02pMuB2ON.S48csdVYqKK1Jg1G', '2024-02-15 10:49:22', NULL),
	(3, 'test', 'bkkabla@hotmail.com', '["ROLE_USER"]', '$2y$10$oj87JG/7wrCqcqsQYoCSYupSZv/u1imoC0x3drr6mbOoR1bDxPv5K', '2024-02-19 15:31:04', NULL),
	(5, 'ok', 'ok@ok.ok', '["ROLE_USER"]', '$2y$10$Wyd0XQtbsJrogykuwMaRLOZW2naj7rAkU99fem7Gpzw6D6UKQmBQG', '2024-02-20 07:59:10', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
