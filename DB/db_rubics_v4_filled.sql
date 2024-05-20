-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 08, 2024 at 01:47 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rubics`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `actif` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `actif`) VALUES
(1, 'Graphic Design', 'Services de conception graphique pour tous types de supports publicitaires.', 1),
(2, 'Video', 'Production de vidéos publicitaires, de vidéos promotionnelles et de contenu vidéo pour les réseaux sociaux.', 1),
(3, 'Web-développement back-end', 'Développement de la partie serveur et base de données des sites web et des applications web.', 1),
(4, 'Web-développement front-end', 'Conception et développement de l\'interface utilisateur des sites web et des applications web.', 1),
(5, 'Web Design', 'Création de maquettes et de designs pour les sites web et les applications web.', 1),
(6, '3D', 'Modélisation, animation et rendu en 3D pour la publicité et la promotion.', 1),
(7, 'Audiovisuel', 'Services de production audiovisuelle, y compris la création de contenu sonore et visuel pour diverses plateformes.', 1),
(8, 'Marketing digital', 'Stratégies et campagnes de marketing en ligne, y compris le référencement, les médias sociaux et la publicité en ligne.', 1),
(9, 'Création de contenu', 'Création de contenu marketing de haute qualité, y compris des articles de blog, des infographies et des livres blancs.', 1),
(10, 'Brand Identity', 'Développement d\'identités de marque cohérentes, y compris la conception de logos, la typographie et les palettes de couleurs.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `characterize`
--

CREATE TABLE `characterize` (
  `skill_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `characterize`
--

INSERT INTO `characterize` (`skill_id`, `employee_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(39, 1),
(40, 1),
(41, 1),
(5, 2),
(7, 2),
(23, 2),
(28, 2),
(43, 2),
(46, 2),
(47, 2),
(48, 2),
(9, 3),
(10, 3),
(11, 3),
(14, 3),
(38, 3),
(42, 3),
(12, 4),
(13, 4),
(15, 4),
(16, 4),
(17, 4),
(20, 4),
(18, 5),
(19, 5),
(20, 5),
(21, 5),
(44, 5),
(45, 5),
(22, 6),
(24, 6),
(25, 6),
(26, 6),
(49, 6),
(50, 6),
(51, 7),
(52, 7),
(53, 7),
(54, 7),
(55, 7),
(56, 7),
(57, 7),
(58, 7),
(59, 7),
(60, 7),
(29, 8),
(31, 8),
(34, 8),
(30, 9),
(31, 9),
(32, 9),
(34, 9),
(36, 9),
(37, 9),
(39, 9),
(30, 10),
(32, 10),
(34, 10),
(36, 10),
(39, 10);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_connection` datetime NOT NULL,
  `actif` tinyint(4) NOT NULL,
  `identifier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `first_name`, `last_name`, `birthdate`, `created_at`, `last_connection`, `actif`, `identifier_id`) VALUES
(1, 'John', 'Doe', '1990-05-15', '2023-10-20 06:30:00', '2024-04-15 15:20:00', 1, 1),
(2, 'Alice', 'Smith', '1985-09-28', '2023-11-05 09:15:00', '2024-04-20 18:45:00', 1, 2),
(3, 'Michael', 'Johnson', '1978-03-12', '2023-12-10 13:20:00', '2024-04-25 09:10:00', 0, 3),
(4, 'Emily', 'Brown', '1995-07-03', '2024-01-05 08:45:00', '2024-04-30 11:30:00', 1, 4),
(5, 'William', 'Jones', '1982-11-18', '2024-02-20 11:30:00', '2024-05-05 13:55:00', 1, 5),
(6, 'Sophia', 'Davis', '1993-04-25', '2024-03-15 10:00:00', '2024-05-08 09:20:00', 1, 6),
(7, 'James', 'Wilson', '1988-08-08', '2024-04-01 12:45:00', '2024-05-10 17:30:00', 1, 7),
(8, 'Mike', 'Shinoda', '1996-12-10', '2024-05-08 13:37:59', '2024-05-12 08:15:00', 0, 8),
(9, 'Alexander', 'Martinez', '1980-06-20', '2024-05-05 07:15:00', '2024-05-15 12:40:00', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `vat` varchar(25) NOT NULL,
  `country` varchar(25) NOT NULL,
  `locality` varchar(25) NOT NULL,
  `zip_code` varchar(25) NOT NULL,
  `street` varchar(25) NOT NULL,
  `number` varchar(25) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `vat`, `country`, `locality`, `zip_code`, `street`, `number`, `comment`, `client_id`) VALUES
(1, 'Alpha Belgique', 'BE0123456789', 'Belgique', 'Bruxelles', '1000', 'Rue de la Liberté', '10', 'Siège social', 1),
(2, 'Beta Entreprise', 'BE9876543210', 'Belgique', 'Liège', '4000', 'Avenue des Roses', '5', 'Bureau principal', 2),
(3, 'Gamma SA', 'BE2468135790', 'Belgique', 'Gand', '9000', 'Place du Marché', '15', 'Centre de distribution', 3),
(4, 'Delta France', 'FR12345678901', 'France', 'Paris', '75001', 'Rue de la Paix', '20', 'Siège social', 4),
(5, 'Epsilon SARL', 'FR98765432109', 'France', 'Lyon', '69001', 'Avenue du Bonheur', '8', 'Bureau principal', 5);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `biography` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `actif` tinyint(4) NOT NULL,
  `team_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `avatar`, `first_name`, `last_name`, `birthdate`, `biography`, `created_at`, `actif`, `team_id`, `role_id`) VALUES
(1, '/Rubics/public/uploads/employees/AliceDoe/AliceDoe.jpg', 'Alice', 'Doe', '1990-05-15', 'Passionnée de design visuel, j\'apporte créativité et innovation à chaque projet.', '2024-05-07 22:00:00', 1, 1, 1),
(2, '/Rubics/public/uploads/employees/BobSmith/BobSmith.jpg', 'Bob', 'Smith', '1985-09-20', 'Vidéaste talentueux, j\'excelle à capturer des moments mémorables et à créer des récits captivants.', '2024-05-07 22:00:00', 1, 2, 2),
(3, '/Rubics/public/uploads/employees/CharlieJohnson/CharlieJohnson.jpg', 'Charlie', 'Johnson', '1988-03-10', 'Développeur backend talentueux, j\'aime construire des applications web robustes et efficaces.', '2024-05-07 22:00:00', 1, 3, 3),
(4, '/Rubics/public/uploads/employees/DianaBrown/DianaBrown.jpg', 'Diana', 'Brown', '1992-11-25', 'Développeuse frontend passionnée, je transforme les concepts de design en interfaces web interactives.', '2024-05-07 22:00:00', 1, 4, 4),
(5, '/Rubics/public/uploads/employees/EmilyWilliams/EmilyWilliams.jpg', 'Emily', 'Williams', '1987-07-08', 'Créatrice de sites web conviviaux, j\'aime expérimenter avec les nouvelles tendances de design.', '2024-05-07 22:00:00', 1, 5, 5),
(6, '/Rubics/public/uploads/employees/FrankAnderson/FrankAnderson.jpg', 'Frank', 'Anderson', '1984-12-18', 'Artiste 3D passionné, j\'aime créer des environnements immersifs et des effets visuels époustouflants.', '2024-05-07 22:00:00', 1, 6, 6),
(7, '/Rubics/public/uploads/employees/GraceThomas/GraceThomas.jpg', 'Grace', 'Thomas', '1991-02-28', 'Experte audiovisuelle polyvalente, j\'excelle dans la création d\'expériences multimédias captivantes.', '2024-05-07 22:00:00', 1, 7, 7),
(8, '/Rubics/public/uploads/employees/HenryJackson/HenryJackson.jpg', 'Henry', 'Jackson', '1986-06-12', 'Expert en marketing digital, j\'explore constamment de nouvelles stratégies pour toucher les audiences.', '2024-05-07 22:00:00', 1, 8, 8),
(9, '/Rubics/public/uploads/employees/IvyMiller/IvyMiller.jpg', 'Ivy', 'Miller', '1993-04-05', 'Passionnée de création de contenu, j\'excelle dans la création de récits captivants sur différentes plateformes.', '2024-05-07 22:00:00', 1, 9, 9),
(10,'/Rubics/public/uploads/employees/JackMoore/JackMoore.jpg',  'Jack', 'Moore', '1989-08-30', 'Expert en branding, j\'aime créer des expériences de marque cohérentes qui résonnent avec les audiences.', '2024-05-07 22:00:00', 1, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `identifier`
--

CREATE TABLE `identifier` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `secret_question` varchar(250) NOT NULL,
  `secret_answer` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `identifier`
--

INSERT INTO `identifier` (`id`, `username`, `mail`, `pwd`, `secret_question`, `secret_answer`) VALUES
(1, 'john_doe', 'john.doe@example.com', 'b0c56a50389f2a0f172f83c3fd30aad6', 'pet', 'Smith'),
(2, 'alice_smith', 'alice.smith@example.com', 'd625fcd01cbb600c60a7ee0d5bf15c2a', 'school', 'New York'),
(3, 'michaelj', 'michael.j@example.com', '931fa1373e8c04fec709ae558964eadc', 'pet', 'Trex'),
(4, 'emilyb', 'emily.b@example.com', '965682a92f51858255d17f8de0df573c', 'pet', 'Fluffy'),
(5, 'will_jones', 'will.jones@example.com', 'b54aaa412a8e8390165e1186c5313390', 'color', 'Red'),
(6, 'sophia_d', 'sophia.d@example.com', '66b7b5ab57a0c5da8c576dfc2d9122ce', 'color', 'Blue'),
(7, 'james_w', 'james.w@example.com', '358e601116b541129b1996be05045e75', 'school', 'Tournai'),
(8, 'mike_s', 'mike.s@example.com', 'faa668b1de61c5e3f28cae4c3f559e26', 'pet', 'Heyden'),
(9, 'alex_m', 'alex.m@example.com', '30c12d6bdadc049d75e9c17004a684c7', 'school', 'Mouscron');


-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `extension` varchar(50) NOT NULL,
  `path` varchar(250) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `finished_at` timestamp NULL DEFAULT NULL,
  `finalized` tinyint(4) NOT NULL,
  `request_id` int(11) NOT NULL,
  `comment` text NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `created_at`, `finished_at`, `finalized`, `request_id`, `comment`) VALUES
(1, 'Entreprise de design d\'intérieur', 'Création d\'un logo et d\'une charte graphique', '2024-05-07 22:00:00', '2024-06-07 22:00:00', 0, 1, 'Nous sommes extrêmement satisfaits du logo et de la charte graphique créés par l\'équipe. Ils ont capturé parfaitement l\'essence de notre marque et ont su transmettre notre message de manière visuellement saisissante.'),
(2, 'Événement caritatif', 'Réalisation d\'une vidéo promotionnelle.', '2024-05-07 22:00:00', '2024-06-07 22:00:00', 0, 2, 'La vidéo promotionnelle réalisée a dépassé toutes nos attentes. Elle a été un élément clé dans notre stratégie de marketing et a suscité un fort engagement de la part de notre audience. Bravo pour le travail exceptionnel!'),
(3, 'Entreprise de commerce électronique', 'Développement d\'une application web de gestion des stocks.', '2024-05-07 22:00:00', '2024-06-07 22:00:00', 0, 3, 'L\'application web développée par l\'équipe a grandement facilité nos processus internes. Son interface intuitive et ses fonctionnalités robustes ont considérablement amélioré notre efficacité opérationnelle. Merci pour cette solution sur mesure!'),
(4, 'Agence de voyage', 'Conception et développement d\'un site web vitrine.', '2024-05-07 22:00:00', '2024-06-07 22:00:00', 0, 4, 'Le site web vitrine conçu et développé correspond parfaitement à notre image de marque. Son design épuré et ses performances exceptionnelles ont contribué à renforcer notre présence en ligne et à attirer de nouveaux clients.'),
(5, 'Entreprise en cosmétique', 'Modélisation 3D d\'un prototype de produit.', '2024-05-07 22:00:00', '2024-06-07 22:00:00', 0, 5, 'La modélisation 3D du prototype de notre produit a été réalisée avec une précision remarquable. Les détails et la qualité du rendu ont permis à notre équipe de mieux visualiser le produit final et d\'apporter des améliorations significatives. Un travail impeccable!'),
(6, 'Marque de vêtements', 'Montage vidéo d\'une publicité.', '2024-05-07 22:00:00', '2024-06-07 22:00:00', 0, 6, 'La publicité montée par l\'équipe a été un véritable succès. Son dynamisme, sa créativité et sa capacité à captiver l\'attention ont généré un retour positif de la part de notre audience. Merci pour cette collaboration fructueuse!'),
(7, 'Nouvelle application mobile', 'Stratégie de marketing numérique.', '2024-05-07 22:00:00', '2024-06-07 22:00:00', 0, 7, 'La stratégie de marketing numérique mise en place a été extrêmement efficace pour accroître notre visibilité en ligne et générer des leads qualifiés. Les résultats obtenus ont dépassé nos attentes et ont contribué à la croissance de notre entreprise.'),
(8, 'Entreprise de restauration', 'Création de contenu pour les réseaux sociaux.', '2024-05-07 22:00:00', '2024-06-07 22:00:00', 0, 8, 'Le contenu créé pour nos réseaux sociaux a été très bien reçu par notre communauté. Il a réussi à susciter de l\'engagement et à renforcer notre présence en ligne. Nous sommes ravis de la qualité et de la pertinence du contenu produit.'),
(9, 'Entreprise en technologie', 'Refonte de l\'identité visuelle.', '2024-05-07 22:00:00', '2024-06-07 22:00:00', 0, 9, 'La refonte de notre identité visuelle a été un véritable coup de maître. L\'équipe a su moderniser notre image de marque tout en préservant nos valeurs fondamentales. Cette nouvelle identité visuelle reflète parfaitement qui nous sommes et où nous allons.');

-- --------------------------------------------------------

--
-- Table structure for table `realize`
--

CREATE TABLE `realize` (
  `project_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `realize`
--

INSERT INTO `realize` (`project_id`, `employee_id`) VALUES
(1, 1),
(1, 10),
(2, 2),
(2, 7),
(2, 9),
(3, 1),
(3, 3),
(3, 4),
(3, 5),
(3, 9),
(4, 3),
(4, 4),
(4, 5),
(4, 8),
(5, 6),
(6, 2),
(6, 6),
(7, 8),
(7, 9),
(7, 10),
(8, 8),
(8, 9),
(9, 1),
(9, 3),
(9, 4),
(9, 5),
(9, 10);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `budget` float NOT NULL,
  `category_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `name`, `description`, `budget`, `category_id`, `client_id`) VALUES
(1, 'Création', 'Création d\'un logo et d\'une charte graphique pour une nouvelle entreprise de design d\'intérieur.', 5000, 1, 1),
(2, 'Réalisation', 'Réalisation d\'une vidéo promotionnelle pour un événement caritatif.', 8000, 2, 2),
(3, 'Développement', 'Développement d\'une application web de gestion des stocks pour une entreprise de commerce électronique.', 10000, 4, 3),
(4, 'Conception', 'Conception et développement d\'un site web vitrine pour une agence de voyage.', 6000, 5, 4),
(5, 'Modélisation', 'Modélisation 3D d\'un prototype de produit pour une entreprise de fabrication.', 7000, 6, 5),
(6, 'Montage', 'Montage vidéo d\'une publicité pour une marque de vêtements.', 4000, 7, 6),
(7, 'Stratégie', 'Stratégie de marketing numérique pour le lancement d\'une nouvelle application mobile.', 12000, 8, 7),
(8, 'Création', 'Création de contenu pour les réseaux sociaux pour une entreprise de restauration.', 3000, 9, 8),
(9, 'Refonte', 'Refonte de l\'identité visuelle d\'une entreprise de technologie.', 9000, 10, 9);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `pwd` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `actif` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `priority`, `pwd`, `created_at`, `actif`) VALUES
(1, 2, 'b0c56a50389f2a0f172f83c3fd30aad6', '2024-05-08 08:00:00', 1),
(2, 2, 'd625fcd01cbb600c60a7ee0d5bf15c2a', '2024-05-08 08:30:00', 1),
(3, 2, '931fa1373e8c04fec709ae558964eadc', '2024-05-08 09:00:00', 1),
(4, 2, '965682a92f51858255d17f8de0df573c', '2024-05-08 09:30:00', 1),
(5, 2, 'b54aaa412a8e8390165e1186c5313390', '2024-05-08 10:00:00', 1),
(6, 2, '66b7b5ab57a0c5da8c576dfc2d9122ce', '2024-05-08 11:00:00', 1),
(7, 2, '358e601116b541129b1996be05045e75', '2024-05-08 11:30:00', 1),
(8, 2, 'faa668b1de61c5e3f28cae4c3f559e26', '2024-05-08 12:00:00', 1),
(9, 2, '30c12d6bdadc049d75e9c17004a684c7', '2024-05-08 12:30:00', 1),
(10, 2, '0cb1664d30ed979b3c8a01b703bbcf84', '2024-05-08 13:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `actif` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `name`, `actif`) VALUES
(1, 'Design', 1),
(2, 'Créativité', 1),
(3, 'Illustration', 1),
(4, 'Adobe Suite', 1),
(5, 'Multicam', 1),
(6, 'Montage', 1),
(7, 'Production', 1),
(8, 'Effets spéciaux', 1),
(9, 'Serveur', 1),
(10, 'Base de données', 1),
(11, 'Backend', 1),
(12, 'Frontend', 1),
(13, 'Interface utilisateur', 1),
(14, 'PHP', 1),
(15, 'HTML', 1),
(16, 'CSS', 1),
(17, 'JavaScript', 1),
(18, 'Maquette', 1),
(19, 'Conception', 1),
(20, 'UX/UI', 1),
(21, 'Wireframe', 1),
(22, 'Modélisation', 1),
(23, 'Animation', 1),
(24, 'Rendu', 1),
(25, 'Autodesk Maya', 1),
(26, 'Blender', 1),
(27, 'Audio visuel', 1),
(28, 'Production studio', 1),
(29, 'Stratégie marketing', 1),
(30, 'SEO', 1),
(31, 'Médias sociaux', 1),
(32, 'Rédaction contenu', 1),
(33, 'Infographie', 1),
(34, 'Identité de marque', 1),
(35, 'Logo', 1),
(36, 'Branding', 1),
(37, 'Typographie', 1),
(38, 'PhpStorm', 1),
(39, 'InDesign', 1),
(40, 'Photoshop', 1),
(41, 'Illustrator', 1),
(42, 'Visual studio code', 1),
(43, 'After Effects', 1),
(44, 'Figma', 1),
(45, 'Adobe XD', 1),
(46, 'Coupe', 1),
(47, 'Rognage', 1),
(48, 'Fusion', 1),
(49, 'Cinema 4D', 1),
(50, 'Sketchup', 1),
(51, 'Max/MSP', 1),
(52, 'Pure Data', 1),
(53, 'Processing', 1),
(54, 'OpenFrameworks', 1),
(55, 'TouchDesigner', 1),
(56, 'VDMX', 1),
(57, 'Resolume Arena', 1),
(58, 'Isadora', 1),
(59, 'Cycling', 1),
(60, 'Supercollider', 1);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `actif` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `actif`) VALUES
(1, 'Graphic Design', 1),
(2, 'Video', 1),
(3, 'Web-développement back-end', 1),
(4, 'Web-développement front-end', 1),
(5, 'Web Design', 1),
(6, '3D', 1),
(7, 'Audiovisuel', 1),
(8, 'Marketing digital', 1),
(9, 'Création de contenu', 1),
(10, 'Brand Identity', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `characterize`
--
ALTER TABLE `characterize`
  ADD KEY `fk_characterize_skill1_idx` (`skill_id`),
  ADD KEY `fk_characterize_employee1_idx` (`employee_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_identifier_idx` (`identifier_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`,`client_id`),
  ADD KEY `fk_company_client1_idx` (`client_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_team_FK` (`team_id`),
  ADD KEY `employee_role0_FK` (`role_id`);

--
-- Indexes for table `identifier`
--
ALTER TABLE `identifier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_media_project1_idx` (`project_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`,`request_id`),
  ADD KEY `fk_project_request1_idx` (`request_id`);

--
-- Indexes for table `realize`
--
ALTER TABLE `realize`
  ADD KEY `fk_realize_project1_idx` (`project_id`),
  ADD KEY `fk_realize_employee1_idx` (`employee_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`,`client_id`),
  ADD KEY `request_category0_FK` (`category_id`),
  ADD KEY `fk_request_client` (`client_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `identifier`
--
ALTER TABLE `identifier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `characterize`
--
ALTER TABLE `characterize`
  ADD CONSTRAINT `fk_characterize_employee1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_characterize_skill1` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `fk_identifier` FOREIGN KEY (`identifier_id`) REFERENCES `identifier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `company`
--
ALTER TABLE `company`
  ADD CONSTRAINT `fk_company_client1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_role0_FK` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_team_FK` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `fk_media_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `fk_project_request1` FOREIGN KEY (`request_id`) REFERENCES `request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `realize`
--
ALTER TABLE `realize`
  ADD CONSTRAINT `fk_realize_employee1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_realize_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `fk_request_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_category0_FK` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
