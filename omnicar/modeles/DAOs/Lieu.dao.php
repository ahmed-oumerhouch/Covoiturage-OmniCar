
<?php
/*
    insererParObjet($objetLieu) : Insère un enregistrement dans la table "lieu".
        Paramètre : $objetLieu, étant un objet entité Lieu().
        Retourne : $id étant l'IDLieu de l'enregistrement inseré, NULL si une erreur s'est produite (connexion ou PDO).
    
    insererParTableau($tableuLieu) : Insère un enregistrement dans la table "lieu".
        Paramètre : $tableuLieu, étant un tableau à attributs "lieu".
        Retourne : $id étant l'IDLieu de l'enregistrement inseré, NULL si une erreur s'est produite (connexion ou PDO).

    trouverToutAvecOBJ($ordre) : Recherche tous les enregistrements de la table "lieu".
        Paramètre : $ordre, étant l'ordre de la requête : "ASC" => ordre croissant, "DESC" => décroissant.
        Retourne : Array() contenant une liste d'objet entite Lieu() représentant tous les enregistrements de la table "lieu",
                   NULL si la table est vide ou si une erreur s'est produite (connexion ou PDO).

    trouverToutAvecASSOC($ordre) : Recherche tous les enregistrements de la table "lieu".
        Paramètre : $ordre, étant l'ordre de la requête : "ASC" => ordre croissant, "DESC" => décroissant.
        Retourne : Array() contenant la liste du résultat sous forme de tableau FETCH_ASSOC représentant tous les enregistrements de la table "lieu",
                   NULL si la table est vide ou si une erreur s'est produite (connexion ou PDO).

    trouverParIdAvecOBJ($id) : Recherche un enregistrement dans la table "lieu" selon son IDLieu.
        Paramètre : $id étant l'IDLieu de l'enregistrement à rechercher.
        Retourne : Lieu() étant l'objet entite représentant l'enregistrement trouvé,
                   NULL si l'enregistrement n'existe pas ou si une erreur s'est produite (connexion ou PDO).

    trouverParIdAvecASSOC($id) : Recherche un enregistrement dans la table "lieu" selon son IDLieu.
        Paramètre : $id étant l'IDLieu de l'enregistrement à rechercher.
        Retourne : $lieu[] étant un tableau représentant l'enregistrement trouvé,
                   NULL si l'enregistrement n'existe pas ou si une erreur s'est produite (connexion ou PDO).

    miseAJourParObjet($objetLieu) : Met à jour un enregistrement de la table "lieu".
        Paramètre : $objetLieu, étant un objet entité Lieu().
        Retourne : TRUE si la connexion avec la BD a été établie sinon FALSE.

    miseAJourParTableau($tableauLieu) : Met à jour un enregistrement de la table "lieu".
        Paramètre : $tableauLieu, étant un tableau à attributs "lieu".
        Retourne : TRUE si la connexion avec la BD a été établie sinon FALSE.

    miseAJourAttribut($idLieu,$attribut,$valeur) : Met à jour un attribut d'un enregistrement donné de la table "lieu".
        Paramètre : $idLieu, étant l'IDLIeu de l'enregistrement à mettre à jour.
                    $attribut, étant l'attribut de l'enregistrement à mettre à jour.
                    $valeur, étant la nouvelle valeur à attribuer à l'enregistrement.
        Retourne : TRUE si la connexion avec la BD a été établie sinon FALSE.

    supprimerParId($idLieu) : Supprime un enregistrement dans la table "lieu".
        Paramètre : $idLieu, étant l'IDLieu de l'enregistrement à supprimer.
        Retourne : TRUE si la connexion avec la BD a été établie sinon FALSE.
*/


require_once("./modeles/classes/ConnexionBD.classe.php");
require_once("./modeles/entites/Lieu.entite.php");

class LieuDAO{
	public static function insererParObjet($objetLieu){
        $connexion = ConnexionBD::getConnexion();
        $id = null;
        if($connexion != null){		
            $requete = $connexion->prepare(
                "INSERT INTO lieu (numCiviqueLieu,appartementLieu,rueLieu,villeLieu,
                                provinceLieu,paysLieu,descriptionLieu,coordonneesLieu,imageLieu)
                 VALUES (:nc,:a,:r,:v,:p,:pays,:d,:c,:i)"
            );
            $requete->execute(array(
                ':nc' => $objetLieu->getNumCivique(),':a' => $objetLieu->getAppartement(),':r' => $objetLieu->getRue(),':v' => $objetLieu->getVille(),
                ':p' => $objetLieu->getProvince(),':pays' => $objetLieu->getPays(),':d' => $objetLieu->getDescription(),
                ':c' => $objetLieu->getCoordonnees(),':i' => $objetLieu->getImage()
            ));
            $requete = $connexion->prepare("SELECT MAX(IDLieu) AS ID FROM lieu WHERE numCiviqueLieu = :nc AND rueLieu = :r AND villeLieu = :v");
            $requete->execute(array(':nc' => $objetLieu->getNumCivique(),':r' => $objetLieu->getRue(),':v' => $objetLieu->getVille()));
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

    public static function insererParTableau($tableauLieu){
        $connexion = ConnexionBD::getConnexion();
        $id = null;
        if($connexion != null){		
            $requete = $connexion->prepare(
                "INSERT INTO lieu (numCiviqueLieu,appartementLieu,rueLieu,villeLieu,provinceLieu,
                    paysLieu,descriptionLieu,coordonneesLieu,imageLieu)
                 VALUES (:nc,:a,:r,:v,:p,:pays,:d,:c,:i)"
            );
            $requete->execute(array(
                ':nc' => $tableauLieu['numCiviqueLieu'],':a' => $tableauLieu['appartementLieu'],':r' => $tableauLieu['rueLieu'],
                ':v' => $tableauLieu['villeLieu'],':p' => $tableauLieu['provinceLieu'],':pays' => $tableauLieu['paysLieu'],':d' => $tableauLieu['descriptionLieu'],
                ':c' => $tableauLieu['coordonneesLieu'],':i' => $tableauLieu['imageLieu']
            ));
            $requete = $connexion->prepare("SELECT MAX(IDLieu) AS ID FROM lieu WHERE numCiviqueLieu = :nc AND rueLieu = :r AND villeLieu = :v");
            $requete->execute(array(':nc' => $tableauLieu['numCiviqueLieu'],':r' => $tableauLieu['rueLieu'],':v' => $tableauLieu['villeLieu']));
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
    
    public static function trouverToutAvecOBJ($ordre){
		$connexion = ConnexionBD::getConnexion();
		$listeLieu = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM lieu ORDER BY IDLieu ".$ordre);
            $requete->execute();
            try{
                while($donnees = $requete->fetch(PDO::FETCH_OBJ)){
                    $l = new Lieu();
                    $l->chargerObjetBD($donnees);
                    array_push($listeLieu,$l);
                }
            }catch(Exception $ex){
                $listeLieu = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listeLieu = null;
        }
		return $listeLieu;
    }

    public static function trouverToutAvecASSOC($ordre){
		$connexion = ConnexionBD::getConnexion();
		$listeLieu = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM lieu ORDER BY idLieu ".$ordre);
            $requete->execute();
            try{
                while($donnees = $requete->fetch(PDO::FETCH_ASSOC)){
                    array_push($listeLieu,$donnees);
                }
            }catch(Exception $ex){
                $listeLieu = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listeLieu = null;
        }
		return $listeLieu;
    }
    
    public static function trouverParIdAvecOBJ($id){
		$connexion = ConnexionBD::getConnexion();
		$lieu = new Lieu();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM lieu WHERE IDLieu = :id");
            $requete->execute(array(':id' => $id));
            try{
                $donnees = $requete->fetch(PDO::FETCH_OBJ);
                if($donnees)
                    $lieu->chargerObjetBD($donnees);
                else{
                    $lieu = null;
                }
            }catch(Exception $ex){
                $lieu = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $lieu = null;
        }
		return $lieu;
    }

    public static function trouverParIdAvecASSOC($id){
		$connexion = ConnexionBD::getConnexion();
		$lieu = null;	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM lieu WHERE IDLieu = :id");
            $requete->execute(array(':id' => $id));
            try{
                $donnees = $requete->fetch(PDO::FETCH_ASSOC);
                if($donnees){
                    $lieu = $donnees;
                }
            }catch(Exception $ex){
                $lieu = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
		return $lieu;
    }
    
    public static function miseAJourParObjet($objetLieu){
		$connexion = ConnexionBD::getConnexion();
        if($connexion != null){
            $requete = $connexion->prepare(
                "UPDATE lieu SET numCiviqueLieu=:n,appartementLieu=:a,rueLieu=:r,villeLieu=:v,provinceLieu=:p,
                    paysLieu=:pays,descriptionLieu=:d,coordonneesLieu=:c,imageLieu=:i
                 WHERE IDLieu = :id");
            $requete->execute(array(
                ':n' => $objetLieu->getNumCivique(),':a' => $objetLieu->getAppartement(),':r' => $objetLieu->getRue(),':v' => $objetLieu->getVille(),
                ':p' => $objetLieu->getProvince(),':pays' => $objetLieu->getPays(),':d' => $objetLieu->getDescription(),
                ':c' => $objetLieu->getCoordonnees(),':i' => $objetLieu->getImage(),':id' => $objetLieu->getId()
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

    public static function miseAJourParTableau($tableauLieu){
		$connexion = ConnexionBD::getConnexion();
        if($connexion != null){
            $requete = $connexion->prepare(
                "UPDATE lieu SET numCiviqueLieu=:n,appartementLieu=:a,rueLieu=:r,villeLieu=:v,provinceLieu=:p,
                    paysLieu=:pays,descriptionLieu=:d,coordonneesLieu=:c,imageLieu=:i WHERE IDLieu = :id");
            $requete->execute(array(
                ':n' => $tableauLieu['numCiviqueLieu'],':a' => $tableauLieu['appartementLieu'],':r' => $tableauLieu['rueLieu'],':v' => $tableauLieu['villeLieu'],
                ':p' => $tableauLieu['provinceLieu'],':pays' => $tableauLieu['paysLieu'],':d' => $tableauLieu['descriptionLieu'],
                ':c' => $tableauLieu['coordonneesLieu'],':i' => $tableauLieu['imageLieu'],':id' => $tableauLieu['IDLieu']
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
    
    public static function miseAJourAttribut($idLieu,$attribut,$valeur){
		$connexion = ConnexionBD::getConnexion();
        if($connexion != null){
            $requete = $connexion->prepare(
                "UPDATE lieu SET ".$attribut."=:v WHERE IDLieu = :id");
            $requete->execute(array(':v' => $valeur,':id' => $idLieu));
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
            return true;
        }
        else{
            return false;
        }
    }

    public static function supprimerParId($idLieu){
		$connexion = ConnexionBD::getConnexion();	
        if($connexion != null){
            $requete = $connexion->prepare("DELETE FROM lieu WHERE IDLieu = :id");
            $requete->execute(array(':id' => intval($idLieu)));
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
            return TRUE;
        }
        else{
            return FALSE;
        }		
	}
}

?>