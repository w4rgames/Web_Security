-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Serveur: localhost
-- Généré le : Mercredi 05 Novembre 2008 à 00:00
-- Version du serveur: 5.0.27
-- Version de PHP: 5.2.0
-- 
-- Base de données: `hack_trainer`
-- 

-- --------------------------------------------------------

-- 
-- Structure de la table `comptes`
-- 

CREATE TABLE `comptes` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `droits` int(11) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Contenu de la table `comptes`
-- 

INSERT INTO `comptes` (`id`, `login`, `password`, `droits`, `photo`, `email`) VALUES 
(1, 'admin', 'admin', 0, 'harry.png', 'mon_adresse@mon_serveur.com'),
(7, 'test', 'test', 1, 'pas_de_photo.gif', '');

-- --------------------------------------------------------

-- 
-- Structure de la table `news`
-- 

CREATE TABLE `news` (
  `id_news` int(6) NOT NULL auto_increment,
  `news_titre` text NOT NULL,
  `news_message` text NOT NULL,
  PRIMARY KEY  (`id_news`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Contenu de la table `news`
-- 

INSERT INTO `news` (`id_news`, `news_titre`, `news_message`) VALUES 
(1, 'Bienvenue !', 'Ce site vous offre beaucoup de possibilités, profitez-en !\r\n\r\nn''oubliez pas de faire profiter l''auteur de ce site si vous trouvez un hack qu''il n''avait pas trouvé !\r\n\r\nBon courage.');
