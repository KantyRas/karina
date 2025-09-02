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
create table equipements(
    idequipement serial primary key,
    code varchar(50),
    nom varchar(75),
    iddepartement int references departements(idDepartement),
    date_mise_service date
);
-- Demande achats ou sorties -> stocks --
create table type_demandes(
    idtypedemande serial primary key,
    nomtype varchar(75)
);
create table demandes(
    iddemande serial primary key,
    iddemandeur int references users(idUser),   -- demandeur --
    idreceveur int references users(idUser),    -- receveur (achat -> responsable achat & sortie -> responsable magasin) --
    idtypedemande int references type_demandes(idTypeDemande),
    datedemande date,
    description text,
    statut int default 0  -- statut:0 = En attente / statut:1 = Reçu na validé / statut:2 = Rejeté --
);
create table detail_article_demandes(
    idarticledemande serial primary key,
    iddemande int references demandes(idDemande),
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
    quantite double precision,
    idunite int references unites(idUnite),
    idfamille int references familles(idFamille)
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
