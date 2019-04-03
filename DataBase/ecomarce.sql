-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 03 Avril 2019 à 02:46
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
  `parent` int(11) NOT NULL,
  `ordering` int(11) DEFAULT NULL,
  `visibility` tinyint(4) NOT NULL DEFAULT '0',
  `allow_comment` tinyint(4) NOT NULL DEFAULT '0',
  `allow_ads` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `descreption`, `parent`, `ordering`, `visibility`, `allow_comment`, `allow_ads`) VALUES
(7, 'nokia', 'nokia phones', 3, 1, 0, 0, 0),
(9, 'hemmers', 'hemmers desc', 5, 1, 0, 0, 0),
(10, 'blackberry', 'blackbirry phones', 3, 2, 0, 0, 0),
(11, 'Agriculture & Food', 'description  Agriculture & Food', 0, 1, 0, 0, 0),
(12, 'Textiles & Accessories', 'description Apparel,Textiles & Accessories', 0, 2, 0, 0, 0),
(13, 'Auto & Transportation', 'decription Auto & Transportation', 0, 3, 0, 0, 0),
(14, 'Bags, Shoes & Accessories', 'description Bags, Shoes & Accessories', 0, 4, 0, 0, 0),
(15, 'Electronics', 'description Electronics', 0, 0, 0, 0, 0),
(16, 'Gifts, Sports & Toys', 'description Gifts, Sports & Toys', 0, 0, 0, 0, 0),
(17, 'Health & Beauty', 'description Health & Beauty', 0, 0, 0, 0, 0),
(18, 'Animal Extract', 'description Animal Extract', 17, 0, 0, 0, 0),
(19, 'Body Weight', 'description Body Weight', 17, 0, 0, 0, 0),
(20, 'Health Care Supplies', 'description Health Care Supplies', 17, 0, 0, 0, 0),
(21, 'Agricultural Waste', 'description Agricultural Waste', 11, 0, 0, 0, 0),
(22, 'Beans', 'description Beans', 11, 0, 0, 0, 0),
(23, 'Feed', 'description Feed', 11, 0, 0, 0, 0),
(24, 'Coffee Beans', 'description Coffee Beans', 11, 0, 0, 0, 0),
(25, 'Hardware & Software', 'description Computer Hardware & Software', 15, 0, 0, 0, 0),
(26, 'Accessories & Parts', 'description Accessories & Parts', 15, 0, 0, 0, 0);

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
(1, 'goood Item And Nice Price Thank You ', '2019-03-23 21:56:07', 1, 23, 47),
(2, 'goood Item And Nice Price Thank You ', '2019-03-23 21:56:24', 0, 23, 47),
(3, 'comentaire obida saidi ', '2019-03-24 13:05:08', 1, 24, 47),
(4, 'comentaire obida saidi ', '2019-03-24 13:05:42', 0, 24, 47);

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
(47, 'HD LED interactive', '65579224.jpg,71746826.jpg,98703003.jpg,97863770.jpg,48574829.jpg,74517823.jpg', 'description  HD LED interactive', '$250', '2019-03-23 07:52:42', 'jappan', '', '1', 0, 1, 15, 23);

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
(1, 'Arabic', 1),
(2, 'English', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
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

INSERT INTO `users` (`userID`, `userName`, `password`, `phone`, `Email`, `FullName`, `GroupID`, `trustStatus`, `Regstatus`, `date_Registred`, `ImageUser`) VALUES
(13, 'root', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '+213797141904', 'bilalBatna@gmail.com', 'bilal saidi  1996', 1, 0, 1, '2018-11-21 23:08:04', '13870239.jpg'),
(23, 'bilal', '86fb83ba06c10aad90c9a6860310e46120c26768', '0668815130', 'b.saidi@esi-sba.dz', 'mohammed Ali ', 0, 0, 1, '2019-03-23 07:36:02', '78475952.jpg'),
(24, 'obida', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '797141904', 'o.saidi@gmail.com', 'obida saidi ', 0, 0, 1, '2019-03-24 14:03:59', '52847290.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
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
