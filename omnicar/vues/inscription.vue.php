<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel=stylesheet href="./css/css_inscription_connexion.css">
		<!--<script src=js.js> </script>-->
		<title>Inscription</title>
	</head>
	<body>
		<nav class="zone white">
			 <ul class="main-nav">
			 	<li> <a href="?action=afficher&page=accueil"><img src="./image/omnicar_logo.png" width="270" height="80"></a></li>
			 </ul>
		 </nav>
		<div class="container">
			<img src="./image/user.png" width="40" height="40">
		</div>
		<div class="container">
			<header>
				<h1> Inscription </h1>
			</header>	




			<form name="Form" action="" onsubmit="return inscription()" method="post">
				<div class="Inscription container">
					Nom  <br />
					<input type="text" id="nom" name="user_nom"style="background-color: white" required> <br /><br />
					
					Prenom  <br />
					<input type="text" id="prenom" name="user_prenom"style="background-color: white" required><br /><br />
					
					Adresse email  <br />
					<input type="email" id="adresse" name="user_adresse"style="background-color: white" required> <br /><br />

					Mot de passe  <br />
					<input type="password" id="password" name="user_password"style="background-color: white" required><br /><br />
					
					Confirmer mot de passe  <br>
					<input type="password" id="password" name="conf_password"style="background-color: white" required>

					<span id="error_message"></span>
				</div >
				
	    		<div class="button">
	        		<button type="submit" name="action" value="inscription">S'inscrire</button>
	    		</div>
			</form>




			<div class="container">
				<span class="lien_se_connecter"> déjà un compte? <a href="?action=afficher&page=page_connexion"><span style="color:blue;">se connecter</span> </a></span>
			</div>
		</div>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<footer class="zone yellow">    
		    <a href="" style="font-size: 1.2em;">Vos commentaires |</a>
		    <a href="" style="font-size: 1.2em;">version mobile</a>
		    <p align="center">514-970-8318 (sans frais)</p>
		    © 2020 Covoiturage OmniCar. Tous droits réservés

  		</footer>
<?php
		if(ISSET($_SESSION['messageInscription'])){
			//echo "<script>alert('".$_SESSION['messageInscription']."')</script>";
			UNSET($_SESSION['messageInscription']);
		}
?>
	<script src="./js/validationFormulaire.js"></script>
	</body>

</html>