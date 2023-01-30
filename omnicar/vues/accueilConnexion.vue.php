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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
              <a href="#"onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Publier un départ</a>      
              <a href="?action=mesMessages">Mes Messages</a>
              <a href="?action=afficher&page=page_mes_departs">Mes Départs</a>
              <a href="?action=deconnexion">Déconnexion</a>
            </div>
          </div>
      </li>
      </ul>
  </nav>
<div class=" zone white center">
  <h2>Acceuil</h2>
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
            <button id="site-search" type="button" onclick="new RecherchePublication('<?=Config::DOMAIN_NAME?>','<?=Config::GOOGLE_API_KEY?>','accueilConnexion')">Rechercher</button>
          </div>
        </li> 

      </ul>
    </nav> 
  </div>  
    <br><br><br>
    <div> <center id="boiteMessagePublication"></center> </div>
    <div class="grid-wrapper" id="conteneurPublications">
<?php
      $publications = PublicationDAO::trouverToutAvecOBJ('DESC');
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
            <p id="A1" style= "margin-bottom:  35px;"><?=$p->getDate();?> | <?=ConvertDateTime::formatHeure($p->getHeure());?></p>
            <img src="./image/avatar.png" width="30" height="30">
            <p style= "margin-bottom:  35px;" ><?=$utilisateur->getNom().",".$utilisateur->getPrenom();?></p>
            <img src="./image/car.png" width="30" height="30">
            <p style= "margin-bottom:  35px;"><?=$p->getVehicule();?></p>
            <img src="./image/home.png" width="30" height="30">
            <p style= "margin-bottom:  35px;"><?=$p->getDescription();?></p>
            <img src="./image/telephone.png" width="30" height="30">
            <p style= "margin-bottom:  35px;"><?=$p->getTelephone();?></p>   
            <img src="./image/direction.png" width="35" height="35">  
            <p style= "margin-bottom:  35px;"><?=$p->getDirection();?></p> 

 

            <form name="testForm" id="testForm"  method="POST"  >
                <input name="woo" id="woo" type="hidden" value="<?= $utilisateur->getId(); ?>">
                <input name="wooo" id="wooo" type="hidden" value="<?= $p->getDirection(); ?>">
                <input name="woooo" id="woooo" type="hidden" value="<?= $p->getCollege(); ?>">
            <button  type="submit" name="btn" value="submit" autofocus  onclick=" return true;" style="width:auto;">Envoyer un message</button>
            </form> 

        </div>
<?PHP
      }


?>
    </div>
    <!-- page pop up  --------------------------------------------------------------->
<?PHP
if(isset($_POST['btn'])){
          $k =  $_POST['woo'];
          $ko =  $_POST['wooo'];
          $koo =  $_POST['woooo'];
          echo '<div id="id03" class="modal3">
          <form class="modal3-content animate"  method="post">
          <h1 style="padding-left:2%;">Message</h1>
          <input name="idutilisateur" id="idutilisateur" type="hidden" value="'.$k.'">
          <input name="directiontitre" id="directiontitre" type="hidden" value="'.$ko.'">
          <input name="collegetitre" id="collegetitre" type="hidden" value="'.$koo.'">
          </br>
          <div style="padding-left:2%;padding-right:2%;"> 
          <table>
          <tr>
            <td style="width:100%; height: 90px;">
               <textarea placeholder="" name="msg" required style="width:100%; height: 90px;"></textarea>
            </td>
            <td>
               <button type="submit" name="action" value="acceuilEnvoyerMessage" >Envoyer <i class="fa fa-paper-plane-o"></i></button>
            </td>
          </tr>
           </table>
           </div>
          </br>
           </br></br></br>
           </form>

          </div>';
          

}



      if(ISSET($_SESSION['MessageRedirection'])){
        if($_SESSION['MessageRedirection'] == "true")
        {
          echo '<div id="id03" class="modal3">
          <form class="modal3-content animate"  method="post">
          <h1 style="padding-left:2%;">Message Envoyé</h1>
          </form>
          </div>';
        }
        
        UNSET($_SESSION['MessageRedirection']);
      }

    ?>
 
       
         
            


    <!-- page pop up  --------------------------------------------------------------->
  <div id="id01" class="modal ">
    <form class="modal-content animate" action="" method="post" id="formulairePublication">
        <div class="ajoutTrajet">
          <table cellpadding="10">          
                  <tr>
                    <td><img src="./image/ecole.jpg" width="32" height="32"></td>
                    <!--<td><input name="college" class="inputPop" type="text" placeholder="nom du collège"></td>-->
                    <td>
                      <select name="college" class="dropdown-select" required>
                        <OPTION value="">Choisir un Collège
                        <OPTION value="Collège de Rosemont">Collège de Rosemont
                        <OPTION value="Collège de Maisonneuve">Collège de Maisonneuve
                        <OPTION value="Collège Bois de Boulogne">Collège Bois de Boulogne
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><img src="./image/car.png" width="32" height="32"></td>
                    <td><input required name="vehicule" class="inputPop" type="text" placeholder="marque, modèle, année, couleur" value="<?=$_SESSION['membre']->getVehicule()?>"></td>
                  </tr>
                  <tr>
                    <td><img src="./image/home.png" width="32" height="32"></td>
                    <td><input required name="description" class="inputPop" type="text" placeholder="adresse (6400 16e Avenue, H1X 2S9)" value="<?=$_SESSION['membre']->getAdresse()?>" > </td>
                  </tr>
                  <tr>
                    <td><img src="./image/letter.png" width="32" height="32"></td>
                     <td><input required id="codePostal_MSG" name="codePostal" class="inputPop" type="text" placeholder="Code postal" value="<?=$_SESSION['membre']->getCodePostal()?>"></td>
                  </tr>
                  <tr>
                    <td><img src="./image/calendar.png" width="32" height="32"></td>
                    <td><input required type="date" id="date" name="date"></td>
                  </tr>
                  <tr>
                    <td><img src="./image/clock.png" width="32" height="32"></td>
                    <td><input required type="time" id="time" name="time"></td>
                  </tr>
                  <tr>
                    <td><img src="./image/telephone.png" width="32" height="32"></td>
                    <td><input required name="telephone" class="inputPop" type="text" placeholder="téléphone (514-123-4567)" value="<?=$_SESSION['membre']->getTelephone()?>"></td>
                  </tr>
                  <tr> 
                    <td><img src="./image/direction.png" width="32" height="32"></td>
                    <td>
                      <input class="bouton_radio" type="radio" id="btn_aller" name="btn_radio" value="Aller" required> 
                      <label class="label_radio">Aller</label>
                      <input class="bouton_radio" type="radio" id="btn_retour" name="btn_radio" value="Retour"> 
                      <label class="label_radio">Retour</label>
                    </td>
                  </tr>
          </table>
        </div>
        <div class="button">
            <button type="button" name="" value="" onclick="new SoumettreFormulairePublication('<?=Config::GOOGLE_API_KEY?>','accueilConnexion')">Ajouter</button>
        </div>
    </form>
  </div>
    <!--              -->

 <script src="./js/popUp.js">  </script>  

  <!-- FIN page pop up ------------------------------------------------------------->    

<!-- fin grand div -->
    </div>
<!-- Footer -->

<br><br><br><br><br><br><br><br><br><br><br><br>

  <footer class="zone yellow ">    
    <a href="" style="font-size: 1.2em;">Vos commentaires |</a>
    <a href="" style="font-size: 1.2em;">version mobile</a>
    <p align="center">514-970-8318 (sans frais)</p>
    © 2020 Covoiturage OmniCar. Tous droits réservés
  </footer>
</body>
</html>