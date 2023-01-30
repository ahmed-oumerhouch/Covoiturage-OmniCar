<?php
if(!ISSET($_SESSION))
	session_start();
if(!ISSET($_SESSION['membre']))
	header('Location: ../index.php');
  require_once('./modeles/entites/Utilisateur.entite.php'); 
  require_once('./modeles/entites/Publication.entite.php'); 
  require_once('./modeles/DAOs/Publication.dao.php'); 
  require_once('./config/Config.interface.php');
  require_once('./modeles/classes/ConvertDateTime.php');
  require_once('./modeles/classes/ConvertCodePostale.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Acceuil de connection</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" type="text/css" href="./css/styleAcceuilConnexion.css">
    <link rel="stylesheet" href="./css/popUp.css">
	  <script src="./js/jQuery_min.js"></script>
    <script src="./js/Requete.js"></script>
    <script src="./js/GoogleLocalisation.js"></script>
    <script src="./js/RecherchePublication.js"></script>
    <script src="./js/SoumettreFormulairePublication.js"></script>
</head>
<body>
  <nav class="zone white sticky">
      <ul class="main-nav">
        <li> <a href="?action=afficher&page=accueilConnexion"><img src="./image/omnicar_logo.png" width="270" height="80"></a></li>
        <li class="push"> 
          <div class="dropdown" style="float:right;">
            <button class="dropbtn"><img src="./image/user.png" width="30" height="30"></button>
            <div class="dropdown-content">
              <a  style="text-decoration: underline;" ><?= $_SESSION["membre"]->getPrenom()." ".$_SESSION["membre"]->getNom(); ?></a>
              <a href="?action=afficher&page=page_compte">Compte</a>                         
              <a href="#"onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Publier un départ</a>      
              <a href="">Mes Messages</a>
              <a href="?action=afficher&page=page_mes_departs">Mes Départs</a>
              <a href="?action=deconnexion">Déconnexion</a>
            </div>
          </div>
      </li>
      </ul>
  </nav>
<div class=" zone white center">
    <nav class="zone white">
      <ul class="nav2 main-nav ">
        <li> 
          <select class="dropdown-select" name="nom" size="1" id="selectCollege">
              <OPTION value="">Choisir un Collège
              <OPTION value="Collège de Rosemont">Collège de Rosemont
              <OPTION value="Collège de Maisonneuve">Collège de Maisonneuve
              <OPTION value="Collège Bois de Boulogne">Collège Bois de Boulogne 
          </select>
        </li>
        <li> 
          <select class="dropdown-select" name="nom" size="1" id="selectDirection">
              <OPTION value="">Aller/Retour
              <OPTION value="Aller">Aller
              <OPTION value="Retour">Retour
          </select>
        </li>
        <li>
          <input type="search" id="codePostal" name="q" placeholder="Code postal" />
        </li> 
        <li >          
          <div class="button"style="float:right; margin-top:0.2px">
            <button id="site-search" type="button" onclick="new RecherchePublication('<?=Config::DOMAIN_NAME?>','<?=Config::GOOGLE_API_KEY?>','mesDeparts')">Rechercher</button>
          </div>
        </li> 

      </ul>
    </nav> 
  </div>  
    <br><br><br>
<div class="zone grid-wrapper" id="conteneurPublications">
<?php
            $id = $_SESSION["membre"]->getId();
      $publications = PublicationDAO::trouverParUtilisateur("DESC",$id);
            foreach($publications as $p){
        $utilisateur = UtilisateurDAO::trouverParIdAvecOBJ($p->getUtilisateur());
?>
        <div class="card">
            <div>
            <?php
              for($i=0;$i < 5;$i++){
                if($i < $utilisateur->getNote()){
                  echo '<img src="./image/star.png" width="10" height="10"> ';
                }else{
                  echo '<img src="./image/star_vide.png" width="10" height="10"> ';
                }
              }
               
?>
            </div>
            </br>
            
            <p id="A1" style= "margin-bottom:  35px;"><?=$p->getDate();?> | <?=ConvertDateTime::formatHeure($p->getHeure()) ;?></p>
            <img src="./image/car.png" width="30" height="30">
               <p id="A1" style= "margin-bottom:  35px;"><?=$p->getVehicule();?></p>
            <img src="./image/home.png" width="30" height="30">
                <p id="A2"style= "margin-bottom:  35px;"><?=$p->getDescription();?></p>
            <img src="./image/letter.png" width="30" height="30">
                <p id="A2"style= "margin-bottom:  35px;"><?=ConvertCodePostale::formatCode($p->getCodePostal()) ;?></p>
            <img src="./image/telephone.png" width="30" height="30">
               <p id="A4"style= "margin-bottom:  35px;"><?=$p->getTelephone();?></p>   
            <img src="./image/direction.png" width="35" height="35">  
               <p style= "margin-bottom:  35px;"><?= $p->getDirection();?></p>   
              <form name="testForm" id="testForm"  method="POST"  >
                <input name="woo" id="woo" type="hidden" value="<?= $p->getId(); ?>">
            <button  type="submit" name="btn" value="submit" autofocus  onclick=" return true;" style="width:auto;">Mise à jour</button>
            </form>
          </div>
<?PHP
      }
?>
 
 <?php
    if(isset($_POST['btn'])){
      $k =  $_POST['woo'];
      $La_publications = PublicationDAO::trouverParIdAvecOBJ($k);

    

      echo '

  <div id="id01" style="display: block;" class="modal">
    <form class="modal-content animate" method="post">
<input name="wooo" id="wooo" type="hidden" value="'.$La_publications->getId() .'">
        <div class="modifierTrajet">
          <table cellpadding="10">          
            <tr>
              <td><img src="./image/ecole.jpg" width="32" height="32"></td>
              <td>
                    <select id="nom_du_collegeMSG" name="nom_du_collegeMSG" class="dropdown-select">
                      <OPTION value="'.$La_publications->getCollege().'"> '.$La_publications->getCollege().'
                      <OPTION value="Collège de Rosemont">Collège de Rosemont
                      <OPTION value="Collège de Maisonneuve">Collège de Maisonneuve
                      <OPTION value="Collège Bois de Boulogne">Collège Bois de Boulogne
                    </select>
              </td>
            </tr>
            <tr>
              <td><img src="./image/car.png" width="32" height="32"></td>
                <td><input id="voiture_MSG" name="voiture_MSG" type="text" placeholder="marque, modèle, année, couleur" value="'.$La_publications->getVehicule() .'"></td>
            </tr>
            <tr>
              <td><img src="./image/home.png" width="32" height="32"></td>
                <td><input id="adresse_MSG" name="adresse_MSG" type="text" placeholder="adresse (6400 16e Avenue, H1X 2S9)" value="'.$La_publications->getDescription() .'"></td>
            </tr>
            <tr>
              <td><img src="./image/letter.png" width="32" height="32"></td>
              <td><input id="codePostalmdfg" name="codePostalmdfg"   class="inputPop" type="text" placeholder="Code postal" value="'.$La_publications->getCodePostal() .'"></td>
            </tr>
            <tr>
              <td><img src="./image/calendar.png" width="32" height="32"></td>
              <td><input type="date" id="date" name="date" value="'.$La_publications->getDate() .'" ></td>
            </tr>
            <tr>
              <td><img src="./image/clock.png" width="32" height="32"></td>
              <td><input type="time" id="time" name="time" value="'.$La_publications->getHeure() .'"  ></td>
            </tr>


            <tr>
              <td><img src="./image/telephone.png" width="32" height="32"></td>
                <td><input id="telephone_MSG" name="telephone_MSG" type="text" placeholder="téléphone (514-123-4567)"  value="'.$La_publications->getTelephone() .'"></td>
            </tr>
            <tr>
              <td><img src="./image/direction.png" width="32" height="32"></td>
                  <td> ';
$valeur = $La_publications->getDirection();

if ($valeur == "Aller"){
  echo '
                    <input class="bouton_radio" type="radio" id="btn_aller" name="btn_radio" value="Aller" checked="checked"> 
                    <label class="label_radio">Aller</label>
                    <input class="bouton_radio" type="radio" id="btn_retour" name="btn_radio" value="Retour"> 
                    <label class="label_radio">Retour</label>
                  </td>
            </tr>
          </table>
          
        </div>
        <div class="button">
            <button type="submit" name="action" value="MAJdepart">Mise à jour</button>
        </div>
        <div class="button">
            <button type="submit" name="action" value="Deletedepart">Supprimer</button>
        </div>
    </form>
  </div> ';
}else{
echo '
                    <input class="bouton_radio" type="radio" id="btn_aller" name="btn_radio" value="Aller"> 
                    <label class="label_radio">Aller</label>
                    <input class="bouton_radio" type="radio" id="btn_retour" name="btn_radio" value="Retour" checked="checked"> 
                    <label class="label_radio">Retour</label>
                  </td>
            </tr>
          </table>
          
        </div>
        <div class="button">
            <button type="submit" name="action" value="MAJdepart">Mise à jour</button>
        </div>
        <div class="button">
            <button type="submit" name="action" value="Deletedepart">Supprimer</button>
        </div>
    </form>
  </div> ';

}

     }
  ?>
   


   <?php
    if(ISSET($_SESSION['messageMiseAJour'])){
      echo "<script>alert('".$_SESSION['messageMiseAJour']."')</script>";
      UNSET($_SESSION['messageMiseAJour']);
    }
    if(ISSET($_SESSION['messageSupprimer'])){
      echo "<script>alert('".$_SESSION['messageSupprimer']."')</script>";
      UNSET($_SESSION['messageSupprimer']);
    }

?>
  <!-- fin page pop up MAJ --------------------------------------------------------------->

  <!-- page pop up publier depart --------------------------------------------------------------->
   <div id="id02" class="modal2">
    <form class="modal2-content animate" action="" method="post">
        <div class="ajoutTrajet">
          <table cellpadding="10">          
                          <tr>
                  <td><img src="./image/ecole.jpg" width="32" height="32"></td>
                  <!--<td><input name="college" class="inputPop" type="text" placeholder="nom du collège"></td>-->
                  <td>
                    <select name="college" class="dropdown-select">
                      <OPTION value="">Choisir un Collège
                      <OPTION value="Collège de Rosemont">Collège de Rosemont
                      <OPTION value="Collège de Maisonneuve">Collège de Maisonneuve
                      <OPTION value="Collège Bois de Boulogne">Collège Bois de Boulogne
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><img src="./image/car.png" width="32" height="32"></td>
                  <td><input name="vehicule" class="inputPop" type="text" placeholder="marque, modèle, année, couleur"></td>
                </tr>
                <tr>
                  <td><img src="./image/home.png" width="32" height="32"></td>
                  <td><input name="description" class="inputPop" type="text" placeholder="adresse (6400 16e Avenue, H1X 2S9)"></td>
                </tr>
                <tr>
                  <td><img src="./image/letter.png" width="32" height="32"></td>
                  <td><input id="codePostal_MSG" name="codePostal" name="codePostal" class="inputPop" type="text" placeholder="Code postal"></td>
                </tr>
                <tr>
                  <td><img src="./image/calendar.png" width="32" height="32"></td>
                  <td><input type="date" id="date" name="date"></td>
                </tr>
                <tr>
                  <td><img src="./image/clock.png" width="32" height="32"></td>
                  <td><input type="time" id="time" name="time"></td>
                </tr>
                <tr>
                  <td><img src="./image/telephone.png" width="32" height="32"></td>
                  <td><input name="telephone" class="inputPop" type="text" placeholder="téléphone (514-123-4567)"></td>
                </tr>
                <tr> 
                  <td><img src="./image/direction.png" width="32" height="32"></td>
                  <td>
                    <input class="bouton_radio" type="radio" id="btn_aller" name="btn_radio" value="Aller"> 
                    <label class="label_radio">Aller</label>
                    <input class="bouton_radio" type="radio" id="btn_retour" name="btn_radio" value="Retour"> 
                    <label class="label_radio">Retour</label>
                  </td>
                </tr>
          </table>
        </div>
        <div class="button">
            <button type="submit" name="action" value="publicationDepart">Ajouter</button>
        </div>
    </form>
  </div>
  <!-- fin page pop up publier depart --------------------------------------------------------------->
  <script src="./js/popUp.js">  </script>

    <!-- FIN page pop up ------------------------------------------------------------->

<!-- fin grand div -->
    </div>

<br><br><br><br><br><br><br><br><br><br><br><br>

<!-- Footer -->
  <footer class="zone yellow ">    
    <a href="" style="font-size: 1.2em;">Vos commentaires |</a>
    <a href="" style="font-size: 1.2em;">version mobile</a>
    <p align="center">514-970-8318 (sans frais)</p>
    © 2020 Covoiturage OmniCar. Tous droits réservés

  </footer>
</body>
</html>