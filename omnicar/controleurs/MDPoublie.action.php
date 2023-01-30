<?php
require_once('./Config/Config.interface.php');
require_once('./modeles/interfaces/Action.interface.php');
require_once('./modeles/interfaces/PRG.interface.php');
require_once('./modeles/entites/Utilisateur.entite.php');
require_once('./modeles/DAOs/Utilisateur.dao.php');
class MDPoublie implements Action,PRG{
    public function executer(){
        if(!ISSET($_SESSION))
            session_start();

        $email = $_REQUEST['user_adresse'];
        
        if(UtilisateurDAO::courrielExistant($_REQUEST['user_adresse']) == 1){
            $_SESSION['messagemdp'] = UtilisateurDAO::recevoirmdp($_REQUEST['user_adresse']);
            return "page_mdp_oublie";
        }

        if(UtilisateurDAO::courrielExistant($_REQUEST['user_adresse']) == -1){
            $_SESSION['messagemdp'] = "Une erreur est survenue lors du traitement du mot de passe oublié";
            return "page_mdp_oublie";
        }
    }
}
?>