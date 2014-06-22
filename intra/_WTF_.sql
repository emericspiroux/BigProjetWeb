-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 22 Juin 2014 à 19:07
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `activity`
--

INSERT INTO `activity` (`id`, `name`, `description`, `date_reg`, `date_beg`, `date_peer`, `date_end`, `id_mod`, `groupe`, `nb_groupe`, `nb_place`, `type`, `nb_peer`, `id_cron_peer`, `id_cron_groupe`, `id_cron_mark`) VALUES
(1, 'libft', 'libft', '2014-06-22 10:00:00', '2014-06-29 08:42:00', '2014-06-30 12:00:00', '2014-07-06 11:00:00', 1, 1, 2, 1000, 'TD', 2, 2, 1, 3),
(2, 'ft_printf', 'ft_printf', '2014-06-22 09:42:00', '2014-06-29 00:00:00', '2014-06-30 00:00:00', '2014-07-01 00:00:00', 1, 0, 0, 1000, 'TD', 2, 1, 0, 2),
(3, 'filler', ' Le sujet de ce projet est connu une fois que tout le monde a une libft 100% opérationnelle. ', '2014-06-22 00:00:00', '2014-06-29 00:00:00', '2014-06-30 00:00:00', '2014-07-01 00:00:00', 1, 2, 4, 1000, 'TD', 2, 3, 0, 4),
(4, 'Soon', '  Quand il faut arriver a l''heure sinon on ne peux plus s''inscrire et on ne vois meme pas le sujet...', '2014-06-16 00:00:00', '2014-06-22 00:00:00', '2014-06-29 00:00:00', '2014-06-30 00:00:00', 1, 0, 0, 1000, 'TD', 2, 1, 0, 2),
(5, 'No_places', ' Quand il n''y a plus de place !', '2014-06-22 00:00:00', '2014-06-29 00:00:00', '2014-06-30 00:00:00', '2014-07-01 00:00:00', 1, 0, 0, 0, 'TD', 2, 3, 0, 4),
(6, 'la_caverne_de_platon', 'Entre illusion et realite.', '2014-06-22 00:00:00', '2014-06-29 10:00:00', '2014-07-06 10:00:00', '2014-07-06 12:00:00', 2, 0, 0, 1000, 'TD', 2, 1, 0, 2),
(7, 'test_du_peer_correcting', 'ici on test le peer-correcting', '2014-06-22 00:00:00', '2014-06-22 18:00:00', '2014-06-22 18:30:00', '2014-06-29 00:00:00', 3, 0, 0, 993, 'TD', 2, 1, 0, 2),
(8, 'test_de_la_notation', '  ici on test quand tu recois tes notes', '2014-06-22 18:00:00', '2014-06-22 18:30:00', '2014-06-22 19:00:00', '2014-06-22 19:00:00', 3, 0, 0, 994, 'TD', 2, 4, 0, 5),
(9, '19', '  1adw', '2014-06-14 11:11:00', '2014-06-22 10:00:00', '2014-06-28 10:00:00', '2014-06-22 10:00:00', 3, 1, 2, 1000, 'TD', 2, 2, 1, 3),
(10, 'test_auto', 'auto', '2014-06-22 00:00:00', '2014-06-22 19:00:00', '2014-06-24 00:00:00', '2014-06-29 00:00:00', 4, 1, 2, 994, 'TD', 3, 8, 7, 9),
(11, 'test_manu', 'manu  ', '2014-06-22 00:00:00', '2014-06-22 22:00:00', '2014-06-22 00:00:00', '2014-06-22 00:00:00', 4, 2, 2, 999, 'TD', 3, 12, 0, 13),
(12, 'test_manu_2', '  ici on te montre la page de groupe', '2014-06-22 00:00:00', '2014-06-29 00:00:00', '2014-07-01 00:00:00', '2014-06-24 00:00:00', 4, 2, 4, 1000, 'TD', 3, 16, 0, 17),
(13, 'ici_c''est_trop_tot', 'Trop tot !  ', '2014-06-29 12:00:00', '2014-06-30 12:00:00', '2014-07-01 00:00:00', '2014-07-02 00:00:00', 1, 0, 0, 1000, 'TD', 2, 1, 0, 2);

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
('01c21184486a9c2875ad0d591378fd27', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36', 1403456556, 'a:11:{s:9:"user_data";s:0:"";s:6:"pseudo";s:8:"espiroux";s:2:"id";s:3:"102";s:6:"passwd";s:128:"9266f9b8ff03b896bfbbdc736324f02438f00423fcd849acfefd6784ab67bc5019a3029b88ababfc96f8bafa69762eb6240c454cab7fd5e14a398c7d0a69c25c";s:5:"email";s:27:"emeric.spiroux@gmail.comawd";s:4:"root";s:1:"0";s:8:"ldap_log";s:8:"espiroux";s:8:"ldap_pwd";s:10:"Larryeme25";s:10:"img_profil";s:65:"asset/images/10253811_10203685882446997_6414426687689446326_n.jpg";s:5:"login";i:1;s:3:"mdp";s:128:"9266f9b8ff03b896bfbbdc736324f02438f00423fcd849acfefd6784ab67bc5019a3029b88ababfc96f8bafa69762eb6240c454cab7fd5e14a398c7d0a69c25c";}');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `correction`
--

INSERT INTO `correction` (`id`, `id_teacher`, `id_student`, `id_activity`, `id_groupe`, `mark`, `feedback`, `accept`, `save`) VALUES
(1, 44, 107, 7, 0, NULL, '', 0, 0),
(2, 44, 104, 7, 0, NULL, '', 0, 0),
(3, 102, 107, 7, 0, NULL, '', 0, 0),
(4, 102, 104, 7, 0, NULL, '', 0, 0),
(5, 103, 104, 7, 0, NULL, '', 0, 0),
(6, 103, 105, 7, 0, NULL, '', 0, 0),
(7, 104, 44, 7, 0, NULL, '', 0, 0),
(8, 104, 102, 7, 0, NULL, '', 0, 0),
(9, 105, 104, 7, 0, NULL, '', 0, 0),
(10, 105, 107, 7, 0, NULL, '', 0, 0),
(11, 106, 44, 7, 0, NULL, '', 0, 0),
(12, 106, 102, 7, 0, NULL, '', 0, 0),
(13, 107, 106, 7, 0, NULL, '', 0, 0),
(14, 107, 104, 7, 0, NULL, '', 0, 0),
(15, 44, 106, 8, 0, 8, 'pas tres bien mais sa suffira pour un 8 !', 1, 0),
(16, 44, 105, 8, 0, 7, 'adad', 1, 0),
(17, 103, 104, 8, 0, 10, 'bien bien', 1, 0),
(18, 103, 106, 8, 0, 10, 'pas mal', 1, 0),
(19, 104, 106, 8, 0, 5, 'alwkdjalw', 1, 0),
(20, 104, 103, 8, 0, 14, 'awdawd', 1, 0),
(21, 105, 44, 8, 0, 1, 'awdawd', 1, 0),
(22, 105, 106, 8, 0, 12, 'awdaw', 1, 0),
(23, 106, 107, 8, 0, 0, 'akwdjhadw', 1, 0),
(24, 106, 103, 8, 0, 1, 'aadwwda', 1, 0),
(25, 107, 103, 8, 0, 4, '1adw', 1, 0),
(26, 107, 104, 8, 0, 12, 'dwad', 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `e_learning`
--

INSERT INTO `e_learning` (`id`, `name`, `url`, `id_activity`) VALUES
(1, 'ici on apprend', 'https://www.youtube.com/watch?v=CVCCSRKeCtE', 2),
(2, 'encore', 'https://www.youtube.com/watch?v=5v7h4ZmgMvw', 2),
(3, 'la caverne de platon', 'https://www.youtube.com/watch?v=_MxNM0gkeYg', 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `forum_cat`
--

INSERT INTO `forum_cat` (`id`, `title`, `comment`, `id_user`) VALUES
(1, 'Welcome Forhome', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et vulputate ante. Morbi accumsan vestibulum dolor, a fermentum lectus luctus in. Vestibulum at lorem pellentesque, ultrices purus ut, mattis quam. Quisque vel dui lacus. Morbi nulla sapien, blandit sagittis tempus vel, gravida vel purus', 44),
(2, 'Algo', 'Ici on code du code', 44),
(3, 'Philo', 'Ou tu n''est pas inscrit et ou tu ne fera pas de philo', 44),
(4, 'crontab', 'ici on test les peer-correcting', 44),
(5, 'test_de_groupe', 'ici on test les groupe manu et auto', 44);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `forum_message`
--

INSERT INTO `forum_message` (`id`, `comment`, `datetime`, `id_user`, `id_thread`) VALUES
(1, 'Coucou je suis l''admin<br />\n', '2014-06-22 15:34:27', 44, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `forum_s_cat`
--

INSERT INTO `forum_s_cat` (`id`, `title`, `comment`, `id_user`, `id_cat`) VALUES
(1, 'Ici c''est le forum', 'Forum youhouhou', 44, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `forum_thread`
--

INSERT INTO `forum_thread` (`id`, `title`, `comment`, `id_user`, `id_s_cat`) VALUES
(1, 'thread forum', 'Foruuuum', 44, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`id`, `name`, `id_activity`, `peer_correcting`) VALUES
(1, 'test_manu_groupe_0', 10, 0),
(2, 'test_manu_groupe_1', 10, 0),
(3, 'test_manu_groupe_2', 10, 0),
(4, ' coucou', 11, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=198 ;

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
(176, 94, 127, 54, 0, 1, 0, 0, 0),
(177, 44, 7, 0, 1, 0, 0, 1, 2),
(178, 102, 7, 0, 1, 0, 0, 1, 2),
(179, 103, 7, 0, 1, 0, 0, 1, 0),
(180, 104, 7, 0, 1, 0, 0, 1, 5),
(181, 105, 7, 0, 1, 0, 0, 1, 1),
(182, 106, 7, 0, 1, 0, 0, 1, 1),
(183, 107, 7, 0, 1, 0, 0, 1, 3),
(184, 44, 8, 0, 1, 0, 0, 1, 1),
(185, 103, 8, 0, 1, 0, 0, 1, 3),
(186, 104, 8, 0, 1, 0, 0, 1, 2),
(187, 105, 8, 0, 1, 0, 0, 1, 1),
(188, 106, 8, 0, 1, 0, 0, 1, 4),
(189, 107, 8, 0, 1, 0, 0, 1, 1),
(190, 44, 10, 1, 1, 1, 0, 1, 0),
(191, 103, 10, 3, 1, 1, 0, 1, 0),
(192, 104, 10, 2, 1, 1, 0, 1, 0),
(193, 105, 10, 2, 1, 1, 0, 1, 0),
(194, 106, 10, 3, 1, 1, 0, 1, 0),
(195, 107, 10, 1, 1, 1, 0, 1, 0),
(196, 103, 11, 4, 0, 1, 0, 0, 0),
(197, 44, 11, 4, 0, 1, 0, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `inscrit_module`
--

INSERT INTO `inscrit_module` (`id`, `id_user`, `id_mod`, `inscrit`, `validate`) VALUES
(3, 44, 3, 1, 0),
(4, 102, 3, 1, 0),
(5, 103, 3, 1, 0),
(6, 104, 3, 1, 0),
(7, 105, 3, 1, 0),
(8, 106, 3, 1, 0),
(9, 107, 3, 1, 0),
(10, 44, 4, 1, 0),
(11, 103, 4, 1, 0),
(12, 104, 4, 1, 0),
(13, 105, 4, 1, 0),
(14, 106, 4, 1, 0),
(15, 107, 4, 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `module`
--

INSERT INTO `module` (`id`, `name`, `description`, `date_beg`, `date_end_register`, `date_end`, `nb_credit`, `nb_place`) VALUES
(1, 'Algo', 'Ici on code du code', '2014-06-22', '2014-06-29', '2014-09-01', 12, 1000),
(2, 'Philo', 'Ou tu n''est pas inscrit et ou tu ne fera pas de philo', '2014-06-22', '2014-06-29', '2014-06-30', 12, 1000),
(3, 'crontab', 'ici on test les peer-correcting', '2014-06-22', '2014-06-29', '2014-07-06', 12, 1104),
(4, 'test_de_groupe', 'ici on test les groupe manu et auto', '2014-06-22', '2014-06-23', '2014-06-24', 12, 994);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `note_activity`
--

INSERT INTO `note_activity` (`id`, `id_user`, `id_activity`, `mark`) VALUES
(1, 44, 8, 1),
(2, 103, 8, 6),
(3, 104, 8, 11),
(4, 105, 8, 7),
(5, 106, 8, 9),
(6, 107, 8, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Contenu de la table `objet_activity`
--

INSERT INTO `objet_activity` (`id`, `id_activity`, `name`, `link`) VALUES
(87, 2, 'ft_printf.pdf', 'asset/subject/ft_printf.pdf');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `passwd`, `root`, `email`, `img_profil`) VALUES
(44, 'admin', '6a4e012bd9583858a5a6fa15f58bd86a25af266d3a4344f1ec2018b778f29ba83be86eb45e6dc204e11276f4a99eff4e2144fbe15e756c2c88e999649aae7d94', 1, 'emeric.spiroux@gmail.com', 'asset/images/10253811_10203685882446997_6414426687689446326_n3.jpg'),
(102, 'espiroux', '9266f9b8ff03b896bfbbdc736324f02438f00423fcd849acfefd6784ab67bc5019a3029b88ababfc96f8bafa69762eb6240c454cab7fd5e14a398c7d0a69c25c', 0, 'emeric.spiroux@gmail.comawd', 'asset/images/10253811_10203685882446997_6414426687689446326_n.jpg'),
(103, 'q', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', 0, '', 'asset/images/profil.jpg'),
(104, 'w', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', 0, '', 'asset/images/profil.jpg'),
(105, 'e', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', 0, '', 'asset/images/profil.jpg'),
(106, 'r', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', 0, '', 'asset/images/profil.jpg'),
(107, 't', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', 0, '', 'asset/images/profil.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
