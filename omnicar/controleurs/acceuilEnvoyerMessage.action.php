<?php
require_once('./Config/Config.interface.php');
require_once('./modeles/interfaces/Action.interface.php');
require_once('./modeles/interfaces/PRG.interface.php');
require_once('./modeles/entites/Utilisateur.entite.php');
require_once('./modeles/DAOs/Utilisateur.dao.php');
require_once('./modeles/entites/Publication.entite.php');
require_once('./modeles/DAOs/Publication.dao.php'); 
require_once('./modeles/entites/message.entite.php');
require_once('./modeles/DAOs/Message.dao.php'); 

class acceuilEnvoyerMessage implements Action,PRG{
	public function executer(){
            if(!ISSET($_SESSION))
                session_start();

        $id_Chauffeur =  $_REQUEST['idutilisateur'];
        $membre = $_SESSION["membre"]->getId();
        $contenu =  $_REQUEST['msg'];

        $direction = $_REQUEST['directiontitre'];
        $college = $_REQUEST['collegetitre'];
        $titre = $direction."-".$college;

        $typeMessage = "message";
             
 
        $message = new Message();
        $message->setDestinataire($id_Chauffeur);
        $message->setProvenance($membre);
        $message->setContenu($contenu);
        $message->setDate(date("Y-m-d"));
        $message->setHeure(date("h:i:s"));

        $message->setTitre($titre);
        $message->setType($typeMessage);

        $id = MessageDAO::inserer($message);

        if($id == null){
            $_SESSION['MessageRedirection'] = "Une erreur inatendue est survenue. Le message a échouée.";
            return "accueilConnexion";
        }
        $_SESSION['MessageRedirection'] = "true";
        return "accueilConnexion";
    }
}
?>
   
                                           