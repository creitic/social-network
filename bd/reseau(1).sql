-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 10 sep. 2019 à 11:55
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `reseau`
--

-- --------------------------------------------------------

--
-- Structure de la table `auth_tokens`
--

DROP TABLE IF EXISTS `auth_tokens`;
CREATE TABLE IF NOT EXISTS `auth_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `selector` varchar(20) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `codes`
--

DROP TABLE IF EXISTS `codes`;
CREATE TABLE IF NOT EXISTS `codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `friends_relationships`
--

DROP TABLE IF EXISTS `friends_relationships`;
CREATE TABLE IF NOT EXISTS `friends_relationships` (
  `user_id1` int(11) NOT NULL,
  `user_id2` int(11) NOT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id1`,`user_id2`),
  KEY `user_id2` (`user_id2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `friends_relationships`
--

INSERT INTO `friends_relationships` (`user_id1`, `user_id2`, `status`, `created_at`) VALUES
(3, 3, '2', '2019-09-10 14:13:30'),
(4, 4, '2', '2019-09-10 14:13:30'),
(5, 5, '2', '2019-09-10 14:13:30'),
(6, 6, '2', '2019-09-10 14:13:30'),
(7, 7, '2', '2019-09-10 14:13:30'),
(8, 8, '2', '2019-09-10 14:13:30'),
(9, 9, '2', '2019-09-10 14:13:30'),
(10, 10, '2', '2019-09-10 14:13:30'),
(11, 11, '2', '2019-09-10 14:13:30'),
(12, 12, '2', '2019-09-10 14:13:30'),
(13, 13, '2', '2019-09-10 14:13:31'),
(14, 14, '2', '2019-09-10 14:13:31'),
(15, 15, '2', '2019-09-10 14:13:31'),
(16, 16, '2', '2019-09-10 14:13:31'),
(17, 17, '2', '2019-09-10 14:13:31'),
(18, 18, '2', '2019-09-10 14:13:31'),
(19, 19, '2', '2019-09-10 14:13:31'),
(20, 20, '2', '2019-09-10 14:13:31'),
(21, 21, '2', '2019-09-10 14:13:31'),
(22, 22, '2', '2019-09-10 14:13:31'),
(23, 23, '2', '2019-09-10 14:13:31'),
(24, 24, '2', '2019-09-10 14:13:31'),
(25, 25, '2', '2019-09-10 14:13:31'),
(26, 26, '2', '2019-09-10 14:13:32'),
(27, 27, '2', '2019-09-10 14:13:32'),
(28, 28, '2', '2019-09-10 14:13:32'),
(29, 29, '2', '2019-09-10 14:13:32'),
(30, 30, '2', '2019-09-10 14:13:32'),
(31, 31, '2', '2019-09-10 14:13:32'),
(32, 32, '2', '2019-09-10 14:13:32'),
(33, 33, '2', '2019-09-10 14:47:34');

-- --------------------------------------------------------

--
-- Structure de la table `microposts`
--

DROP TABLE IF EXISTS `microposts`;
CREATE TABLE IF NOT EXISTS `microposts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `like_count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `microposts`
--

INSERT INTO `microposts` (`id`, `content`, `user_id`, `created_at`, `like_count`) VALUES
(1, 'slt', 33, '2019-09-10 14:48:47', 0);

-- --------------------------------------------------------

--
-- Structure de la table `micropost_like`
--

DROP TABLE IF EXISTS `micropost_like`;
CREATE TABLE IF NOT EXISTS `micropost_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `micropost_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `micropost_id` (`micropost_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `seen` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `active` enum('0','1') DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `sex` enum('H','F') DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `available_for_hiring` enum('0','1') DEFAULT '0',
  `bio` text,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `pseudo`, `email`, `password`, `active`, `created_at`, `city`, `country`, `sex`, `twitter`, `github`, `available_for_hiring`, `bio`, `avatar`) VALUES
(33, 'RAMAHAVITA claudio', 'claudio', 'claudioramahavita@gmail.com', '$2y$10$fqms5AauzdLi1EFouZArUeeoE4LYtXEgO7Ixe2K6Q2C1cRCGsbW.6', '1', '2019-09-10 14:47:34', 'Depot analakininina', 'Tamatave', 'H', NULL, NULL, '1', 'Voluptatem velit et non nobis. Ea unde porro dolorem vel assumenda necessitatibus. Itaque sed et culpa vel quia nostrum. Quidem aut nam dolor aperiam fugit porro.', NULL),
(3, 'Joshuah Yundt', 'aurelia.kautzer', 'randal54@gerhold.org', '$2y$10$6gyFIJdyCST0KG4KW.xR3usBUG.OD6HB3NJ.Q7GZtgBUxHPXd/aHO', '1', '2008-11-05 11:35:06', 'Port Delbert', 'Guinea-Bissau', 'F', NULL, NULL, '1', 'Voluptatem velit et non nobis. Ea unde porro dolorem vel assumenda necessitatibus. Itaque sed et culpa vel quia nostrum. Quidem aut nam dolor aperiam fugit porro.', NULL),
(4, 'Ms. Corene Keebler', 'kris.caitlyn', 'felicia31@considine.biz', '$2y$10$LsYHnPheX07N394539TXhOcfRWHDB/zXh1f9P0RjVwONSQ6pQ4oam', '1', '1976-08-13 22:06:49', 'South Peteville', 'Aruba', 'H', NULL, NULL, '1', 'Unde et omnis rerum ut officia repellat. Magni velit placeat numquam quo dolores rerum. Eum quis distinctio quidem aperiam optio. Consequatur suscipit consequuntur quo et praesentium qui vel.', NULL),
(5, 'Prof. Chadd Mayer DVM', 'ucummings', 'bjakubowski@yahoo.com', '$2y$10$IRspA/EaZaAUO4.98CorL.BmpXUoAnxjDzHzquQ4aY6PPDZHG1.Oy', '1', '1992-12-04 08:35:17', 'Aylinmouth', 'Sweden', 'F', NULL, NULL, '1', 'Cumque nihil et iste ut et delectus. Qui suscipit omnis accusantium eos at. Perferendis molestiae placeat voluptatem doloremque vero.', NULL),
(6, 'Prof. Joey Herzog', 'schneider.llewellyn', 'hartmann.ellie@hotmail.com', '$2y$10$dzeXf.Pl04sEmRLc6k./9eaT3FJ1JQtTgSrvX33EidPw9I565nW2m', '1', '2006-09-12 07:15:41', 'Monahanville', 'United States Virgin Islands', 'F', NULL, NULL, '1', 'Est nostrum nam cumque deleniti molestiae commodi dolores debitis. Nulla distinctio omnis voluptate eos. Officia odio ab est omnis eos.', NULL),
(7, 'Rickey Daugherty', 'bwaters', 'xweimann@weber.com', '$2y$10$TDrlA6nDEC.HgRMHre/FS.YhMbo1uwaujg70z7Ca5.L/C8gQhZRKS', '1', '1976-09-11 08:16:35', 'Zanetown', 'Brazil', 'F', NULL, NULL, '1', 'Rem vel ipsum sapiente modi ea. Vel consequatur odio qui quidem repellat veritatis. Nihil aut nobis porro. Vel ad repellat enim veritatis adipisci error et.', NULL),
(8, 'Ariane Krajcik', 'keyon10', 'yundt.westley@altenwerth.net', '$2y$10$pvrOe2Zg8yRpJ7ivwz1N1.2n8lwMdSYh7uZpRTw4Yhxa/sO5EZUNC', '1', '1999-03-18 15:41:43', 'East Chase', 'Guatemala', 'H', NULL, NULL, '0', 'Autem ut cum dolore nostrum possimus in. Architecto aspernatur ipsa dolores commodi omnis quis ea quaerat. Rerum qui officiis architecto.', NULL),
(9, 'Prof. Ruthie Labadie', 'aliyah14', 'breitenberg.ole@yahoo.com', '$2y$10$DWKLeOIpkeREG/nhSv29EeJlsiqVHw9PoUyZVuJjPmlWIZf7YOK4S', '1', '2012-08-11 00:38:15', 'West Sister', 'Armenia', 'F', NULL, NULL, '0', 'Et illo dignissimos vero fuga corrupti rerum. Quibusdam et voluptatibus in ut omnis iure ex voluptas. Rerum qui assumenda atque itaque.', NULL),
(10, 'Vesta VonRueden', 'brielle80', 'katelyn56@baileybeer.info', '$2y$10$LtHvuPaY5c4yQvxgMhI2nOLI78oxHF5RP6UC5aM0Mn5FXRcG1SKiG', '1', '1998-06-25 15:40:55', 'Henriport', 'Guinea-Bissau', 'F', NULL, NULL, '1', 'Molestiae necessitatibus ut atque omnis aut. Necessitatibus quis sed velit voluptatum. Facere facere maiores et officiis provident ut repellat.', NULL),
(11, 'Maeve Gibson', 'daniel.aida', 'kunze.philip@collins.com', '$2y$10$QOtjCkC0rWYJkDMmWX5g2eO0soUWeJ4QxRJZeysRWTP.GF7ZcMnM.', '1', '2018-10-23 16:10:22', 'Port Vinniefurt', 'Finland', 'F', NULL, NULL, '1', 'Dolores exercitationem magni consequatur culpa. Sequi est harum dolor rem ut repudiandae animi. Excepturi deserunt et autem dolore necessitatibus quod aliquid est.', NULL),
(12, 'Estelle Pouros', 'fframi', 'oschaden@boehm.info', '$2y$10$IcZ9JSAtG9OILYtuc2jmz.lE3N4CkG8swa91sXoCIismLhCd6TB46', '1', '2010-10-27 01:59:40', 'Murrayview', 'Saint Vincent and the Grenadines', 'F', NULL, NULL, '1', 'Recusandae et non explicabo qui placeat sint error impedit. Facilis non minima quae corporis reiciendis et nostrum. Voluptate sed ut sunt accusantium.', NULL),
(13, 'Bret Mueller IV', 'mbernhard', 'barrett44@schambergerlubowitz.org', '$2y$10$KbO2jXP/nrHvaPz0zp.4Ou4A3aAroSnXnycRMtUGp6x1hDX9SEJJ2', '1', '1992-04-29 09:42:51', 'East Jazmynhaven', 'Western Sahara', 'F', NULL, NULL, '0', 'Qui et sequi molestias blanditiis qui. Pariatur pariatur ut hic blanditiis earum repellendus sapiente vel.', NULL),
(14, 'Brock Fisher', 'tstracke', 'brenna.moore@russel.org', '$2y$10$QB6TRtQkymj3XfVlTSlKoOzOq1yYPqYeb45VSiMxmqslm93/b5.pq', '1', '1974-08-24 00:39:25', 'New Marcelle', 'Iraq', 'H', NULL, NULL, '1', 'Aspernatur incidunt inventore rerum adipisci deleniti quibusdam eligendi. Eveniet nisi hic hic eos. Nostrum voluptates corrupti libero amet. Quo inventore exercitationem aspernatur voluptatum est nisi eligendi veritatis. Impedit accusamus eveniet magnam ab.', NULL),
(15, 'Lucienne Cremin IV', 'elva.o\'conner', 'gbednar@yahoo.com', '$2y$10$C4olIWzfGMMZeeRVvXuNeOR1H7iWgVfVoOyfONQ9P8IkrYbUqa1fu', '1', '2012-09-24 05:54:46', 'Hayestown', 'Uganda', 'H', NULL, NULL, '1', 'Sint incidunt vel ut soluta consequatur corrupti omnis et. Magnam et corrupti aut debitis et. Magnam voluptas excepturi voluptatem ea ipsa nobis.', NULL),
(16, 'Amani Bins', 'miguel.runte', 'ally40@gmail.com', '$2y$10$j/LgueniXyEHcb2OOrwS.uBIPS8mkrXZ8qa92DDyXjL5.p7DJuFMi', '1', '1996-11-28 19:59:23', 'Bednarshire', 'British Virgin Islands', 'F', NULL, NULL, '0', 'Natus officia labore nobis explicabo saepe. A eius adipisci dolor unde. Enim sed officia et amet occaecati aut laborum.', NULL),
(17, 'Kevin Wuckert II', 'miller94', 'heidenreich.keira@gmail.com', '$2y$10$p1BZEUqRGluRVrJ7SN2qqOmL2DrUBkzU1mifgRMI.rIGHeUk117Fq', '1', '2004-12-06 14:25:20', 'Godfreymouth', 'Uruguay', 'F', NULL, NULL, '0', 'Officia et voluptates sit ab iusto sint hic quia. Iure at fugiat rerum illum sint. Repellat aperiam est voluptatibus id et.', NULL),
(18, 'Mr. Brycen Gleason DVM', 'fleta56', 'mueller.justyn@yahoo.com', '$2y$10$T2kNz1G50vw9XzdJX4Yua.npasW44bB4/MI7JX3T7gPgC8yPy8ueC', '1', '2017-10-09 04:58:38', 'Lake Gino', 'Tonga', 'F', NULL, NULL, '1', 'Saepe aut quod minima dolor sit. Eveniet numquam saepe quo quis recusandae nemo. Molestiae ut et inventore est aperiam temporibus. Deleniti aliquam qui blanditiis aspernatur sunt distinctio.', NULL),
(19, 'Krystel Labadie PhD', 'rau.joaquin', 'ortiz.hollie@yahoo.com', '$2y$10$ii60H3tRNU/HDPH8H7/x2e.g/0yU1jork0TOZHOBAX3mrb4i98jJG', '1', '1977-12-28 10:42:14', 'Shaneview', 'United States Minor Outlying Islands', 'H', NULL, NULL, '0', 'Laboriosam voluptas consequatur veniam rem mollitia nam. Laboriosam doloribus sequi ab sed consequatur. Voluptatem iure eligendi excepturi.', NULL),
(20, 'Leatha Weber', 'dheaney', 'madelynn.tremblay@kutch.info', '$2y$10$AMwM/LVuNqL21uFFvawL8eCkeU9gs2SM1ZoAvG7lgwBvw.XlmvW.G', '1', '2006-08-23 03:31:54', 'Gastonshire', 'Guinea', 'F', NULL, NULL, '1', 'Et magni adipisci autem aut. Voluptatem quod neque soluta dignissimos. Quis odio voluptatem eveniet.', NULL),
(21, 'Jacinthe VonRueden', 'garnett.kris', 'whyatt@yahoo.com', '$2y$10$ou.zFrfQ3FGz5MqQ0ITiauIEowwGXQnQQ2NtZd4dRTlBudZY3gGD2', '1', '1983-08-17 19:54:35', 'South Marcellaborough', 'Greenland', 'F', NULL, NULL, '0', 'Sit velit at vel voluptas similique suscipit quas voluptatum. Est ratione et consequatur voluptas odit enim quos. Ut ratione quam optio dolore natus in quibusdam. Dignissimos sequi et explicabo incidunt maiores iusto.', NULL),
(22, 'Hoyt Turcotte', 'qreichert', 'dewitt00@hotmail.com', '$2y$10$HdmfSORyJkeqCzyu2FePI.M3uovdgXPirtB5re8f5CDjkZVQZfdO6', '1', '2006-05-26 14:21:44', 'Alysonview', 'Zimbabwe', 'F', NULL, NULL, '1', 'Ex expedita nihil dolor. Voluptatum aliquam ut mollitia nobis fuga. Est incidunt nihil dolores.', NULL),
(23, 'Ellen Boyle', 'dane14', 'brianne43@yahoo.com', '$2y$10$FS77DuL.8YiLJY1ScFR3cOHP148vScl9dK/JgiRzDJCjuuOcXo.oy', '1', '1978-10-27 16:40:40', 'Schinnerberg', 'Guinea', 'H', NULL, NULL, '1', 'Perferendis repellat exercitationem sint rerum perspiciatis minus minus. Est error ex quia et at accusantium. Vero corrupti assumenda inventore nemo iure. Rerum at aut incidunt cumque molestias rem ex.', NULL),
(24, 'Muriel Pagac III', 'gtorphy', 'theo65@hotmail.com', '$2y$10$Gh1yYnYCJZ8phz1TO2P./.TWRVcfnNW4cXCFE9/Yu33RKPKZRJarm', '1', '1980-01-28 09:49:43', 'Royceshire', 'Brunei Darussalam', 'H', NULL, NULL, '1', 'Sit iste et consequuntur aut unde. Culpa porro cumque non debitis eaque. Qui expedita culpa blanditiis consequatur nostrum voluptate.', NULL),
(25, 'Noah Wuckert', 'jgleichner', 'arnaldo.quitzon@lakin.info', '$2y$10$cjC8Fg7Dg05iZCDzhAjpoece8q/SZ.dzHnQBkahamFm.XdUBt3wq2', '1', '1987-01-27 02:58:06', 'Shannonmouth', 'Colombia', 'H', NULL, NULL, '0', 'Et repellat aliquid occaecati quisquam ea doloremque. Dolorem quia quia dignissimos recusandae. Maxime vitae ab accusamus est est quidem.', NULL),
(26, 'Prof. Kendrick Johnston', 'dashawn.spencer', 'ko\'conner@hotmail.com', '$2y$10$goYhegJiThiG7KAz6bFnDetD7To6Vy2J/v.iw96fRMdWG5aRZp33i', '1', '1990-01-07 10:23:20', 'Brendonhaven', 'Fiji', 'H', NULL, NULL, '1', 'Ex modi deserunt optio aut accusantium voluptatem consequatur. Est reiciendis hic repellat eaque veniam. Expedita natus iure nam in. Et aspernatur facere voluptas praesentium.', NULL),
(27, 'Joan Friesen PhD', 'considine.tiffany', 'albin54@yahoo.com', '$2y$10$9ILWbgaqbGOwdC499I3Cquy5WeTGZ7S3zZA2moJHqs6G7n/HnxdPy', '1', '1995-10-13 05:40:59', 'North Kaelynhaven', 'San Marino', 'H', NULL, NULL, '0', 'Ut quod quia nobis assumenda. Aliquam culpa aut earum a itaque. Tempora aut non facilis praesentium enim et.', NULL),
(28, 'Prof. Jayden Ondricka', 'abdul80', 'gennaro.schaden@yahoo.com', '$2y$10$sY03CjN72smNacBprCVMLuljJZtBrXLKXDDKZX4QAWrkCkgIhwo5W', '1', '1994-09-08 03:22:20', 'Prudencefurt', 'Croatia', 'F', NULL, NULL, '1', 'Quas rerum delectus saepe ex. Voluptatem quia error aperiam officiis minima. Eligendi aut qui harum earum. Atque sequi accusantium dicta nihil vel commodi.', NULL),
(29, 'Kristin Krajcik', 'dennis.herman', 'izabella60@johnson.biz', '$2y$10$K6aon2es6XoVjmGx33/TRell9osmPawF7JVUD6kws4TI0zB8d02si', '1', '2015-06-08 18:57:48', 'Leviview', 'Antarctica (the territory South of 60 deg S)', 'H', NULL, NULL, '0', 'Eos reprehenderit est rem aliquam dolores. Velit non et at beatae officia. Est ipsa consequatur quae sed omnis voluptate molestiae deserunt.', NULL),
(30, 'Constantin Leffler DVM', 'elinore48', 'amiller@morarziemann.net', '$2y$10$wjWiG1l.s5VPrRxO//I8m.uYlPL115Rf99NwvEoIz9eeJxK4KmiJG', '1', '2017-12-19 20:43:11', 'South Lonfurt', 'Syrian Arab Republic', 'H', NULL, NULL, '1', 'Itaque dolorum aut fuga. Voluptas a deleniti voluptatem voluptatem tempora et. Inventore repellendus cum voluptas quibusdam rerum et.', NULL),
(31, 'Tony Terry', 'atillman', 'rohan.isabelle@hotmail.com', '$2y$10$ge5uZsUILWn05/wqa6cB4.dAR8yFy67boLQ4MAMq1fiy2vPTNi4zG', '1', '1982-07-17 08:29:04', 'Port Hermina', 'Poland', 'H', NULL, NULL, '0', 'Aut saepe totam laboriosam eum. Neque accusantium deserunt laboriosam laboriosam qui officia minus et. In nobis ipsam ut est labore ratione.', NULL),
(32, 'Dr. Broderick Metz II', 'margie26', 'margie29@wintheisermitchell.com', '$2y$10$uDX9ypve9jayztTUOIQFbesCN4wTPHNjBFC7PMipumdSzulFp4Eg6', '1', '1977-02-07 01:02:33', 'North Linwood', 'Bangladesh', 'F', NULL, NULL, '0', 'Sed similique nisi quia quae rerum. Odit quos voluptatem rerum. Nesciunt architecto accusantium aspernatur id aut dolorem non.', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
