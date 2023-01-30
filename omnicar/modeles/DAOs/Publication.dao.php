<?php
/*
    insererParObjet($objetPublication) : Insère un enregistrement dans la table "publication".
        Paramètre : $objetPublication, étant un objet entité Publication().
        Retourne : $id étant l'IDPublication de l'enregistrement inseré, NULL si une erreur s'est produite (connexion ou PDO).

    insererParTableau($tableuPublication) : Insère un enregistrement dans la table "publication".
        Paramètre : $tableuPublication, étant un tableau à attributs "publication".
        Retourne : $id étant l'IDPubication de l'enregistrement inseré, NULL si une erreur s'est produite (connexion ou PDO).

    trouverToutAvecOBJ($ordre) : Recherche tous les enregistrements de la table "publication".
        Paramètre : $ordre, étant l'ordre de la requête : "ASC" => ordre croissant, "DESC" => décroissant.
        Retourne : Array() contenant une liste d'objet entite Publication() représentant tous les enregistrements de la table "publication",
                   NULL si la table est vide ou si une erreur s'est produite (connexion ou PDO).

    trouverToutAvecASSOC($ordre) : Recherche tous les enregistrements de la table "publication".
        Paramètre : $ordre, étant l'ordre de la requête : "ASC" => ordre croissant, "DESC" => décroissant.
        Retourne : Array() contenant la liste du résultat sous forme de tableau FETCH_ASSOC représentant tous les enregistrements de la table "publication",
                   NULL si la table est vide ou si une erreur s'est produite (connexion ou PDO).

    trouverParIdAvecOBJ($id) : Recherche un enregistrement dans la table "publication" selon son IDPublication.
        Paramètre : $id étant l'IDPublication de l'enregistrement à rechercher.
        Retourne : Publication() étant l'objet entite représentant l'enregistrement trouvé,
                   NULL si l'enregistrement n'existe pas ou si une erreur s'est produite (connexion ou PDO).

    trouverParIdAvecASSOC($id) : Recherche un enregistrement dans la table "publication" selon son IDPublication.
        Paramètre : $id étant l'IDPublication de l'enregistrement à rechercher.
        Retourne : $publication[] étant un tableau représentant l'enregistrement trouvé,
                   NULL si l'enregistrement n'existe pas ou si une erreur s'est produite (connexion ou PDO).

    miseAJourParObjet($objetPublication) : Met à jour un enregistrement de la table "publication".
        Paramètre : $objetPublication, étant un objet entité Publication().
        Retourne : TRUE si la connexion avec la BD a été établie sinon FALSE.

    miseAJourParTableau($tableauPublication) : Met à jour un enregistrement de la table "publication".
        Paramètre : $tableauPublication, étant un tableau à attributs "publication".
        Retourne : TRUE si la connexion avec la BD a été établie sinon FALSE.

    miseAJourAttribut($idPublication,$attribut,$valeur) : Met à jour un attribut d'un enregistrement donné de la table "publication".
        Paramètre : $idPublication, étant l'IDPublication de l'enregistrement à mettre à jour.
                    $attribut, étant l'attribut de l'enregistrement à mettre à jour.
                    $valeur, étant la nouvelle valeur à attribuer à l'enregistrement.
        Retourne : TRUE si la connexion avec la BD a été établie sinon FALSE.

*/


require_once("./modeles/classes/ConnexionBD.classe.php");
require_once("./modeles/entites/Publication.entite.php");

class PublicationDAO{
    public static function insererParObjet($objetPublication){
        $connexion = ConnexionBD::getConnexion();
        $id = null;
        if($connexion != null){		
            $requete = $connexion->prepare(
                "INSERT INTO publication (collegePublication,telephonePublication,vehiculePublication,descriptionPublication,
                        codePostalPublication,directionPublication,utilisateurPublication,datePublication,heurePublication)
                    VALUES (:c,:t,:v,:de,:cp,:di,:u,:da,:h)"
            );
            $requete->execute(array(
                ':c' => $objetPublication->getCollege(),':t' => $objetPublication->getTelephone(),
                ':v' => $objetPublication->getVehicule(),':de' => $objetPublication->getDescription(),
                ':cp' => $objetPublication->getCodePOstal(),':di' => $objetPublication->getDirection(),
                ':u' => $objetPublication->getUtilisateur(), ':da' => $objetPublication->getDate(),
                ':h' => $objetPublication->getHeure()
            ));
            $requete = $connexion->prepare(
                "SELECT MAX(IDPublication) AS ID FROM publication
                    WHERE utilisateurPublication = :u"
            );
            $requete->execute(array(':u' => $objetPublication->getUtilisateur()));
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

    public static function insererParTableau($tableauPublication){
        $connexion = ConnexionBD::getConnexion();
        $id = null;
        if($connexion != null){		
            $requete = $connexion->prepare(
                "INSERT INTO publication (
                    collegePublication,telephonePublication,vehiculePublication,descriptionPublication,
                    codePostalPublication,directionPublication,utilisateurPublication)
                VALUES (:c,:t,:v,:de,:cp,:di,:u,:da,:h)"
            );
            $requete->execute(array(
                ':c' => $tableauPublication['collegePublication'],':t' => $tableauPublication['telephonePublication'],
                ':v' => $tableauPublication['vehiculePublication'],':de' => $tableauPublication['descriptionPublication'],
                ':cp' => $tableauPublication['codePostalPublication'],':di' => $tableauPublication['directionPublication'],
                ':u' => $tableauPublication['utilisateurPublication'],':da' => $tableauPublication['datePublication'],
                ':h' => $tableauPublication['heurePublication']
            ));
            $requete = $connexion->prepare("SELECT MAX(IDPublication) AS ID FROM publication
                                                WHERE utilisateurPublication = :u");
            $requete->execute(array(':u' => $tableauPublication['utilisateurPublication']));
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

    public static function trouverToutAvecOBJLimite4($ordre){
        $connexion = ConnexionBD::getConnexion();
        $listePublication = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM publication ORDER BY IDPublication ".$ordre." LIMIT 4");
            $requete->execute();
            try{
                while($donnees = $requete->fetch(PDO::FETCH_OBJ)){
                    $p = new Publication();
                    $p->chargerObjetBD($donnees);
                    array_push($listePublication,$p);
                }
            }catch(Exception $ex){
                $listePublication = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listePublication = null;
        }
        return $listePublication;
    }

    public static function trouverToutAvecOBJ($ordre){
        $connexion = ConnexionBD::getConnexion();
        $listePublication = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM publication ORDER BY IDPublication ".$ordre);
            $requete->execute();
            try{
                while($donnees = $requete->fetch(PDO::FETCH_OBJ)){
                    $p = new Publication();
                    $p->chargerObjetBD($donnees);
                    array_push($listePublication,$p);
                }
            }catch(Exception $ex){
                $listePublication = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listePublication = null;
        }
        return $listePublication;
    }

    public static function trouverToutAvecASSOC($ordre){
        $connexion = ConnexionBD::getConnexion();
        $listePublication = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM publication ORDER BY IDPublication ".$ordre);
            $requete->execute();
            try{
                while($donnees = $requete->fetch(PDO::FETCH_ASSOC)){
                    array_push($listePublication,$donnees);
                }
            }catch(Exception $ex){
                $listePublication = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listePublication = null;
        }
        return $listePublication;
    }

    public static function trouverCinqDernieres($ordre){
        $connexion = ConnexionBD::getConnexion();
        $listePublication = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM publication ORDER BY IDPublication ".$ordre." LIMIT 5");
            $requete->execute();
            try{
                while($donnees = $requete->fetch(PDO::FETCH_OBJ)){
                    $p = new Publication();
                    $p->chargerObjetBD($donnees);
                    array_push($listePublication,$p);
                }
            }catch(Exception $ex){
                $listePublication = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listePublication = null;
        }
        return $listePublication;
    }

    public static function trouverParIdAvecOBJ($id){
        $connexion = ConnexionBD::getConnexion();
        $publication = new Publication();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM publication WHERE IDPublication = :id");
            $requete->execute(array(':id' => $id));
            try{
                $donnees = $requete->fetch(PDO::FETCH_OBJ);
                if($donnees)
                    $publication->chargerObjetBD($donnees);
                else{
                    $publication = null;
                }
            }catch(Exception $ex){
                $publication = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $publication = null;
        }
        return $publication;
    }

    public static function trouverParIdAvecASSOC($id){
        $connexion = ConnexionBD::getConnexion();
        $publication = null;	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM publication WHERE IDPublication = :id");
            $requete->execute(array(':id' => $id));
            try{
                $donnees = $requete->fetch(PDO::FETCH_ASSOC);
                if($donnees){
                    $publication = $donnees;
                }
            }catch(Exception $ex){
                $publication = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        return $publication;
    }

    public static function trouverParUtilisateur($ordre,$id){       
        $connexion = ConnexionBD::getConnexion();
        $listePublication = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM publication WHERE utilisateurPublication = :idu ORDER BY IDPublication ".$ordre);
            $requete->execute(array(':idu' => $id));
            try{
                while($donnees = $requete->fetch(PDO::FETCH_OBJ)){
                    $p = new Publication();
                    $p->chargerObjetBD($donnees);
                    array_push($listePublication,$p);
                }
            }catch(Exception $ex){
                $listePublication = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listePublication = null;
        }
        return $listePublication;      
    }

    public static function trouverParAttribut($ordre,$att,$val){       
        $connexion = ConnexionBD::getConnexion();
        $listePublication = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM publication WHERE ".$att." = :v ORDER BY IDPublication ".$ordre);
            $requete->execute(array(':v' => $val));
            try{
                while($donnees = $requete->fetch(PDO::FETCH_OBJ)){
                    $p = new Publication();
                    $p->chargerObjetBD($donnees);
                    array_push($listePublication,$p);
                }
            }catch(Exception $ex){
                $listePublication = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listePublication = null;
        }
        return $listePublication;      
    }

    public static function trouverParAttributParUtilisateur($ordre,$att,$val,$uid){       
        $connexion = ConnexionBD::getConnexion();
        $listePublication = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM publication WHERE ".$att." = :v AND utilisateurPublication = :uid ORDER BY IDPublication ".$ordre);
            $requete->execute(array(':v' => $val, ':uid' => $uid));
            try{
                while($donnees = $requete->fetch(PDO::FETCH_OBJ)){
                    $p = new Publication();
                    $p->chargerObjetBD($donnees);
                    array_push($listePublication,$p);
                }
            }catch(Exception $ex){
                $listePublication = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listePublication = null;
        }
        return $listePublication;      
    }

    public static function trouverParCollegeAvecDirection($ordre,$col,$dir){       
        $connexion = ConnexionBD::getConnexion();
        $listePublication = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM publication WHERE collegePublication = :c AND directionPublication = :d ORDER BY IDPublication ".$ordre);
            $requete->execute(array(':c' => $col,':d' => $dir));
            try{
                while($donnees = $requete->fetch(PDO::FETCH_OBJ)){
                    $p = new Publication();
                    $p->chargerObjetBD($donnees);
                    array_push($listePublication,$p);
                }
            }catch(Exception $ex){
                $listePublication = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listePublication = null;
        }
        return $listePublication;      
    }

    public static function trouverParCollegeAvecDirectionParUtilisateur($ordre,$col,$dir,$uid){       
        $connexion = ConnexionBD::getConnexion();
        $listePublication = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM publication WHERE collegePublication = :c AND directionPublication = :d AND utilisateurPublication = :uid ORDER BY IDPublication ".$ordre);
            $requete->execute(array(':c' => $col,':d' => $dir,':uid' => $uid));
            try{
                while($donnees = $requete->fetch(PDO::FETCH_OBJ)){
                    $p = new Publication();
                    $p->chargerObjetBD($donnees);
                    array_push($listePublication,$p);
                }
            }catch(Exception $ex){
                $listePublication = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listePublication = null;
        }
        return $listePublication;      
    }

    public static function miseAJourParObjet($objetPublication){
        $connexion = ConnexionBD::getConnexion();
        if($connexion != null){
            $requete = $connexion->prepare(
                "UPDATE publication SET collegePublication=:c,telephonePublication=:t,vehiculePublication=:v,directionPublication=:di,
                                        descriptionPublication=:d,codePostalPublication=:cp,utilisateurPublication=:u,datePublication=:da,
                                        heurePublication=:h
                    WHERE IDPublication = :id");
            $requete->execute(array(
                ':c' => $objetPublication->getCollege(),':t' => $objetPublication->getTelephone(),
                ':v' => $objetPublication->getVehicule(),':d' => $objetPublication->getDescription(),
                ':cp'=> $objetPublication->getCodePostal(),':di' => $objetPublication->getDirection(),
                ':u' => $objetPublication->getUtilisateur(),':id' => $objetPublication->getId(),
                ':da' => $objetPublication->getDate(),':h' => $objetPublication->getHeure()
            ));
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
            return true;
        }
        else{
            return false;
        }
    }

    public static function miseAJourParTableau($tableauPublication){
        $connexion = ConnexionBD::getConnexion();
        if($connexion != null){
            $requete = $connexion->prepare(
                "UPDATE publication SET collegePublication=:c,telephonePublication=:t,vehiculePublication=:v,directionPublication=:di,
                                        descriptionPublication=:d,codePostalPublication=:cp,utilisateurPublication=:u,datePublication=:da,
                                        heurePublication=:h
                WHERE IDPublication = :id");
            $requete->execute(array(
                ':c' => $tableauPublication['collegePublication'],':t' => $tableauPublication['telephonePublication'],
                ':v' => $tableauPublication['vehiculePublication'],':d' => $tableauPublication['descriptionPublication'],
                ':cp'=> $tableauPublication['codePostalPublication'],':di' => $tableauPublication['directionPublication'],
                ':u' => $tableauPublication['utilisateurPublication'],':id' => $tableauPublication['IDPublication'],
                ':da' => $tableauPublication['datePublication'],':h' => $tableauPublication['heurePublication']
            ));
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
            return true;
        }
        else{
            return false;
        }
    }

    public static function miseAJourAttribut($idPublication,$attribut,$valeur){
		$connexion = ConnexionBD::getConnexion();
        if($connexion != null){
            $requete = $connexion->prepare(
                "UPDATE publication SET ".$attribut."=:v WHERE IDPublication = :id");
            $requete->execute(array(':v' => $valeur,':id' => $idPublication));
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
            return true;
        }
        else{
            return false;
        }
    }
    
    public static function supprimerParId($idPublication){
		$connexion = ConnexionBD::getConnexion();	
        if($connexion != null){
            $requete = $connexion->prepare("DELETE FROM publication WHERE IDPublication = :id");
            $requete->execute(array(':id' => intval($idPublication)));
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
            return TRUE;
        }
        else{
            return FALSE;
        }		
	}
        public static function trouvrePublicationParIdUtilisateur($id){
        $connexion = ConnexionBD::getConnexion();
        $listePublication = Array();    
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM publication WHERE utilisateurPublication = ".$id);
            $requete->execute();
            try{
                while($donnees = $requete->fetch(PDO::FETCH_OBJ)){
                    $p = new Publication();
                    $p->chargerObjetBD($donnees);
                    array_push($listePublication,$p);
                }
            }catch(Exception $ex){
                $listePublication = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listePublication = null;
        }
        return $listePublication;
    }

    
}


?>