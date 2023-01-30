<?php
require_once('./Config/Config.interface.php');
require_once('./modeles/interfaces/Action.interface.php');
require_once('./modeles/interfaces/PRG.interface.php');
require_once('./modeles/entites/Utilisateur.entite.php');
require_once('./modeles/DAOs/Utilisateur.dao.php');
class Connexion implements Action,PRG{
    public function executer(){
        if(!ISSET($_SESSION))
            session_start();

        $email = $_REQUEST['user_adresse'];
        $password = $_REQUEST['user_password'];
        if($email== "" && $password == ""){
            return "page_connexion";
        }
        if($email== "" || $password == ""){
            return "page_connexion";
        }
        
        if(UtilisateurDAO::courrielExistant($_REQUEST['user_adresse']) == 1){

            $le_vrai_mdp = UtilisateurDAO::recevoirmdp($_REQUEST['user_adresse']);
            if($password== $le_vrai_mdp){

                $_SESSION['membre'] =   UtilisateurDAO::getObjectParCourriel($_REQUEST['user_adresse']);
                return "accueilConnexion";
            }else{return "page_connexion";}
        }

        if(UtilisateurDAO::courrielExistant($_REQUEST['user_adresse']) == -1){
            $_SESSION['messageco'] = "Une erreur est survenue Veuillez verifier si vous avez les bonnes information de votre compte";
            return "page_connexion";
        }
    }
}
?>