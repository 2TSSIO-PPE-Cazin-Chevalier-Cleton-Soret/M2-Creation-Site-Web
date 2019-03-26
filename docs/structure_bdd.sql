-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 26 Mars 2019 à 21:08
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
(8, 'Bonne', 20, 'Oui', 'Oui', '12h, 19h', 'Carotte', '10h 12h, 11h 12h', 'Heureux', 'Foot', '10h 12h', 'Il a etait sage', '2019-03-26 00:00:00', 16),
(9, 'Malade', 20, 'Oui', 'Oui', '12h, 19h', 'Carotte', '10h 12h, 11h 12h', 'Heureux', 'Foot', '10h 12h', 'Il a bruler l\'ecole', '2019-03-26 00:00:00', 25),
(10, 'Mort', 20, 'Oui', 'Oui', '12h, 19h', 'Carotte', '10h 12h, 11h 12h', 'Heureux', 'Foot', '10h 12h', 'Test', '2019-03-26 00:00:00', 37),
(11, 'Bonne', 20, 'Oui', 'Oui', '12h, 19h', 'Carotte', '10h 12h, 11h 12h', 'Heureux', 'Foot', '10h 12h', 'Il a etait sage', '2019-03-26 00:00:00', 38),
(12, 'Pas mal', 20, 'Oui', 'Oui', '12h, 19h', 'Carotte, kodsfkosd,fk, fdsfsd', '10h 12h, 11h 12h', 'Heureux', 'Foot', '10h 12h', 'Il a etait sage', '2019-03-26 00:00:00', 39);

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
(16, 'Cazin', 'Guillaume', 10, 44, 45),
(17, 'Evrard', 'Steven', 12, 56, 45),
(21, 'Dupont', 'Jean', 20, 48, 46),
(22, 'Doe', 'John', 30, 48, 46),
(25, 'Test', 'Test', 10, 44, 45),
(35, 'Cazin', 'Guillaume', 20, 56, 45),
(37, 'Test2', 'test2', 12, 44, 45),
(38, 'Cazin', 'Guillaume', 20, 73, 46),
(39, 'Cazin', 'Stecy', 24, 73, 46);

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
(42, 'Guillaume', '$2y$10$B6Iv.UEcOZPL4SOkzZutB.nkmpYTqVHSFXBUpGx5S4PKFqZ7K1qza', 'Cazin', 'Guillaume', 62200, 'Boulogne-sur-Mer', 'France', 'czn.guillaume@gmail.com', '1', 'parent', 0),
(44, 'Parent', '$2y$10$1zlbA6VeISbsRzR1tSjEqeyl.7mRntvSoFpgIu//.41APSAUDmzN.', 'Parent', 'Parent', 62200, 'Boulogne', 'France', 'czn.guillaume@yahoo.fr', '3', 'parent', 45),
(45, 'Assistante', '$2y$10$vqWyWf02aJz.Cmq4jX9v3.Uq8vfyfuAevO7TkJP8VRNyolM44BTFK', 'Assistante', 'Assistante', 62200, 'Boulogne', 'France', 'czn.guillaume@yahoo.fr', '', 'assistante', 0),
(46, 'Assistante-2', '$2y$10$48F4VF/G0fgjgpDPF9t.7O.94yWrsaYa/6npKJTQCytec6UPp40gW', 'Assistante-2', 'Assistante-2', 62200, 'BOULOGNE SUR MER', 'France', 'czn.guillaume@gmail.com', '', 'assistante', NULL),
(48, 'Parent-2', '$2y$10$K9kZiw2iD8ysbqtKUdvxs.9cjNvrUIsUAdd1XlPKzuCADfHn5Zky.', 'Cazin', 'Guillaume', 62200, 'Boulogne sur mer', 'France', 'czn.guillaume@gmail.com', '2', 'parent', 45),
(56, 'Parent-3', '$2y$10$Q24K0WFSQw42UMFfY5XvD.wQMh6rkmLiEjqf0aBqlOm/H8iuCgQzG', 'Cazin', 'Guillaume', 62200, 'BOULOGNE SUR MER', 'France', 'czn.guillaume@gmail.com', '2', 'parent', 45),
(69, 'Parent-4', '$2y$10$3qVTBZEex3GHfbdvqRR28uRPUd5/Nsb7W334PuwGc.TkGBP/zpgs6', 'Cazin', 'Guillaume', 62200, 'BOULOGNE SUR MER', 'France', 'czn.guillaume@gmail.com', '1', 'parent', 45),
(73, 'Sophie', '$2y$10$u/O7yOip.tiS1TLNuiKXC.MlIptfmXVwTU2/BD8zVcxymocIMg0t6', 'Joan', 'Sophie', 62200, 'Boulogne Sur Mer', 'France', 'boudechou1014@gmail.com', '2', 'parent', 46);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `enfants`
--
ALTER TABLE `enfants`
  MODIFY `idEnfant` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
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
