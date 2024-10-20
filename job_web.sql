-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 19 oct. 2024 à 10:39
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `job_web`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `id_annonce` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(500) NOT NULL,
  `temps` date NOT NULL,
  `paye` int NOT NULL,
  `endroit` varchar(500) NOT NULL,
  `entreprise_id` int NOT NULL,
  `id_contrat` int DEFAULT NULL,
  `description` varchar(1500) NOT NULL,
  PRIMARY KEY (`id_annonce`),
  KEY `entreprise_id` (`entreprise_id`),
  KEY `fk_contrat` (`id_contrat`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `annonces`
--

INSERT INTO `annonces` (`id_annonce`, `nom`, `temps`, `paye`, `endroit`, `entreprise_id`, `id_contrat`, `description`) VALUES
(13, 'Vendeuse/Vendeur', '2024-12-01', 1800, 'Marseille', 11, 3, 'Nous recherchons un(e) vendeur/vendeuse dynamique et motivé(e) pour rejoindre notre équipe en intérim. Vous serez responsable de l’accueil des clients, de la gestion des ventes et de la mise en rayon des produits.\r\n\r\nResponsabilités : Accueillir et conseiller les clients avec courtoisie et professionnalisme. Assurer la vente des produits et services de l’entreprise. Gérer les encaissements et les retours. Participer à la mise en rayon et au réassortiment des produits. Maintenir un espace de vente propre et attrayant. Contribuer à la réalisation des objectifs de vente.\r\n\r\nProfil recherché : Expérience préalable en vente ou en service à la clientèle souhaitée. Excellentes compétences en communication et en relation client. Capacité à travailler en équipe et à s’adapter rapidement. Sens de l’organisation et rigueur. Disponibilité pour travailler en horaires flexibles, y compris les week-ends.\r\n\r\nNous offrons : Une expérience enrichissante au sein d’une équipe dynamique. Une formation continue pour développer vos compétences. Une opportunité de découvrir différents aspects de la vente.'),
(15, ' Vendeur/Vendeuse Apple Store', '2024-12-01', 1600, 'Marseille', 12, 1, 'Rejoignez notre équipe dynamique au sein de l\'Apple Store en tant que vendeur/vendeuse ! Vous serez au cœur de l\'expérience client, aidant les visiteurs à découvrir les produits Apple et à trouver des solutions adaptées à leurs besoins. Responsabilités   Accueillir et conseiller les clients : Offrir un service exceptionnel en répondant aux questions et en guidant les clients dans le choix de produits et accessoires.   Démonstration des produits : Présenter les fonctionnalités et avantages des produits Apple, en utilisant des démonstrations pratiques pour susciter l\'intérêt des clients.   Atteindre les objectifs de vente individuels et collectifs tout en assurant une expérience client mémorable. Établir des relations durables avec les clients, en leur offrant un suivi personnalisé et des recommandations pertinentes. Collaborer avec les membres de l’équipe pour assurer une atmosphère de travail positive et productive.'),
(20, 'Consultant Microsoft Teams', '2024-12-01', 2100, 'Limoges', 13, 2, 'Nous recherchons un consultant Microsoft Teams pour accompagner nos clients dans l\'optimisation de leur utilisation de la plateforme. Vous serez responsable de l\'analyse des besoins, de la mise en œuvre de solutions personnalisées et de la formation des utilisateurs.  ### Responsabilités : - Évaluer les besoins des clients et proposer des solutions adaptées. - Configurer et déployer Microsoft Teams pour améliorer la collaboration. - Former les utilisateurs et fournir un support technique. - Collaborer avec les équipes internes pour assurer l\'intégration fluide des outils. ### Profil recherché : - Expérience avec Microsoft Teams et les outils Microsoft 365. - Compétences en communication et en gestion de projet. - Capacité à travailler en équipe et à résoudre des problèmes. Rejoignez-nous pour aider nos clients à tirer le meilleur parti de Microsoft Teams !'),
(26, 'Coach LOL Iron 4', '2024-10-15', 1400, 'Paris', 26, 1, 'gestion de lane, farming, proxy de waves, maitrise de 5 champions / 2 lanes /mute all trade'),
(31, 'Développeur Web FullStack', '2024-10-18', 1200, 'Montpellier', 21, 5, 'Votre mission sera de développer le site web de l\'entreprise. Votre tuteur sera M. Jean Frist (le fondateur de New StartUp). Possibilité de télétravail.'),
(34, 'Comptable', '2024-10-18', 2000, 'Angers', 27, 2, 'Nous recherchons un comptable dynamique et organisé pour rejoindre notre équipe. Le candidat idéal aura pour mission de gérer les opérations comptables quotidiennes, préparer les états financiers, assurer le suivi des budgets, et garantir la conformité avec les normes fiscales. Une attention particulière aux détails et de solides compétences en analyse financière sont essentielles. Une expérience préalable dans un environnement similaire est un atout. Une maîtrise des logiciels de comptabilité est requise.'),
(35, 'Stage Développeur(euse) d\'application', '2024-10-18', 400, 'Angers', 27, 4, 'Nous recherchons un stagiaire développeur d\'application passionné pour rejoindre notre équipe dynamique. Le candidat participera à la conception, au développement et à la maintenance d\'applications web et mobiles. Une bonne connaissance des langages de programmation tels que Java, Python ou JavaScript est souhaitée. Vous travaillerez en collaboration avec des développeurs expérimentés et contribuerez à des projets innovants. Ce stage est une excellente opportunité pour acquérir de l\'expérience pratique et développer vos compétences techniques dans un environnement stimulant.'),
(36, 'Graphiste', '2024-10-18', 1200, 'Marseille', 28, 5, 'Nous recherchons un graphiste en alternance créatif et motivé pour rejoindre notre équipe. Le candidat participera à la création de visuels pour divers supports (print et digital), collaborant avec les équipes marketing et communication. Une maîtrise des logiciels de design (Adobe Creative Suite) est essentielle, ainsi qu’un bon sens de l’esthétique et de la typographie. Ce poste offre une excellente opportunité d\'apprentissage et de développement de compétences dans un environnement professionnel dynamique.'),
(37, 'Commentateur(trice) CS:GO', '2024-10-19', 1400, 'Paris', 26, 1, 'Vous serez responsable de l\'animation et de l\'analyse des matchs en direct. Vous devrez fournir des commentaires engageants, expliquer les stratégies des équipes et capturer l\'intensité du jeu pour le public. Une bonne connaissance du jeu, des compétences en communication et une capacité à improviser sont essentielles. Vous travaillerez souvent en équipe avec d\'autres commentateurs et producteurs pour créer une expérience immersive pour les spectateurs. Passion et énergie sont de mise pour rendre chaque match mémorable !'),
(38, 'Stagiaire Fleuriste', '2024-10-19', 150, 'Grenoble', 29, 4, 'Ce stage de fleuriste offre une immersion dans le monde de la création florale. Les stagiaires apprendront les techniques de composition, la manipulation des fleurs et des plantes, ainsi que les bases de la vente et du service client. Sous la supervision d\'un fleuriste expérimenté, ils participeront à la réalisation de bouquets, d\'arrangements pour des événements et à la gestion quotidienne de la boutique. Ce stage est une excellente opportunité pour développer des compétences artistiques et pratiques dans un environnement stimulant et créatif.'),
(39, 'Responsable des Ventes', '2024-10-19', 1800, 'Nimes', 30, 2, 'Vous êtes passionné(e) par la vente et l’environnement ? Rejoignez ÉcoVrac en tant que Responsable des Ventes ! Vous serez le pilier de notre équipe, en charge de garantir une expérience client exceptionnelle. Vous développerez des stratégies de vente innovantes pour augmenter notre impact tout en formant et motivant notre équipe. Vous aurez également l\'opportunité d\'organiser des ateliers éducatifs sur le zéro déchet, faisant de notre boutique un lieu d’apprentissage et d’engagement. Rejoignez-nous pour faire la différence !'),
(40, 'Designer Produit', '2024-10-19', 1600, 'Marseille', 31, 2, 'Vous avez une passion pour le design et la technologie ? TechArtisan recherche un(e) Designer Produit créatif(ve) pour transformer des idées en objets artisanaux uniques. En utilisant des logiciels de modélisation 3D, vous concevrez des produits innovants tout en collaborant étroitement avec nos artisans. Votre rôle sera crucial pour assurer la faisabilité et l’esthétique des designs, tout en explorant de nouvelles tendances et matériaux. Si vous souhaitez allier art et technologie, cette opportunité est faite pour vous !'),
(41, 'Conseiller(ère) Client', '2024-10-19', 1400, 'Nimes', 30, 2, 'ÉcoVrac est à la recherche d\'un(e) Conseiller(ère) Clientèle passionné(e) par le zéro déchet et les produits durables. Dans ce rôle, vous serez le premier point de contact pour nos clients, offrant un service exceptionnel et des conseils avisés sur nos produits. Vous aiderez à sensibiliser les clients sur les avantages d’un mode de vie écoresponsable, tout en les guidant dans leurs choix d\'achats en vrac. En collaboration avec l’équipe, vous participerez également à l’organisation d’ateliers et d\'événements pour promouvoir nos valeurs. Si vous souhaitez contribuer à un projet engagé et inspirant, rejoignez-nous pour faire la différence au quotidien !'),
(42, 'Responsable Production', '2024-10-19', 1600, 'Marseille', 31, 1, 'TechArtisan recherche un(e) Responsable Production pour superviser la fabrication de nos objets artisanaux. Vous serez en charge de la gestion quotidienne de l\'atelier, en veillant à la qualité des produits et au respect des délais de production. Vous collaborerez étroitement avec les designers et les artisans pour assurer la mise en œuvre efficace des projets, tout en optimisant les processus de fabrication. Votre sens de l’organisation et votre capacité à résoudre des problèmes seront essentiels pour garantir un environnement de travail fluide et créatif. Si vous êtes passionné(e) par l’artisanat et la technologie, rejoignez-nous et participez à l’innovation !'),
(43, 'Community Manager', '2024-10-19', 1800, 'Marseille', 31, 3, 'TechArtisan cherche un(e) Community Manager dynamique pour renforcer notre présence en ligne et engager notre communauté. Vous serez responsable de la création et de la gestion de contenus sur nos réseaux sociaux, ainsi que de l\'interaction avec nos clients et nos abonnés. Votre mission sera de promouvoir nos produits, d\'organiser des concours et de partager les coulisses de notre atelier. Une passion pour le design et une connaissance des tendances numériques sont indispensables pour inspirer et fidéliser notre audience. Rejoignez-nous pour construire une communauté engagée autour de l\'artisanat et de l\'innovation !'),
(44, 'Animateur(trice) d\'Événements', '2024-10-19', 1500, 'Lyon', 32, 1, 'Êtes-vous un(e) passionné(e) de littérature à la recherche d\'un rôle dynamique ? Le Café Littéraire recrute un(e) Animateur(trice) d\'Événements pour créer une atmosphère chaleureuse et engageante. Vous serez responsable de la planification et de l\'organisation d\'événements littéraires variés, allant des lectures d\'auteurs aux ateliers d\'écriture. Votre créativité et vos compétences en communication seront essentielles pour attirer et interagir avec notre communauté de passionnés. Rejoignez-nous pour faire de chaque rencontre un moment inoubliable !'),
(45, 'Technicien(ne) en Énergies Vertes', '2024-10-19', 1600, 'Lyon', 33, 2, 'GreenTech Solutions recherche un(e) Technicien(ne) en Énergies Vertes pour installer et maintenir nos systèmes solaires et éoliens. Vous serez responsable de la réalisation d’audits techniques, de l’installation des équipements et de l’assistance technique auprès des clients. Une formation en énergies renouvelables est souhaitée.'),
(46, 'Chargé(e) de Projets Écologiques', '2024-10-19', 1700, 'Lyon', 33, 2, 'En tant que Chargé(e) de Projets Écologiques, vous coordonnerez des projets liés à la durabilité et à l’efficacité énergétique. Vous travaillerez en étroite collaboration avec nos partenaires pour développer des solutions innovantes. Une expérience en gestion de projet est un plus.'),
(47, 'Barista', '2024-10-19', 1600, 'Marseille', 34, 1, 'Café Bio & Co. recherche un(e) Barista passionné(e) par le café bio et le service client. Vous serez responsable de la préparation de boissons, de la gestion de la caisse et de l’accueil des clients. Une expérience en café est un plus.'),
(48, 'Responsable de Salle', '2024-10-19', 1800, 'Marseille', 34, 2, 'En tant que Responsable de Salle, vous gérerez l’équipe de service, garantissant une expérience client exceptionnelle. Vous serez en charge de la formation du personnel et de la gestion des réservations. Une expérience en restauration est requise.'),
(49, 'Coordinateur(trice) d\'Événements', '2024-10-19', 1200, 'Marseille', 34, 5, 'Café Bio & Co. recherche un(e) Coordinateur(trice) d\'Événements pour organiser des ateliers et des soirées à thème. Vous serez responsable de la planification, de la logistique et de la promotion des événements. Une créativité et un sens de l’organisation sont indispensables.'),
(50, 'Assistant(e) Commercial(e)', '2024-10-19', 1200, 'Lyon', 33, 5, 'GreenTech Solutions recherche un(e) Assistant(e) Commercial(e) pour soutenir l’équipe de vente. Vous serez en charge de la gestion des commandes, de la relation client et de la préparation de documents commerciaux. Une bonne maîtrise des outils bureautiques est requise.'),
(51, 'Guetteur', '2024-10-19', 5000, 'Marseille', 35, 2, 'Tu vas crier quand tu vas voir les condés arriver, si tu échoues et que ça se fait péter t\'es dans la sauce'),
(52, 'Tueur à gages', '2024-10-19', 15000, 'Marseille', 35, 3, 'Besoin d\'un tueur à gages en URGENCE sur ma prof de mathématiques, je suis prêt à payer le prix indiqué');

-- --------------------------------------------------------

--
-- Structure de la table `candidatures`
--

DROP TABLE IF EXISTS `candidatures`;
CREATE TABLE IF NOT EXISTS `candidatures` (
  `id_candidature` int NOT NULL AUTO_INCREMENT,
  `annonce_id` int NOT NULL,
  `candidat_id` int NOT NULL,
  `date_candidature` date NOT NULL,
  PRIMARY KEY (`id_candidature`),
  KEY `annonce_id` (`annonce_id`),
  KEY `fk_candidat_user` (`candidat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `candidatures`
--

INSERT INTO `candidatures` (`id_candidature`, `annonce_id`, `candidat_id`, `date_candidature`) VALUES
(37, 35, 18, '2024-10-18'),
(38, 20, 40, '2024-10-19'),
(39, 31, 40, '2024-10-19'),
(40, 35, 40, '2024-10-19'),
(41, 31, 18, '2024-10-19'),
(42, 20, 18, '2024-10-19'),
(43, 13, 18, '2024-10-19'),
(44, 15, 41, '2024-10-19'),
(45, 13, 41, '2024-10-19'),
(46, 31, 41, '2024-10-19'),
(47, 20, 41, '2024-10-19'),
(48, 35, 41, '2024-10-19'),
(49, 36, 41, '2024-10-19'),
(50, 47, 41, '2024-10-19'),
(51, 13, 42, '2024-10-19'),
(52, 15, 42, '2024-10-19'),
(53, 20, 42, '2024-10-19'),
(54, 31, 42, '2024-10-19'),
(55, 35, 42, '2024-10-19'),
(56, 34, 42, '2024-10-19'),
(57, 37, 42, '2024-10-19'),
(58, 45, 42, '2024-10-19'),
(59, 49, 42, '2024-10-19'),
(60, 13, 43, '2024-10-19'),
(61, 15, 43, '2024-10-19'),
(62, 20, 43, '2024-10-19'),
(63, 31, 43, '2024-10-19'),
(64, 35, 43, '2024-10-19'),
(65, 38, 43, '2024-10-19'),
(66, 40, 43, '2024-10-19'),
(67, 13, 44, '2024-10-19'),
(68, 15, 44, '2024-10-19'),
(69, 20, 44, '2024-10-19'),
(70, 31, 44, '2024-10-19'),
(71, 45, 44, '2024-10-19'),
(72, 47, 44, '2024-10-19'),
(73, 52, 44, '2024-10-19'),
(74, 13, 45, '2024-10-19'),
(75, 15, 45, '2024-10-19'),
(76, 20, 45, '2024-10-19'),
(77, 31, 45, '2024-10-19'),
(78, 26, 45, '2024-10-19'),
(79, 37, 45, '2024-10-19'),
(80, 34, 45, '2024-10-19'),
(81, 35, 45, '2024-10-19'),
(82, 36, 45, '2024-10-19'),
(83, 38, 45, '2024-10-19'),
(84, 39, 45, '2024-10-19'),
(85, 41, 45, '2024-10-19'),
(86, 40, 45, '2024-10-19'),
(87, 42, 45, '2024-10-19'),
(88, 43, 45, '2024-10-19'),
(89, 44, 45, '2024-10-19'),
(90, 45, 45, '2024-10-19'),
(91, 46, 45, '2024-10-19'),
(92, 50, 45, '2024-10-19'),
(93, 47, 45, '2024-10-19'),
(94, 48, 45, '2024-10-19'),
(95, 49, 45, '2024-10-19'),
(96, 51, 45, '2024-10-19'),
(97, 52, 45, '2024-10-19');

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

DROP TABLE IF EXISTS `entreprises`;
CREATE TABLE IF NOT EXISTS `entreprises` (
  `id_entreprise` int NOT NULL AUTO_INCREMENT,
  `id_admin` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`id_entreprise`),
  KEY `fk_admin_user` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id_entreprise`, `id_admin`, `nom`, `description`) VALUES
(11, 2, 'DYC RAG', 'Une entreprise dans le pret a porte depuis plus de 20 ans'),
(12, 4, 'Apple', 'Entreprise multinationale américaine de tech'),
(13, 10, 'Microsoft', 'Leader international des logiciels informatiques et de la tech'),
(21, 25, 'New StartUp', 'Startup dans le domaine des nouvelles technologies basée à Montpellier'),
(26, 30, 'Esport Prism', 'Nous formons les gamers à faire de leur passion leur métier'),
(27, 31, 'EcoLivraison', 'Votre service de référence pour des livraisons respectueuses de l\'environnement et de ses clients'),
(28, 32, 'LearnOnline', 'LearnOnline est une école spécialisée dans le domaine de l\'informatique qui permet à ses étudiants d\'obtenir leur diplôme grâce à des formations en ligne'),
(29, 33, 'Pétales de Bonheur', 'Boutique florale dédiée à la création de bouquets uniques et enchanteurs pour toutes les occasions. Notre passion pour les fleurs se traduit par des compositions artistiques qui célèbrent la beauté de la nature.'),
(30, 34, 'ÉcoVrac', 'ÉcoVrac est une épicerie zéro déchet qui propose des produits en vrac, des aliments bio et des alternatives durables. L\'objectif est de réduire les emballages plastiques et de promouvoir un mode de vie respectueux de l\'environnement.'),
(31, 35, 'TechArtisan', 'TechArtisan est une entreprise spécialisée dans la création d\'objets artisanaux utilisant des technologies modernes comme l\'impression 3D et la découpe laser. Nous allions savoir-faire traditionnel et innovation pour des produits uniques et personnalisés.'),
(32, 36, 'Café Littéraire', 'Café Littéraire est un espace convivial qui combine un café chaleureux et une librairie indépendante. Nous proposons des événements littéraires, des lectures et des ateliers d\'écriture pour rassembler les passionnés de livres et de café.'),
(33, 37, 'GreenTech Solutions', 'GreenTech Solutions est une entreprise innovante basée à Lyon, spécialisée dans les énergies renouvelables. Nous proposons des solutions écologiques pour les particuliers et les entreprises, notamment des installations solaires et éoliennes.'),
(34, 38, 'Café Bio & Co', 'Café Bio & Co. est un café convivial situé à Marseille, dédié à la promotion de produits bio et locaux. Nous offrons une expérience unique alliant café de qualité, pâtisseries artisanales et événements culturels.'),
(35, 39, 'ANONYMOUS', 'Entreprise qui agit dans l\'ombre ');

-- --------------------------------------------------------

--
-- Structure de la table `types_contrat`
--

DROP TABLE IF EXISTS `types_contrat`;
CREATE TABLE IF NOT EXISTS `types_contrat` (
  `id_contrat` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id_contrat`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `types_contrat`
--

INSERT INTO `types_contrat` (`id_contrat`, `nom`) VALUES
(1, 'CDD'),
(2, 'CDI'),
(3, 'intérim'),
(4, 'stage'),
(5, 'alternance');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom`, `prenom`, `mail`, `telephone`, `password`) VALUES
(2, 'Sabbah', 'Shirel', 'shisabbah15@icloud.com', '0782850167', '1506'),
(3, 'Nolot', 'Tom', 'tom@gmail.com', '0616542378', 'ok'),
(4, 'Jobs', 'Steven', 'apple@gmail.com', '0655663970', 'ok'),
(10, 'Gates', 'Billy', 'microsoft@gmail.com', '0687995311', 'ok'),
(18, 'Mars', 'Tom', 'tom1@gmail.com', '0744332211', 'ok'),
(25, 'Frist', 'Jean', 'newstartup@gmail.com', '0699876503', 'ok'),
(30, 'Crook', 'Lane', 'esport@gmail.com', '0488731982', 'ok'),
(31, 'Big', 'Ben', 'ecolivraison@gmail.com', '0491732864', 'ok'),
(32, 'Antoine', 'Marc', 'learnonline@gmail.com', '0431267818', 'ok'),
(33, 'Malibu', 'Florence', 'petales@gmail.com', '0682043042', 'ok'),
(34, 'Tuille', 'Sophie', 'ecovrac@gmail.com', '0677510933', 'ok'),
(35, 'Gonsales', 'Mélissa', 'techartisan@gmail.com', '0451361928', 'ok'),
(36, 'Durant', 'Sylvie', 'cafelitteraire@gmail.com', '0423526443', 'ok'),
(37, 'Doyen', 'Patricia', 'greentechsolutions@gmail.com', '0697431255', 'ok'),
(38, 'El Kader', 'Abdel', 'cafebio&co@gmail.com', '0494768319', 'ok'),
(39, 'Troll', 'Petit', 'troll@gmail.com', '0000000000', 'ok'),
(40, 'Tapisserie', 'Bernard', 'bernard@gmail.com', '0674986531', 'ok'),
(41, 'Condor', 'Sara', 'scondor@gmail.com', '0747886574', 'ok'),
(42, 'Berceau', 'Sophie', 'sberceau@gmail.com', '0610121425', 'ok'),
(43, 'Faupaire', 'Gustave', 'gfaupaire@gmail.com', '0636448759', 'ok'),
(44, 'Maurice', 'Philippe', 'pmaurice@gmail.com', '0684126651', 'ok'),
(45, 'Bot', 'Boi', 'bot@gmail.com', '0747886574', 'ok');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonces`
--
ALTER TABLE `annonces`
  ADD CONSTRAINT `annonces_ibfk_1` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id_entreprise`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_contrat` FOREIGN KEY (`id_contrat`) REFERENCES `types_contrat` (`id_contrat`) ON DELETE SET NULL;

--
-- Contraintes pour la table `candidatures`
--
ALTER TABLE `candidatures`
  ADD CONSTRAINT `candidatures_ibfk_1` FOREIGN KEY (`annonce_id`) REFERENCES `annonces` (`id_annonce`) ON DELETE CASCADE,
  ADD CONSTRAINT `candidatures_ibfk_2` FOREIGN KEY (`candidat_id`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `fk_candidat_user` FOREIGN KEY (`candidat_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD CONSTRAINT `fk_admin_user` FOREIGN KEY (`id_admin`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
