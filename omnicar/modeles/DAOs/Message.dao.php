<?php
require_once("./modeles/classes/ConnexionBD.classe.php");
require_once("./modeles/entites/Message.entite.php");

class MessageDAO{

    
    public static function inserer($objetMessage){
        $connexion = ConnexionBD::getConnexion();
        $id = 0;
        if($connexion != null){		
            $requete = $connexion->prepare("INSERT INTO message (titreMessage,contenuMessage,typeMessage,dateMessage,".
                                                "heureMessage,destinataireMessage,provenanceMessage)".
                                            " VALUES (:titre,:cont,:type,:date,:h,:dest,:prov);"
            );
            $requete->execute(array(':titre' => $objetMessage->getTitre(),':cont' => $objetMessage->getContenu(),
                                    ':type' => $objetMessage->getType(),':date' => $objetMessage->getDate(),
                                    ':h' => $objetMessage->getHeure(),':dest' => $objetMessage->getDestinataire(),
                                    ':prov' => $objetMessage->getProvenance(),

            ));
            $requete = $connexion->prepare("SELECT MAX(IDMessage) AS ID FROM message WHERE provenanceMessage = :p");
            $requete->execute(array(':p' => $objetMessage->getProvenance()));
            try{
                $donnees = $requete->fetch(PDO::FETCH_OBJ);
                if($donnees)
                    $id = $donnees->ID;
            }catch(Exception $ex){
                $id = null;
            }		
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        return $id;
    }

    public static function trouverParProvenance($idUtilisateur){
        $connexion = ConnexionBD::getConnexion();
        $listeMsg = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM message WHERE provenanceMessage = :pm ORDER BY IDMessage DESC");
            $requete->execute(array(':pm' => $idUtilisateur));
            try{
                while($donnees = $requete->fetch(PDO::FETCH_OBJ)){
                    $m = new Message();
                    $m->chargerObjetBD($donnees);
                    array_push($listeMsg,$m);
                }
            }catch(Exception $ex){
                $listeMsg = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listeMsg = null;
        }
        return $listeMsg;
    }

    public static function trouverParDestinataire($idUtilisateur){
        $connexion = ConnexionBD::getConnexion();
        $listeMsg = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM message WHERE destinataireMessage = :dm ORDER BY IDMessage DESC");
            $requete->execute(array(':dm' => $idUtilisateur));
            try{
                while($donnees = $requete->fetch(PDO::FETCH_OBJ)){
                    $m = new Message();
                    $m->chargerObjetBD($donnees);
                    array_push($listeMsg,$m);
                }
            }catch(Exception $ex){
                $listeMsg = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listeMsg = null;
        }
        return $listeMsg;
    }









    public static function trouverParId($id){
        $connexion = ConnexionBD::getConnexion();
        $msg = new Message();   
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM message WHERE IDMessage = :id");
            $requete->execute(array(':id' => $id));
            try{
                $donnees = $requete->fetch(PDO::FETCH_OBJ);
                if($donnees)
                    $msg->chargerObjetBD($donnees);
                else{
                    $msg = null;
                }
            }catch(Exception $ex){
                $msg = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $msg = null;
        }
        return $msg;
    }
}
?>