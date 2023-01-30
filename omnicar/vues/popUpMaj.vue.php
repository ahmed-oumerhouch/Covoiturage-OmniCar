<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="../css/popUpMaj.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	</head>
	
	<body>
		<button class="modal-btn">pop</button>
		
		<div class="modal-bg">
			<div class="modal">
				<table cellpadding="10">					
					<tr>
					  <td>Nom du collège</td>
					  <td><input type="text" placeholder="nom du collège"></td>
					</tr>
					<tr>
						<td><img src="../image/car.png" width="32" height="32"></td>
					  	<td><input type="text" placeholder="marque, modèle, année, couleur"></td>
					</tr>
					<tr>
						<td><img src="../image/home.png" width="32" height="32"></td>
					  	<td><input type="text" placeholder="adresse (6400 16e Avenue, H1X 2S9)"></td>
					</tr>
					<tr>
						<td><img src="../image/telephone.png" width="32" height="32"></td>
					  	<td><input type="text" placeholder="téléphone (514-123-4567)"></td>
					</tr>
				</table>
				<div>
				</br>
					<button class="btnAjouter" type="submit">Mise à jour</button>
					<button class="btnFermer" type="submit">Supprimer</button>
				</div>
			</div>
		</div>
		<script src="../js/popUpMaj.js"></script>
	</body>
</html>