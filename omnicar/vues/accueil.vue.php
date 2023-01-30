<!DOCTYPE html>
<?php
  require_once('./modeles/entites/publication.entite.php');
  require_once('./modeles/DAOs/publication.dao.php');
  require_once('./modeles/entites/utilisateur.entite.php');
  require_once('./modeles/DAOs/utilisateur.dao.php');
  require_once('./modeles/classes/ConvertDateTime.php');
?>

<html>
<head>
	<title>Accueil</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" type="text/css" href="./css/styleAcceuilConnexion.css">
</head>
<body>
	<nav class="zone sticky">
  		<ul class="main-nav">
  			<li> <a href="?action=afficher&page=accueil"><img src="./image/omnicar_logo.png" width="270" height="80"></a></li>
  			<li class="push"> 
          <div class="dropdown" style="float:right;">
            <button class="dropbtn"><img src="./image/user.png" width="30" height="30"></button>
            <div class="dropdown-content">
              <a href="?action=afficher&page=page_connexion">Connexion</a>
              <a href="?action=afficher&page=inscription">Inscription</a>
            </div>
          </div>
      </li>
  		</ul>
  	</nav>
    <br><br>
    <iframe class ="video" src="./video/CovoiturageV.mp4"></iframe>
    <br><br><br>
<div class="grid-wrapper" id="conteneurPublications">
<?php
      $publications = PublicationDAO::trouverToutAvecOBJLimite4('DESC');
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
        </div>
<?PHP
      }
?>
    </div>



  

<!-- Footer -->

<br><br><br>

  <footer class="zone yellow ">    
    <a href="" style="font-size: 1.2em;">Vos commentaires |</a>
    <a href="" style="font-size: 1.2em;">version mobile</a>
    <p align="center">514-970-8318 (sans frais)</p>
    © 2020 Covoiturage OmniCar. Tous droits réservés

  </footer>


</body>
</html>