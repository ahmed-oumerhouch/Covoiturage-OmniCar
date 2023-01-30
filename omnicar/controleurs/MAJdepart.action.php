<?php
require_once('./Config/Config.interface.php');
require_once('./modeles/interfaces/Action.interface.php');
require_once('./modeles/interfaces/PRG.interface.php');
require_once('./modeles/entites/Utilisateur.entite.php');
require_once('./modeles/DAOs/Utilisateur.dao.php');
  require_once('./modeles/entites/publication.entite.php');
  require_once('./modeles/DAOs/publication.dao.php');
class MAJdepart implements Action,PRG{
    public function executer(){
        if(!ISSET($_SESSION))
            session_start();

        $id = $_REQUEST['wooo'];
        $college = $_REQUEST['nom_du_collegeMSG'];
        $voiture = $_REQUEST['voiture_MSG'];
        $adresse = $_REQUEST['adresse_MSG'];
        $telephone = $_REQUEST['telephone_MSG']; 

        $ZIP = $_REQUEST['codePostalmdfg'];
        
        $direction = $_REQUEST['btn_radio'];

        if($college== "" && $voiture == "" && $adresse == "" && $telephone == "" && $ZIP == "" && $direction == ""){
            $_SESSION['messageMiseAJour'] = "Une erreur est survenue.";
            
            return "page_mes_departs";
        }
        else if(  $college== "" || $voiture == "" || $adresse == "" || $telephone == "" || $ZIP == "" || $direction == ""){
            $_SESSION['messageMiseAJour'] = "Une erreur est survenue.";
            return "page_mes_departs";
        }
        else
        {
            $publications = PublicationDAO::miseAJourAttribut($id,"collegePublication",$college);
            $publications = PublicationDAO::miseAJourAttribut($id,"vehiculePublication",$voiture);
            $publications = PublicationDAO::miseAJourAttribut($id,"descriptionPublication",$adresse);
            $publications = PublicationDAO::miseAJourAttribut($id,"telephonePublication",$telephone);

            $publications = PublicationDAO::miseAJourAttribut($id,"codePostalPublication",$ZIP);
            $publications = PublicationDAO::miseAJourAttribut($id,"directionPublication",$direction);
            
            return "page_mes_departs";
        }
    }
}
?>