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

class afficherMessage implements Action,PRG{
    public function executer(){
            if(!ISSET($_SESSION))
                session_start();
            
            
            if(ISSET($_REQUEST['idmessage'])){
            $membre= $_REQUEST['idmessage'];
            $idutilisateur= $_REQUEST['idUtilisateur'];
            }

 

            $convo = MessageDAO::trouverParId($membre);
             
            
            if($convo != null)
            {


                $_SESSION['AfficherMessageContenu'] = $convo->getContenu();

                $_SESSION['membreId'] = $idutilisateur;
                $titre =$convo->getTitre();
                 
                $_SESSION['titre'] = $titre;
           

            }
            else
                {$_SESSION['AfficherMessageContenu'] = null; }


 
            return "page_mes_messages";
 

    }
}
?>
   
                                           