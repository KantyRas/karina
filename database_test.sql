-- Admin gestion utilisateur/personnel --
create table roles(
    idrole serial primary key,
    role varchar(75)
);
create table fonctions(
    idfonction serial primary key,
    fonction varchar(255)
);
create table employes(
    idemploye serial primary key,
    nom varchar(75),
    prenom varchar(75),
    matricule varchar(10) unique,
    idfonction int references fonctions(idFonction),
    email varchar(75) unique,
    telephone varchar(10),
    estactif int default 1
);
create table users(
    iduser serial primary key,
    idemploye int references employes(idEmploye) default 0,
    username varchar(75) unique not null,
    email varchar(75) unique not null,
    password varchar(255) not null,
    role int references roles(idRole)
);
create table emplacements(
    idemplacement serial primary key,
    emplacement varchar(75)
);
create table frequences(
    idfrequence serial primary key,
    frequence varchar(75)
);
create table carnets(
    idcarnet serial primary key,
    item varchar(255),
    idfrequence int references frequences(idFrequence)
);
create table carnet_emplacements(
    idcarnetemplacement serial primary key,
    idcarnet int references carnets(idCarnet),
    idemplacement int references emplacements(idEmplacement)
);
create table sous_emplacement(
    idsousemplacement serial primary key,
    idcarnetemplacement int references carnet_emplacements(idCarnetEmplacement),
    localisation varchar(255)
);
create table carnet_employes(
    idcarnetemploye serial primary key,
    idcarnet int references carnets(idCarnet),
    idemploye int references employes(idEmploye)
);
CREATE TABLE fiches(
    idfiche SERIAL PRIMARY KEY,
    idcarnet INT REFERENCES carnets(idCarnet),
    iduser int references users(idUser),
    nomfiche VARCHAR(100) NOT NULL,
    date_creation timestamp default current_timestamp,
    date_dernier_maj timestamp default current_timestamp,
    statut int default 0 -- En cours / Cloturée
);
create table fiche_parametres(
    idficheparametre serial primary key,
    idfiche int references fiches(idFiche),
    parametres varchar(255)
);
create table fiche_details(
    idfichedetail serial primary key,
    idfiche int references fiches(idFiche),
    idemploye int references employes(idEmploye),
    dateajout timestamp default current_timestamp,
    idficheparametre int references fiche_parametres(idFicheParametre),
    valeurs varchar(255);
);
-- Demande achats ou sorties -> stocks --
create table type_demandes(
    idtypedemande serial primary key,
    nomtype varchar(75),
    id_receveur int references users(iduser)
);
insert into type_demandes (nomtype,id_receveur) values
('Maintenance generale',1),
('Informatique',1);

create table type_travaux(
    idtypetravaux serial primary key,
    type varchar(55)
);
insert into type_travaux (type) values
('REPARATION'),
('RENNOVATION'),
('CONFECTION');
create table departements(
    iddepartement serial primary key,
    nom varchar(75),
    responsable varchar(75)
);
insert into departement (nom,responsable) values
('Ressources Humaines','Tsihorisoa Andrianjafinimanana'),
('Administration Finance','Tiana Andrianarisoa'),
('Merchandising Sourcing Achats','Sirajudeen Yousuf'),
('Planning','Tahiana Rakotomalala'),
('Developpement Produit','Tantely Randrianirina'),
('Qualite','Arun Govind'),
('Compliance','Aartee Jeebun'),
('Montage Services','Vishal Soumber'),
('Valeur Ajoutée','Sheila Soumber'),
('Finition','Sheila Soumber'),
('Coupe','Sheila Soumber'),
('Technologie Informatique','Abel Randriamalala'),
('Visuel','Sheila Soumber'),
('Transit','Haingo Andrianarivo'),
('Maintenance','Jean Cloud Mbelo Ndriamanampy');

create table sections(
    idsection serial primary key,
    iddepartement int references departements(iddepartement),
    nomsection varchar(75)
);
insert into sections (iddepartement,nomsection) values
(1,'Personnel'),
(1,'Femmes de menage'),
(1,'Securite'),
(1,'Transport'),
(2,'Comptabilite'),
(2,'Controleur de Gestion'),
(2,'Grand Magasin Accessoires'),
(2,'Grand Magasin Tissu'),
(2,'Achat Fournitures Consommables'),
(3,'Merchandising'),
(3,'Achats Tissus'),
(3,'Achats Accessoires Production'),
(4,'Sec_Planning'),
(4,'Qmo'),
(4,'Seam'),
(5,'Patronage'),
(5,'Echantillonage'),
(6,'Laboratoires'),
(6,'Controle Tissus'),
(6,'Qualite Echantillonnage'),
(6,'Qualite pre-production'),
(6,'Qualite coupe thermo biais'),
(6,'Qualite valeus ajoutees'),
(6,'Qualite confection montage'),
(6,'Inspection avant apres Lavage'),
(6,'Qualite lavage teinture'),
(6,'Qualite finition mise en carton'),
(6,'Assurance qualite montage'),
(6,'Assurance qualite finition'),
(6,'Assurance qualite finale'),
(6,'Qualite 1er_choix 2nd_choix'),
(6,'Qualite sous-traitance'),
(7,'Audit interne'),
(7,'Sec_compliance'),
(8,'Packing'),
(8,'Montage'),
(8,'Temps Méthodes'),
(8,'Pré-production'),
(8,'Mécanique'),
(9,'Sérigraphie'),
(9,'Broderie machine'),
(9,'Broderie main'),
(10,'Transfert'),
(10,'Lavage'),
(10,'Finition'),
(10,'Produits finis'),
(10,'Mise en carton'),
(11,'Smocks'),
(11,'Biais'),
(11,'Coupe'),
(11,'Thermocollage'),
(11,'Préparation après coupe'),
(11,'Magasin coupe'),
(12,'Technologie informatique'),
(13,'Visuel'),
(14,'Transit'),
(15,'Maintenance');

create table demande_travaux(
    iddemandetravaux serial primary key,
    idsection int references sections(idsection),
    idtypedemande int references type_demandes(idtypedemande),
    idtypetravaux int references type_travaux(idtypetravaux),
    iddemandeur int references users(idUser),
    datedemande date,
    datesouhaite date,
    numeroserie varchar(100),
    statut int,
    motif text,
    description text
);
create table fiche_joints_travaux(
    idfichejoint serial primary key,
    fichier varchar(155),
    iddemandetravaux int references demande_travaux(idtypedemande),
);

create table demande_achats(
    iddemandeachat serial primary key,
    iddemandeur int references users(idUser),   -- demandeur --
    idreceveur int references users(idUser),    -- receveur (achat -> responsable achat & sortie -> responsable magasin) --
    idtypedemande int references type_demandes(idTypeDemande),
    datedemande date,
    description text
);

create table detail_articles(
    idarticledemande serial primary key,
    iddemandeachat int references demandes(idDemande),
    idarticle int references articles(idArticle),
    quantitedemande double precision
);

-- Interventions --
create table type_interventions(
    idtypeintervention serial primary key,
    type varchar(75) default 'Autres'
);

create table demande_interventions(  -- demande en cours --
    iddemandeintervention serial primary key,
    iddemandeur int references users(idUser), -- celui qui a besoin de l'intervention de la maintenance
    idreceveur int references users(idUser), -- admin application Laravel (maintenance) = chef de departement maintenance
    idequipement int references equipements(idEquipement),
    datedemande timestamp default current_time,
    description text,
    statut int default 0  -- (0=en attente, 1=validé par le dept_maintenance, 3=rejetté)
);
create table fiche_interventions(
    idficheintervention serial primary key,
    iddemandeintervention int references demande_interventions(idDemandeIntervention),
    idtypeintervention int references type_interventions(idTypeIntervention),
    idemployeassigne int references employes(idEmploye),
    dateplanifie date,
    date_intervention date
);
-- Gestion articles --
create table depots(
    iddepot serial primary key,
    nom varchar(75)
);
create table familles(
    idfamille serial primary key,
    iddepot int references depots(idDepot),
    nom varchar(75)
);
create table unites(
    idunite serial primary key,
    unite varchar(10)
);
create table articles(
    idarticle serial primary key,
    code varchar(20) unique,
    designation text,
    idunite int references unites(idUnite),
    idfamille int references familles(idFamille)
);
create table articles(
    idarticle serial primary key,
    code varchar(20) unique,
    designation text,
    depot varchar(255),
    famille varchar(255),
    unite varchar(50)
);
--  debut nouvelle table
create table equipements(
    idequipement serial primary key,
    nomequipement varchar(55),
    code varchar(55),
    idemplacement int references emplacements(idemplacement)
);

create table employe_equipements(
    id serial primary key,
    idemploye int references employes(idemploye),
    idequipementint references equipements(idequipement)

);

create table parametre_equipements(
    idparametreequipement serial primary key,
    idequipement int references equipements(idequipement),
    nomparametre varchar,
    idfrequence int references frequences(idfrequence)
);

create table parametre_equipement_details(
    id serial primary key,
    idparametreequipement int references parametre_equipements(idparametreequipement),
    Valeur varchar(55),
    dateajout timestamp
);

-- 1 carnet = 1 tâche dans la departement maintenance (ex: Verification machine, reparation filtres, suivie compresseur, relevé consommation electricité)
-- 1 tâche est localisé par des emplacements définis à l'avance pour que les employés les effectuent sans problème
-- 1 tâche est executé par un ou plusieurs employé
-- La tâche est executée par les employés selon sa fréquence definit à l'avance (Journalière,Hebdomadaire,Mensuel,Tous les 2 semaines,A la demande)
-- 1 carnet ou 1 tâche est lié à une fiche qui est deja définie à l'avance (le nom,le type et ses paramètres à verifier)
-- En ce moment il y a 3 types de fiche (Relevé, checklist, point de contrôle)
-- Ses fiches sont remplies par les employés responsables de leur tâche selon la frequence de suivie definit dans le carnet

-- vue --
CREATE VIEW vue_carnets AS
SELECT
    c.idCarnet,
    c.item,
    e.idEmplacement,
    e.emplacement,
    emp.nom AS nom_employe,
    emp.prenom AS prenom_employe,
    emp.matricule,
    fs.fonction,
    f.frequence
FROM carnets c
         JOIN frequences f
              ON c.idFrequence = f.idFrequence
         LEFT JOIN carnet_emplacement ce
                   ON c.idCarnet = ce.idCarnet
         LEFT JOIN emplacements e
                   ON ce.idEmplacement = e.idEmplacement
         LEFT JOIN carnet_employe cem
                   ON c.idCarnet = cem.idCarnet
         LEFT JOIN employes emp
                   ON cem.idEmploye = emp.idEmploye
         LEFT JOIN fonctions fs
                   ON emp.idFontion = fs.idFonction;


-- Roles
INSERT INTO roles (role) VALUES
('SuperAdmin'),
('Admin'),
('Compliance'),
('Achat'),
('Technicien');

-- Fonctions
INSERT INTO fonctions (fonction) VALUES
('Développeur'),
('Analyste'),
('Chef de projet');

-- Employés
INSERT INTO employes (nom, prenom, matricule, idfonction, email, telephone, estActif) VALUES
('Dupont', 'Jean', '6906', 1, 'jean.dupont@example.com', '0601020304', 1);
('Martin', 'Claire', '5642', 2, 'claire.martin@example.com', '0605060708', 1),
('Durand', 'Paul', '7854', 3, 'paul.durand@example.com', '0608091011', 0);

-- Users
-- Note: les mots de passe sont hashés avec bcrypt (exemple Laravel)
INSERT INTO users (idemploye, username, email, password, role) VALUES
(null, 'Noum', 'raso@gmail.com', '$2y$10$Y/.s83ZfGUM/dtUjANNs9e.M8N7ZD3BKI4nMo4wuUThZ.JL1Pppka', 1);
(null, 'kanty', 'rasolofomananakanty@gmail.com', '$2y$10$pEHfUUPRX0GaEQ0gvYWBDegqXcf6J3WIYqD9JC63BtLIKg74jWM7q', 1);
(null, 'usertest', 'test@gmail.com', '$2y$10$sNt.k.Fu1cY1xqfkNCVoxe1VrLT3TjSZBG5.qLbioC8C8LI4wZuvi', 2);

INSERT INTO type_demandes (idtypedemande, nomtype, id_receveur) VALUES (4, 'teste',1);
INSERT INTO type_travaux (type) VALUES ('typetest');

php -r "echo password_hash('12345', PASSWORD_BCRYPT);"
