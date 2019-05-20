<!doctype html>
	<html lang="en">
	  <head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-select.min.css">
		<link rel="stylesheet" href="css/mon-style.css">
		

		<title>Mementel</title>
	  </head>
	  <body>
			
		
		<div class="container">
			<h1>Mementel</h1>
			<!--<a class="btn btn-primary" href="contacts.php">Liste des contacts</a>-->
			<ul class="nav nav-tabs">
				<li class="active">
					<a data-toggle="tab" href="#list-contact">Liste des contacts</a>
				</li> 
				<li>
					<a data-toggle="tab" href="#list-categorie">Liste des categories</a>
				</li> 
			</ul>
			
			
			<div class="tab-content">
			
				<div class="tab-pane fade in active" id="list-contact">
					<div class="row">
						<div class="col-9">
							<table class="table" id="table-contact">
								<thead class="thead-dark">
									<tr>
									  <th scope="col">#</th>
									  <th scope="col">nom</th>
									  <th scope="col">prenom</th>
									  <th scope="col">pseudo</th>
									  <th scope="col">date de naissance</th>
									  <th scope="col">chemin_photo</th>
									  <th scope="col">estProfessionnel</th>
									</tr>
								</thead>
								<tbody>

<!--on déclare le code PHP où on veut dans le code HTML-->
<?php

//on inclus l'utilisation du code situé dans utils.php : il contient l'objet de connexion à la BDD
include 'utils.php';

//création de la requête SELECT pour la table "contact",
//elle sélectionne chacun des éléments du contact
$sql = "SELECT ID, nom, prenom, pseudo, dateNaissance, estProfessionnel FROM contact";
//on attribue à l'objet "conn()" la requête SQL pour qu'il sache sur quelle BDD ça doit etre fait
$result = conn()->query($sql);

//dans le cas où il y a au moins une rangée,
if ($result->num_rows > 0) {
// output data of each row
//on retourne le code html suivant
while($row = $result->fetch_assoc()) {
	echo "<tr class='clickable-row'><th scope='row'>".$row["ID"]."</th><td>". $row["nom"]."</td><td>".$row["prenom"]."</td><td>".$row["pseudo"]."</td><td>".$row["dateNaissance"]."</td><td></td><td>".$row["estProfessionnel"]."</td></tr>";
}
//sinon on retourne qu'il n'y a pas de ligne existante
} else {
echo "0 results";
}

?>

								</tbody>
							</table>
						</div>
						<div class="col-3">
								<button type="button" class="btn btn-success" id="ajouter-contact" data-toggle="modal" data-target="#contact-modal">Ajouter</button><br><br>
								<button type="button" class="btn btn-secondary" id="modifier-contact" data-toggle="modal" data-target="#contact-modal" >Editer</button><br><br>
								<form id="form-delete-contact" method="post" role="form" action="contact-controller.php?query=delete">
									<input type="hidden" id="contact=id" name="contact-id">
									<button type="submit" class="btn btn-danger" id="supprimer-contact">Supprimer</button>
								</form>
							<br><br>
							<select id="select-filtre" class="selectpicker">
								<option>TOUS</option>
							</select>
						</div>
								
						
					</div>
				</div> 
				<div class="tab-pane fade" id="list-categorie">
					<div class="row">
						<div class="col-9">
		
							<table class="table table-bordered" id="table-categorie">
								<thead class="thead-dark">
									<tr>
										<th scope="col">#</th>
										<th scope="col">intitule</th>
									</tr>
								</thead>
								<tbody>
		
		
<?php
	//création de la requête SELECT pour la table "categorie",
	//elle sélectionne chacun des éléments de la categorie
	$sql = "SELECT ID, intitule  FROM categorie";
	//on attribue à l'objet "conn()" la requête SQL pour qu'il sache sur quelle BDD ça doit etre fait
	$result = conn()->query($sql);

	//dans le cas où il y a au moins une rangée,
	if ($result->num_rows > 0) {
		// output data of each row
		//on retourne le code html suivant
		while($row = $result->fetch_assoc()) {
			echo "<tr class='clickable-row'><th scope='row'>".$row["ID"]."</th><td>". $row["intitule"]."</td></tr>";
		}
		//sinon on retourne qu'il n'y a pas de ligne existante
	} else {
		echo "0 results";
	}

?>
		
								</tbody>
							</table>
						</div>
						<div class="col-3">
							<button type="button" class="btn btn-success" id="ajouter-categorie" data-toggle="modal" data-target="#exampleModal">Ajouter</button><br><br>
							<button type="button" class="btn btn-secondary" id="modifier-categorie" data-toggle="modal" data-target="#exampleModal">Editer</button><br><br>
							<form id="form-delete-categorie" method="post" role="form" action="categorie-controller.php?query=delete">
								<input type="hidden" id="categorie=id" name="categorie-id">
								<button type="submit" class="btn btn-danger" id="supprimer-categorie">Supprimer</button>
							</form>
						</div>
					</div>
				</div>
				</div>
		</div>
		
		
		
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <form id="form-categorie" method="post" role="form" action="categorie-controller.php?query=add-update">
			  
			  <div class="modal-body">
				<div class="form-group">
					<input type="hidden" id="categorie=id-modifier" name="categorie-id-modifier">
					<label for="intitule">Intitulé</label>
					<input type="text" class="form-control" id="intitule" placeholder="Saisissez l'intitulé" name="intitule" required>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
				<button type="submit" class="btn btn-primary">valider</button>
			  </div>
			  </form>
			</div>
		  </div>
		</div>
		
		<div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="contact-modal-label" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="contact-modal-label">ajout/edit contact</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <form id="form-contact" method="post" role="form" action="contact-controller.php?query=add-update">
			  
			  <div class="modal-body">
				<div class="form-group">
					<input type="hidden" id="contact=id-modifier" name="contact-id-modifier">
					<label for="nom">Nom</label><input type="text" class="form-control" id="nom" placeholder="Saisissez le nom" name="nom" required>
					<label for="prenom">Prénom</label><input type="text" class="form-control" id="prenom" placeholder="Saisissez le prenom" name="prenom" required>
					<label for="pseudo">Pseudo</label><input type="text" class="form-control" id="pseudo" placeholder="Saisissez le pseudo" name="pseudo">
					<label for="dateDeNaissance">Date de naissance</label><input type="date" class="form-control" id="dateDeNaissance" placeholder="Saisissez la date de naissance" name="dateDeNaissance" required>
					<label for="chemin_photo">Chemin_Photo</label><input type="text" class="form-control" id="chemin_photo" placeholder="Saisissez le chemin photo" name="chemin_photo">
					<label class="checkbox-inline" for="estProfessionnel"><input type="checkbox" id="estProfessionnel" name="estProfessionnel">Est professionnel</label>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary2" data-dismiss="modal">fermer</button>
				<button type="submit" class="btn btn-primary2">valider</button>
			  </div>
			  </form>
			</div>
		  </div>
		</div>
		
		
		
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="js/jquery-3.3.1.min.js" ></script>
		<script src="js/popper.min.js" ></script>
		<script src="js/bootstrap.min.js" ></script>
		<script src="js/bootstrap-select.min.js" ></script>
		<script src="js/mementel.js" ></script>
		
	  </body>

	

	</html>