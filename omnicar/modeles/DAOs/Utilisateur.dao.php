<?php
/*
    insererParObjet($objetUtilisateur) : Insère un enregistrement dans la table "utilisateur".
        Paramètre : $objetUtilisateur, étant un objet entité Utilisateur().
        Retourne : $id étant l'IDUtilisateur de l'enregistrement inseré, NULL si une erreur s'est produite (connexion ou PDO).
    
    insererParTableau($tableuUtilisateur) : Insère un enregistrement dans la table "utilisateur".
        Paramètre : $tableuUtilisateur, étant un tableau à attributs utilisateur.
        Retourne : $id étant l'IDUtilisateur de l'enregistrement inseré, NULL si une erreur s'est produite (connexion ou PDO).

    trouverToutAvecOBJ($ordre) : Recherche tous les enregistrements de la table "utilisateur".
        Paramètre : $ordre, étant l'ordre de la requête : "ASC" => ordre croissant, "DESC" => décroissant.
        Retourne : Array() contenant une liste d'objet entite Utilisateur() représentant tous les enregistrements de la table "utilisateur",
                   NULL si la table est vide ou si une erreur s'est produite (connexion ou PDO).

    trouverToutAvecASSOC($ordre) : Recherche tous les enregistrements de la table "utilisateur".
        Paramètre : $ordre, étant l'ordre de la requête : "ASC" => ordre croissant, "DESC" => décroissant.
        Retourne : Array() contenant la liste du résultat sous forme de tableau FETCH_ASSOC représentant tous les enregistrements de la table "utilisateur",
                   NULL si la table est vide ou si une erreur s'est produite (connexion ou PDO).

    trouverParIdAvecOBJ($id) : Recherche un enregistrement dans la table "utilisateur" selon son IDUtilisateur.
        Paramètre : $id étant l'IDUtilisateur de l'enregistrement à rechercher.
        Retourne : Utilisateur() étant l'objet entite représentant l'enregistrement trouvé,
                   NULL si l'enregistrement n'existe pas ou si une erreur s'est produite (connexion ou PDO).

    trouverParIdAvecASSOC($id) : Recherche un enregistrement dans la table "utilisateur" selon son IDUtilisateur.
        Paramètre : $id étant l'IDUtilisateur de l'enregistrement à rechercher.
        Retourne : $utilisateur[] étant un tableau représentant l'enregistrement trouvé,
                   NULL si l'enregistrement n'existe pas ou si une erreur s'est produite (connexion ou PDO).

    miseAJourParObjet($objetUtilisateur) : Met à jour un enregistrement de la table "utilisateur".
        Paramètre : $objetUtilisateur, étant un objet entité Utilisateur().
        Retourne : TRUE si la connexion avec la BD a été établie sinon FALSE.

    miseAJourParTableau($tableauUtilisateur) : Met à jour un enregistrement de la table "utilisateur".
        Paramètre : $tableauUtilisateur, étant un tableau à attributs "utilisateur".
        Retourne : TRUE si la connexion avec la BD a été établie sinon FALSE.
    
    miseAJourAttribut($idUtilisateur,$attribut,$valeur) : Met à jour un attribut d'un enregistrement donné de la table "utilisateur".
        Paramètre : $idUtilisateur, étant l'IDUtilisateur de l'enregistrement à mettre à jour.
                    $attribut, étant l'attribut de l'enregistrement à mettre à jour.
                    $valeur, étant la nouvelle valeur à attribuer à l'enregistrement.
        Retourne : TRUE si la connexion avec la BD a été établie sinon FALSE.
    
    supprimerParId($idUtilisateur) : Supprime un enregistrement dans la table "utilisateur".
        Paramètre : $idUtilisateur, étant l'IDUtilisateur de l'enregistrement à supprimer.
        Retourne : TRUE si la connexion avec la BD a été établie sinon FALSE.

    courrielExistant($c) : Recherche si un enregistrement possède déjà le courrielUtilisateur passé en paramètre dans la table "utilisateur".
        Paramètre : $c étant le courrielUtilisateur à rechercher.
        Retourne : 0 si le courrielUtilisateur n'appartient à aucun enregistrement, 1 si un enregistrement le possède déjà
                   et -1 si une erreur s'est produite (connexion ou PDO).

*/

require_once("./modeles/classes/ConnexionBD.classe.php");
require_once("./modeles/entites/Utilisateur.entite.php");


class UtilisateurDAO{
    public static function insererParObjet($objetUtilisateur){
        $connexion = ConnexionBD::getConnexion();
        $id = null;
        if($connexion != null){		
            $requete = $connexion->prepare(
                "INSERT INTO utilisateur (nomUtilisateur,prenomUtilisateur,courrielUtilisateur,telephoneUtilisateur,
                        typeUtilisateur,noteUtilisateur,descriptionUtilisateur,vehiculeUtilisateur,motDePasseUtilisateur,
                        imageUtilisateur,adresseUtilisateur,codePostalUtilisateur)
                 VALUES (:nom,:p,:c,:tel,:t,:note,:d,:v,:m,:i,:a,:cp)"
            );
            $requete->execute(array(
                ':nom' => $objetUtilisateur->getNom(),':p' => $objetUtilisateur->getPrenom(),':c' => $objetUtilisateur->getCourriel(),
                ':tel' => $objetUtilisateur->getTelephone(),':t' => $objetUtilisateur->getType(),':note' => $objetUtilisateur->getNote(),
                ':d' => $objetUtilisateur->getDescription(),':v' => $objetUtilisateur->getVehicule(),':m' => $objetUtilisateur->getMotDePasse(),
                ':i' => $objetUtilisateur->getImage(),':a' => $objetUtilisateur->getAdresse(),':cp' => $objetUtilisateur->getCodePostal()
            ));
            $requete = $connexion->prepare("SELECT MAX(IDUtilisateur) AS ID FROM utilisateur WHERE courrielUtilisateur = :c");
            $requete->execute(array(':c' => $objetUtilisateur->getCourriel()));
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

    public static function insererParTableau($tableauUtilisateur){
        $connexion = ConnexionBD::getConnexion();
        $id = null;
        if($connexion != null){		
            $requete = $connexion->prepare(
                "INSERT INTO utilisateur (nomUtilisateur,prenomUtilisateur,courrielUtilisateur,telephoneUtilisateur,
                        typeUtilisateur,noteUtilisateur,descriptionUtilisateur,vehiculeUtilisateur,motDePasseUtilisateur,
                        imageUtilisateur,adresseUtilisateur,codePostalUtilisateur)
                 VALUES (:nom,:p,:c,:tel,:t,:note,:d,:v,:m,:i,:a,:cp)"
            );
            $requete->execute(array(
                ':nom' => $tableauUtilisateur['nomUtilisateur'],':p' => $tableauUtilisateur['prenomUtilisateur'],
                ':c' => $tableauUtilisateur['courrielUtilisateur'],':tel' => $tableauUtilisateur['telephoneUtilisateur'],
                ':t' => $tableauUtilisateur['typeUtilisateur'],':note' => $tableauUtilisateur['noteUtilisateur'],
                ':d' => $tableauUtilisateur['descriptionUtilisateur'],':v' => $tableauUtilisateur['vehiculeUtilisateur'],
                ':m' => $tableauUtilisateur['motDePasseUtilisateur'],':i' => $tableauUtilisateur['imageUtilisateur'],
                ':a' => $tableauUtilisateur['adresseUtilisateur'],':cp' => $tableauUtilisateur['codePostalUtilisateur']
            ));
            $requete = $connexion->prepare("SELECT MAX(IDUtilisateur) AS ID FROM utilisateur WHERE courrielUtilisateur = :c");
            $requete->execute(array(':c' => $tableauUtilisateur['courrielUtilisateur']));
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
		$listeUtilisateur = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM utilisateur ORDER BY IDUtilisateur ".$ordre);
            $requete->execute();
            try{
                while($donnees = $requete->fetch(PDO::FETCH_OBJ)){
                    $u = new Utilisateur();
                    $u->chargerObjetBD($donnees);
                    array_push($listeUtilisateur,$u);
                    
                }
            }catch(Exception $ex){
                $listeUtilisateur = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listeUtilisateur = null;
        }
		return $listeUtilisateur;
    }

    public static function trouverToutAvecASSOC($ordre){
		$connexion = ConnexionBD::getConnexion();
		$listeUtilisateur = Array();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM utilisateur ORDER BY IDUtilisateur ".$ordre);
            $requete->execute();
            try{
                while($donnees = $requete->fetch(PDO::FETCH_ASSOC)){
                    array_push($listeUtilisateur,$donnees);
                }
            }catch(Exception $ex){
                $listeUtilisateur = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $listeUtilisateur = null;
        }
		return $listeUtilisateur;
    }

    public static function trouverParIdAvecOBJ($id){
		$connexion = ConnexionBD::getConnexion();
		$utilisateur = new Utilisateur();	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE IDUtilisateur = :id");
            $requete->execute(array(':id' => $id));
            try{
                $donnees = $requete->fetch(PDO::FETCH_OBJ);
                if($donnees)
                    $utilisateur->chargerObjetBD($donnees);
                else{
                    $utilisateur = null;
                }
            }catch(Exception $ex){
                $utilisateur = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $utilisateur = null;
        }
		return $utilisateur;
    }

    public static function trouverParIdAvecASSOC($id){
		$connexion = ConnexionBD::getConnexion();
		$utilisateur = null;	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE IDUtilisateur = :id");
            $requete->execute(array(':id' => $id));
            try{
                $donnees = $requete->fetch(PDO::FETCH_ASSOC);
                if($donnees){
                    $utilisateur = $donnees;
                }
            }catch(Exception $ex){
                $utilisateur = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
		return $utilisateur;
    }

    public static function miseAJourParObjet($objetUtilisateur){
		$connexion = ConnexionBD::getConnexion();
        if($connexion != null){
            $requete = $connexion->prepare(
                "UPDATE utilisateur SET nomUtilisateur=:nom,prenomUtilisateur=:p,courrielUtilisateur=:c,
                    telephoneUtilisateur=:tel,typeUtilisateur=:t,noteUtilisateur=:note,descriptionUtilisateur=:d,
                    vehiculeUtilisateur=:v,motDePasseUtilisateur=:mdp,imageUtilisateur=:i,adresseUtilisateur=:a,codePostalUtilisateur=:cp
                 WHERE IDUtilisateur = :id");
            $requete->execute(array(
                ':nom' => $objetUtilisateur->getNom(),':p' => $objetUtilisateur->getPrenom(),
                ':c' => $objetUtilisateur->getCourriel(),':tel' => $objetUtilisateur->getTelephone(),
                ':t' => $objetUtilisateur->getType(),':note' => $objetUtilisateur->getNote(),
                ':d' => $objetUtilisateur->getDescription(),':v' => $objetUtilisateur->getVehicule(),
                ':mdp' => $objetUtilisateur->getMotDePasse(),':i' => $objetUtilisateur->getImage(),
                ':a' => $objetUtilisateur->getAdresse(),':cp' => $objetUtilisateur->getCodePostal(),':id' => $objetUtilisateur->getId()
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

    public static function miseAJourParTableau($tableauUtilisateur){
		$connexion = ConnexionBD::getConnexion();
        if($connexion != null){
            $requete = $connexion->prepare(
                "UPDATE utilisateur SET nomUtilisateur=:nom,prenomUtilisateur=:p,courrielUtilisateur=:c,
                    telephoneUtilisateur=:tel,typeUtilisateur=:t,noteUtilisateur=:note,descriptionUtilisateur=:d,
                    vehiculeUtilisateur=:v,motDePasseUtilisateur=:mdp,imageUtilisateur=:i,adresseUtilisateur=:a,codePostalUtilisateur=:cp
                 WHERE IDUtilisateur = :id");
            $requete->execute(array(
                ':nom' => $tableauUtilisateur['nomUtilisateur'],':p' => $tableauUtilisateur['prenomUtilisateur'],
                ':c' => $tableauUtilisateur['courrielUtilisateur'],':tel' => $tableauUtilisateur['telephoneUtilisateur'],
                ':t' => $tableauUtilisateur['typeUtilisateur'],':note' => $tableauUtilisateur['noteUtilisateur'],
                ':d' => $tableauUtilisateur['descriptionUtilisateur'],':v' => $tableauUtilisateur['vehiculeUtilisateur'],
                ':mdp' => $tableauUtilisateur['motDePasseUtilisateur'],':i' => $tableauUtilisateur['imageUtilisateur'],
                ':a' => $tableauUtilisateur['adresseUtilisateur'],':cp' => $tableauUtilisateur['codePostalUtilisateur'],':id' => $tableauUtilisateur['IDUtilisateur']
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

    public static function miseAJourAttribut($idUtilisateur,$attribut,$valeur){
		$connexion = ConnexionBD::getConnexion();
        if($connexion != null){
            $requete = $connexion->prepare(
                "UPDATE utilisateur SET ".$attribut."=:v WHERE IDUtilisateur = :id");
            $requete->execute(array(':v' => $valeur,':id' => $idUtilisateur));
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
            return true;
        }
        else{
            return false;
        }
    }

    public static function supprimerParId($idUtilisateur){
		$connexion = ConnexionBD::getConnexion();	
        if($connexion != null){
            $requete = $connexion->prepare("DELETE FROM utilisateur WHERE IDUtilisateur = :id");
            $requete->execute(array(':id' => intval($idUtilisateur)));
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
            return TRUE;
        }
        else{
            return FALSE;
        }		
	}
    
    public static function courrielExistant($c){
		$connexion = ConnexionBD::getConnexion();
		$courrielExistant = 0;	
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE courrielUtilisateur = :c");
            $requete->execute(array(':c' => $c));
            try{
                $donnees = $requete->fetch(PDO::FETCH_OBJ);
                if($donnees)
                    $courrielExistant = 1;
            }catch(Exception $ex){
                $courrielExistant = -1;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $courrielExistant = -1;
        }
		return $courrielExistant;
    }


    public static function recevoirmdp($c){
        $connexion = ConnexionBD::getConnexion();
        $utilisateur = null;    
        if($connexion != null){
            $requete = $connexion->prepare("SELECT motDePasseUtilisateur FROM utilisateur WHERE courrielUtilisateur = :c");
            $requete->execute(array(':c' => $c));
            try{
                $donnees = $requete->fetch(PDO::FETCH_ASSOC);
                if($donnees){
                    $utilisateur = $donnees["motDePasseUtilisateur"];
                }
            }catch(Exception $ex){
                $utilisateur = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        return $utilisateur;
    }
    public static function getObjectParCourriel ($d)
    {
        $connexion = ConnexionBD::getConnexion();
        $utilisateur = new Utilisateur();   
        if($connexion != null){
            $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE courrielUtilisateur = :d");
            $requete->execute(array(':d' => $d));
            try{
                $donnees = $requete->fetch(PDO::FETCH_OBJ);
                if($donnees)
                    $utilisateur->chargerObjetBD($donnees);
                else{
                    $utilisateur = null;
                }
            }catch(Exception $ex){
                $utilisateur = null;
            }
            $requete->closeCursor();
            $requete = null;
            ConnexionBD::fermerConnexion();
        }
        else{
            $utilisateur = null;
        }
        return $utilisateur;

    }
}

?>