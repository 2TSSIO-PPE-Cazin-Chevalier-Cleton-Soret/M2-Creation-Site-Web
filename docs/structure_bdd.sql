-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 27 Mars 2019 à 12:35
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ram`
--

-- --------------------------------------------------------

--
-- Structure de la table `calendrier`
--

CREATE TABLE `calendrier` (
  `id` int(11) NOT NULL,
  `sante` varchar(255) NOT NULL,
  `temperature` double NOT NULL,
  `pleurs` varchar(255) NOT NULL,
  `besoins` varchar(255) NOT NULL,
  `repas` varchar(255) NOT NULL,
  `aliments` varchar(255) NOT NULL,
  `dodo` varchar(255) NOT NULL,
  `humeur` varchar(255) NOT NULL,
  `activite` varchar(255) NOT NULL,
  `promenade` varchar(255) NOT NULL,
  `remarques` longtext,
  `date` datetime NOT NULL,
  `idEnfant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `calendrier`
--

INSERT INTO `calendrier` (`id`, `sante`, `temperature`, `pleurs`, `besoins`, `repas`, `aliments`, `dodo`, `humeur`, `activite`, `promenade`, `remarques`, `date`, `idEnfant`) VALUES
(16, 'Bonne', 37, 'Oui', 'Oui', '10h 12h 14h 16h', 'Carotte', '14h', 'Heureux', 'Foot', '10h 12h', 'Il a etait sage', '2019-03-27 00:00:00', 41),
(17, 'Bonne', 37, 'Oui', 'Oui', '12h, 19h', 'Carotte', '10h 12h, 11h 12h', 'Heureux', 'Rugby', '10h 12h', 'Il a etait sage', '2019-03-27 00:00:00', 42),
(18, 'Bonne', 37, 'Oui', 'Oui', '12h, 19h', 'Carotte', '10h 12h, 11h 12h', 'Heureux', 'Badminton', '10h 12h', 'Il a travaille', '2019-03-27 00:00:00', 43),
(19, 'Bonne', 37, 'Oui', 'Oui', '12h, 19h', 'Carotte', '10h 12h, 11h 12h', 'Heureux', 'Basket', '10h 12h', 'Il a etait sage', '2019-03-27 00:00:00', 44);

-- --------------------------------------------------------

--
-- Structure de la table `enfants`
--

CREATE TABLE `enfants` (
  `idEnfant` int(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `age` int(255) NOT NULL,
  `idParent` int(255) NOT NULL,
  `idNounou` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `enfants`
--

INSERT INTO `enfants` (`idEnfant`, `nom`, `prenom`, `age`, `idParent`, `idNounou`) VALUES
(41, 'Cazin', 'Guillaume', 20, 1, 3),
(42, 'Cleton', 'Benjamin', 22, 2, 4),
(43, 'Chevalier', 'Theo', 20, 2, 4),
(44, 'Soret', 'Florent', 23, 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `cp` int(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nbrEnfant` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `choix_nounou` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `mdp`, `nom`, `prenom`, `cp`, `ville`, `pays`, `email`, `nbrEnfant`, `type`, `choix_nounou`) VALUES
(1, 'Parent', '$2y$10$B6Iv.UEcOZPL4SOkzZutB.nkmpYTqVHSFXBUpGx5S4PKFqZ7K1qza', 'Cazin', 'Guillaume', 62200, 'Boulogne-sur-Mer', 'France', 'czn.guillaume@gmail.com', '1', 'parent', 3),
(2, 'Parent-2', '$2y$10$1zlbA6VeISbsRzR1tSjEqeyl.7mRntvSoFpgIu//.41APSAUDmzN.', 'Parent', 'Parent', 62200, 'Boulogne', 'France', 'czn.guillaume@yahoo.fr', '3', 'parent', 4),
(3, 'Assistante', '$2y$10$vqWyWf02aJz.Cmq4jX9v3.Uq8vfyfuAevO7TkJP8VRNyolM44BTFK', 'Assistante', 'Assistante', 62200, 'Boulogne', 'France', 'czn.guillaume@yahoo.fr', '', 'assistante', 0),
(4, 'Assistante-2', '$2y$10$48F4VF/G0fgjgpDPF9t.7O.94yWrsaYa/6npKJTQCytec6UPp40gW', 'Assistante-2', 'Assistante-2', 62200, 'BOULOGNE SUR MER', 'France', 'czn.guillaume@gmail.com', '', 'assistante', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idEnfant` (`idEnfant`);

--
-- Index pour la table `enfants`
--
ALTER TABLE `enfants`
  ADD PRIMARY KEY (`idEnfant`,`idNounou`),
  ADD KEY `enfantNounou` (`idNounou`),
  ADD KEY `idParent` (`idParent`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `calendrier`
--
ALTER TABLE `calendrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `enfants`
--
ALTER TABLE `enfants`
  MODIFY `idEnfant` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `calendrier`
--
ALTER TABLE `calendrier`
  ADD CONSTRAINT `calendrier_ibfk_1` FOREIGN KEY (`idEnfant`) REFERENCES `enfants` (`idEnfant`);

--
-- Contraintes pour la table `enfants`
--
ALTER TABLE `enfants`
  ADD CONSTRAINT `enfantNounou` FOREIGN KEY (`idNounou`) REFERENCES `membres` (`id`),
  ADD CONSTRAINT `enfants_ibfk_1` FOREIGN KEY (`idParent`) REFERENCES `membres` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
