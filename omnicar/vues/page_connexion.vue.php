<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel=stylesheet href="./css/css_inscription_connexion.css">


		<!--<script src=js.js> </script>-->
		<title>index</title>
	</head>
	<body>
		<nav class="zone white ">
			 <ul class="main-nav">
			 	<li> <a href="?action=afficher&page=accueil"><img src="./image/omnicar_logo.png" width="270" height="80"></a></li>
			 </ul>
		 </nav>
		<div class="container">
			<img src="./image/user.png" width="40" height="40">
		</div>
		<div class="container">
			<header>
				<h1> Connexion </h1>
			</header>	
			<!-- Formulaire -->
			<form name="Form" action="" onsubmit="return connexion()" method="post">
				<div class="Connexion container">					
					Adresse email  <br />
					<input type="email" id="adresse" name="user_adresse"style="background-color: white" required> <br /><br />

					Mot de passe  <br />
					<input type="password" id="password" name="user_password" style="background-color: white" required>
	    		</div >
	    		<div class="button">
	        		<button type="submit" name="action" value="Connexion">Se connecter</button>
	    		</div>
			</form>
			<div class="container">
				<span class="lien_se_connecter"> <a href="?action=afficher&page=inscription"><span style="color:blue;">Créer un compte</span> </a></span>
				<span class="lien_pass"> <a href="?action=afficher&page=page_mdp_oublie"><span style="color:blue;"> Mot de passe oublié ?</span> </a></span>
				
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
		if(ISSET($_SESSION['messageco'])){
			//echo "<script>alert('".$_SESSION['messageco']."')</script>";
			UNSET($_SESSION['messageco']);
		}

?>
	<script src="./js/validationFormulaire.js"></script>
	</body>

</html>