/*Création des tables de la BD covoiturage*/
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS transaction;
DROP TABLE IF EXISTS propos;
DROP TABLE IF EXISTS conversation;
DROP TABLE IF EXISTS passagerRoute;
DROP TABLE IF EXISTS pointService;
DROP TABLE IF EXISTS route;
DROP TABLE IF EXISTS publication;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS lieu;


CREATE TABLE lieu(
	IDLieu INT AUTO_INCREMENT,
	numCiviqueLieu VARCHAR(40),
	appartementLieu VARCHAR(40),
	rueLieu VARCHAR(40),
	villeLieu VARCHAR(40) NOT NULL,
	provinceLieu VARCHAR(40),
	paysLieu VARCHAR(40),
	descriptionLieu VARCHAR(500),
	coordonneesLieu VARCHAR(40),
	imageLieu VARCHAR(100),
	PRIMARY KEY (IDLieu)
);

CREATE TABLE utilisateur(
	IDUtilisateur INT AUTO_INCREMENT,
	nomUtilisateur VARCHAR(40) NOT NUll,
	prenomUtilisateur VARCHAR(40) NOT NULL,
	courrielUtilisateur VARCHAR(100) NOT NULL,
	telephoneUtilisateur VARCHAR(20),
	typeUtilisateur VARCHAR(40),
	noteUtilisateur INT(10),
	descriptionUtilisateur VARCHAR(500),
	vehiculeUtilisateur VARCHAR(40),
	motDePasseUtilisateur VARCHAR(25) NOT NULL,
	imageUtilisateur VARCHAR(200),
	adresseUtilisateur VARCHAR(100),
	codePostalUtilisateur VARCHAR(10),
	PRIMARY KEY(IDUtilisateur)
);

CREATE TABLE publication(
	IDPublication INT AUTO_INCREMENT,
	collegePublication VARCHAR(40),
	telephonePublication VARCHAR(20),
	vehiculePublication VARCHAR(40),
	descriptionPublication VARCHAR(500),
	codePostalPublication VARCHAR(100),
	directionPublication VARCHAR(20),
	utilisateurPublication INT(10),
	datePublication DATE,
	heurePublication TIME,
	PRIMARY KEY(IDPublication),
	FOREIGN KEY (utilisateurPublication) REFERENCES utilisateur(IDUtilisateur)
);

CREATE TABLE route(
	IDRoute INT AUTO_INCREMENT,
	statutRoute VARCHAR(40),
	nombrePassagerRoute INT(3),
	directionRoute INT(10),
	chauffeurRoute INT(10),
	PRIMARY KEY (IDRoute),
	FOREIGN KEY (directionRoute) REFERENCES lieu(IDLieu),
	FOREIGN KEY (chauffeurRoute) REFERENCES utilisateur(IDUtilisateur)
);

CREATE TABLE pointService(
	IDPointService INT AUTO_INCREMENT,
	datePointService DATE,
	heurePointService TIME,
	lieuPointService INT(10),
	routePointService INT(10),
	PRIMARY KEY (IDPointService),
	FOREIGN KEY (lieuPointService) REFERENCES lieu (IDLieu),
	FOREIGN KEY (routePointService) REFERENCES route (IDRoute)
);

CREATE TABLE passagerRoute(
	pointServicePassagerRoute INT(10),
	utilisateurPassagerRoute INT(10),
	PRIMARY KEY (pointServicePassagerRoute,utilisateurPassagerRoute),
	FOREIGN KEY (pointServicePassagerRoute) REFERENCES pointService (IDPointService),
	FOREIGN KEY (utilisateurPassagerRoute) REFERENCES utilisateur (IDUtilisateur)
);

CREATE TABLE conversation(
	IDConversation INT AUTO_INCREMENT,
	dateDebutConversation DATE,
	heureFinConversation TIME,
	dateFinConversation DATE,
	heureDebutConversation TIME,
	PRIMARY KEY (IDConversation)
);

CREATE TABLE propos(
	IDPropos INT AUTO_INCREMENT,
	contenuPropos VARCHAR(300),
	datePropos DATE,
	heurePropos TIME,
	utilisateurPropos INT(10),
	conversationPropos INT(10),
	PRIMARY KEY (IDPropos),
	FOREIGN KEY (utilisateurPropos) REFERENCES utilisateur (IDUtilisateur),
	FOREIGN KEY (conversationPropos) REFERENCES conversation (IDConversation)
);

CREATE TABLE transaction(
	IDTransaction INT AUTO_INCREMENT,
	montantTransaction FLOAT(10),
	dateTransaction DATE,
	heureTransaction TIME,
	payeurTransaction INT(10),
	debiteurTransaction INT(10),
	lieuTransaction INT(10),
	PRIMARY KEY (IDTransaction),
	FOREIGN KEY (payeurTransaction) REFERENCES utilisateur (IDUtilisateur),
	FOREIGN KEY (debiteurTransaction) REFERENCES utilisateur (IDUtilisateur),
	FOREIGN KEY (lieuTransaction) REFERENCES lieu (IDLieu)
);

CREATE TABLE message(
	IDMessage INT AUTO_INCREMENT,
	titreMessage VARCHAR(100) NOT NULL,
	contenuMessage VARCHAR(4000),
	typeMessage VARCHAR(40),
	dateMessage DATE NOT NULL,
	heureMessage TIME NOT NULL,
	destinataireMessage INT(10),
	provenanceMessage INT(10),
	PRIMARY KEY (IDMessage),
	FOREIGN KEY (destinataireMessage) REFERENCES utilisateur (IDUtilisateur),
	FOREIGN KEY (provenanceMessage) REFERENCES utilisateur (IDUtilisateur)
);

INSERT INTO lieu (numCiviqueLieu,appartementLieu,rueLieu,villeLieu,provinceLieu,paysLieu,descriptionLieu,coordonneesLieu,imageLieu)
VALUES ("14","4","12 Avenue","Montréal","Qc","USA","Les Derniers Seront Les Premiers","5555/8888","./ici.png");

SET FOREIGN_KEY_CHECKS = 1;













