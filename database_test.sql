-- Admin gestion utilisateur/personnel --
create table roles(
    idRole serial primary key,
    role varchar(75)
);
create table fonctions(
    idFonction serial primary key,
    fonction varchar(255)
);
create table employes(
    idEmploye serial primary key,
    nom varchar(75),
    prenom varchar(75),
    matricule varchar(10) unique,
    idFonction int references fonctions(idFonction),
    email varchar(75) unique,
    telephone varchar(10),
    estActif int default 1
);
create table users(
    idUser serial primary key,
    idEmploye int references employes(idEmploye) default 0,
    email varchar(75) unique not null,
    password varchar(255) not null,
    role int references roles(idRole)
);
create table emplacements(
    idEmplacement serial primary key,
    emplacement varchar(75)
);
create table frequences(
    idFrequence serial primary key,
    frequence varchar(75)
);
create table carnets(
    idCarnet serial primary key,
    item varchar(255),
    idFrequence int references frequences(idFrequence)
);
create table carnet_emplacements(
    idCarnetEmplacement serial primary key,
    idCarnet int references carnets(idCarnet),
    idEmplacement int references emplacements(idEmplacement)
);
create table sous_emplacement(
    idSousEmplacement serial primary key,
    idCarnetEmplacement int references carnet_emplacements(idCarnetEmplacement),
    localisation varchar(255)
);
create table carnet_employes(
    idCarnetEmploye serial primary key
    idCarnet int references carnets(idCarnet),
    idEmploye int references employes(idEmploye)
);
CREATE TABLE fiches(
    idFiche SERIAL PRIMARY KEY,
    idCarnet INT REFERENCES carnets(idCarnet),
    idUser int references users(idUser),
    nomFiche VARCHAR(100) NOT NULL,
    date_creation timestamp default current_timestamp,
    date_dernier_maj timestamp default current_timestamp,
    statut int default 0 -- En cours / Cloturée
);
create table fiche_parametres(
    idFicheParametre serial primary key,
    idFiche int references fiches(idFiche),
    parametres varchar(255)
);
create table fiche_details(
    idFicheDetail serial primary key,
    idFiche int references fiches(idFiche),
    idEmploye int references employes(idEmploye),
    dateAjout timestamp default current_timestamp,
    idFicheParametre int references fiche_parametres(idFicheParametre);
    valeurs varchar(255)
);
create table equipements(
    idEquipement serial primary key,
    code varchar(50),
    nom varchar(75),
    idDepartement int references departements(idDepartement),
    date_mise_service date
);
-- Demande achats ou sorties -> stocks --
create table type_demandes(
    idTypeDemande serial primary key,
    nomType varchar(75)
);
create table demandes(
    idDemande serial primary key,
    idDemandeur int references users(idUser),   -- demandeur --
    idReceveur int references users(idUser),    -- receveur (achat -> responsable achat & sortie -> responsable magasin) --
    idTypeDemande int references type_demandes(idTypeDemande),
    dateDemande date,
    description text,
    statut int default 0  -- statut:0 = En attente / statut:1 = Reçu na validé / statut:2 = Rejeté --
);
create table detail_article_demandes(
    idArticleDemande serial primary key,
    idDemande int references demandes(idDemande),
    idArticle int references articles(idArticle),
    quantiteDemande double precision
);
-- Interventions --
create table type_interventions(
    idTypeIntervention serial primary key,
    type varchar(75) default 'Autres'
);
create table demande_interventions(  -- demande en cours --
    idDemandeIntervention serial primary key,
    idDemandeur int references users(idUser), -- celui qui a besoin de l'intervention de la maintenance
    idReceveur int references users(idUser), -- admin application Laravel (maintenance) = chef de departement maintenance
    idEquipement int references equipements(idEquipement),
    dateDemande timestamp default current_time,
    description text,
    statut int default 0  -- (0=en attente, 1=validé par le dept_maintenance, 3=rejetté)
);
create table fiche_interventions(
    idFicheIntervention serial primary key,
    idDemandeIntervention int references demande_interventions(idDemandeIntervention),
    idTypeintervention int references type_interventions(idTypeIntervention),
    idEmployeAssigne int references employes(idEmploye),
    datePlanifie date,
    date_intervention date
);
-- Gestion articles --
create table depots(
    idDepot serial primary key,
    nom varchar(75)
);
create table familles(
    idFamille serial primary key,
    idDepot int references depots(idDepot),
    nom varchar(75)
);
create table unites(
    idUnite serial primary key,
    unite varchar(10)
);
create table articles(
    idArticle serial primary key,
    code varchar(20) unique,
    designation text,
    quantite double precision,
    idUnite int references unites(idUnite),
    idFamille int references familles(idFamille)
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
