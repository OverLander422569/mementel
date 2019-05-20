<?php
	
	// on utilise le code présent sur "utils" : la connexion à la BDD
	include 'utils.php';
	
	if($_REQUEST ["query"] == "get"){
	
	
		$sql = "SELECT *  FROM contact";
		$result = conn()->query($sql);
		
		$array = array();

		if ($result->num_rows > 0) {
			
			while($row = $result->fetch_assoc()) {
				
				$array[]=$row;
			}
			
		} else {
			echo "0 results";
		}
		
		print json_encode($array);
	}
	elseif($_REQUEST ["query"] == "delete"){
		$id = 0;

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$id = intval($_POST["contact-id"]);
			
			
			$sql = "DELETE FROM contact WHERE ID= ".$id.";";
			$result = conn()->query($sql);

			if ($result === TRUE) {
				header("Location:index.php");	
			}
			 else {
				echo "erreur:".$sql;
			}
		}
	}
	elseif($_REQUEST ["query"] == "add-update"){
		$nom = "";
		$prenom = "";
		$pseudo = "";
		$dateNaissance = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$nom = $_POST["nom"];
			$prenom = $_POST["prenom"];
			$pseudo = $_POST["pseudo"];
			$dateNaissance = $_POST["dateDeNaissance"];
			$id = $_POST["contact-id-modifier"];
			
			$estProSql = 0;
			if (isset ($_POST["estProfessionnel"])){
				$estProSql=1;
			}
			
			if ($id===""){
				$sql = "INSERT INTO contact (nom, prenom, pseudo, dateNaissance, estProfessionnel, chemin_photo) VALUES ('".$nom."','".$prenom."','".$pseudo."','".$dateNaissance."',".$estProSql.",'');";
				
			}
			else{
				$sql= "UPDATE contact SET nom = '".$nom."', prenom = '".$prenom."', pseudo = '".$pseudo."', dateNaissance = '".$dateNaissance."', estProfessionnel = ".$estProSql." WHERE ID = ".$id.";";
			}
			$result = conn()->query($sql);

			if ($result === TRUE) {
				header("Location:index.php");	
			}
			 else {
				echo "erreur:".$sql;
			}
		}		
	}

?>