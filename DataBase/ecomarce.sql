-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 21 Février 2019 à 16:04
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ecomarce`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `descreption` text NOT NULL,
  `ordering` int(11) DEFAULT NULL,
  `visibility` tinyint(4) NOT NULL DEFAULT '0',
  `allow_comment` tinyint(4) NOT NULL DEFAULT '0',
  `allow_ads` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `descreption`, `ordering`, `visibility`, `allow_comment`, `allow_ads`) VALUES
(1, 'Han Made', 'Hand Made Items', 1, 0, 0, 0),
(3, 'Cell Phones', 'Cell Phones Items', 3, 0, 0, 0),
(4, 'clothing', 'clothing and Fashion', 4, 0, 0, 0),
(5, 'Tools', 'Home Tools', 5, 0, 0, 0),
(6, 'computers', 'computers items', 3, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `idComment` int(11) NOT NULL,
  `comment` text NOT NULL,
  `addDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `idMember` int(11) NOT NULL,
  `idItem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`idComment`, `comment`, `addDate`, `status`, `idMember`, `idItem`) VALUES
(7, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:27:29', 1, 12, 14),
(8, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:28:25', 0, 12, 14),
(9, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:30:29', 0, 12, 14),
(10, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:31:24', 0, 12, 14),
(11, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:33:14', 0, 12, 14),
(12, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:33:52', 0, 12, 14),
(13, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:34:23', 0, 12, 14),
(14, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:34:47', 0, 12, 14),
(15, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:35:04', 0, 12, 14),
(16, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:35:53', 0, 12, 14),
(17, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:35:57', 0, 12, 14),
(18, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:36:00', 0, 12, 14),
(19, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:40:41', 0, 12, 14),
(20, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:50:29', 0, 12, 14),
(21, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:54:44', 0, 12, 14),
(22, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:56:12', 1, 12, 14),
(23, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:58:34', 0, 12, 14),
(24, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 22:59:46', 0, 12, 14),
(25, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 23:01:20', 1, 12, 14),
(26, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 23:01:23', 1, 12, 14),
(27, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 23:02:30', 1, 12, 14),
(28, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 23:04:51', 1, 12, 14),
(29, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 23:06:19', 1, 12, 14),
(30, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 23:07:14', 1, 12, 14),
(31, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 23:07:26', 1, 12, 14),
(33, 'Nice Ipad Thank You saddek test Comment mohammed', '2018-12-02 23:08:12', 1, 12, 14),
(35, 'Je me suis mis aux PWA cette année. Passer d’une SPA à une PWA est super simple. C’est surtout le worker qui fait tout le job, mais le résultat est bluffant. Faire des applications offline qui s’installent comme des applications natives devient un jeu d’enfant. Bref je conseille si vous avez des projets qui sont en service.\r\n\r\nPHP reste aussi pour moi un très bon langage. Celui que j’utilise le plus d’ailleurs. Quant à Doctrine, je suis sur que 99‰ des soucis que tu as vous être réglés grace à cette vidéo : https://www.youtube.com/watch?v=KJ3uCPqNdPE Tu te rendras compte que Doctrine n’est pas aussi intrusif que ça dans ton code.', '2019-01-01 13:25:14', 1, 20, 20),
(36, 'this is test comment this is test comment ', '2019-01-01 22:26:22', 1, 20, 20),
(37, 'this  is cemment Saddek User ', '2019-01-07 10:14:42', 1, 12, 20);

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ImagesItem` text NOT NULL,
  `Description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `Add_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Country_Made` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Rating` smallint(6) NOT NULL,
  `Approve` tinyint(4) NOT NULL DEFAULT '0',
  `Cat_id` int(11) NOT NULL,
  `Member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `items`
--

INSERT INTO `items` (`item_id`, `name`, `ImagesItem`, `Description`, `price`, `Add_Date`, `Country_Made`, `Image`, `Status`, `Rating`, `Approve`, `Cat_id`, `Member_id`) VALUES
(4, 'tool', '', 'nice tool', '$500', '2018-11-21 00:00:00', 'jappan', '', '2', 0, 1, 5, 11),
(5, 'hp 250s', '', 'nice pc ang  good ram ', '$250', '2018-11-21 00:00:00', 'usa', '', '2', 0, 1, 6, 11),
(12, 'clothing', '', 'this is test item for category clothing', '$250', '2018-12-02 21:42:33', 'Algeira', '', '1', 0, 1, 4, 12),
(13, 'ipone s6', '', 'this is test for category cell phones ', '$85', '2018-12-02 21:43:37', 'Jappan', '', '3', 0, 1, 3, 12),
(14, 'ipad', '', 'nice ipad and amazing ram', '$980', '2018-12-02 21:45:06', 'usa', '', '1', 0, 1, 6, 12),
(15, 'nokia s6', '', 'this test description for nokia ', '$250', '2018-12-02 21:45:49', 'china', '', '1', 0, 1, 3, 12),
(16, 'Lenove', '', 'test descreption for lenevo', '$500', '2018-12-02 21:46:26', 'china', '', '2', 0, 1, 6, 12),
(17, 'lenovo s20', '', 'this is test description for computer', '$800', '2018-12-02 21:47:04', 'jappan', '', '1', 0, 1, 6, 12),
(18, 'clothing 02', '', 'this is test description for clothing', '$200', '2018-12-02 21:48:35', 'algeria', '', '1', 0, 1, 4, 12),
(20, 'lelle arrierre', '', 'jdid noir colour ', '$50', '2019-01-01 14:22:30', 'france', '', '1', 0, 1, 1, 21),
(27, 'iphone 20', '2734375.jpg,35720825.jpg,4681396.jpg', 'nice And Good Cell Phone ', '$200', '2019-01-07 21:04:59', 'jappan', '', '1', 0, 1, 3, 20),
(29, 'nokia 3310', '33660889.png,47335815.png,98840333.png', 'good phone and nice price ', '$225', '2019-02-16 22:07:58', 'china', '', '1', 0, 1, 3, 20),
(30, 'canon ef ', '97808838.png,45712280.jpg,3125000.jpg', 'nice camera and good price ', '$300', '2019-02-16 22:10:24', 'algeria', '', '1', 0, 1, 3, 20),
(31, 'laptop', '66000366.jpg,27026367.png,46047974.jpg', 'test description laptop test ', '$2000', '2019-02-16 22:26:23', 'jappan', '', '1', 0, 1, 6, 20),
(32, 'newItem', '78298950.png,45697021.jpg,96774292.jpg,75134278.jpg,8560180.jpg', 'description For New Item', '$500', '2019-02-16 22:42:28', 'algeria', '', '2', 0, 1, 5, 12);

-- --------------------------------------------------------

--
-- Structure de la table `langlist`
--

CREATE TABLE `langlist` (
  `id` int(11) NOT NULL,
  `NameLang` varchar(255) NOT NULL,
  `Status` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `langlist`
--

INSERT INTO `langlist` (`id`, `NameLang`, `Status`) VALUES
(1, 'Arabic', 0),
(2, 'English', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT '0' COMMENT 'identify User Group',
  `trustStatus` int(11) NOT NULL DEFAULT '0' COMMENT 'Saliar Rank',
  `Regstatus` int(11) NOT NULL DEFAULT '0',
  `date_Registred` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ImageUser` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`userID`, `userName`, `password`, `Email`, `FullName`, `GroupID`, `trustStatus`, `Regstatus`, `date_Registred`, `ImageUser`) VALUES
(11, 'yahia', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'yahia@gmail.com', 'yahia boucetta', 0, 0, 1, '2018-11-21 20:31:20', ''),
(12, 'saddek', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'saddek@gmail.com', 'saddek saidi', 0, 0, 1, '2018-11-21 20:31:46', ''),
(13, 'root', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'ahmed@gmail.com', 'root root', 1, 0, 1, '2018-11-21 23:08:04', ''),
(14, 'بلال', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'bilal@gmail.com', 'bilal  bilal', 0, 0, 1, '2018-11-21 23:10:09', ''),
(16, 'tuuto', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'tuu@gmail.com', 'tuut toto', 0, 0, 1, '2018-11-26 15:12:27', ''),
(20, 'bilal', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'b@gmail.com', 'bilal saidi', 0, 0, 1, '2018-12-31 23:51:04', '157379_bilal.jpg'),
(21, 'obida', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'obida@gmail.com', '', 0, 0, 1, '2019-01-01 14:19:35', ''),
(22, 'user05', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'user05@gmail.com', 'user05 user05', 0, 0, 1, '2019-02-16 22:50:04', '428406_client-1.jpg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `comment_member` (`idMember`),
  ADD KEY `comment_item` (`idItem`);

--
-- Index pour la table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `cat_1` (`Cat_id`),
  ADD KEY `user_1` (`Member_id`);

--
-- Index pour la table `langlist`
--
ALTER TABLE `langlist`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_item` FOREIGN KEY (`idItem`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_member` FOREIGN KEY (`idMember`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_1` FOREIGN KEY (`Member_id`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
