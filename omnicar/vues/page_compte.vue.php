<?php
  if(!ISSET($_SESSION))
	session_start();
if(!ISSET($_SESSION['membre']))
	header('Location: ../index.php');
  require_once('./modeles/entites/Utilisateur.entite.php'); 
  require_once('./modeles/entites/Publication.entite.php'); 
  require_once('./modeles/DAOs/Publication.dao.php'); 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel=stylesheet href="./css/css_inscription_connexion.css">
		<script src=js.js> </script>
		<title>Compte</title>
	</head>
	<body>
		<nav class="zone white">
			 <ul class="main-nav">
			 	<li> <a href="?action=afficher&page=accueilConnexion"><img src="./image/omnicar_logo.png" width="270" height="80"></a></li>
			 </ul>
		 </nav>
		 <div class="container">
			<img src="./image/user.png" width="40" height="40">
		</div>
		<div class="container">
			<!-- Formulaire -->
			<form class="Compte" method="post" name="Form">
				<table cellpadding="10">
					<tr>
						<td colspan="2" align="center"> Information utilisateur </td>
					</tr>
					<tr>
					  <td>Nom</td>
					  <td><input type="text" value="<?= $_SESSION["membre"]->getNom(); ?>" id="nom" name="user_nom"style="background-color: white" required readonly> <br /></td>
					</tr>
					<tr>
						<td>Prénom</td>
					  	<td><input type="text" value="<?= $_SESSION["membre"]->getPrenom(); ?>" id="prenom" name="user_prenom"style="background-color: white" required readonly> <br /></td>
					</tr>
					<tr>
						<td>Adresse email</td>
						
						<input type="hidden" value="<?= $_SESSION["membre"]->getCourriel(); ?>" name="ancien_email" >

					  	<td><input type="text" value="<?= $_SESSION["membre"]->getCourriel(); ?>"  id="adresse" name="user_adresse"style="background-color: white" required >  <br /></td>
					</tr>
					<tr>
						<td colspan="2" align="center"> Changement mot de passe </td>
					</tr>
					<tr>
						<td>Ancien mot de passe</td>
					  	<td><input type="password" id="ancien_password" name="ancien_password"style="background-color: white" required><br /></td>
					</tr>
					<tr>
						<td>Nouveau mot de passe</td>
					  	<td><input type="password" id="nouveau_password" name="nouveau_password"style="background-color: white" required><br /></td>
					</tr>
					<tr>
						<td>Confirmer mot de passe</td>
					  	<td><input type="password" id="confirm_password" name="confirm_password" style="background-color: white" required></td>
					</tr>

				</table>
	    		<div class="button_maj">
	        		<button type="submit" name="action" value="MAJcompte" >Mise à jour</button>
				</div>
				<br />
				<br />
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
		if(ISSET($_SESSION['messageMAJcompte'])){
			echo "<script>alert('".$_SESSION['messageMAJcompte']."')</script>";
			UNSET($_SESSION['messageMAJcompte']);
		}
?>
	</body>
	<script src="./js/modificationCompte.js"></script>

</html>