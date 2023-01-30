<?php
require_once('./Config/Config.interface.php');
require_once('./modeles/interfaces/Action.interface.php');
require_once('./modeles/interfaces/PRG.interface.php');
require_once('./modeles/entites/Utilisateur.entite.php');
require_once('./modeles/DAOs/Utilisateur.dao.php');
  require_once('./modeles/entites/publication.entite.php');
  require_once('./modeles/DAOs/publication.dao.php');
class Deletedepart implements Action,PRG{
	public function executer(){
        if(!ISSET($_SESSION))
            session_start();
        $id = $_REQUEST["wooo"];
        $publications = PublicationDAO::supprimerParId($id);
        if($publications == TRUE)
        	{
        		$_SESSION['messageSupprimer'] = "Départ suprimé";
        		 return "page_mes_departs";
        	}else
        	{
        		$_SESSION['messageSupprimer'] = "Erreur de suppression";
        		 return "page_mes_departs";

        	};
       
    }
}
?>