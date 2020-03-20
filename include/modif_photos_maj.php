<?php

	// On enregistre le fichier en base de données
	switch(@$_SESSION["niveau"])
	{
		case NIVEAU_1;
			$requete = "UPDATE comptes SET photo='$nomFichier' WHERE id=".$_SESSION["id"];
			$erreur = mysqli_error();
		break;

		case NIVEAU_2;
			"UPDATE comptes SET photo='". addslashes($nomFichier) . "' WHERE id=".$_SESSION["id"];
			$erreur = mysqli_error();
		break;

		case NIVEAU_3;
			"UPDATE comptes SET photo='". addslashes($nomFichier) . "' WHERE id=".$_SESSION["id"];
			$erreur = "";
		break;
	}

	$resultat = mysqli_query($requete);
	if($resultat){
		echo "<font color=blue>-> Photo mise à jour en BDD</font>";
	}else{
		echo "<font color=red>-> Photo non mise à jour en BDD</font>" . $erreur;
	}

	echo "<br>";
?>
