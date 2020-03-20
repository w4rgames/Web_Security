<?php

// Cassage de certaines contraintes PHP INI
ini_set("allow_url_fopen", 1);
ini_set("allow_url_include", 1);
ini_set("session.use_cookies", 1);
ini_set("magic_quotes_gpc", 0);

if($_SERVER["SERVER_NAME"] == "127.0.0.1"){
	$log="root"; 			//Nom d'utilisateur de la base de données
	$mdp=""; 				//Mdp  de la base de données
	$bdd="hack_trainer"; 	//Nom  de la base de données
	$host="localhost"; 		//Adresse  de la base de données
}
else{
	$log="polytek"; 			//Nom d'utilisateur de la base de données
	$mdp="forever"; 				//Mdp  de la base de données
	$bdd="polytek"; 	//Nom  de la base de données
	$host="sql.hostarea.org"; 		//Adresse  de la base de données
}
define ("NIVEAU_1", "Faible");
define ("NIVEAU_2", "Moyen");
define ("NIVEAU_3", "Eleve");

// Renvoi juste un texte en fonction du numéro de droit
function type_droit($droits)
{
	switch($droits)
	{
		case "0";	
			return "Sans droits";;
		break;		
		
		case "1";	
			return "Admin";;
		break;							

		default:
		break;
	}
}

?>
