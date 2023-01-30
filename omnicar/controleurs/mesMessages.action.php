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

class mesMessages implements Action,PRG{
	public function executer(){
            if(!ISSET($_SESSION))
                session_start();


            $membre = $_SESSION["membre"]->getId();
$_SESSION['AfficherMessageContenu'] = "cliquer sur un message reçu pour afficher son contenue";

            $listenom = Array(); 

            $listeid = Array();

            $convo = MessageDAO::trouverParDestinataire($membre);

            if($convo != null)
            {
                foreach($convo as $p){
                             array_push($listeid,$p->getDestinataire());
                }

             

                foreach($listeid as $w){
                    $nom = UtilisateurDAO::trouverParIdAvecOBJ($w);
                    array_push($listenom,$nom);
                }

                $_SESSION['listeMembre'] = $listenom;
                $_SESSION['listeMessage'] = $convo;
            }
            else
                {$_SESSION['listeMembre'] = null;$_SESSION['listeMessage'] = null;
        }


            $_SESSION['tempmessage'] = "reçus";

            return "page_mes_messages";
 

    }
}
?>
   
                                           