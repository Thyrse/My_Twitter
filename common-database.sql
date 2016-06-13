-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 25 Janvier 2016 à 12:42
-- Version du serveur :  5.5.46-0+deb8u1
-- Version de PHP :  5.6.14-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `common-database`
--
CREATE DATABASE IF NOT EXISTS `common-database` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `common-database`;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id_message` int(11) NOT NULL,
  `id_emitter` int(11) NOT NULL,
  `id_recipient` int(11) NOT NULL,
  `content` text NOT NULL,
  `medias` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `retweets`
--

CREATE TABLE IF NOT EXISTS `retweets` (
`id_retweet` int(11) NOT NULL,
  `id_tweet` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `comment` text NOT NULL,
  `hashtags` text NOT NULL,
  `user_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tweets`
--

CREATE TABLE IF NOT EXISTS `tweets` (
`id_tweet` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `localisation` text NOT NULL,
  `status` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  `hashtags` text NOT NULL,
  `medias` text NOT NULL,
  `user_link` int(11) NOT NULL,
  `likes` text NOT NULL,
  `is_reply` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `registration_token` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `registration_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `theme` text NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `localisation` varchar(255) NOT NULL,
  `biographie` text NOT NULL,
  `website` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `banniere` text NOT NULL,
  `token_cookie` varchar(255) NOT NULL,
  `follows` text NOT NULL,
  `followers` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `retweets`
--
ALTER TABLE `retweets`
 ADD PRIMARY KEY (`id_retweet`);

--
-- Index pour la table `tweets`
--
ALTER TABLE `tweets`
 ADD PRIMARY KEY (`id_tweet`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `retweets`
--
ALTER TABLE `retweets`
MODIFY `id_retweet` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tweets`
--
ALTER TABLE `tweets`
MODIFY `id_tweet` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
