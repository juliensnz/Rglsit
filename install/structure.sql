-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Lun 10 Octobre 2011 à 20:58
-- Version du serveur: 5.1.44
-- Version de PHP: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `reglisse`
--

-- --------------------------------------------------------

--
-- Structure de la table `reg_rglsit`
--

DROP TABLE IF EXISTS `rglsit`;
CREATE TABLE IF NOT EXISTS `reg_rglsit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = file, 1 = url',
  `name` varchar(100) NOT NULL,
  `hash` varchar(20) NOT NULL,
  `mime` varchar(10) NOT NULL,
  `md5` varchar(32) NOT NULL,
  `url` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `downloads` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
