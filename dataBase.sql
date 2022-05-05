-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           10.4.22-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ciclismos
DROP DATABASE IF EXISTS `ciclismos`;
CREATE DATABASE IF NOT EXISTS `ciclismos` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ciclismos`;

-- Dumping structure for visualização ciclismos.atletas
DROP VIEW IF EXISTS `atletas`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `atletas` (
	`id_atleta` INT(11) NOT NULL,
	`nome` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`data_nascimento` DATE NULL,
	`nacionalidade` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`peso` FLOAT NULL,
	`potencia` FLOAT NULL,
	`segunda` VARCHAR(9) NULL COLLATE 'latin1_swedish_ci',
	`terca` VARCHAR(9) NULL COLLATE 'latin1_swedish_ci',
	`quarta` VARCHAR(9) NULL COLLATE 'latin1_swedish_ci',
	`quinta` VARCHAR(9) NULL COLLATE 'latin1_swedish_ci',
	`sexta` VARCHAR(9) NULL COLLATE 'latin1_swedish_ci',
	`sabado` VARCHAR(9) NULL COLLATE 'latin1_swedish_ci',
	`domingo` VARCHAR(9) NULL COLLATE 'latin1_swedish_ci',
	`sexo` INT(11) NULL,
	`imagem` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for visualização ciclismos.competicao
DROP VIEW IF EXISTS `competicao`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `competicao` (
	`id_competicao` INT(11) NOT NULL,
	`nome_competicao` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`id_escalao` INT(11) NULL,
	`idade_maxima` INT(11) NULL,
	`idade_minima` INT(11) NULL,
	`data_prova` DATE NULL,
	`horas_prova` TIME NULL,
	`numero_equipa_max` INT(11) NULL,
	`numero_equipa_min` INT(11) NULL,
	`duracao` TIME NULL
) ENGINE=MyISAM;

-- Dumping structure for visualização ciclismos.equipas
DROP VIEW IF EXISTS `equipas`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `equipas` (
	`id_equipa` INT(11) NOT NULL,
	`nome_equipa` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`id_competicao` INT(11) NULL
) ENGINE=MyISAM;

-- Dumping structure for visualização ciclismos.equipa_jogadores
DROP VIEW IF EXISTS `equipa_jogadores`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `equipa_jogadores` (
	`id_equipa_jogador` INT(11) NOT NULL,
	`id_equipa` INT(11) NULL,
	`id_jogador` INT(11) NULL
) ENGINE=MyISAM;

-- Dumping structure for visualização ciclismos.escaloes
DROP VIEW IF EXISTS `escaloes`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `escaloes` (
	`id_escalao` INT(11) NOT NULL,
	`nome_escalao` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`min_potencia` FLOAT NULL,
	`max_potencia` FLOAT NULL,
	`sexo` INT(11) NULL
) ENGINE=MyISAM;

-- Dumping structure for visualização ciclismos.users
DROP VIEW IF EXISTS `users`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `users` (
	`id_user` INT(11) NOT NULL,
	`email` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`palavrachave` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`nome` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`token` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for visualização ciclismos.atletas
DROP VIEW IF EXISTS `atletas`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `atletas`;
;

-- Dumping structure for visualização ciclismos.competicao
DROP VIEW IF EXISTS `competicao`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `competicao`;
;

-- Dumping structure for visualização ciclismos.equipas
DROP VIEW IF EXISTS `equipas`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `equipas`;
;

-- Dumping structure for visualização ciclismos.equipa_jogadores
DROP VIEW IF EXISTS `equipa_jogadores`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `equipa_jogadores`;
;

-- Dumping structure for visualização ciclismos.escaloes
DROP VIEW IF EXISTS `escaloes`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `escaloes`;
;

-- Dumping structure for visualização ciclismos.users
DROP VIEW IF EXISTS `users`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `users`;
;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
