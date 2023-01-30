<?php
require_once('./Config/Config.interface.php');
require_once('./modeles/interfaces/Action.interface.php');
require_once('./modeles/interfaces/PRG.interface.php');
require_once('./modeles/entites/Utilisateur.entite.php');
require_once('./modeles/DAOs/Utilisateur.dao.php');
class Inscription implements Action,PRG{
	public function executer(){
        if(!ISSET($_SESSION))
			session_start();
        if($_REQUEST['user_nom'] == "" && $_REQUEST['user_prenom'] == "" && $_REQUEST['user_adresse'] == "" &&
            $_REQUEST['user_password'] == "" && $_REQUEST['conf_password'] == ""){
            return "inscription";
        }
        if($_REQUEST['user_nom'] == "" || $_REQUEST['user_prenom'] == "" || $_REQUEST['user_adresse'] == "" ||
            $_REQUEST['user_password'] == "" || $_REQUEST['conf_password'] == ""){
            $_SESSION['messageInscription'] = "S.V.P. Veuillez fournir toutes les informations";
            return "inscription";
        }
        if(UtilisateurDAO::courrielExistant($_REQUEST['user_adresse']) == 1){
            $_SESSION['messageInscription'] = "Un compte possède déjà le courriel fournit";
            return "inscription";
        }
        if(UtilisateurDAO::courrielExistant($_REQUEST['user_adresse']) == -1){
            $_SESSION['messageInscription'] = "Une erreur est survenue lors du traitement de l'inscription";
            return "inscription";
        }
        if($_REQUEST['user_password'] != $_REQUEST['conf_password']){
            $_SESSION['messageInscription'] = "Les mots de passes ne correspondent pas";
            return "inscription";
        }
        $utilisateur = new Utilisateur();
        $utilisateur->setId(0);
        $utilisateur->setNom($_REQUEST['user_nom']);
        $utilisateur->setPrenom($_REQUEST['user_prenom']);
        $utilisateur->setCourriel($_REQUEST['user_adresse']);
        $utilisateur->setTelephone("");
        $utilisateur->setType(null);
        $utilisateur->setNote(5);
        $utilisateur->setDescription("");
        $utilisateur->setVehicule("");
        $utilisateur->setMotDePasse($_REQUEST['user_password']);
        $utilisateur->setImage(null);
        $utilisateur->setAdresse("");
        $utilisateur->setCodePostal("");
        $id = UtilisateurDAO::insererParObjet($utilisateur);
        if($id == null){
            $_SESSION['messageInscription'] = "Une erreur est survenue lors du traitement de l'inscription";
            return "inscription";
        }
        $utilisateur->setId($id);
        $_SESSION['messageInscription'] = "Votre inscription a été effectuée avec succès Bienvenue dans Omnicar !!!";
        $_SESSION['membre'] = $utilisateur;
		return "accueilConnexion";
	}
}
?>