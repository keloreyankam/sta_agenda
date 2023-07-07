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


-- Listage de la structure de la base pour sta_db
CREATE DATABASE IF NOT EXISTS `sta_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sta_db`;

-- Listage de la structure de table sta_db. agenda
CREATE TABLE IF NOT EXISTS `agenda` (
  `ID_agenda` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Date_de_debut` date NOT NULL,
  `Date_de_fin` date NOT NULL,
  `ID_utilisateur` int DEFAULT NULL,
  `ID_equipe` int DEFAULT NULL,
  PRIMARY KEY (`ID_agenda`),
  KEY `ID_utilisateur` (`ID_utilisateur`),
  KEY `ID_equipe` (`ID_equipe`),
  CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID_utilisateur`),
  CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`ID_equipe`) REFERENCES `equipe` (`ID_equipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sta_db.agenda : ~0 rows (environ)

-- Listage de la structure de table sta_db. equipe
CREATE TABLE IF NOT EXISTS `equipe` (
  `ID_equipe` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_equipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sta_db.equipe : ~0 rows (environ)

-- Listage de la structure de table sta_db. evenement
CREATE TABLE IF NOT EXISTS `evenement` (
  `id_eve` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Date_de_debut` datetime NOT NULL,
  `Date_de_fin` datetime NOT NULL,
  `ID_agenda` int DEFAULT NULL,
  PRIMARY KEY (`id_eve`) USING BTREE,
  KEY `ID_agenda` (`ID_agenda`),
  CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`ID_agenda`) REFERENCES `agenda` (`ID_agenda`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sta_db.evenement : ~0 rows (environ)
REPLACE INTO `evenement` (`id_eve`, `Nom`, `Description`, `Date_de_debut`, `Date_de_fin`, `ID_agenda`) VALUES
	(3, 'reunion', 'la reunion', '2023-07-06 22:52:00', '2023-07-07 22:52:00', NULL),
	(4, 'depot dossier ', 'deposer les dossiers', '2023-07-07 19:46:00', '2023-07-07 19:49:00', NULL),
	(5, 'reunion', 'reunion', '2023-07-09 19:50:00', '2023-07-10 09:15:00', NULL),
	(6, 'reunion', 'z', '2023-07-02 19:56:00', '2023-07-01 21:57:00', NULL);

-- Listage de la structure de table sta_db. notification
CREATE TABLE IF NOT EXISTS `notification` (
  `ID_notification` int NOT NULL AUTO_INCREMENT,
  `Message` varchar(255) NOT NULL,
  `ID_utilisateur` int DEFAULT NULL,
  `ID_agenda` int DEFAULT NULL,
  PRIMARY KEY (`ID_notification`),
  KEY `ID_utilisateur` (`ID_utilisateur`),
  KEY `ID_agenda` (`ID_agenda`),
  CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID_utilisateur`),
  CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`ID_agenda`) REFERENCES `agenda` (`ID_agenda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sta_db.notification : ~0 rows (environ)

-- Listage de la structure de table sta_db. tache
CREATE TABLE IF NOT EXISTS `tache` (
  `ID_tache` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Date_d_echeance` date NOT NULL,
  `Etat` enum('en_cours','terminee') DEFAULT 'en_cours',
  `ID_utilisateur` int DEFAULT NULL,
  `ID_equipe` int DEFAULT NULL,
  `ID_agenda` int DEFAULT NULL,
  PRIMARY KEY (`ID_tache`),
  KEY `ID_utilisateur` (`ID_utilisateur`),
  KEY `ID_equipe` (`ID_equipe`),
  KEY `ID_agenda` (`ID_agenda`),
  CONSTRAINT `tache_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID_utilisateur`),
  CONSTRAINT `tache_ibfk_2` FOREIGN KEY (`ID_equipe`) REFERENCES `equipe` (`ID_equipe`),
  CONSTRAINT `tache_ibfk_3` FOREIGN KEY (`ID_agenda`) REFERENCES `agenda` (`ID_agenda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sta_db.tache : ~0 rows (environ)

-- Listage de la structure de table sta_db. utilisateurs
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` enum('utilisateur','administrateur') DEFAULT 'utilisateur',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table sta_db.utilisateurs : ~0 rows (environ)
REPLACE INTO `utilisateurs` (`id`, `nom`, `email`, `password`, `role`) VALUES
	(1, 'kelore', 'yankamkelore@gmail.com', '$2y$10$sA2F6RoL/HGyroTPyBmz2u8Lj0PBhBpM6.VdT8vZZ.HXDfmI82/3C', 'utilisateur');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
