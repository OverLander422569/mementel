<?php

//on crée un objet de connexion "conn" à la BDD qui contient les infos de connexion
function conn() {
		$mysqli = new mysqli('127.0.0.1', 'root', '', 'repertoire', 3306);
		$mysqli->set_charset('utf8');
		//vérification de la connexion
		if ($mysqli -> connect_errno){
			//si erreur, elle doit retourner le message suivant
			printf("Verbindung fehlgeschlagen: %s\n", $mysqli->connect_error);
			exit();
		}
		//S'il n'y a pas d'erreur, on crée la connexion
		return $mysqli;
	}
?>