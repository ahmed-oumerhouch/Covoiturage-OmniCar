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
    <link rel="stylesheet" href="./css/messages.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
              <a href="?action=mesMessages">Mes Messages</a>
              <a href="?action=afficher&page=page_mes_departs">Mes Départs</a>
              <a href="?action=deconnexion">Déconnexion</a>
            </div>
          </div>
      </li>
      </ul>
  </nav>

<div class=" zone white center">
    
</div>  
<br><br><br>
<h1> Messages <?php if (isset($_SESSION['tempmessage'])) {echo $_SESSION['tempmessage']; } ?> </h1>
<!-- Block de tous les messages -->
<div class="container-fluid grand_block">  
  <!-- Block destinataires -->
  <div class="block_destinataires">
  <div class="container">
    <p> <a href="?action=mesMessages">Messages reçus </a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?action=mesMessagesEnvoye">Messages envoyés</a></p>
  </div>
<?php


      if(ISSET($_SESSION['listeMembre'])){
        if($_SESSION['listeMembre'] != null)
        {
          $p = $_SESSION['listeMembre'];
          $o= $_SESSION['listeMessage'];
          for($i = 0; $i < count($p); ++$i) 
          {
            echo '
            <div class="container"><a href="?action=afficherMessage&idmessage='.$o[$i]->getId().'&idUtilisateur='.$p[$i]->getId().'">

                 <div class="destinataire">
                      <h2>'.$p[$i]->getNom().', '.$p[$i]->getPrenom().'</h2>
                     <p> &nbsp;&nbsp;'.$o[$i]->getDate().','.$o[$i]->getHeure().' <p>
                 </div>

                     </a>
            </div>';
          }

        }else{
          echo '<div class="container"><a href=""><div class="destinataire"><h2>Messagerie Vide </h2></div></a></div>';
        }
 
        
      }else{
          echo '<div class="container"><a href=""><div class="destinataire"><h2>Messagerie Vide </h2></div></a></div>';
          
        }


?>

  </div>
  <!-- fin block destinataires -->

  <div id="div_message" class="block_message">
    <div class="container">
        <table width="73%">
<?php

     if(ISSET($_SESSION['AfficherMessageContenu'])){
 
            echo '<tr class="msg_gauche"><td> <h4> '.$_SESSION['AfficherMessageContenu'].'</h4> </td> <td width="50%"></td>
</tr>';
    }


?>


          
        </table>
    </div>
     <br>
  </div>
  <div class="block_nouveau_message"> 

  <?php

     if(ISSET($_SESSION['membreId'])){
      $k =  $_SESSION['membreId'];
      $ko =  $_SESSION['titre'];
 
          echo '
          <form   method="post">
          
          <input name="idutilisateur" id="idutilisateur" type="hidden" value="'.$k.'">
          
          <input name="directiontitre" id="directiontitre" type="hidden" value="'.$ko.'">
          
          <input type="text" name="nouveau_message" id="nouveau_message" placeholder="Saisire votre message ici..." required>

          <button type="submit" name="action" value="EnvoyerMessageMesMessage" id="btn_envoyer"> Envoyer </button>

          </form>';

    }

      if(ISSET($_SESSION['MessageReponseEnvoye'])){
        if($_SESSION['MessageReponseEnvoye'] == "true")
        {
          echo '<div id="id03" class="modal3">
          <form class="modal3-content animate"  method="post">
          <h1 style="padding-left:2%;">Message Envoyé</h1>
          </form>
          </div>';
        }
        
        UNSET($_SESSION['MessageReponseEnvoye']);
      }
?>

  </div>

  <!-- Fin du block message --> 
  <script > 
      var element = document.getElementById("div_message");
      element.scrollTop = element.scrollHeight;
    </script>
  
</div>
<!-- Fin du GROS Block --> 




  <!-- page pop up publier depart --------------------------------------------------------------->
   <div id="id02" class="modal2">
    <form class="modal2-content animate" action="" method="post" id="formulairePublication">
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
                  <td><input required name="vehicule" class="inputPop" type="text" placeholder="marque, modèle, année, couleur" value="<?=$_SESSION['membre']->getVehicule()?>"></td>
                </tr>
                <tr>
                  <td><img src="./image/home.png" width="32" height="32"></td>
                  <td><input required name="description" class="inputPop" type="text" placeholder="adresse (6400 16e Avenue, H1X 2S9)" value="<?=$_SESSION['membre']->getAdresse()?>"></td>
                </tr>
                <tr>
                  <td><img src="./image/letter.png" width="32" height="32"></td>
                  <td><input required id="codePostal_MSG" name="codePostal" name="codePostal" class="inputPop" type="text" placeholder="Code postal" value="<?=$_SESSION['membre']->getCodePostal()?>"></td>
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
                    <input class="bouton_radio" type="radio" id="btn_aller" name="btn_radio" value="Aller"> 
                    <label class="label_radio">Aller</label>
                    <input class="bouton_radio" type="radio" id="btn_retour" name="btn_radio" value="Retour"> 
                    <label class="label_radio">Retour</label>
                  </td>
                </tr>
          </table>
        </div>
        <div class="button">
            <button type="button" name="" value="" onclick="new SoumettreFormulairePublication('<?=Config::GOOGLE_API_KEY?>','page_mes_departs')">Ajouter</button>
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