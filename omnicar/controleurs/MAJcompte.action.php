<?php
require_once('./Config/Config.interface.php');
require_once('./modeles/interfaces/Action.interface.php');
require_once('./modeles/interfaces/PRG.interface.php');
require_once('./modeles/entites/Utilisateur.entite.php');
require_once('./modeles/DAOs/Utilisateur.dao.php');
class MAJcompte implements Action,PRG{
    public function executer(){
        if(!ISSET($_SESSION))
            session_start();

        $nom = $_REQUEST['user_nom'];
        $prenom = $_REQUEST['user_prenom'];
        $email = $_REQUEST['user_adresse'];

        $mdpA = $_REQUEST['ancien_password'];
        $ancien_email = $_REQUEST['ancien_email'];
        $le_vrai_mdp = UtilisateurDAO::recevoirmdp($ancien_email);

        $mdpB = $_REQUEST['nouveau_password'];
        $mdpC = $_REQUEST['nouveau_password'];


        if($nom == "" && $prenom == "" && $email == "" &&
            $mdpA== "" && $mdpB == "" && $mdpC == "")
        {
            $_SESSION['messageMAJcompte'] = "S.V.P. Veuillez fournir toutes les informations";
            return "page_compte";
        }
        if(  $nom == "" || $prenom == "" || $email == "" ||
            $mdpA== "" || $mdpB == "" || $mdpC == "")
        {
            $_SESSION['messageMAJcompte'] = "S.V.P. Veuillez fournir toutes les informations";
            return "page_compte";
        }

        if($mdpB != $mdpC){
            $_SESSION['messageMAJcompte'] = "Les mots de passes ne correspondent pas";
            return "page_compte";
        }

        if($mdpA != $le_vrai_mdp)
        {
            $_SESSION['messageMAJcompte'] = "L'ancien mots de passes ne correspond pas";
            return "page_compte";
        }else if ($mdpA == $le_vrai_mdp) {
            $membre =   UtilisateurDAO::getObjectParCourriel($ancien_email);
            $membre->setNom($nom);
            $membre->setPrenom($prenom);
            $membre->setCourriel($email);
            $membre->setMotDePasse($mdpB);
            $reponse = UtilisateurDAO::miseAJourParObjet($membre);
            $_SESSION['membre']->setNom($nom);
            $_SESSION['membre']->setPrenom($prenom);
            $_SESSION['membre']->setCourriel($email);
            $_SESSION['membre']->setMotDePasse($mdpB);
            
            if ($reponse == false)
            {
                $_SESSION['messageMAJcompte'] = "Une erreur est survenue lors du traitement de la mise a jour.";
                return "page_compte";
            }else if ($reponse == true)
            {
                $_SESSION['messageMAJcompte'] = "La mise a jour de votre compte a été effectuée avec succès.";
                return "page_compte";
            }
        }

    }
}
?>