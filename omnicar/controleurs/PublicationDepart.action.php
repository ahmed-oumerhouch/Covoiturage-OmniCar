<?php
require_once('./Config/Config.interface.php');
require_once('./modeles/interfaces/Action.interface.php');
require_once('./modeles/interfaces/PRG.interface.php');
require_once('./modeles/entites/Utilisateur.entite.php');
require_once('./modeles/DAOs/Utilisateur.dao.php');
require_once('./modeles/entites/Publication.entite.php');
require_once('./modeles/DAOs/Publication.dao.php');

class PublicationDepart implements Action,PRG{
	public function executer(){
        if(!ISSET($_SESSION))
            session_start();
        if($_REQUEST['college'] == "" || $_REQUEST['vehicule'] == "" || $_REQUEST['description'] == "" ||
            $_REQUEST['codePostal'] == "" || $_REQUEST['btn_radio'] == "" || $_REQUEST['telephone'] == "" || $_REQUEST['date'] == ""|| $_REQUEST['time'] == ""){
            $_SESSION['msgPublicationDepart'] = "S.V.P. Veuillez remplir tous les champs";
            return $_REQUEST['page'];
        }

        $publication = new Publication();
        $publication->setId(0);
        $publication->setCollege($_REQUEST['college']);
        $publication->setTelephone($_REQUEST['telephone']);
        $publication->setVehicule($_REQUEST['vehicule']);
        $publication->setDescription($_REQUEST['description']);
        $publication->setCodePostal($_REQUEST['codePostal'].";".$_REQUEST['latitude'].";".$_REQUEST['longitude']);
        $publication->setDirection($_REQUEST['btn_radio']);
        $publication->setDate($_REQUEST['date']);
        $publication->setHeure($_REQUEST['time']);
        $publication->setUtilisateur($_SESSION['membre']->getId());
        $id = PublicationDAO::insererParObjet($publication);
        if($id == null){
            $_SESSION['msgPublicationDepart'] = "Une erreur inatendue est survenue. La publication a échouée.";
            return $_REQUEST['page'];
        }
        $_SESSION['membre']->setAdresse($_REQUEST['description']);
        $_SESSION['membre']->setCodePostal($_REQUEST['codePostal']);
        $_SESSION['membre']->setVehicule($_REQUEST['vehicule']);
        $_SESSION['membre']->setTelephone($_REQUEST['telephone']);
        UtilisateurDAO::miseAJourParObjet($_SESSION['membre']);
        $_SESSION['msgPublicationDepart'] = "Le départ a bien été publié";
        return $_REQUEST['page'];
    }
}
?>