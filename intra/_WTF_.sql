-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 21 Juin 2014 à 18:49
-- Version du serveur: 5.5.33
-- Version de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `framework`
--

-- --------------------------------------------------------

--
-- Structure de la table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `date_reg` datetime NOT NULL,
  `date_beg` datetime NOT NULL,
  `date_peer` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `id_mod` int(11) NOT NULL,
  `groupe` tinyint(1) NOT NULL DEFAULT '0',
  `nb_groupe` int(11) NOT NULL,
  `nb_place` int(11) NOT NULL,
  `type` varchar(128) NOT NULL DEFAULT 'TD',
  `nb_peer` int(11) NOT NULL,
  `id_cron_peer` int(11) NOT NULL,
  `id_cron_groupe` int(11) NOT NULL,
  `id_cron_mark` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=128 ;

-- --------------------------------------------------------

--
-- Structure de la table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('0f48c1000ff88d84e1fc142474fb3064', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36', 1403369375, '');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(254) NOT NULL,
  `email` varchar(254) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `correction`
--

CREATE TABLE `correction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_teacher` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `id_activity` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `mark` int(11) DEFAULT NULL,
  `feedback` text NOT NULL,
  `accept` int(11) NOT NULL,
  `save` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=157 ;

-- --------------------------------------------------------

--
-- Structure de la table `e_learning`
--

CREATE TABLE `e_learning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `url` text NOT NULL,
  `id_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Structure de la table `forum_cat`
--

CREATE TABLE `forum_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `comment` text NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Contenu de la table `forum_cat`
--

INSERT INTO `forum_cat` (`id`, `title`, `comment`, `id_user`) VALUES
(1, 'Welcome Forhome', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et vulputate ante. Morbi accumsan vestibulum dolor, a fermentum lectus luctus in. Vestibulum at lorem pellentesque, ultrices purus ut, mattis quam. Quisque vel dui lacus. Morbi nulla sapien, blandit sagittis tempus vel, gravida vel purus', 44);

-- --------------------------------------------------------

--
-- Structure de la table `forum_message`
--

CREATE TABLE `forum_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  `id_thread` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

-- --------------------------------------------------------

--
-- Structure de la table `forum_s_cat`
--

CREATE TABLE `forum_s_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Structure de la table `forum_thread`
--

CREATE TABLE `forum_thread` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `comment` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_s_cat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `id_activity` int(11) NOT NULL,
  `peer_correcting` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- Structure de la table `inscrit_activity`
--

CREATE TABLE `inscrit_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_activity` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `inscrit` int(11) NOT NULL,
  `select` int(11) DEFAULT '0',
  `validate` int(11) NOT NULL,
  `user_correcting` int(11) NOT NULL,
  `peer_correcting` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=178 ;

--
-- Contenu de la table `inscrit_activity`
--

INSERT INTO `inscrit_activity` (`id`, `id_user`, `id_activity`, `id_groupe`, `inscrit`, `select`, `validate`, `user_correcting`, `peer_correcting`) VALUES
(114, 92, 28, 0, 1, 0, 0, 0, 0),
(115, 93, 28, 0, 1, 0, 0, 0, 0),
(116, 94, 28, 0, 1, 0, 0, 0, 0),
(117, 95, 28, 0, 1, 0, 0, 0, 0),
(118, 44, 29, 0, 1, 0, 0, 0, 0),
(119, 44, 30, 0, 1, 0, 0, 0, 0),
(121, 44, 31, 0, 1, 0, 0, 0, 0),
(122, 69, 31, 0, 1, 0, 0, 0, 0),
(123, 44, 32, 0, 1, 0, 0, 0, 0),
(124, 44, 33, 0, 1, 0, 0, 0, 0),
(125, 69, 33, 0, 1, 0, 0, 0, 0),
(126, 44, 115, 0, 1, 0, 0, 0, 0),
(127, 69, 115, 0, 1, 0, 0, 0, 0),
(128, 44, 116, 0, 1, 0, 0, 0, 0),
(129, 69, 116, 0, 1, 0, 0, 0, 0),
(130, 91, 116, 0, 1, 0, 0, 0, 0),
(131, 44, 117, 25, 1, 1, 0, 1, 0),
(132, 69, 117, 26, 1, 1, 0, 1, 0),
(133, 91, 117, 27, 1, 1, 0, 1, 0),
(134, 92, 117, 25, 1, 1, 0, 1, 0),
(135, 93, 117, 26, 1, 1, 0, 1, 0),
(136, 44, 122, 25, 1, 1, 0, 1, 0),
(137, 69, 122, 26, 1, 1, 0, 1, 0),
(138, 91, 122, 27, 1, 1, 0, 1, 0),
(139, 92, 122, 26, 1, 1, 0, 1, 0),
(140, 93, 122, 25, 1, 1, 0, 1, 0),
(155, 90, 127, 48, 0, 1, 0, 0, 0),
(156, 91, 127, 48, 0, 1, 0, 0, 0),
(157, 92, 127, 48, 0, 1, 0, 0, 0),
(158, 0, 127, 48, 0, 1, 0, 0, 0),
(159, 90, 127, 48, 0, 1, 0, 0, 0),
(160, 91, 127, 48, 0, 1, 0, 0, 0),
(161, 92, 127, 48, 0, 1, 0, 0, 0),
(163, 90, 127, 48, 0, 1, 0, 0, 0),
(164, 91, 127, 48, 0, 1, 0, 0, 0),
(165, 92, 127, 48, 0, 1, 0, 0, 0),
(167, 90, 125, 52, 0, 1, 0, 0, 0),
(168, 44, 125, 52, 0, 1, 0, 0, 0),
(169, 44, 124, 0, 1, 0, 0, 0, 0),
(170, 90, 127, 53, 0, 1, 0, 0, 0),
(171, 91, 127, 53, 0, 1, 0, 0, 0),
(172, 92, 127, 53, 0, 1, 0, 0, 0),
(174, 91, 127, 54, 0, 1, 0, 0, 0),
(175, 93, 127, 54, 0, 1, 0, 0, 0),
(176, 94, 127, 54, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `inscrit_module`
--

CREATE TABLE `inscrit_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_mod` int(11) NOT NULL,
  `inscrit` int(11) NOT NULL,
  `validate` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=113 ;

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_beg` date NOT NULL,
  `date_end_register` date NOT NULL,
  `date_end` date NOT NULL,
  `nb_credit` int(11) NOT NULL,
  `nb_place` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Structure de la table `note_activity`
--

CREATE TABLE `note_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_activity` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Structure de la table `objet_activity`
--

CREATE TABLE `objet_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_activity` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `link` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Contenu de la table `objet_activity`
--

INSERT INTO `objet_activity` (`id`, `id_activity`, `name`, `link`) VALUES
(82, 5, 'minitalk.zip', 'asset/subject/minitalk.zip'),
(84, 7, 'TE_Allegoriedelacaverne.pdf', 'asset/subject/TE_Allegoriedelacaverne.pdf'),
(85, 17, 'edwardsnowdenggmap.png', 'asset/subject/edwardsnowdenggmap.png'),
(86, 26, 'mariochampi.png', 'asset/subject/mariochampi.png');

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_admin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `objet` varchar(255) NOT NULL,
  `date_ticket` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Structure de la table `ticket_cat`
--

CREATE TABLE `ticket_cat` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cat` text NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `ticket_cat`
--

INSERT INTO `ticket_cat` (`id_cat`, `nom_cat`) VALUES
(1, 'ADM'),
(2, 'Idea box'),
(3, 'Session'),
(4, 'Intra'),
(6, 'Subject'),
(7, 'TIG'),
(8, 'Vogsphere\r\n'),
(9, 'Other');

-- --------------------------------------------------------

--
-- Structure de la table `ticket_message`
--

CREATE TABLE `ticket_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_message` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(128) NOT NULL,
  `passwd` varchar(256) NOT NULL,
  `root` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `img_profil` varchar(256) NOT NULL DEFAULT 'asset/images/profil.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `passwd`, `root`, `email`, `img_profil`) VALUES
(44, 'admin', '6a4e012bd9583858a5a6fa15f58bd86a25af266d3a4344f1ec2018b778f29ba83be86eb45e6dc204e11276f4a99eff4e2144fbe15e756c2c88e999649aae7d94', 1, 'emeric.spiroux@gmail.com', 'asset/images/10253811_10203685882446997_6414426687689446326_n3.jpg'),
(102, 'espiroux', '9266f9b8ff03b896bfbbdc736324f02438f00423fcd849acfefd6784ab67bc5019a3029b88ababfc96f8bafa69762eb6240c454cab7fd5e14a398c7d0a69c25c', 0, 'emeric.spiroux@gmail.comawd', 'asset/images/10253811_10203685882446997_6414426687689446326_n.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
