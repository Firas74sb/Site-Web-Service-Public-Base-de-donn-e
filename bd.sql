/* Jeu de données Projet-Service Public */
/* Suppression des tables */
DROP TABLE IF EXISTS `REGION`;
DROP TABLE IF EXISTS `DEPARTEMENT`;
DROP TABLE IF EXISTS `COMMUNE`;
DROP TABLE IF EXISTS `SERVICE`;
DROP TABLE IF EXISTS `PROPOSE`;
DROP TABLE IF EXISTS `DEMANDE`;
DROP TABLE IF EXISTS `CITOYEN`;
DROP TABLE IF EXISTS `ENFANT`;
DROP TABLE IF EXISTS `LIEUX`;
DROP TABLE IF EXISTS `CANTINE`;
DROP TABLE IF EXISTS `MANGER`;

/* Création des tables */
CREATE TABLE `REGION` (
  INSEE_Region INT NOT NULL PRIMARY KEY,
  nomRegion    VARCHAR(42)
);
CREATE TABLE `DEPARTEMENT` (
  INSEE_Departement INT NOT NULL PRIMARY KEY,
  nomDepartement    VARCHAR(42),
  INSEE_Region      INT NOT NULL REFERENCES `REGION`(INSEE_Region)
);
CREATE TABLE `COMMUNE` (
  INSEE_Commune     INT NOT NULL PRIMARY KEY,
  nomCommune        VARCHAR(42),
  code_postal       VARCHAR(5),
  latitude_C        FLOAT,
  longitude_C       FLOAT,
  INSEE_Departement INT NOT NULL REFERENCES `DEPARTEMENT`(INSEE_Departement)
);
CREATE TABLE `SERVICE` (
  idService           INT NOT NULL PRIMARY KEY,
  type_Service        VARCHAR(42)
);
CREATE TABLE `PROPOSE` (
  PRIMARY KEY (INSEE_Commune, idService),
  INSEE_Commune INT NOT NULL REFERENCES `COMMUNE`(INSEE_Commune),
  idService     INT NOT NULL REFERENCES `SERVICE`(idService),
  dureeSiEssai  INT NULL
);

CREATE TABLE `CITOYEN` (
  idCitoyen         INT NOT NULL PRIMARY KEY,
  nomCitoyen        VARCHAR(42),
  prenomCitoyen     VARCHAR(42)
);
CREATE TABLE `DEMANDE` (
  idDemande             INT NOT NULL PRIMARY KEY,
  idCitoyen             INT NOT NULL REFERENCES `CITOYEN`(idCitoyen),
  idService             INT NOT NULL REFERENCES `SERVICE`(idService),
  INSEE_Commune         INT NOT NULL REFERENCES `COMMUNE`(INSEE_Commune)
);
CREATE TABLE `ENFANT` (
  idEnfant              INT NOT NULL PRIMARY KEY,
  nomEnfant             VARCHAR(42),
  prenomEnfant          VARCHAR(42),
  idLieu                INT NOT NULL REFERENCES `LIEUX`(idLieu)
);
CREATE TABLE `LIEUX` (
  idLieu      INT NOT NULL PRIMARY KEY,
  nomLieu     VARCHAR(42),
  type_Lieu   VARCHAR(42)
);
CREATE TABLE `CANTINE` (
  idCantine         INT NOT NULL PRIMARY KEY,
  nomCantine        VARCHAR(42)
);
CREATE TABLE `MANGER` (
 idEnfant            INT NOT NULL REFERENCES `ENFANT`(idEnfant),
 idCantine           INT NOT NULL REFERENCES `CANTINE`(idCantine) ,
 dateDebut           DATE,
 dateFin             DATE
);
 
/* Insértion de données de base dans les tables */
/* 18 Régions [FULL] */
INSERT INTO `REGION` VALUES (84, 'Auvergne-Rhône-Alpes');
INSERT INTO `REGION` VALUES (27, 'Bourgogne-Franche-Comté');
INSERT INTO `REGION` VALUES (53, 'Bretagne');
INSERT INTO `REGION` VALUES (24, 'Centre-Val de Loire');
INSERT INTO `REGION` VALUES (94, 'Corse');
INSERT INTO `REGION` VALUES (44, 'Grand-Est');
INSERT INTO `REGION` VALUES (01, 'Guadeloupe');
INSERT INTO `REGION` VALUES (03, 'Guyane');
INSERT INTO `REGION` VALUES (32, 'Hauts-de-France');
INSERT INTO `REGION` VALUES (11, 'Île-de-France');
INSERT INTO `REGION` VALUES (04, 'La Réunion');
INSERT INTO `REGION` VALUES (02, 'Martinique');
INSERT INTO `REGION` VALUES (06, 'Mayotte');
INSERT INTO `REGION` VALUES (28, 'Normandie');
INSERT INTO `REGION` VALUES (75, 'Nouvelle-Aquitaine');
INSERT INTO `REGION` VALUES (76, 'Occitanie'); 
INSERT INTO `REGION` VALUES (52, 'Pays de la Loire');
INSERT INTO `REGION` VALUES (93, 'Provence-Alpes-Côte d\'Azur');

/* Departement 6 dans Iles de France, Grand Est, Auvergne */

/* 6 Commune pour Paris, Rhone, Meurthe-et-moselle */

/* 6 Services [FULL] */
INSERT INTO `SERVICE` VALUES (1, 'Scolaire');
INSERT INTO `SERVICE` VALUES (2, 'Élection');
INSERT INTO `SERVICE` VALUES (3, 'Restauration');
INSERT INTO `SERVICE` VALUES (4, 'Signalement');
INSERT INTO `SERVICE` VALUES (5, 'Union');
INSERT INTO `SERVICE` VALUES (6, 'État civil');

/* Services porpose par les communces */

/* Insertion de lieux et ecoles */
INSERT INTO `LIEUX` VALUES (1, 'Ecole maternelle Albert-Camus', 'Ecole');
INSERT INTO `LIEUX` VALUES (2, 'Ecole primaire Charles Perrault', 'Ecole');
INSERT INTO `LIEUX` VALUES (3, 'Ecole élémentaire Rosa-Parks', 'Ecole');
INSERT INTO `LIEUX` VALUES (4, 'Collége de Jean Moulin', 'Ecole');
INSERT INTO `LIEUX` VALUES (5, 'Lycée du Vieux Lyon', 'Ecole');

/* Insertion de cantine */
INSERT INTO `CANTINE` VALUES (1, 'Cantine du Rocher');
INSERT INTO `CANTINE` VALUES (2, 'Cantine de la chute d\'eau');
INSERT INTO `CANTINE` VALUES (3, 'Cantine de la feuille');
INSERT INTO `CANTINE` VALUES (4, 'Cantine du Mont d\'Or');

/* Insertion d'enfant */
INSERT INTO `ENFANT` VALUES (1, 'Élisa', 'LaRue', 2);
INSERT INTO `ENFANT` VALUES (2, 'Claudia', 'Boudet', 1);
INSERT INTO `ENFANT` VALUES (3, 'Tourneur', 'Lortie', 3);
INSERT INTO `ENFANT` VALUES (4, 'Claudia', 'Lortie', 1);
INSERT INTO `ENFANT` VALUES (5, 'Élisa', 'Sandraue', 1);
INSERT INTO `ENFANT` VALUES (6, 'Poincaré', 'Gaétan', 2);
INSERT INTO `ENFANT` VALUES (7, 'Tonnelier', 'Richard', 2);
INSERT INTO `ENFANT` VALUES (8, 'Philippon', 'Josué', 2);
INSERT INTO `ENFANT` VALUES (9, 'Boissieu', 'Médard', 2);
INSERT INTO `ENFANT` VALUES (10, 'Coulomb', 'Noé', 5);
INSERT INTO `ENFANT` VALUES (11, 'Fouquet', 'Marine',3);
INSERT INTO `ENFANT` VALUES (12, 'Bernier', 'Marie-Claire',3);
INSERT INTO `ENFANT` VALUES (13, 'Jullien', 'Radegonde',3);
INSERT INTO `ENFANT` VALUES (14, 'Rossignol', 'Sigolène',3);
INSERT INTO `ENFANT` VALUES (15, 'Bruguière', 'Paola', 5);
INSERT INTO `ENFANT` VALUES (16, 'Bouhier', 'Léonie', 4);
INSERT INTO `ENFANT` VALUES (17, 'Delafosse', 'Lucie', 5);
INSERT INTO `ENFANT` VALUES (18, 'Bettencourt', 'Barbara', 4);
INSERT INTO `ENFANT` VALUES (19, 'Beauvau', 'Noëlle', 4);
INSERT INTO `ENFANT` VALUES (20, 'Brassard', 'Marion', 4);
INSERT INTO `ENFANT` VALUES (21, 'Élisa', 'LaRue', 4);
INSERT INTO `ENFANT` VALUES (22, 'Claudia', 'Boudet', 5);
INSERT INTO `ENFANT` VALUES (23, 'Tourneur', 'Lortie', 5);
INSERT INTO `ENFANT` VALUES (24, 'Claudia', 'Lortie', 3);
INSERT INTO `ENFANT` VALUES (25, 'Élisa', 'Sandraue', 2);

/* Insertion de Relation Enfant - CANTINE */
INSERT INTO `MANGER` VALUES (1, 1, '2023-09-01', '2023-12-05');
INSERT INTO `MANGER` VALUES (2, 2, '2023-12-06', '2024-08-31');
INSERT INTO `MANGER` VALUES (3, 3, '2023-09-01', '2024-08-31');
INSERT INTO `MANGER` VALUES (4, 4, '2023-09-01', '2023-12-05');
INSERT INTO `MANGER` VALUES (5, 1, '2023-12-06', '2024-08-31');
INSERT INTO `MANGER` VALUES (6, 2, '2023-09-01', '2024-08-31');
INSERT INTO `MANGER` VALUES (7, 3, '2023-09-01', '2023-12-05');
INSERT INTO `MANGER` VALUES (8, 4, '2023-12-06', '2024-08-31');
INSERT INTO `MANGER` VALUES (9, 1, '2023-09-01', '2024-08-31');
INSERT INTO `MANGER` VALUES (10, 2, '2023-09-01', '2023-12-05');
INSERT INTO `MANGER` VALUES (11, 3, '2023-12-06', '2024-08-31');
INSERT INTO `MANGER` VALUES (12, 4, '2023-09-01', '2024-08-31');
INSERT INTO `MANGER` VALUES (13, 1, '2023-09-01', '2023-12-05');
INSERT INTO `MANGER` VALUES (14, 2, '2023-12-06', '2024-08-31');
INSERT INTO `MANGER` VALUES (15, 3, '2023-09-01', '2024-08-31');
INSERT INTO `MANGER` VALUES (16, 4, '2023-09-01', '2023-12-05');
INSERT INTO `MANGER` VALUES (17, 1, '2023-12-06', '2024-08-31');
INSERT INTO `MANGER` VALUES (18, 2, '2023-09-01', '2024-08-31');
INSERT INTO `MANGER` VALUES (19, 3, '2023-09-01', '2023-12-05');
INSERT INTO `MANGER` VALUES (20, 4, '2023-12-06', '2024-08-31');
INSERT INTO `MANGER` VALUES (21, 1, '2023-09-01', '2024-08-31');
INSERT INTO `MANGER` VALUES (22, 2, '2023-09-01', '2023-12-05');
INSERT INTO `MANGER` VALUES (23, 3, '2023-12-06', '2024-08-31');
INSERT INTO `MANGER` VALUES (24, 4, '2023-09-01', '2024-08-31');
INSERT INTO `MANGER` VALUES (25, 1, '2023-09-01', '2023-12-05');


/* Insertion de Citoyen.ne.s */
/* Hommes */
INSERT INTO `CITOYEN` VALUES (1, 'Charles', 'Regnard');
INSERT INTO `CITOYEN` VALUES (2, 'Grégoire', 'Thibodeaux');
INSERT INTO `CITOYEN` VALUES (3, 'Alban', 'Marchal');
INSERT INTO `CITOYEN` VALUES (4, 'Isaïe', 'Chappuis');
INSERT INTO `CITOYEN` VALUES (5, 'Alarie', 'Jérôme');
INSERT INTO `CITOYEN` VALUES (6, 'Émeric', 'Lajoie');
INSERT INTO `CITOYEN` VALUES (7, 'Constantin', 'Bethune');
INSERT INTO `CITOYEN` VALUES (8, 'Jordan', 'Robillard');
INSERT INTO `CITOYEN` VALUES (9, 'Pierre-Louis', 'Lièvremont');
INSERT INTO `CITOYEN` VALUES (10, 'Ange', 'Neri');
/* Femmes */
INSERT INTO `CITOYEN` VALUES (11, 'Leblanc', 'Myriam');
INSERT INTO `CITOYEN` VALUES (12, 'Bazalgette', 'Thaïs');
INSERT INTO `CITOYEN` VALUES (13, ' Lecocq', 'Alizée');
INSERT INTO `CITOYEN` VALUES (14, 'Boudreaux', 'Solange');
INSERT INTO `CITOYEN` VALUES (15, 'Portier', 'Mathilde');
INSERT INTO `CITOYEN` VALUES (16, 'Stuart', 'Murielle');
INSERT INTO `CITOYEN` VALUES (17, 'Rousselle', 'Amandine');
INSERT INTO `CITOYEN` VALUES (18, 'D\'Aboville', 'Romaine');
INSERT INTO `CITOYEN` VALUES (19, 'Beauvau', 'Gilberte');
INSERT INTO `CITOYEN` VALUES (20, 'Delafosse', 'Gaëlle'); 

/* Insertion Demande Service par Citoyen Exclusivement dans la Commune de Villeurbanne */
/* 4 Services Scolaire */
INSERT INTO `DEMANDE` VALUES (1, 1, 1, 69266);
INSERT INTO `DEMANDE` VALUES (2, 2, 1, 69266);
INSERT INTO `DEMANDE` VALUES (3, 3, 1, 69266);
INSERT INTO `DEMANDE` VALUES (4, 4, 1, 69266);
/* 3 Services Signalement */
INSERT INTO `DEMANDE` VALUES (5, 5, 4, 69266);
INSERT INTO `DEMANDE` VALUES (6, 6, 4, 69266);
INSERT INTO `DEMANDE` VALUES (7, 7, 4, 69266);
/* 1 Demande Restauration */
INSERT INTO `DEMANDE` VALUES (8, 8, 3, 69266);

/* Test Demande Union 6 */
/* Vileurbanne 3 */
INSERT INTO `DEMANDE` VALUES (9, 9, 5, 69266);
INSERT INTO `DEMANDE` VALUES (10, 10, 5, 69266);
INSERT INTO `DEMANDE` VALUES (11, 11, 5, 69266);
/* Nancy 2 */
INSERT INTO `DEMANDE` VALUES (12, 12, 5, 54395);
INSERT INTO `DEMANDE` VALUES (13, 13, 5, 54395);
/* Venissieux 1 */
INSERT INTO `DEMANDE` VALUES (14, 14, 5, 69259);