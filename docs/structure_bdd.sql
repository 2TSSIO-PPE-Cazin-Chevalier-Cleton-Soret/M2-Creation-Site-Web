-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 26 Avril 2019 à 12:29
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

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ajouterCalendrier` (IN `sante` VARCHAR(255), IN `temperature` INT(11), IN `pleurs` VARCHAR(255), IN `besoins` VARCHAR(255), IN `repas` VARCHAR(255), IN `alimentation` VARCHAR(255), IN `dodo` VARCHAR(255), IN `humeur` VARCHAR(255), IN `activite` VARCHAR(255), IN `promenade` VARCHAR(255), IN `remarques` VARCHAR(255), IN `date` INT(11), IN `idEnfant` INT(11))  NO SQL
INSERT INTO calendrier(sante, temperature, pleurs, besoins, repas, aliments, dodo, humeur, activite, promenade, remarques, date, idEnfant) VALUES (sante, temperature, pleurs, besoins, repas, aliments, dodo, humeur, activite, promenade, remarques, date, idEnfant)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ajouterEnfant` (IN `nom` VARCHAR(255), IN `prenom` VARCHAR(255), IN `age` INT(11), IN `idParent` INT(11), IN `idNounou` INT(11))  NO SQL
INSERT INTO enfants(nom, prenom, age, idParent, idNounou) 
VALUES (nom, prenom, age, idParent, idNounou)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `calendrierRempliOuNon` (IN `enfant` INT(11))  NO SQL
SELECT COUNT(*) 
FROM calendrier
WHERE idEnfant = enfant
AND date = CURDATE()$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inscriptionUtilisateur` (IN `pseudo` VARCHAR(255), IN `mdp` VARCHAR(255), IN `nom` VARCHAR(255), IN `prenom` VARCHAR(255), IN `cp` INT(11), IN `ville` VARCHAR(255), IN `pays` VARCHAR(255), IN `email` VARCHAR(255), IN `nbrEnfant` INT(11), IN `type` VARCHAR(255), IN `choix_nounou` INT(11))  NO SQL
INSERT INTO membres(pseudo, mdp, nom, prenom, cp, ville, pays, email, nbrEnfant, type, choix_nounou) VALUES(pseudo, mdp, nom, prenom, cp, ville, pays, email, nbrEnfant, type, choix_nounou)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recupererEnfant` (`idSession` INT)  SELECT *
FROM calendrier AS c
INNER JOIN enfants AS e on c.idEnfant = e.idEnfant
WHERE idParent = idSession AND date = CURDATE()$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recupererInformationsUtilisateur` (IN `idSession` INT(11))  NO SQL
SELECT * 
FROM membres 
WHERE id = idSession$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recupererNombreEnfantDeLUtilisateur` (IN `idSession` INT(11))  NO SQL
SELECT COUNT(*) 
FROM enfants 
WHERE idParent = idSession$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `recupererUtilisateur` (IN `pseudoVoulu` VARCHAR(255))  NO SQL
SELECT id, pseudo, mdp, choix_nounou
FROM membres
WHERE pseudo = pseudoVoulu$$

DELIMITER ;

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
(17, 'Bonne', 37, 'Oui', 'Oui', '12h, 19h', 'Carotte', '10h 12h, 11h 12h', 'Heureux', 'Rugby', '10h 12h', 'Il a etait sage', '2019-03-27 00:00:00', 42),
(18, 'Bonne', 37, 'Oui', 'Oui', '12h, 19h', 'Carotte', '10h 12h, 11h 12h', 'Heureux', 'Badminton', '10h 12h', 'Il a travaille', '2019-03-27 00:00:00', 43),
(19, 'Bonne', 37, 'Oui', 'Oui', '12h, 19h', 'Carotte', '10h 12h, 11h 12h', 'Heureux', 'Basket', '10h 12h', 'Il a etait sage', '2019-03-27 00:00:00', 44),
(23, 'Bonne', 37, 'Oui', 'Oui', '12h, 19h', '', '10h 12h, 11h 12h', 'Heureux', 'Foot', '10h 12h', 'Il a etait sage', '2019-03-27 00:00:00', 41);

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
  `idNounou` int(255) NOT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `infoComplementaires` longtext,
  `dateInscription` date DEFAULT NULL,
  `dateFinInscription` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `enfants`
--

INSERT INTO `enfants` (`idEnfant`, `nom`, `prenom`, `age`, `idParent`, `idNounou`, `statut`, `infoComplementaires`, `dateInscription`, `dateFinInscription`) VALUES
(41, 'Cazin', 'Guillaume', 20, 1, 3, NULL, NULL, NULL, NULL),
(42, 'Cleton', 'Benjamin', 22, 2, 4, NULL, NULL, NULL, NULL),
(43, 'Chevalier', 'Theo', 20, 2, 4, NULL, NULL, NULL, NULL),
(44, 'Soret', 'Florent', 23, 2, 4, NULL, NULL, NULL, NULL);

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
(1, 'Parent', '$2y$10$S1miluTi.e8aTGnXNvGZNeYQfIaC5oAUwOGBafV/HRmxq1tpMTzQa', 'Cazin', 'Guillaume', 62200, 'Boulogne-sur-Mer', 'France', 'czn.guillaume@gmail.com', '1', 'parent', 3),
(2, 'Parent-2', '$2y$10$mNamhXoPrOTsA909DliuoOpTIgE6GfGrwMuO3Jg2akjv9IcDeDHvS\n', 'Parent', 'Parent', 62200, 'Boulogne', 'France', 'czn.guillaume@yahoo.fr', '3', 'parent', 4),
(3, 'Assistante', '$2y$10$DPIms/xONoMZH4oVcSACLurw19GvAulQ6DSjHJ44T42bSjHEIwRDS', 'Assistante', 'Assistante', 62200, 'Boulogne', 'France', 'czn.guillaume@yahoo.fr', '', 'assistante', 0),
(4, 'Assistante-2', '$2y$10$jZWkfiSzQogzEgTd0yILMujnCjrKBFej7YE0tkMjCtNYVa4Aerqm.', 'Assistante-2', 'Assistante-2', 62200, 'BOULOGNE SUR MER', 'France', 'czn.guillaume@gmail.com', '', 'assistante', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `enfants`
--
ALTER TABLE `enfants`
  MODIFY `idEnfant` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
