-- Il faut commencer par créer une base de données
-- avec phpmyadmin ou
-- décommenter les deux lignes suivantes
-- CREATE DATABASE critiques;
-- USE critites;
-- Base de données :  `critiques`
--

-- --------------------------------------------------------

--
-- Structure de la table `chercheur`
--

CREATE TABLE `chercheur` (
  `pk_id_chercheur` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `URL` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ISNI` varchar(19) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `collectif`
--

CREATE TABLE `collectif` (
`pk_id_collectif` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auteursSecondaires` text COLLATE utf8_unicode_ci COMMENT 'auteurs non référencés dans la base'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `collectif`
--

INSERT INTO `collectif` (`pk_id_collectif`, `titre`, `auteursSecondaires`) VALUES
(1, 'Marius-Ary LEBLOND', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `compositionsignature`
--

CREATE TABLE `compositionsignature` (
  `fk_id_signature` int(11) NOT NULL,
  `fk_id_critiquedart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table de liaison entre une signatures, les signataires et le';

--
-- Contenu de la table `compositionsignature`
--

INSERT INTO `compositionsignature` (`fk_id_signature`, `fk_id_critiquedart`) VALUES
(19, 1),
(20, 1),
(21, 1),
(1, 12),
(2, 12),
(3, 12),
(4, 12),
(5, 12),
(8, 12),
(9, 12),
(10, 12),
(11, 12),
(12, 12),
(13, 12),
(14, 12),
(15, 12),
(16, 12),
(17, 12),
(18, 12),
(22, 12),
(23, 12),
(24, 12),
(25, 12),
(26, 12),
(27, 12);

-- --------------------------------------------------------

--
-- Structure de la table `critique`
--

CREATE TABLE `critique` (
`pk_id_critique` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `complementTitre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('preface','postface','introduction','article','chapitre','monographie') COLLATE utf8_unicode_ci NOT NULL,
  `pagination` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n.p.',
  `attribution` enum('attribué','certifié') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'certifié' COMMENT 'sert à attribuer la paternité d''une critique de manière certifiée ou attribuée',
  `reedition` smallint(6) DEFAULT NULL COMMENT 'En cas de republication, indiquer l''année d''origine',
  `fk_id_ouvrage` int(11) DEFAULT NULL,
  `fk_id_numeroperiodique` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `critique`
--

INSERT INTO `critique` (`pk_id_critique`, `titre`, `complementTitre`, `type`, `pagination`, `attribution`, `reedition`, `fk_id_ouvrage`, `fk_id_numeroperiodique`) VALUES
(2, 'Géricault et Delacroix, élèves au Lycée impérial', NULL, 'article', '85-88', 'certifié', NULL, NULL, 4),
(3, 'Histoire de l''art', NULL, 'article', '31-35', 'certifié', NULL, NULL, 5),
(4, 'L’architecture à l’exposition de Grenoble', NULL, 'article', '306-309', 'certifié', NULL, NULL, 7),
(5, 'Manet et l’Espagne', NULL, 'article', '203-214', 'certifié', NULL, NULL, 6),
(6, 'Une maquette de Chinard au musée de Lyon', NULL, 'article', '209-210', 'certifié', NULL, NULL, 3),
(8, 'J.-J. de Boissieu, peintre-graveur (1736-1810)', NULL, 'article', '79-81', 'certifié', NULL, NULL, 8),
(9, 'Tony Garnier et le stade pour les sports athlétiques de Lyon', NULL, 'article', '109-119', 'certifié', NULL, NULL, 9),
(10, 'Indications bibliographiques. Agrégation féminine, Histoire de l’art', NULL, 'article', '27-31', 'certifié', NULL, NULL, 10),
(11, 'Au Musée de Lyon', NULL, 'article', '315-316', 'certifié', NULL, NULL, 11),
(12, 'La renaissance de la verrerie française au XIXe siècle', NULL, 'article', '51-64', 'certifié', NULL, NULL, 12),
(13, 'Un musée d’estampes à Paris', NULL, 'article', '27-29', 'certifié', NULL, NULL, 13),
(14, 'La “maison moderne” par Louis Sorel', NULL, 'article', '143-148', 'certifié', NULL, NULL, 14),
(15, 'La gravure italienne à la Chalcographie de Rome', NULL, 'article', '91-102', 'certifié', NULL, NULL, 15),
(16, 'Histoire de l’art', NULL, 'article', '29-32', 'certifié', NULL, NULL, 16),
(17, 'Au musée de Lyon, Acquisitions', NULL, 'article', '13-15', 'certifié', NULL, NULL, 17),
(18, 'Un buste inédit par Chinard', NULL, 'article', '253-256', 'certifié', NULL, NULL, 18),
(19, 'La sculpture bourguignonne', 'sur une conférence prononcée par L. Courajod', 'article', '1', 'certifié', NULL, NULL, 19),
(20, 'Théodore Chassériau et son œuvre de graveur', NULL, 'article', '119-123', 'certifié', NULL, NULL, 20),
(21, 'Manet et l’Espagne', NULL, 'article', '203-214', 'certifié', NULL, NULL, 6),
(22, 'Les Salons de 1928', NULL, 'article', '161-190', 'certifié', NULL, NULL, 21),
(23, 'La maison rose de Louis Sorel', NULL, 'article', '375-381', 'certifié', NULL, NULL, 22),
(24, 'A ceux qui ne sont pas socialistes', NULL, 'article', '1', 'certifié', NULL, NULL, 23),
(25, 'Paroles socialistes', NULL, 'article', '1', 'certifié', NULL, NULL, 23),
(26, 'A propos d’un jugement', NULL, 'article', '1', 'certifié', NULL, NULL, 24),
(27, 'Choses d’Espagne', NULL, 'article', '1', 'certifié', NULL, NULL, 25);

-- --------------------------------------------------------

--
-- Structure de la table `critiquedart`
--

CREATE TABLE `critiquedart` (
`pk_id_critiqueDart` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anneeNaissance` smallint(6) DEFAULT NULL,
  `anneeMort` smallint(6) DEFAULT NULL,
  `ISNI` varchar(19) COLLATE utf8_unicode_ci DEFAULT NULL,
  `initiales` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `URL_WP` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `critiquedart`
--

INSERT INTO `critiquedart` (`pk_id_critiqueDart`, `nom`, `prenom`, `anneeNaissance`, `anneeMort`, `ISNI`, `initiales`, `URL_WP`) VALUES
(1, 'MARX', 'Roger', 1859, 1913, '0000 0001 2280 7639', 'R. M.', NULL),
(2, 'BESSON', 'George', 1882, 1971, '0000 0001 0874 3720', 'G. B.', NULL),
(3, 'BLANCHE', 'Jacques-Emile', 1861, 1942, '0000 0001 1021 1328', 'J.-E. B.', NULL),
(4, 'DOLENT', 'Jean', 1835, 1909, NULL, 'J. D. ', NULL),
(5, 'FONTAINAS', 'André', 1865, 1948, '0000 0001 1641 3297', 'A. F.', NULL),
(6, 'de FOURCAUD', 'Louis', 1851, 1914, '0000 0000 8354 3051', 'L. F.', NULL),
(7, 'HUYSMANS', 'Joris-Karl', 1848, 1907, NULL, 'J.-K. H.', NULL),
(8, 'LEBLOND', 'Marius-Ary', NULL, NULL, NULL, 'M.-A. L.', NULL),
(9, 'LEBLOND', 'Marius', 1877, 1953, NULL, 'M. L.', NULL),
(10, 'LEBLOND', 'Ary', 1880, 1958, NULL, 'A. L.', NULL),
(11, 'ROGER-MARX', 'Claude', 1888, 1977, NULL, 'C. R.-M.', NULL),
(12, 'ROSENTHAL', 'Léon', 1870, 1932, '0000 0001 0858 8150', 'L. R.', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `editeur`
--

CREATE TABLE `editeur` (
`pk_id_editeur` int(11) NOT NULL,
  `nom` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `editeur`
--

INSERT INTO `editeur` (`pk_id_editeur`, `nom`, `ville`) VALUES
(1, 'Flammarion', 'Paris'),
(2, 'Librairies-imprimeries réunies', 'Paris'),
(3, 'H. Laurens', 'Paris'),
(4, 'L’Art et les artistes', 'Paris');

-- --------------------------------------------------------

--
-- Structure de la table `numeroperiodique`
--

CREATE TABLE `numeroperiodique` (
`pk_id_numero_periodique` int(11) NOT NULL,
  `numero` smallint(6) DEFAULT NULL,
  `annee` smallint(6) DEFAULT NULL,
  `nb_pages` smallint(6) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complementTitre` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `volume` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateprecise` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fk_id_periodique` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `numeroperiodique`
--

INSERT INTO `numeroperiodique` (`pk_id_numero_periodique`, `numero`, `annee`, `nb_pages`, `titre`, `complementTitre`, `volume`, `dateprecise`, `fk_id_periodique`) VALUES
(1, NULL, 1929, NULL, NULL, NULL, 'X', NULL, 66),
(2, 5, 1929, NULL, NULL, NULL, NULL, NULL, 70),
(3, 7, 1925, NULL, NULL, NULL, NULL, '1925-07-01', 21),
(4, NULL, 1925, NULL, NULL, NULL, NULL, NULL, 25),
(5, 45, 1925, NULL, NULL, NULL, NULL, NULL, 27),
(6, NULL, 1925, NULL, NULL, NULL, NULL, NULL, 57),
(7, 18, 1925, NULL, NULL, NULL, NULL, '1925-09-01', 69),
(8, NULL, 1926, NULL, NULL, NULL, NULL, NULL, 91),
(9, 9, 1929, NULL, NULL, NULL, NULL, NULL, 70),
(10, 50, 1927, NULL, NULL, NULL, NULL, NULL, 27),
(11, NULL, 1927, NULL, NULL, NULL, NULL, NULL, 21),
(12, NULL, 1927, NULL, NULL, NULL, NULL, '1927-02-01', 57),
(13, NULL, 1927, NULL, NULL, NULL, NULL, NULL, 64),
(14, 5, 1927, NULL, NULL, NULL, NULL, NULL, 70),
(15, NULL, 1927, NULL, NULL, NULL, NULL, NULL, 222),
(16, NULL, 1928, NULL, NULL, NULL, NULL, '1928-11-01', 27),
(17, NULL, 1928, NULL, NULL, NULL, NULL, NULL, 32),
(18, NULL, 1928, NULL, NULL, NULL, NULL, '1928-04-01', 57),
(19, NULL, 1892, NULL, NULL, NULL, NULL, '1892-07-11', 203),
(20, 6, 1898, NULL, 'Théodore Chassériau (1819-1856) et les peintures de la Cour des Comptes', NULL, NULL, '1898-07-15', 99),
(21, 6, 1928, NULL, NULL, NULL, NULL, NULL, 70),
(22, 10, 1929, NULL, NULL, NULL, NULL, NULL, 70),
(23, NULL, 1902, NULL, NULL, NULL, NULL, '1902-02-08', 197),
(24, NULL, 1902, NULL, NULL, NULL, NULL, '1902-03-22', 197),
(25, NULL, 1902, NULL, NULL, NULL, NULL, '1902-03-30', 197);

-- --------------------------------------------------------

--
-- Structure de la table `ouvrage`
--

CREATE TABLE `ouvrage` (
`pk_id_ouvrage` int(11) NOT NULL,
  `ISBN_10` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `annee` smallint(6) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `complement_titre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `coordonnateur` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `collection` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edition` tinyint(4) DEFAULT NULL,
  `fk_id_editeur` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ouvrage`
--

INSERT INTO `ouvrage` (`pk_id_ouvrage`, `ISBN_10`, `annee`, `titre`, `complement_titre`, `coordonnateur`, `collection`, `edition`, `fk_id_editeur`) VALUES
(1, NULL, 1892, 'Histoire de l''art décoratif, du XVIe siècle à nos jours', 'Ouvrage orné de quarante-huit planches en couleurs, douze eaux-fortes, cinq cent vingt-six dessins dans le texte.', 'H. Laurens', NULL, NULL, NULL),
(4, NULL, 1889, 'Exposition Jules Chéret [Catalogue d''exposition] Galerie du théâtre d''application', 'Pastels, lithographies, dessins, affiches illustrées', NULL, NULL, 1, NULL),
(8, NULL, 1912, 'Histoire générale de la peinture', NULL, 'Armand Dayot', NULL, 2, 4),
(9, NULL, 1893, 'Études d''art. Le Salon de 1852', NULL, 'Edmond et Jules de Goncourt', 'Librairie des Bibliophiles', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `periodique`
--

CREATE TABLE `periodique` (
`pk_id_periodique` int(11) NOT NULL,
  `ISSN` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `periodicite` enum('quotidien','hebdomadaire','bimensuel','mensuel','bi-hebdomadaire','semestriel','annuel','trimestriel') COLLATE utf8_unicode_ci DEFAULT NULL,
  `couverture` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=349 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `periodique`
--

INSERT INTO `periodique` (`pk_id_periodique`, `ISSN`, `titre`, `periodicite`, `couverture`) VALUES
(1, '1153-4044', 'La Revue blanche', 'bimensuel', '1891-1903'),
(2, '1954-619X', '14 rue du Dragon', '', '1933-1934'),
(3, NULL, 'ABC magazine d''art', '', '1925-1928'),
(4, '2113-4391', 'ABC artistique et littéraire', '', '1928-1931'),
(5, '2113-3387', 'ABC magazine', '', '1934-1939'),
(6, '1144-9977', 'Action', '', '1920-1922'),
(7, NULL, 'America', '', '1945-1947'),
(8, '1273-9227', 'Annales de la jeunesse laïque', '', '1902-1914'),
(9, '0779-9330', 'Antée', 'mensuel', '1905-1908'),
(10, '2119-6923', 'Art artisanat', '', '1934-1938'),
(11, '2119-6923', 'Art et artisanat', '', '1934-1938'),
(12, '1160-7432', 'Art et industrie', 'mensuel', '1909-1914'),
(13, '0004-3168', 'Art et décoration', 'mensuel', '1897-XXXX'),
(14, '1160-7475', 'Art et industrie', '', '1925-1955'),
(15, NULL, 'Art et style', '', '1945-1962'),
(16, '1149-3526', 'Art présent', '', '1945-1950'),
(17, '1144-1321', 'Arts', '', '1945-1967'),
(18, NULL, 'Arts de France', '', '1945-1951'),
(19, '1278-1452', 'Arts et métiers graphiques', '', '1927-1939'),
(20, '0408-277X', 'Ballet', '', '1951-1959'),
(21, '1144-1283', 'Beaux-arts', '', '1923-1940'),
(22, '2022-4672', 'Bulletin de l''Effort moderne', '', '1924-1927'),
(23, NULL, 'Bulletin de l''Office international des instituts d''archéologie et d''histoire de l''art', '', '1934-1946'),
(24, '0994-8074', 'Bulletin de la Société de l''histoire de l''art français', '', '1875-1878'),
(25, '0301-4126', 'Bulletin de la Société de l''histoire de l''art français', '', '1907-XXXX'),
(26, NULL, 'Bulletin de la Société des amis des cathédrales', 'annuel', '1913-1927'),
(27, '1153-7272', 'Bulletin de la Société des professeurs d''histoire et de géographie de l''enseignement secondaire public', '', '1910-1965'),
(28, '2022-1495', 'Bulletin de la Société Fragonard', 'annuel', '1925-1932'),
(29, '0081-1181', 'Bulletin de la Société Nationale des Antiquaires de France', '', '1870-XXXX'),
(30, '1144-116X', 'Bulletin des musées', 'mensuel', '1890-1893'),
(31, '1144-1186', 'Bulletin des musées de France', '', '1908-1910'),
(32, '1144-1208', 'Bulletin des musées de France', '', '1929-1947'),
(33, '2259-9185', 'Bulletin des Sociétés artistiques de l''Est', '', '1895-1914'),
(34, NULL, 'Bulletin des Universités populaires', '', '1900-XXXX'),
(35, NULL, 'Bulletin du Salon d''Automne', '', '1916-1917'),
(36, NULL, 'Bulletin officiel de l''Union centrale des arts décoratifs', '', '1882-1884'),
(37, '2113-5258', 'Byblis', '', '1921-1931'),
(38, '0995-8274', 'Cahiers d''art', '', '1926-1960'),
(39, NULL, 'Cahiers de Belgique', '', '1928-1931'),
(40, NULL, 'Cahiers libres, artistiques et littéraires', '', '1924-1924'),
(41, '1247-0414', 'Cahiers Points et contrepoints', '', '1946-1948'),
(42, NULL, 'CAP - Critique - Art - Philosophie', '', '1924-1927'),
(43, '0983-3994', 'Chronique de l''ours', '', '1921-1922'),
(44, NULL, 'Courrier de l''art', 'hebdomadaire', '1881-1892'),
(45, '1966-1797', 'Courrier de Meurthe-et-Moselle', '', '1871-XXXX'),
(46, '0776-7331', 'ça ira !', 'mensuel', '1920-1923'),
(47, '0258-3631', 'Die Graphischen Künste', '', '1879-1944'),
(48, NULL, 'Die Zeit', '', '1894-1904'),
(49, '1144-1151', 'Documents', 'mensuel', '1929-1934'),
(50, '2112-9975', 'Eaux-vives de Lutèce', '', '1946-1946'),
(51, '1245-8724', 'Essais d''art libre', 'mensuel', '1892-1894'),
(52, NULL, 'Feuillets d''art', '', '1919-1922'),
(53, NULL, 'Flegrea', '', '1899-1902'),
(54, '2019-0190', 'Formes', '', '1929-1934'),
(55, '1113-4607', 'France-Maroc', 'mensuel', '1917-1925'),
(56, NULL, 'Gand Artistique', 'mensuel', '1922-1931'),
(57, '0016-5530', 'Gazette des beaux-arts', '', '1859-2002'),
(58, '0151-1807', 'Humanisme et Renaissance', 'trimestriel', '1934-1940'),
(59, '1245-8708', 'Jazz', 'mensuel', '1929-1931'),
(60, '1261-5668', 'Journal des artistes', '', '1882-1909'),
(61, NULL, 'Journal des internés français en Suisse', '', ''),
(62, NULL, 'Kunst und Künstler', '', '1903-1933'),
(63, '1256-2971', 'L''Alsacien-Lorrain', '', '1880-1903'),
(64, '1954-6351', 'L''Amateur d''estampes', '', '1921-1934'),
(65, NULL, 'L''Amateur d''estampes', '', '1898-XXXX'),
(66, '1622-3462', 'L''Amour de l''art', 'mensuel', '1920-1938'),
(67, '1622-3489', 'L''Amour de l''art', 'mensuel', '1945-XXXX'),
(68, '1280-4754', 'L''Architecte', '', '1873-1897'),
(69, '0766-5490', 'L''Architecte', 'mensuel', '1906-1935'),
(70, '0766-6292', 'L''Architecture', 'hebdomadaire', '1888-1939'),
(71, '1144-1658', 'L''Art', '', '1875-1907'),
(72, '1149-4840', 'L''Art', '', '1929-1931'),
(73, NULL, 'L''Art à l''école', '', '1908-XXXX'),
(74, NULL, 'L''Art belge', '', '1919-XXXX'),
(75, '1638-8879', 'L''Art d''aujourd''hui', '', '1924-1929'),
(76, '1149-4921', 'L''Art dans les deux mondes', '', '1890-1891'),
(77, '1256-1134', 'L''Art décoratif', '', '1898-1914'),
(78, '1280-4789', 'L''Art décoratif moderne', '', '1894-1898'),
(79, '1280-4789', 'Art décoratif moderne. L''Architecte', '', '1894-1898'),
(80, '0004-3176', 'L''Art et la mode', '', '1880-XXXX'),
(81, '1153-4028', 'L''Art et la vie', '', '1892-1897'),
(82, NULL, 'L''Art et les Artistes', '', '1905-1939'),
(83, NULL, 'L''Art et ses amateurs', '', '1898-XXXX'),
(84, '2021-2011', 'L''Art pour tous', '', '1861-1906'),
(85, '0240-2750', 'L''Artiste', '', '1831-1904'),
(86, '0774-2541', 'L''Art Moderne', '', '1881-1914'),
(87, NULL, 'L''Art social', '', '1913-1914'),
(88, '2260-8419', 'L''Art social', '', '1891-1896'),
(89, NULL, 'L''Art social', '', '1906-1906'),
(90, '0774-4781', 'L''Art universel', 'bimensuel', '1873-1876'),
(91, '1149-4905', 'L''Art vivant', 'bimensuel', '1925-1939'),
(92, '1956-9874', 'L''Echo de la semaine', '', '1888-1901'),
(93, '1956-9890', 'L''Echo de la semaine', '', '1897-1899'),
(94, '1168-4224', 'L''Eclair', '', '1889-1926'),
(95, '1168-4232', 'L''Eclair, supplément littéraire illustré', '', '1894-1897'),
(96, '2425-1860', 'L''Enfant', '', '1891-1936'),
(97, '1256-3935', 'L''Enseignement secondaire', '', '1890-XXXX'),
(98, '2019-0107', 'L''Ermitage', '', '1890-1906'),
(99, NULL, 'L''Estampe et l''affiche', 'mensuel', '1897-1899'),
(100, '1246-6670', 'L''Européen', '', '1901-1906'),
(101, NULL, 'L''Exportateur français', '', '1916-1959'),
(102, '1257-6778', 'L''Idée libre', '', '1892-1895'),
(103, '0246-9251', 'L''Illustration', '', '1843-1944'),
(104, '1954-6238', 'L''Image', '', '1896-1897'),
(105, '1270-6477', 'L''Indépendant littéraire', '', '1886-1890'),
(106, '2267-6139', 'L''hémicycle', '', '1900-1902'),
(107, '0242-6870', 'L''Humanité', 'quotidien', '1904-XXXX'),
(108, '2101-1982', 'L''Humanité nouvelle', '', '1897-1906'),
(109, '1146-9285', 'L''Univers israélite', '', '1849-1940'),
(110, '0996-0120', 'Larousse mensuel illustré', '', '1907-1957'),
(111, NULL, 'La Basoche', '', '1884-1886'),
(112, '1958-6329', 'La Chronique des arts', '', '1956-2002'),
(113, '1144-1267', 'La Chronique des arts et de la curiosité', '', '1861-1922'),
(114, '1145-0053', 'La Coupe', '', '1895-1898'),
(115, '1150-0328', 'La Cravache parisienne', '', '1881-XXXX'),
(116, NULL, 'La France libre', '', '1918-XXXX'),
(117, '1256-0138', 'La Fronde', '', '1897-1930'),
(118, '2128-8372', 'La Gerbe', '', '1918-XXXX'),
(119, '2022-7086', 'La Grande dame', '', '1893-1900'),
(120, '0777-2882', 'La Jeune Belgique', '', '1880-1897'),
(121, '1245-6853', 'La Jeune France', '', '1878-1888'),
(122, '1153-6063', 'La Lecture', '', '1887-1901'),
(123, '1146-965X', 'La Lorraine artiste', '', '1888-XXXX'),
(124, '1146-965X', 'La Lorraine artiste et littéraire', '', '1888-XXXX'),
(125, '1146-965X', 'La Lorraine artiste, littéraire, industrielle', '', '1888-XXXX'),
(126, '0995-791X', 'La Mère éducatrice', '', '1917-XXXX'),
(127, '0834-4566', 'La Minerve', '', '1826-1899'),
(128, '2018-5588', 'La Muse française', '', '1922-1940'),
(129, '0184-7465', 'La Nouvelle revue', 'bimensuel', '1879-1940'),
(130, '0029-4802', 'La Nouvelle revue française', '', '1908-XXXX'),
(131, NULL, 'La Plume', '', '1889-1914'),
(132, NULL, 'La Renaissance d''Occident', '', '1920-XXXX'),
(133, '1257-5933', 'La République française', '', '1871-1924'),
(134, '1257-5933', 'La République', '', '1900-1902'),
(135, '1256-1118', 'La Revue artistique, littéraire et industrielle', '', '1896-1901'),
(136, NULL, 'La Revue artistique de la famille', '', '1895-XXXX'),
(137, NULL, 'La Revue belge', '', '1918-1920'),
(138, '1245-6470', 'La Revue contemporaine', '', '1885-1886'),
(139, '1261-565X', 'La Revue d''art', '', '1899-1900'),
(140, '1257-6794', 'La Revue d''art et de littérature', '', '1892-1893'),
(141, NULL, 'La Revue de Hollande', '', '1915-1918'),
(142, NULL, 'La Revue de l''art ancien et moderne', '', '1897-1937'),
(143, NULL, 'La revue de la femme', '', '1928-1928'),
(144, '0482-7872', 'La Revue des arts', '', '1951-1960'),
(145, '1261-5676', 'La Revue des beaux-arts', '', '1889-1899'),
(146, '1261-5676', 'La Revue des beaux-arts et des lettres', '', ''),
(147, '1261-5641', 'La Revue des beaux-arts', '', '1906-1906'),
(148, '1153-8287', 'La Revue des études', '', '1877-1878'),
(149, '1245-818X', 'La Revue des lettres et des arts', '', '1908-1910'),
(150, '0768-1593', 'La Revue musicale', '', '1920-1991'),
(151, '2025-5195', 'La Société nouvelle', '', '1884-1896'),
(152, '2101-1982', 'La Société nouvelle', '', ''),
(153, '2425-3278', 'La Vie', '', '1911-1942'),
(154, '1149-3798', 'La Vie moderne', '', '1879-XXXX'),
(155, '1273-9154', 'La Vie populaire', '', '1880-XXXX'),
(156, '0337-6249', 'La Vie urbaine', '', '1919-1978'),
(157, NULL, 'La Ville de Paris', '', '1880-XXXX'),
(158, '1149-9834', 'La Vogue', '', '1886-1901'),
(159, '2257-8536', 'La Voix', '', '1928-1930'),
(160, NULL, 'La Volonté', 'quotidien', '1898-1899'),
(161, '1370-4966', 'La Wallonie', 'mensuel', '1886-1892'),
(162, '1775-2949', 'Le XIXe siècle', 'quotidien', '1871-1921'),
(163, '2016-1530', 'Le Bon plaisir', '', '1922-1939'),
(164, '1761-5682', 'Le Bulletin de l''art ancien et moderne', '', '1899-1935'),
(165, '2020-6445', 'Le Bulletin de la vie artistique', '', '1919-1926'),
(166, '2275-9905', 'Le Carnet des artistes', '', '1917-1917'),
(167, '1149-3003', 'Le Chat noir', '', '1882-1889'),
(168, '2030-4919', 'Le Coq rouge', '', '1895-1897'),
(169, '0751-5553', 'Le Crapouillot', '', '1915-1996'),
(170, NULL, 'Le Dessin', '', '1929-1948'),
(171, '1149-204X', 'Le Divan', '', '1909-1958'),
(172, '1149-204X', 'Le Divan aux écrivains morts pour la France', '', '1915-1918'),
(173, '0182-5852', 'Le Figaro', 'quotidien', '1854-XXXX'),
(174, '1160-8528', 'Le Figaro illustré', '', '1883-1911'),
(175, '0223-3894', 'Le Figaro, supplément littéraire', '', '1876-1929'),
(176, '2024-4967', 'Le Fou', 'hebdomadaire', '1883-1883'),
(177, NULL, 'Le français quotidien', '', '1895-1896'),
(178, NULL, 'Le français', '', '1895-1896'),
(179, NULL, 'Le Gaulois', '', '1857-1861'),
(180, '1160-8404', 'Le Gaulois', 'quotidien', '1868-1929'),
(181, '1149-8560', 'Le Japon artistique', '', '1888-1891'),
(182, '1144-1275', 'Le Journal des arts', '', '1879-1932'),
(183, '1144-1305', 'Le Journal des arts', '', '1940-1941'),
(184, '0983-4079', 'Le Manuscrit autographe', '', '1926-1933'),
(185, '1784-4347', 'Le Masque', '', '1910-1914'),
(186, '1256-0359', 'Le Matin', 'quotidien', '1884-1944'),
(187, '2260-8273', 'Le Musée', 'mensuel', '1904-1925'),
(188, NULL, 'Le National', '', '1869-XXXX'),
(189, NULL, 'Le Petit Messager des Arts et des Artistes, et des Industries d''art', '', '1915-1922'),
(190, '0999-2707', 'Le Petit Parisien', '', '1876-1944'),
(191, '0996-2948', 'Le Petit Parisien, supplément littéraire illustré', '', '1889-1912'),
(192, NULL, 'Le Progrès artistique', '', '1878-XXXX'),
(193, NULL, 'Le Progrès Artistique et littéraire', '', '1891-1892'),
(194, '1963-4234', 'Le Progrès de l''Est', '', '1870-1900'),
(195, '1154-0397', 'Le Progrès médical, supplément illustré', '', '1924-1937'),
(196, NULL, 'Le Rapide', '', '1892-XXXX'),
(197, '2115-3175', 'Le Rappel des travailleurs des villes et des campagnes', '', '1895-XXXX'),
(198, '2113-4200', 'Le Réveil', '', '1877-1922'),
(199, '2418-1579', 'Le Semeur', '', '1906-1907'),
(200, '1150-1073', 'Le Temps', 'quotidien', '1861-1942'),
(201, NULL, 'Le Tireur de l''Est', '', '1882-1884'),
(202, '2138-8350', 'Le Travail', '', '1919-1935'),
(203, '1257-6263', 'Le Voltaire', '', '1878-XXXX'),
(204, '2258-3971', 'Le Voltaire, supplément illustré', '', '1880-1896'),
(205, '2258-3971', 'Le Voltaire illustré', '', '1880-1896'),
(206, '2022-8872', 'Les Amis de Paris', '', '1911-1923'),
(207, NULL, 'Les Arts', '', '1902-1920'),
(208, NULL, 'Les Arts de la vie', '', '1904-1905'),
(209, '1280-4770', 'Les Arts du métal : métaux précieux et bronzes', '', '1892-1894'),
(210, '2102-5037', 'Les Arts français', '', '1917-1919'),
(211, NULL, 'Les Beaux-arts', '', '1942-1944'),
(212, '2272-6152', 'Les Cahiers de la République des lettres, des sciences et des arts', '', '1926-XXXX'),
(213, '0772-3768', 'Les Cahiers du Nord', '', '1937-1957'),
(214, NULL, 'Les Idées modernes', '', '1909-1909'),
(215, '0755-8538', 'Les Maîtres artistes', '', '1901-1903'),
(216, NULL, 'Les Modes', '', '1901-1937'),
(217, '1144-1194', 'Les musées de France', '', '1911-1914'),
(218, '0223-3126', 'Les Nouvelles littéraires, artistiques et scientifiques', '', '1922-1958'),
(219, '1157-0628', 'Mémoires de l''Académie de Stanislas', '', '1853-XXXX'),
(220, '0999-3835', 'Mémoires de la Société bourguignonne de géographie et d''histoire', '', '1884-1914'),
(221, '1149-0292', 'Mercure de France', '', '1890-1965'),
(222, '0369-1349', 'Mouseion', '', '1927-1947'),
(223, '1261-5692', 'Moniteur des arts', '', '1858-1899'),
(224, '1261-5692', 'Moniteur des arts illustrés', '', '1897-1897'),
(225, '1261-5692', 'Moniteur des arts et des ventes de l''hôtel Drouot', '', '1858-1899'),
(226, '1261-5692', 'Moniteur des arts et des ventes artistiques', '', '1858-1899'),
(227, '1144-1216', 'Musées de France', '', '1948-1950'),
(228, NULL, 'Musée des deux-mondes', '', '1873-1877'),
(229, '1144-1178', 'Musées et monuments de France', '', '1906-1907'),
(230, '2100-8167', 'Nancy-théâtre : journal artistique et littéraire', '', '1880-1880'),
(231, NULL, 'Notes sur les arts', '', '1911-1913'),
(232, '1248-4415', 'La Grande revue', '', ''),
(233, '1248-4431', 'Pages libres', '', '1901-1940'),
(234, '2025-3729', 'Pan', '', '1895-1895'),
(235, NULL, 'Paris. Les Arts et les Lettres', '', '1945-1946'),
(236, '1160-8536', 'Paris illustré', '', '1883-XXXX'),
(237, '1248-4148', 'Paris-journal', '', '1908-1933'),
(238, '0555-1803', 'Prisme des arts', '', '1956-1959'),
(239, '1622-3470', 'Prométhée : L''amour de l''art', '', '1938-1940'),
(240, '0996-2743', 'Revue d''histoire moderne et contemporaine', '', '1899-1914'),
(241, '1149-4581', 'Revue de l''Alliance française', '', '1920-1948'),
(242, '0980-613X', 'Revue de l''Amérique latine', '', '1922-1932'),
(243, '0994-8082', 'Revue de l''art français ancien et moderne', '', '1885-1907'),
(244, '2017-7240', 'Revue de l''Université de Lyon', '', '1928-1934'),
(245, '1256-1126', 'Revue des arts décoratifs', '', '1880-1902'),
(246, '1261-5676', 'Revue des beaux-arts et des lettres', '', '1896-1899'),
(247, '0035-1962', 'Revue des deux mondes', '', '1829-1971'),
(248, '1962-5006', 'Revue des études napoléoniennes', '', '1912-1940'),
(249, '1766-8409', 'Revue des nations latines', '', '1916-1919'),
(250, '0996-0074', 'Revue encyclopédique', '', '1890-1900'),
(251, NULL, 'Revue franco-britannique', '', '1919-1920'),
(252, NULL, 'The Anglo-French review', '', '1919-1920'),
(253, '2025-1807', 'Revue illustrée', '', '1885-1912'),
(254, '1775-6014', 'Revue internationale de l''enseignement', '', '1881-1940'),
(255, '0390-6701', 'Revue internationale de sociologie', '', '1893-XXXX'),
(256, '1261-5684', 'Revue populaire des beaux-arts', '', '1897-1899'),
(257, NULL, 'Revue Sud-Américaine', '', '1913-1914'),
(258, '0996-0082', 'Revue universelle', '', '1901-1905'),
(259, '1153-6616', 'Revue universitaire', '', '1892-1957'),
(260, NULL, 'The Studio', '', '1898-1919'),
(261, '0991-6997', 'Toute l''édition', '', '1932-1940'),
(262, '1245-7582', 'Vers et prose', 'trimestriel', '1905-1928'),
(263, NULL, 'Wiener Rundschau', '', '1896-1901'),
(264, '1144-1720', 'Cahiers de l''art sacré', '', '1945-1946'),
(265, '0996-1240', 'Cahiers de La Pierre-qui-Vire', '', '1942-1955'),
(266, NULL, 'Formes, an international review of plastic art', '', '1929-1933'),
(267, NULL, 'Integral', '', '1925-1928'),
(268, '1270-671X', 'L''Art de France', '', '1913-1914'),
(269, NULL, 'L''Art et les métiers', '', '1908-1914'),
(270, NULL, 'L''Art flamand et hollandais', '', '1904-1914'),
(271, '2261-7647', 'L''Art français moderne', '', '1916-1920'),
(272, '1144-1712', 'L''Art sacré', '', '1935-1939'),
(273, '1144-1739', 'L''art sacré : revue mensuelle', '', '1947-1969'),
(274, '1147-6745', 'L''Élan', '', '1915-1916'),
(275, '1146-9528', 'L''Esprit nouveau', '', '1920-1925'),
(276, NULL, 'L''Instant', '', '1918-1919'),
(277, '1149-8250', 'L''Occident', '', '1901-1914'),
(278, '0768-7230', 'Labyrinthe', '', '1944-1986'),
(279, '1270-6728', 'La Belle de France', '', '1919-1919'),
(280, '1270-6736', 'La Douce France', '', '1913-1923'),
(281, '2021-0418', 'La France et la Pologne dans leurs relations artistiques', '', '1938-1939'),
(282, '1256-1479', 'La Renaissance', '', '1913-1931'),
(283, '0184-7996', 'La Renaissance', '', '1928-1939'),
(284, '0184-7988', 'La Renaissance de l''art français et des industries de luxe', '', '1918-1928'),
(285, '1153-3900', 'La Rénovation esthétique', '', '1905-1910'),
(286, '1153-3900', 'La Rénovation', '', '1905-1910'),
(287, '1153-3900', 'La Rénovation esthétique et littéraire', '', '1905-1910'),
(288, NULL, 'La Revue artistique', '', '1910-1914'),
(289, '1955-3633', 'Le Cousin Pons', '', '1916-1928'),
(290, '1160-8943', 'Le Figaro. supplément artistique', '', '1923-1923'),
(291, '1160-896X', 'Le Figaro. supplément artistique illustré', '', '1927-1930'),
(292, '1160-8951', 'Le Figaro artistique', '', '1923-1927'),
(293, '1160-8986', 'Le Figaro artistique illustré', '', '1930-1931'),
(294, '1160-8978', 'Le Figaro illustré', '', '1932-1937'),
(295, '1160-8412', 'Le Gaulois artistique', '', '1926-1929'),
(296, '0702-5939', 'Le Nigog', '', '1918-1918'),
(297, '0768-5955', 'Le Point', '', '1936-1962'),
(298, '1245-9437', 'Les Arts à Paris', '', '1918-1935'),
(299, NULL, 'Les Arts plastiques', '', '1925-1925'),
(300, '1370-4230', 'Les Arts plastiques', '', '1947-1954'),
(301, '1245-8325', 'Les Cahiers d''aujourd''hui', '', '1912-1924'),
(302, '0027-0768', 'Les Monuments historiques de la France', '', '1936-1977'),
(303, '1245-9577', 'Les Soirées de Paris', '', '1912-1914'),
(304, '2018-5170', 'Les Tendances nouvelles', '', '1904-1914'),
(305, '0373-7314', 'Mémoires de la Société nationale des antiquaires de France', '', '1871-1969'),
(306, '0758-3001', 'Minotaure', '', '1933-1939'),
(307, '1245-6713', 'Montjoie !', '', '1913-1914'),
(308, NULL, 'Montparnasse', '', '1914-1930'),
(309, '2019-3912', 'Panorama', '', '1943-1944'),
(310, NULL, 'Partisans', '', '1924-1930'),
(311, NULL, 'Phoebus', '', '1946-1949'),
(312, NULL, 'Pro arte', '', '1942-1951'),
(313, '0765-8869', 'Quadrige', '', '1945-1948'),
(314, '0275-2344', 'Renaissance', '', '1943-1945'),
(315, '0995-7510', 'Revue des arts asiatiques', '', '1924-1942'),
(316, '0983-6330', 'Revue des beaux-arts de France', '', '1942-1944'),
(317, '2427-1942', 'Revue internationale de l''esprit nouveau', '', '1927-1927'),
(318, NULL, 'Sélection. Atelier d''art contemporain', '', '1920-1933'),
(319, '0996-1240', 'Témoignages', '', '1942-1955'),
(320, '1145-8720', 'Verve', '', '1937-1960'),
(321, '1145-8739', 'Verve : an artistic and literary quarterly', '', '1937-1960'),
(322, NULL, 'Vouloir', '', '1924-1927'),
(323, NULL, 'Cahiers de la Revue critique', '', '1926-1926'),
(324, '1247-6757', 'Comoedia', '', '1907-1944'),
(325, '1249-7819', 'Comoedia illustré', '', '1929-XXXX'),
(326, '1147-6796', 'Commune', '', '1933-1939'),
(327, '0996-2166', 'Femina', '', '1901-XXXX'),
(328, '0999-2685', 'Femina', '', '1922-1954'),
(329, '1255-9792', 'L''Aurore', '', '1897-1914'),
(330, '1256-0189', 'L''Intransigeant', '', '1880-1948'),
(331, '0221-1769', 'littérature', '', '1919-1924'),
(332, '1779-6229', 'La Dépêche de Rouen et de Normandie', '', '1903-XXXX'),
(333, '1153-608X', 'La Renaissance latine', '', '1902-1905'),
(334, '2017-6775', 'La Revue critique des idées et des livre', '', '1908-1924'),
(335, '0223-3274', 'La Revue de Paris', '', '1894-1970'),
(336, '1147-6818', 'La Revue européenne', '', '1923-1931'),
(337, '0151-1882', 'La Revue hebdomadaire', '', '1892-1939'),
(338, '0779-214X', 'Le Disque vert', '', '1922-1922'),
(339, '0779-2174', 'Le Disque vert', '', '1923-1925'),
(340, '0779-2212', 'Le Disque vert', '', '1941-1955'),
(341, NULL, 'Le Rempart', '', '1933-1933'),
(342, '1147-680X', 'Les écrits nouveaux', '', '1917-1922'),
(343, '2021-5924', 'Les Feuilles libres', '', '1918-1928'),
(344, NULL, 'Vient de paraître', '', '1921-1931'),
(348, NULL, 'Les maîtres de l''affiche', 'mensuel', '1895-1900');

-- --------------------------------------------------------

--
-- Structure de la table `pseudonyme`
--

CREATE TABLE `pseudonyme` (
`pk_id_pseudonyme` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `utilisation` enum('originale','emprunt') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'originale',
  `fk_id_critiqueDart_signataire` int(11) NOT NULL,
  `fk_id_critiqueDart_depositaire` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `signature`
--

CREATE TABLE `signature` (
`pk_id_signature` int(11) NOT NULL,
  `type` enum('pseudonyme','initiales','patronyme','collectif','anonyme') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'patronyme',
  `fk_id_pseudonyme` int(11) DEFAULT NULL,
  `fk_id_collectif` int(11) DEFAULT NULL,
  `fk_id_critique` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `signature`
--

INSERT INTO `signature` (`pk_id_signature`, `type`, `fk_id_pseudonyme`, `fk_id_collectif`, `fk_id_critique`) VALUES
(1, 'patronyme', NULL, NULL, 2),
(2, 'patronyme', NULL, NULL, 3),
(3, 'patronyme', NULL, NULL, 4),
(4, 'patronyme', NULL, NULL, 5),
(5, 'patronyme', NULL, NULL, 6),
(8, 'patronyme', NULL, NULL, 8),
(9, 'patronyme', NULL, NULL, 9),
(10, 'patronyme', NULL, NULL, 10),
(11, 'patronyme', NULL, NULL, 11),
(12, 'patronyme', NULL, NULL, 12),
(13, 'patronyme', NULL, NULL, 13),
(14, 'patronyme', NULL, NULL, 14),
(15, 'patronyme', NULL, NULL, 15),
(16, 'patronyme', NULL, NULL, 16),
(17, 'patronyme', NULL, NULL, 17),
(18, 'patronyme', NULL, NULL, 18),
(19, 'patronyme', NULL, NULL, 19),
(20, 'patronyme', NULL, NULL, 20),
(21, 'patronyme', NULL, NULL, 21),
(22, 'patronyme', NULL, NULL, 22),
(23, 'patronyme', NULL, NULL, 23),
(24, 'patronyme', NULL, NULL, 24),
(25, 'patronyme', NULL, NULL, 25),
(26, 'patronyme', NULL, NULL, 26),
(27, 'patronyme', NULL, NULL, 27);

-- --------------------------------------------------------

--
-- Structure de la table `specialisteauteur`
--

CREATE TABLE `specialisteauteur` (
  `fk_id_chercheur` int(11) NOT NULL,
  `fk_id_critiqueDart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `specialistecollectif`
--

CREATE TABLE `specialistecollectif` (
  `fk_id_chercheur` int(11) NOT NULL,
  `fk_id_collectif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Uniquement les collectifs nommés';

--
-- Index pour les tables exportées
--

--
-- Index pour la table `chercheur`
--
ALTER TABLE `chercheur`
 ADD PRIMARY KEY (`pk_id_chercheur`);

--
-- Index pour la table `collectif`
--
ALTER TABLE `collectif`
 ADD PRIMARY KEY (`pk_id_collectif`);

--
-- Index pour la table `compositionsignature`
--
ALTER TABLE `compositionsignature`
 ADD PRIMARY KEY (`fk_id_signature`,`fk_id_critiquedart`), ADD KEY `fk_id_critiquedart` (`fk_id_critiquedart`);

--
-- Index pour la table `critique`
--
ALTER TABLE `critique`
 ADD PRIMARY KEY (`pk_id_critique`), ADD KEY `fk_id_ouvrage` (`fk_id_ouvrage`,`fk_id_numeroperiodique`), ADD KEY `fk_id_numeroperiodique` (`fk_id_numeroperiodique`);

--
-- Index pour la table `critiquedart`
--
ALTER TABLE `critiquedart`
 ADD PRIMARY KEY (`pk_id_critiqueDart`);

--
-- Index pour la table `editeur`
--
ALTER TABLE `editeur`
 ADD PRIMARY KEY (`pk_id_editeur`);

--
-- Index pour la table `numeroperiodique`
--
ALTER TABLE `numeroperiodique`
 ADD PRIMARY KEY (`pk_id_numero_periodique`), ADD KEY `fk_id_periodique` (`fk_id_periodique`);

--
-- Index pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
 ADD PRIMARY KEY (`pk_id_ouvrage`), ADD KEY `fk_id_editeur` (`fk_id_editeur`);

--
-- Index pour la table `periodique`
--
ALTER TABLE `periodique`
 ADD PRIMARY KEY (`pk_id_periodique`);

--
-- Index pour la table `pseudonyme`
--
ALTER TABLE `pseudonyme`
 ADD PRIMARY KEY (`pk_id_pseudonyme`), ADD KEY `fk_id_critiqueDart_signataire` (`fk_id_critiqueDart_signataire`,`fk_id_critiqueDart_depositaire`), ADD KEY `fk_id_critiqueDart_depositaire` (`fk_id_critiqueDart_depositaire`);

--
-- Index pour la table `signature`
--
ALTER TABLE `signature`
 ADD PRIMARY KEY (`pk_id_signature`), ADD KEY `fk_id_critiqueDart` (`fk_id_pseudonyme`,`fk_id_collectif`), ADD KEY `fk_id_collectif` (`fk_id_collectif`), ADD KEY `fk_id_pseudonyme` (`fk_id_pseudonyme`), ADD KEY `fk_id_critique` (`fk_id_critique`);

--
-- Index pour la table `specialisteauteur`
--
ALTER TABLE `specialisteauteur`
 ADD PRIMARY KEY (`fk_id_chercheur`,`fk_id_critiqueDart`), ADD KEY `fk_id_chercheur` (`fk_id_chercheur`), ADD KEY `fk_id_critiqueDart` (`fk_id_critiqueDart`);

--
-- Index pour la table `specialistecollectif`
--
ALTER TABLE `specialistecollectif`
 ADD PRIMARY KEY (`fk_id_chercheur`,`fk_id_collectif`), ADD KEY `fk_id_chercheur` (`fk_id_chercheur`,`fk_id_collectif`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `collectif`
--
ALTER TABLE `collectif`
MODIFY `pk_id_collectif` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `critique`
--
ALTER TABLE `critique`
MODIFY `pk_id_critique` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `critiquedart`
--
ALTER TABLE `critiquedart`
MODIFY `pk_id_critiqueDart` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `editeur`
--
ALTER TABLE `editeur`
MODIFY `pk_id_editeur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `numeroperiodique`
--
ALTER TABLE `numeroperiodique`
MODIFY `pk_id_numero_periodique` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
MODIFY `pk_id_ouvrage` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `periodique`
--
ALTER TABLE `periodique`
MODIFY `pk_id_periodique` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=349;
--
-- AUTO_INCREMENT pour la table `pseudonyme`
--
ALTER TABLE `pseudonyme`
MODIFY `pk_id_pseudonyme` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `signature`
--
ALTER TABLE `signature`
MODIFY `pk_id_signature` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `compositionsignature`
--
ALTER TABLE `compositionsignature`
ADD CONSTRAINT `compositionsignature_ibfk_1` FOREIGN KEY (`fk_id_signature`) REFERENCES `signature` (`pk_id_signature`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `compositionsignature_ibfk_2` FOREIGN KEY (`fk_id_critiquedart`) REFERENCES `critiquedart` (`pk_id_critiqueDart`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `critique`
--
ALTER TABLE `critique`
ADD CONSTRAINT `critique_ibfk_1` FOREIGN KEY (`fk_id_ouvrage`) REFERENCES `ouvrage` (`pk_id_ouvrage`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `critique_ibfk_4` FOREIGN KEY (`fk_id_numeroperiodique`) REFERENCES `numeroperiodique` (`pk_id_numero_periodique`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `numeroperiodique`
--
ALTER TABLE `numeroperiodique`
ADD CONSTRAINT `numeroperiodique_ibfk_1` FOREIGN KEY (`fk_id_periodique`) REFERENCES `periodique` (`pk_id_periodique`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
ADD CONSTRAINT `ouvrage_ibfk_1` FOREIGN KEY (`fk_id_editeur`) REFERENCES `editeur` (`pk_id_editeur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `pseudonyme`
--
ALTER TABLE `pseudonyme`
ADD CONSTRAINT `pseudonyme_ibfk_1` FOREIGN KEY (`fk_id_critiqueDart_signataire`) REFERENCES `critiquedart` (`pk_id_critiqueDart`),
ADD CONSTRAINT `pseudonyme_ibfk_2` FOREIGN KEY (`fk_id_critiqueDart_depositaire`) REFERENCES `critiquedart` (`pk_id_critiqueDart`);

--
-- Contraintes pour la table `signature`
--
ALTER TABLE `signature`
ADD CONSTRAINT `signature_ibfk_1` FOREIGN KEY (`fk_id_critique`) REFERENCES `critique` (`pk_id_critique`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `specialistecollectif`
--
ALTER TABLE `specialistecollectif`
ADD CONSTRAINT `specialistecollectif_ibfk_1` FOREIGN KEY (`fk_id_chercheur`) REFERENCES `chercheur` (`pk_id_chercheur`) ON DELETE CASCADE ON UPDATE CASCADE;