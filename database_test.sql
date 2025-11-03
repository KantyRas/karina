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
create table sous_emplacements(
    idsousemplacement serial primary key,
    idemplacement int references emplacements(idEmplacement),
    nom varchar(75)
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
insert into type_interventions(type) values ('Urgent'),('Non urgent'),('Autres');

create table demande_interventions(  -- demande en cours --
    iddemandeintervention serial primary key,
    iddemandeur int references users(idUser), -- celui qui a besoin de l'intervention de la maintenance (user connecté)
    idrolereceveur int references roles(idrole), -- admin application Laravel (maintenance) = chef de departement maintenance (iduser = 1)
    idsection int references sections(idsection),
    idtypeintervention int references type_interventions(idtypeintervention),
    datedemande timestamp default current_time,
    datesouhaite date,
    description text,
    motif text,
    statut int default 0  -- (0=en attente, 1=validé par le dept_maintenance, 3=rejetté)
);
create table fiche_interventions(
    idficheintervention serial primary key,
    iddemandeintervention int references demande_interventions(idDemandeIntervention),
    idemployeassigne int references employes(idEmploye),
    datecreation date default now(),
    dateplanifie timestamp,
    dateintervention timestamp
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

create table historique_equipements(
    idhistoriqueequipement serial primary key,
    description varchar(75),
    idequipement int references equipements(idequipement),
    datecreation date
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
    idhistoriqueequipement int references historique_equipements(idhistoriqueequipement),
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
(null, 'kanty', 'kanty@gmail.com', '$2y$10$uwcslFFJrmJ.7W8c3XuZ.OXRJ4QWtPz8/4/PVQX1a0lcbDltf7Vj2', 1);
(null, 'kanty', 'rasolofomananakanty@gmail.com', '$2y$10$pEHfUUPRX0GaEQ0gvYWBDegqXcf6J3WIYqD9JC63BtLIKg74jWM7q', 1);
(null, 'usertest', 'test@gmail.com', '$2y$10$sNt.k.Fu1cY1xqfkNCVoxe1VrLT3TjSZBG5.qLbioC8C8LI4wZuvi', 2);

INSERT INTO type_demandes (idtypedemande, nomtype, id_receveur) VALUES (4, 'teste',1);
INSERT INTO type_travaux (type) VALUES ('typetest');

php -r "echo password_hash('kanty', PASSWORD_BCRYPT);"

create view v_liste_equipement AS
select
eq.idequipement, eq.nomequipement, eq.code,
ep.idemplacement, ep.emplacement,
e.idemploye,
emp.nom as nomemploye, emp.prenom, emp.matricule
from equipements eq
JOIN employe_equipements e ON e.idequipement = eq.idequipement
JOIN employes emp ON emp.idemploye = e.idemploye
JOIN emplacements ep ON eq.idemplacement = ep.idemplacement;

create view v_liste_equipement_regroupe AS
SELECT
    idequipement,
    nomequipement,
    code,
    idemplacement,
    emplacement,
    STRING_AGG(nomemploye || ' ' || prenom, ' - ' ORDER BY nomemploye, prenom) AS nomemploye,
    STRING_AGG(matricule, ' - ' ORDER BY matricule) AS matricule
FROM v_liste_equipement
GROUP BY idequipement, nomequipement, code, idemplacement, emplacement;

-- donnee de test pour equipement

insert into equipements (nomequipement, code, idemplacement) values('Machine A', 'B612', 1),('Machine A', 'B612', 2);

insert into employe_equipements (idemploye, idequipement) values (2,1), (2,1), (1,2), (2,2);
insert into employe_equipements (idemploye, idequipement) values (3,3), (3,4), (2,3), (3,4);


create table typereleve(
    idtypereleve serial primary key,
    nom varchar(75)
);
create table parametretype(
    idparametretype serial primary key,
    idtypereleve int references typereleve(idtypereleve),
    nomparametre varchar(75)
);
create table historiquereleve(
    idhistoriquereleve serial primary key,
    description varchar(75),
    idtypereleve int references typereleve(idtypereleve),
    datecreation date
);
create table detailreleve(
    iddetailreleve serial primary key,
    idhistoriquereleve int references historiquereleve(idhistoriquereleve),
    idparametretype int references parametretype(idparametretype),
    valeur varchar(255),
    datereleve date
);

insert into typereleve (nom) values
('Eau'),
('Electricité'),
('Bois');
-- Electricité
insert into parametretype (idtypereleve, nomparametre) values
(2, 'Relevé en kWh'),
(2, 'Groupe 250 kVa'),
(2, 'Groupe 150 kVa'),
(2, 'Achat Gasoil'),
(2, 'Durée coupure');

insert into historiquereleve (description, idtypereleve, datecreation) values
('Relevé', 2, '2025-10-02');

insert into detailreleve (idhistoriquereleve, idparametretype, valeur, datereleve) values
(1,1,'420','2025-10-02'),
(1,2,'150','2025-10-02'),
(1,3,'0','2025-10-02'),
(1,4,'0','2025-10-02'),
(1,5,'180','2025-10-02'),
(1,1,'872','2025-10-03'),
(1,2,'0','2025-10-03'),
(1,3,'180','2025-10-03'),
(1,4,'200','2025-10-03'),
(1,5,'120','2025-10-03');

-- type releve et parametres --
SELECT t.idtypereleve, t.nom AS typereleve, p.nomparametre
FROM typereleve t
LEFT JOIN parametretype p ON t.idtypereleve = p.idtypereleve;


create view v_detail_equipement as
select ped.id , ped.idparametreequipement, ped.valeur, ped.dateajout, ped.idhistoriqueequipement, pe.idequipement, pe.nomparametre, f.idfrequence, f.frequence
from parametre_equipement_details ped
join parametre_equipements pe on ped.idparametreequipement = pe.idparametreequipement
join frequences f on pe.idfrequence = f.idfrequence;

select count(*) from equipements;
select count (*) from employes;


select he.idhistoriqueequipement, he.description, he.idequipement, he.datecreation, em.idemplacement, s.idsousemplacement, s.nom from historique_equipements he
join equipements e on e.idequipement = he.idequipement
join emplacements em on em.idemplacement = e.idemplacement
left join sous_emplacements s on s.idemplacement = em.idemplacement;

insert into sous_emplacements(idemplacement,nom) values(1,'S1'),(1,'S2');


select he.idhistoriqueequipement, he.description, he.idequipement, he.datecreation, s.idsousemplacement, s.nom, e.idemplacement from historique_equipements he
join sous_emplacements s on s.idsousemplacement = he.idsousemplacement
join equipements eq on eq.idequipement = he.idequipement
right join emplacements e on eq.idemplacement = e.idemplacement;

insert into historique_equipements(description, idequipement, datecreation, idsousemplacement) values('test', 1,);

CREATE EXTENSION IF NOT EXISTS unaccent;

SELECT
    h.idhistoriquereleve,
    h.description,
    h.datecreation,
    MAX(CASE WHEN unaccent(lower(p.nomparametre)) = unaccent(lower('Releve electricite')) THEN d.valeur END) AS "Relevé en kWh",
    MAX(CASE WHEN unaccent(lower(p.nomparametre)) = unaccent(lower('Conso 250 KVA')) THEN d.valeur END) AS "Groupe 250 kVa",
    MAX(CASE WHEN unaccent(lower(p.nomparametre)) = unaccent(lower('Conso 150 KVA')) THEN d.valeur END) AS "Groupe 150 kVa",
    MAX(CASE WHEN unaccent(lower(p.nomparametre)) = unaccent(lower('Achat gasoil (L)')) THEN d.valeur END) AS "Achat Gasoil",
    MAX(CASE WHEN unaccent(lower(p.nomparametre)) = unaccent(lower('Duree coupure (mn)')) THEN d.valeur END) AS "Durée coupure"
FROM historiquereleve h
         LEFT JOIN detailreleve d ON d.idhistoriquereleve = h.idhistoriquereleve
         LEFT JOIN parametretype p ON p.idparametretype = d.idparametretype
WHERE h.idtypereleve = 1
GROUP BY h.idhistoriquereleve, h.description, h.datecreation
ORDER BY h.datecreation DESC;


SELECT * FROM parametre_equipement_details
WHERE EXTRACT(MONTH FROM dateajout) = EXTRACT(MONTH FROM NOW())
  AND EXTRACT(DAY FROM dateajout) = 23
  AND EXTRACT(HOUR FROM dateajout) <= 12;


join parametre_equipements_detail -> parametre_equipements
join parametre_equipements -> frequence

create view v_cron as
select ped.id, pe.idparametreequipement, pe.nomparametre, ped.valeur, ped.dateajout, he.idhistoriqueequipement, pe.idequipement, pe.idfrequence from parametre_equipement_details ped
right join historique_equipements he on he.idhistoriqueequipement = ped.idhistoriqueequipement 
right join parametre_equipements pe on pe.idparametreequipement = ped.idparametreequipement and he.idequipement = pe.idequipement;


select ped.id, ped.valeur, ped.dateajout, he.idhistoriqueequipement, pe.idparametreequipement, e.idequipement, e.nomequipement from parametre_equipement_details ped
left join historique_equipements he on ped.idhistoriqueequipement = he.idhistoriqueequipement
left join parametre_equipements pe on pe.idparametreequipement = ped.idparametreequipement
left join equipements e on e.idequipement = pe.idequipement;

CREATE VIEW v_cron as
SELECT 
    ped.id as id_detail,
    ped.valeur,
    ped.dateajout,
    he.idhistoriqueequipement,
    pe.idparametreequipement,
    pe.nomparametre,
    pe.idfrequence,
    e.idequipement AS idequipement_equipement,
    e.nomequipement
FROM historique_equipements he
JOIN equipements e 
    ON e.idequipement = he.idequipement
LEFT JOIN parametre_equipements pe 
    ON pe.idequipement = he.idequipement 
LEFT JOIN parametre_equipement_details ped 
    ON ped.idparametreequipement = pe.idparametreequipement
   AND ped.idhistoriqueequipement = he.idhistoriqueequipement 
LEFT JOIN frequences f on f.idfrequence = pe.idfrequence;

-- where pe.idfrequence = 1;

select idequipement, idfrequence from v_cron where idfrequence = 1 group by idequipement, idfrequence;
