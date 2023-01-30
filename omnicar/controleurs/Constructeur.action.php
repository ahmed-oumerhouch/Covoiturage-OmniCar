<?php
require_once('./controleurs/Afficher.action.php');
require_once('./controleurs/Defaut.action.php');
require_once('./controleurs/Inscription.action.php');
require_once('./controleurs/MDPoublie.action.php');
require_once('./controleurs/Connexion.action.php');
require_once('./controleurs/PublicationDepart.action.php');
require_once('./controleurs/RecherchePublication.action.php');
require_once('./controleurs/Deconnexion.action.php');
require_once('./controleurs/MAJcompte.action.php');
require_once('./controleurs/Deletedepart.action.php');
require_once('./controleurs/MAJdepart.action.php');
require_once('./controleurs/acceuilEnvoyerMessage.action.php');
 
require_once('./controleurs/mesMessages.action.php');
require_once('./controleurs/mesMessagesEnvoye.action.php');
require_once('./controleurs/afficherMessage.action.php');
require_once('./controleurs/EnvoyerMessageMesMessage.action.php');
class Constructeur{
	public static function getAction($nomAction){
		if(!ISSET($_SESSION))
			session_start();
		switch ($nomAction){
            case "afficher" :
				return new Afficher();
			case "inscription" :
				return new Inscription();
			case "MDPoublie" :
				return new MDPoublie();
			case "Connexion" :
				return new Connexion();
			case "publicationDepart" :
				return new PublicationDepart();
			case "recherchePublication" :
				return new RecherchePublication();
			case "deconnexion" :
				return new Deconnexion();
			case "MAJcompte" :
				return new MAJcompte();
			case "Deletedepart" :
				return new Deletedepart();
			case "MAJdepart" :
				return new MAJdepart();
			case "acceuilEnvoyerMessage" :
				return new acceuilEnvoyerMessage();
			case "mesMessages" :
				return new mesMessages();
			case "mesMessagesEnvoye" :
				return new mesMessagesEnvoye();
			case "afficherMessage" :
				return new afficherMessage();
			case "EnvoyerMessageMesMessage" :
				return new EnvoyerMessageMesMessage();
			default :
				return new Defaut();
		}
	}
}
?>