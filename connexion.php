<?php
	// Variables obligatoires :
	if((isset($_POST["login"])) || (isset($_POST["password"])))
	{
		// R�cup�ration des variables envoy�es lors de la demande
		$password = $_POST["password"];
		$login    = $_POST["login"];

		// On fait la requ�te en fonction du niveau de s&curit�
		switch(@$_SESSION["niveau"])
		{
			case NIVEAU_1;
				$requete = "SELECT * FROM comptes WHERE login='$login' AND password='$password'";
				break;

			case NIVEAU_2;
				$requete = 'SELECT * FROM comptes WHERE login="' . addslashes($login) . '" and password="' . $password . '"';
			break;

			case NIVEAU_3;
				$requete = "SELECT * FROM comptes WHERE login='" . addslashes($login) . "' and password='$password'";
			break;
		}
		$resultat = mysqli_query($requete);

		// S'il y a une erreur et que le niv de s�cu n'est pas �lev�
		if((!$resultat) && ($_SESSION["niveau"] != NIVEAU_3))
		{
			echo "Erreur SQL : " . mysqli_error();
		}
		else
		{
			if (mysqli_num_rows($resultat) != 0)
			{
				$data = mysqli_fetch_array($resultat);

				// Mise en session de l'utillisateur
				$_SESSION["id"] = $data["id"];
				$_SESSION["login"] = $data["login"];
				$_SESSION["ustilisateur_connecte"] = true;
				$_SESSION["droits"] = $data["droits"];
				$_SESSION["photo"] = $data["photo"];

				// On enregistre dans les cookies
				switch(@$_SESSION["niveau"])
				{
					case NIVEAU_1;
						setCookie("id", $data["id"]);
						setCookie("droits", $data["droits"]);
					break;

					case NIVEAU_2;
						setCookie("droits", md5($data["droits"]));
					break;

					case NIVEAU_3;
					break;
				}
			}
		}
	}
?>
