-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 17 Janvier 2019 à 21:46
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ecole`
--

-- --------------------------------------------------------

--
-- Structure de la table `absences`
--

CREATE TABLE `absences` (
  `absJustifiees` varchar(20) NOT NULL,
  `absNonJustifiees` varchar(15) NOT NULL,
  `semestre` varchar(15) NOT NULL,
  `eleve` varchar(8) NOT NULL,
  `anneeScolaire` int(11) NOT NULL,
  `ecole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `anneescolaire`
--

CREATE TABLE `anneescolaire` (
  `idAnneeScolaire` int(11) NOT NULL,
  `anneeScolaire` varchar(11) NOT NULL,
  `ecole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `avoirmatiere`
--

CREATE TABLE `avoirmatiere` (
  `matiere` varchar(20) NOT NULL,
  `niveau` varchar(15) NOT NULL,
  `serie` varchar(15) NOT NULL,
  `coef` int(1) NOT NULL,
  `ecole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `nom` varchar(7) NOT NULL,
  `niveau` varchar(15) DEFAULT NULL,
  `serie` varchar(15) DEFAULT NULL,
  `nombreEleves` int(11) NOT NULL,
  `anneeScolaire` varchar(11) NOT NULL,
  `ecole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ecole`
--

CREATE TABLE `ecole` (
  `idEcole` int(11) NOT NULL,
  `nomEcole` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefax` varchar(14) DEFAULT NULL,
  `telephone1` varchar(18) NOT NULL,
  `telephone2` varchar(18) DEFAULT NULL,
  `BP` int(8) DEFAULT NULL,
  `commune` varchar(20) NOT NULL,
  `nomInspection` varchar(65) NOT NULL,
  `idInspection` int(11) DEFAULT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmation_at` datetime DEFAULT NULL,
  `reset_token` varchar(60) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `avatar` varchar(220) DEFAULT NULL,
  `remember_token` varchar(250) DEFAULT NULL,
  `statut` varchar(6) NOT NULL DEFAULT 'Ecole'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `matricule` varchar(8) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `sexe` varchar(8) DEFAULT NULL,
  `dateNaissance` date DEFAULT NULL,
  `lieuNaissance` varchar(20) DEFAULT NULL,
  `origine` varchar(30) DEFAULT NULL,
  `motifEntre` varchar(100) DEFAULT NULL,
  `numeroTel` varchar(18) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `idEcole` int(11) NOT NULL,
  `statut` varchar(12) NOT NULL DEFAULT 'REGULIER'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `enseigner`
--

CREATE TABLE `enseigner` (
  `prof` int(11) NOT NULL,
  `matiere` varchar(20) NOT NULL,
  `ecole` int(11) NOT NULL,
  `classe1` int(11) DEFAULT NULL,
  `classe2` int(11) DEFAULT NULL,
  `classe3` int(11) DEFAULT NULL,
  `classe4` int(11) DEFAULT NULL,
  `classe5` int(11) DEFAULT NULL,
  `classe6` int(11) DEFAULT NULL,
  `classe7` int(11) DEFAULT NULL,
  `classe8` int(11) DEFAULT NULL,
  `classe9` int(11) DEFAULT NULL,
  `classe10` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etreeleve`
--

CREATE TABLE `etreeleve` (
  `eleve` varchar(8) NOT NULL,
  `niveau` varchar(10) NOT NULL,
  `serie` varchar(15) NOT NULL,
  `classe` varchar(7) NOT NULL,
  `idAnneeScolaire` int(11) NOT NULL,
  `classeDoublee` varchar(3) NOT NULL,
  `ecole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `inspection`
--

CREATE TABLE `inspection` (
  `idInspection` int(11) NOT NULL,
  `nomInspection` varchar(65) NOT NULL,
  `region` varchar(20) NOT NULL,
  `departement` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Telefax` varchar(14) DEFAULT NULL,
  `telephone1` varchar(18) NOT NULL,
  `telephone2` varchar(18) DEFAULT NULL,
  `BP` int(8) DEFAULT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmation_at` datetime DEFAULT NULL,
  `reset_token` varchar(60) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `avatar` varchar(220) DEFAULT NULL,
  `remember_token` varchar(250) DEFAULT NULL,
  `statut` varchar(11) NOT NULL DEFAULT 'Inspection'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `inspection`
--

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `nom` varchar(20) NOT NULL,
  `ecole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `niveau` varchar(15) NOT NULL,
  `ecole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `nomSemestre` varchar(10) NOT NULL,
  `noteDevoir` decimal(4,2) DEFAULT NULL,
  `noteComposition` decimal(4,2) DEFAULT NULL,
  `moyenne` decimal(4,2) DEFAULT NULL,
  `coef` int(11) DEFAULT NULL,
  `moyenneX` decimal(5,2) DEFAULT NULL,
  `appreciation` varchar(15) DEFAULT NULL,
  `rang` varchar(10) DEFAULT NULL,
  `eleve` varchar(8) NOT NULL,
  `matiere` varchar(20) NOT NULL DEFAULT '',
  `niveau` varchar(15) NOT NULL,
  `serie` varchar(15) NOT NULL,
  `classe` varchar(7) DEFAULT NULL,
  `idAnneeScolaire` int(11) NOT NULL,
  `anneeScolaire` varchar(11) NOT NULL,
  `ecole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `notesemestre`
--

CREATE TABLE `notesemestre` (
  `nomSemestre` varchar(10) NOT NULL,
  `sumMoyX` decimal(5,2) DEFAULT NULL,
  `sumCoef` int(2) DEFAULT NULL,
  `moyGenerale` decimal(4,2) DEFAULT NULL,
  `appreciation` varchar(15) DEFAULT NULL,
  `rang` int(2) DEFAULT NULL,
  `eleve` varchar(8) NOT NULL,
  `classe` varchar(7) NOT NULL,
  `idAnneeScolaire` int(11) NOT NULL,
  `ecole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


--
-- Structure de la table `notesemestreAn`
--

CREATE TABLE `notesemestreAn` (
  `eleve` varchar(8) NOT NULL,
  `classe` varchar(7) DEFAULT NULL,
  `anneeScolaire` int(11) DEFAULT NULL,
  `ecole` int(11) DEFAULT NULL,
  `moyS1` decimal(4,2) DEFAULT NULL,
  `moyS2` decimal(4,2) DEFAULT NULL,
  `moyAn` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `identifiant` int(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(55) NOT NULL,
  `sexe` varchar(8) NOT NULL,
  `statut` varchar(100) NOT NULL,
  `telephone` varchar(18) NOT NULL,
  `email` varchar(100) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `idEcole` int(11) NOT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmation_at` datetime DEFAULT NULL,
  `reset_token` varchar(60) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `avatar` varchar(220) DEFAULT NULL,
  `remember_token` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

CREATE TABLE `serie` (
  `serie` varchar(15) NOT NULL,
  `ecole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`eleve`,`anneeScolaire`,`ecole`),
  ADD KEY `fk4_eleve` (`eleve`),
  ADD KEY `fk4_ecole` (`ecole`);

--
-- Index pour la table `anneescolaire`
--
ALTER TABLE `anneescolaire`
  ADD PRIMARY KEY (`idAnneeScolaire`),
  ADD KEY `fk5_ecole` (`ecole`);

--
-- Index pour la table `avoirmatiere`
--
ALTER TABLE `avoirmatiere`
  ADD PRIMARY KEY (`matiere`,`niveau`,`serie`,`ecole`),
  ADD KEY `fk2_matiere` (`matiere`),
  ADD KEY `fk2_niveau` (`niveau`),
  ADD KEY `fk2_serie` (`serie`),
  ADD KEY `fk2_ecole` (`ecole`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`nom`,`anneeScolaire`,`ecole`),
  ADD KEY `fk_niveau` (`niveau`),
  ADD KEY `fk_serie` (`serie`),
  ADD KEY `fk_ecole` (`ecole`);

--
-- Index pour la table `ecole`
--
ALTER TABLE `ecole`
  ADD PRIMARY KEY (`idEcole`),
  ADD KEY `fk_inspection` (`idInspection`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`matricule`,`idEcole`),
  ADD KEY `fk1_ecole` (`idEcole`);

--
-- Index pour la table `enseigner`
--
ALTER TABLE `enseigner`
  ADD PRIMARY KEY (`prof`,`matiere`,`ecole`),
  ADD KEY `fk_personnel` (`prof`),
  ADD KEY `fk_matiere` (`matiere`),
  ADD KEY `fk6_ecole` (`ecole`);

--
-- Index pour la table `etreeleve`
--
ALTER TABLE `etreeleve`
  ADD PRIMARY KEY (`eleve`,`niveau`,`classeDoublee`,`ecole`),
  ADD KEY `fk3_eleve` (`eleve`),
  ADD KEY `fk3_classe` (`classe`),
  ADD KEY `fk3_niveau` (`niveau`),
  ADD KEY `fk3_serie` (`serie`),
  ADD KEY `fk3_anneeScolaire` (`idAnneeScolaire`),
  ADD KEY `fk3_ecole` (`ecole`);

--
-- Index pour la table `inspection`
--
ALTER TABLE `inspection`
  ADD PRIMARY KEY (`idInspection`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`nom`,`ecole`),
  ADD KEY `fk7_ecole` (`ecole`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`niveau`,`ecole`),
  ADD KEY `fk8_ecole` (`ecole`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`nomSemestre`,`eleve`,`matiere`,`idAnneeScolaire`,`ecole`),
  ADD KEY `fk1_eleve` (`eleve`),
  ADD KEY `fk1_matiere` (`matiere`),
  ADD KEY `fk1_classe` (`classe`),
  ADD KEY `fk1_anneeScolaire` (`idAnneeScolaire`),
  ADD KEY `fk1_niveau` (`niveau`),
  ADD KEY `fk1_serie` (`serie`),
  ADD KEY `fk10_ecole` (`ecole`);

--
-- Index pour la table `notesemestre`
--
ALTER TABLE `notesemestre`
  ADD PRIMARY KEY (`nomSemestre`,`eleve`,`classe`,`idAnneeScolaire`,`ecole`),
  ADD KEY `fk_eleve` (`eleve`),
  ADD KEY `fk_classe` (`classe`),
  ADD KEY `fk_anneeScolaire` (`idAnneeScolaire`),
  ADD KEY `fk9_ecole` (`ecole`);

-- Index pour la table `notesemestreAn`
--
ALTER TABLE `notesemestreAn`
  ADD PRIMARY KEY (`eleve`,`classe`,`anneeScolaire`,`ecole`),
  ADD KEY `fk_eleveAn` (`eleve`),
  ADD KEY `fk_classeAn` (`classe`),
  ADD KEY `fk_anneeScolaireAn` (`anneeScolaire`),
  ADD KEY `fk_ecoleAn` (`ecole`);

--
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`identifiant`),
  ADD KEY `fk11_ecole` (`idEcole`);

--
-- Index pour la table `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`serie`,`ecole`),
  ADD KEY `fk12_ecole` (`ecole`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `anneescolaire`
--
ALTER TABLE `anneescolaire`
  MODIFY `idAnneeScolaire` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ecole`
--
ALTER TABLE `ecole`
  MODIFY `idEcole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `inspection`
--
ALTER TABLE `inspection`
  MODIFY `idInspection` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `identifiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `absences`
--
ALTER TABLE `absences`
  ADD CONSTRAINT `fk4_ecole` FOREIGN KEY (`ecole`) REFERENCES `ecole` (`idEcole`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk4_eleve` FOREIGN KEY (`eleve`) REFERENCES `eleve` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `anneescolaire`
--
ALTER TABLE `anneescolaire`
  ADD CONSTRAINT `fk5_ecole` FOREIGN KEY (`ecole`) REFERENCES `ecole` (`idEcole`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `avoirmatiere`
--
ALTER TABLE `avoirmatiere`
  ADD CONSTRAINT `fk2_ecole` FOREIGN KEY (`ecole`) REFERENCES `ecole` (`idEcole`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2_matiere` FOREIGN KEY (`matiere`) REFERENCES `matiere` (`nom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2_niveau` FOREIGN KEY (`niveau`) REFERENCES `niveau` (`niveau`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2_serie` FOREIGN KEY (`serie`) REFERENCES `serie` (`serie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `fk_ecole` FOREIGN KEY (`ecole`) REFERENCES `ecole` (`idEcole`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_niveau` FOREIGN KEY (`niveau`) REFERENCES `niveau` (`niveau`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_serie` FOREIGN KEY (`serie`) REFERENCES `serie` (`serie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ecole`
--
ALTER TABLE `ecole`
  ADD CONSTRAINT `fk_inspection` FOREIGN KEY (`idInspection`) REFERENCES `inspection` (`idInspection`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `fk1_ecole` FOREIGN KEY (`idEcole`) REFERENCES `ecole` (`idEcole`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `enseigner`
--
ALTER TABLE `enseigner`
  ADD CONSTRAINT `fk6_ecole` FOREIGN KEY (`ecole`) REFERENCES `ecole` (`idEcole`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matiere` FOREIGN KEY (`matiere`) REFERENCES `matiere` (`nom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_personnel` FOREIGN KEY (`prof`) REFERENCES `personnel` (`identifiant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etreeleve`
--
ALTER TABLE `etreeleve`
  ADD CONSTRAINT `fk3_anneeScolaire` FOREIGN KEY (`idAnneeScolaire`) REFERENCES `anneescolaire` (`idAnneeScolaire`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk3_classe` FOREIGN KEY (`classe`) REFERENCES `classe` (`nom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk3_ecole` FOREIGN KEY (`ecole`) REFERENCES `ecole` (`idEcole`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk3_eleve` FOREIGN KEY (`eleve`) REFERENCES `eleve` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk3_niveau` FOREIGN KEY (`niveau`) REFERENCES `niveau` (`niveau`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk3_serie` FOREIGN KEY (`serie`) REFERENCES `serie` (`serie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `fk7_ecole` FOREIGN KEY (`ecole`) REFERENCES `ecole` (`idEcole`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD CONSTRAINT `fk8_ecole` FOREIGN KEY (`ecole`) REFERENCES `ecole` (`idEcole`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `fk10_ecole` FOREIGN KEY (`ecole`) REFERENCES `ecole` (`idEcole`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk1_anneeScolaire` FOREIGN KEY (`idAnneeScolaire`) REFERENCES `anneescolaire` (`idAnneeScolaire`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk1_classe` FOREIGN KEY (`classe`) REFERENCES `classe` (`nom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk1_eleve` FOREIGN KEY (`eleve`) REFERENCES `eleve` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk1_matiere` FOREIGN KEY (`matiere`) REFERENCES `matiere` (`nom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk1_niveau` FOREIGN KEY (`niveau`) REFERENCES `niveau` (`niveau`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk1_serie` FOREIGN KEY (`serie`) REFERENCES `serie` (`serie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notesemestre`
--
ALTER TABLE `notesemestre`
  ADD CONSTRAINT `fk9_ecole` FOREIGN KEY (`ecole`) REFERENCES `ecole` (`idEcole`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_anneeScolaire` FOREIGN KEY (`idAnneeScolaire`) REFERENCES `anneescolaire` (`idAnneeScolaire`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_classe` FOREIGN KEY (`classe`) REFERENCES `classe` (`nom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_eleve` FOREIGN KEY (`eleve`) REFERENCES `eleve` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notesemestre`
--
ALTER TABLE `notesemestreAn`
  ADD CONSTRAINT `fk_ecoleAn` FOREIGN KEY (`ecole`) REFERENCES `ecole` (`idEcole`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_anneeScolaireAn` FOREIGN KEY (`anneeScolaire`) REFERENCES `anneescolaire` (`idAnneeScolaire`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_classeAn` FOREIGN KEY (`classe`) REFERENCES `classe` (`nom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_eleveAn` FOREIGN KEY (`eleve`) REFERENCES `eleve` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `fk11_ecole` FOREIGN KEY (`idEcole`) REFERENCES `ecole` (`idEcole`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `serie`
--
ALTER TABLE `serie`
  ADD CONSTRAINT `fk12_ecole` FOREIGN KEY (`ecole`) REFERENCES `ecole` (`idEcole`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
