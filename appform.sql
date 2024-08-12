-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 12 août 2024 à 11:15
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `appform`
--

-- --------------------------------------------------------

--
-- Structure de la table `form`
--

CREATE TABLE `form` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `form`
--

INSERT INTO `form` (`id`, `title`, `description`) VALUES
(14, 'test math', 'un test de math'),
(26, 'date test', 'test date');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `questiontext` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `idform` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `questiontext`, `type`, `idform`) VALUES
(18, '1+1 = ', 'radio', 14),
(19, '5545 / 5 = ', 'input', 14),
(20, '22 * 885', 'radio', 14),
(42, '', 'date', 26);

-- --------------------------------------------------------

--
-- Structure de la table `radiooption`
--

CREATE TABLE `radiooption` (
  `id` int(11) NOT NULL,
  `optiontext` varchar(255) NOT NULL,
  `idquestion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `radiooption`
--

INSERT INTO `radiooption` (`id`, `optiontext`, `idquestion`) VALUES
(21, '1', 18),
(22, '11', 18),
(23, '20', 18),
(24, '445', 20),
(25, '21151', 20),
(26, '4444', 20);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `idform` int(11) NOT NULL,
  `datereponse` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `idform`, `datereponse`) VALUES
(8, 14, '2024-08-09 16:53:14'),
(9, 14, '2024-08-09 16:53:33'),
(10, 14, '2024-08-11 14:50:05'),
(11, 14, '2024-08-11 14:57:29'),
(13, 14, '2024-08-11 19:45:43'),
(14, 26, '2024-08-11 19:46:47'),
(15, 14, '2024-08-11 19:59:18'),
(16, 14, '2024-08-12 09:52:47');

-- --------------------------------------------------------

--
-- Structure de la table `reponsequestion`
--

CREATE TABLE `reponsequestion` (
  `id` int(11) NOT NULL,
  `idquestion` int(11) NOT NULL,
  `idreponse` int(11) NOT NULL,
  `reponsetext` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reponsequestion`
--

INSERT INTO `reponsequestion` (`id`, `idquestion`, `idreponse`, `reponsetext`) VALUES
(16, 18, 8, '20'),
(17, 19, 8, '400'),
(18, 20, 8, '4444'),
(19, 18, 9, '20'),
(20, 19, 9, '400'),
(21, 20, 9, '4444'),
(22, 18, 10, '1'),
(23, 19, 10, '100'),
(24, 20, 10, '445'),
(25, 18, 11, '20'),
(26, 19, 11, '1'),
(27, 20, 11, '21151'),
(31, 18, 13, '20'),
(32, 19, 13, '10'),
(33, 20, 13, '21151'),
(34, 42, 14, '2024-08-13T23:00:00.000Z'),
(35, 18, 15, '20'),
(36, 19, 15, 'dd'),
(37, 20, 15, '21151'),
(38, 18, 16, '11'),
(39, 19, 16, '555'),
(40, 20, 16, '21151');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'omarmarrakchi@gmail.com', 'omar@123');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idform` (`idform`);

--
-- Index pour la table `radiooption`
--
ALTER TABLE `radiooption`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idquestion` (`idquestion`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idform` (`idform`);

--
-- Index pour la table `reponsequestion`
--
ALTER TABLE `reponsequestion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idreponse` (`idreponse`),
  ADD KEY `idquestion` (`idquestion`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `radiooption`
--
ALTER TABLE `radiooption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `reponsequestion`
--
ALTER TABLE `reponsequestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`idform`) REFERENCES `form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `radiooption`
--
ALTER TABLE `radiooption`
  ADD CONSTRAINT `radiooption_ibfk_1` FOREIGN KEY (`idquestion`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`idform`) REFERENCES `form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponsequestion`
--
ALTER TABLE `reponsequestion`
  ADD CONSTRAINT `reponsequestion_ibfk_1` FOREIGN KEY (`idquestion`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reponsequestion_ibfk_2` FOREIGN KEY (`idreponse`) REFERENCES `reponse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
