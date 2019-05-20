<?php
	
	// on utilise le code présent sur "utils" : la connexion à la BDD
	include 'utils.php';
	
	//requête SELECT
	if($_REQUEST ["query"] == "get"){
	
		//création de la requête SELECT pour la table "categorie",
		//elle sélectionne chacun des éléments de la categorie
		$sql = "SELECT ID, intitule  FROM categorie";
		//on attribue à l'objet "conn()" la requête SQL pour qu'il sache sur quelle BDD ça doit etre fait
		$result = conn()->query($sql);
		
		//déclaration d'un objet de type array
		$array = array();

		//dans le cas où il y a au moins une rangée,
		if ($result->num_rows > 0) {
			//Récupère une ligne de résultat sous forme de tableau associatif
			while($row = $result->fetch_assoc()) {
				//on assigne la valeur de $row dans $array 
				$array[]=$row;
			}
			
		} else {
			//sinon on retourne qu'il n'y a pas de ligne existante
			echo "0 results";
		}
		
		print json_encode($array);
	}
	//requête DELETE
	elseif($_REQUEST ["query"] == "delete"){
		$id = 0;
		//envoi d'une requête POST
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//Sélection de l'ID de la catégorie
			$id = intval($_POST["categorie-id"]);
			
			//requête SQL pour supprimer la catégorie suivant l'ID sélectionné
			$sql = "DELETE FROM categorie WHERE ID= ".$id.";";
			$result = conn()->query($sql);

			if ($result === TRUE) {
				//rediriger l'utilisateur vers la page principale
				header("Location:index.php");	
			}
			// sinon on retourne une erreur
			 else {
				echo "erreur:".$sql;
			}
		}
	}
	//Requête ADD et UPDATE
	elseif($_REQUEST ["query"] == "add-update"){
		$id = "";
		$intitule = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$intitule = $_POST["intitule"];
			$id = $_POST["categorie-id-modifier"];
			
			$sql = "";
			
			//si l'ID est vide, on insert la valeur de l'intitulé
			if ($id===""){
				$sql = "INSERT INTO categorie (intitule) VALUES ('".$intitule."');";
			}
			//Sinon on met à jour la valeur
			else{
				$sql= "UPDATE categorie SET intitule = '".$intitule."' WHERE ID = ".$id.";";
			}
			$result = conn()->query($sql);
			
			//rediriger l'utilisateur vers la page principale
			if ($result === TRUE) {
				header("Location:index.php");	
			}
			// sinon on retourne une erreurs
			 else {
				echo "erreur:".$sql;
			}
		}		
	}
	
?>