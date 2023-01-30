<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel=stylesheet href="./css/css_inscription_connexion.css">
		<script src=js.js> </script>
		<title>Mot de passe oublié</title>
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
				<h1> Mot de passe oublié </h1>
			</header>	
			<form method="POST">
				<div class="MotDePasseOublie container">					
					Adresse email  <br />
					<input type="email" id="adresse" name="user_adresse"style="background-color: white" required> <br />
	    		</div >
	    		<div class="button">
	        		<button type="submit" name="action" value="MDPoublie">Rechercher</button>
	    		</div>
			</form>
		</div>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<footer class="zone yellow">    
		    <a href="" style="font-size: 1.2em;">Vos commentaires |</a>
		    <a href="" style="font-size: 1.2em;">version mobile</a>
		    <p align="center">514-970-8318 (sans frais)</p>
		    © 2020 Covoiturage OmniCar. Tous droits réservés

  		</footer>
<?php
		if(ISSET($_SESSION['messagemdp'])){
			echo "<script>alert('".$_SESSION['messagemdp']."')</script>";
			UNSET($_SESSION['messagemdp']);
		}
?>
	</body>

</html>