<?php
require_once('./Config/Config.interface.php');
require_once('./modeles/interfaces/Action.interface.php');
require_once('./modeles/interfaces/PRG.interface.php');
require_once('./modeles/entites/Utilisateur.entite.php');
require_once('./modeles/DAOs/Utilisateur.dao.php');
require_once('./modeles/entites/Publication.entite.php');
require_once('./modeles/DAOs/Publication.dao.php');

class RecherchePublication implements Action,PRG{
	public function executer(){
        if(!ISSET($_SESSION))
            session_start();
        if($_REQUEST['page'] == "accueilConnexion"){
            if($_REQUEST['college'] == "" && $_REQUEST['direction'] == "" && $_REQUEST['codePostal'] == ""){
                $_SESSION['listePublications'] = $publications = PublicationDAO::trouverToutAvecOBJ('DESC');
                return "recherchePublications";
            }
            if($_REQUEST['college'] != "" && $_REQUEST['direction'] == "" && $_REQUEST['codePostal'] == ""){
                $_SESSION['listePublications'] = $publications = PublicationDAO::trouverParAttribut('DESC','collegePublication',$_REQUEST['college']);
                return "recherchePublications";
            }
            if($_REQUEST['college'] != "" && $_REQUEST['direction'] != "" && $_REQUEST['codePostal'] == ""){
                $_SESSION['listePublications'] = $publications = PublicationDAO::trouverParCollegeAvecDirection('DESC',$_REQUEST['college'],$_REQUEST['direction']);
                return "recherchePublications";
            }
        
            if($_REQUEST['college'] == "" && $_REQUEST['direction'] == "" && $_REQUEST['codePostal'] != ""){
                $publications = PublicationDAO::trouverToutAvecOBJ('DESC');
                $resultat = Array();
                foreach($publications as $p){
                    $cp = explode(';',$p->getCodePostal());
                    $pLat = $cp[1];
                    $pLon = $cp[2];
                    $rLat = $_REQUEST['lat'];
                    $rLon = $_REQUEST['lon'];
                    $distance = sqrt(pow($pLat-$rLat,2) + pow($pLon-$rLon,2)) * 86.29798182272748;
                    if($distance < 15){
                        array_push($resultat,$p);
                    } 
                }
                $_SESSION['listePublications'] = $resultat;
                return "recherchePublications";
            }
            if($_REQUEST['college'] != "" && $_REQUEST['direction'] == "" && $_REQUEST['codePostal'] != ""){
                $publications = PublicationDAO::trouverParAttribut('DESC','collegePublication',$_REQUEST['college']);
                $resultat = Array();
                foreach($publications as $p){
                    $cp = explode(';',$p->getCodePostal());
                    $pLat = $cp[1];
                    $pLon = $cp[2];
                    $rLat = $_REQUEST['lat'];
                    $rLon = $_REQUEST['lon'];
                    $distance = sqrt(pow($pLat-$rLat,2) + pow($pLon-$rLon,2)) * 86.29798182272748;
                    if($distance < 15){
                        array_push($resultat,$p);
                    } 
                }
                $_SESSION['listePublications'] = $resultat;
                return "recherchePublications";
            }

            if($_REQUEST['college'] != "" && $_REQUEST['direction'] != "" && $_REQUEST['codePostal'] != ""){
                $publications = PublicationDAO::trouverParCollegeAvecDirection('DESC',$_REQUEST['college'],$_REQUEST['direction']);
                $resultat = Array();
                foreach($publications as $p){
                    $cp = explode(';',$p->getCodePostal());
                    $pLat = $cp[1];
                    $pLon = $cp[2];
                    $rLat = $_REQUEST['lat'];
                    $rLon = $_REQUEST['lon'];
                    $distance = sqrt(pow($pLat-$rLat,2) + pow($pLon-$rLon,2)) * 86.29798182272748;
                    if($distance < 15){
                        array_push($resultat,$p);
                    } 
                }
                $_SESSION['listePublications'] = $resultat;
                return "recherchePublications";
            }
        }
        elseif($_REQUEST['page'] == "mesDeparts"){
            if($_REQUEST['college'] == "" && $_REQUEST['direction'] == "" && $_REQUEST['codePostal'] == ""){
                $_SESSION['listePublications'] = $publications = PublicationDAO::trouverParUtilisateur('DESC',$_SESSION['membre']->getId());
                return "recherchePublicationsMembre";
            }
            if($_REQUEST['college'] != "" && $_REQUEST['direction'] == "" && $_REQUEST['codePostal'] == ""){
                $_SESSION['listePublications'] = $publications = PublicationDAO::trouverParAttributParUtilisateur('DESC','collegePublication',$_REQUEST['college'],$_SESSION['membre']->getId());
                return "recherchePublicationsMembre";
            }
            if($_REQUEST['college'] != "" && $_REQUEST['direction'] != "" && $_REQUEST['codePostal'] == ""){
                $_SESSION['listePublications'] = $publications = PublicationDAO::trouverParCollegeAvecDirectionParUtilisateur('DESC',$_REQUEST['college'],$_REQUEST['direction'],$_SESSION['membre']->getId());
                return "recherchePublicationsMembre";
            }
        
            if($_REQUEST['college'] == "" && $_REQUEST['direction'] == "" && $_REQUEST['codePostal'] != ""){
                $publications = PublicationDAO::trouverParUtilisateur('DESC',$_SESSION['membre']->getId());
                $resultat = Array();
                foreach($publications as $p){
                    $cp = explode(';',$p->getCodePostal());
                    $pLat = $cp[1];
                    $pLon = $cp[2];
                    $rLat = $_REQUEST['lat'];
                    $rLon = $_REQUEST['lon'];
                    $distance = sqrt(pow($pLat-$rLat,2) + pow($pLon-$rLon,2)) * 86.29798182272748;
                    if($distance < 15){
                        array_push($resultat,$p);
                    } 
                }
                $_SESSION['listePublications'] = $resultat;
                return "recherchePublicationsMembre";
            }
            if($_REQUEST['college'] != "" && $_REQUEST['direction'] == "" && $_REQUEST['codePostal'] != ""){
                $publications = PublicationDAO::trouverParAttributParUtilisateur('DESC','collegePublication',$_REQUEST['college'],$_SESSION['membre']->getId());
                $resultat = Array();
                foreach($publications as $p){
                    $cp = explode(';',$p->getCodePostal());
                    $pLat = $cp[1];
                    $pLon = $cp[2];
                    $rLat = $_REQUEST['lat'];
                    $rLon = $_REQUEST['lon'];
                    $distance = sqrt(pow($pLat-$rLat,2) + pow($pLon-$rLon,2)) * 86.29798182272748;
                    if($distance < 15){
                        array_push($resultat,$p);
                    } 
                }
                $_SESSION['listePublications'] = $resultat;
                return "recherchePublicationsMembre";
            }

            if($_REQUEST['college'] != "" && $_REQUEST['direction'] != "" && $_REQUEST['codePostal'] != ""){
                $publications = PublicationDAO::trouverParCollegeAvecDirectionParUtilisateur('DESC',$_REQUEST['college'],$_REQUEST['direction'],$_SESSION['membre']->getId());
                $resultat = Array();
                foreach($publications as $p){
                    $cp = explode(';',$p->getCodePostal());
                    $pLat = $cp[1];
                    $pLon = $cp[2];
                    $rLat = $_REQUEST['lat'];
                    $rLon = $_REQUEST['lon'];
                    $distance = sqrt(pow($pLat-$rLat,2) + pow($pLon-$rLon,2)) * 86.29798182272748;
                    if($distance < 15){
                        array_push($resultat,$p);
                    } 
                }
                $_SESSION['listePublications'] = $resultat;
                return "recherchePublicationsMembre";
            }
        }
        return "pageVide";
    }
}
?>