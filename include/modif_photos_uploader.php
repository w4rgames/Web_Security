<?php
// ############################################################ //
//   Script pour Upload de fichier quelconque sur un serveur	//
// ############################################################ //
// Infos :														//
// -------														//
// Auteur : Fabien Guillod										//
// Email de l'auteur : f_guillod@bluewin.ch						//
// Date de création : 8 mars 2005								//
// Dernière modification : 10 mars 2005							//
// Version : 1.0.0												//
// ############################################################ //
// Fonctionnement :												//
// ----------------												//
// 1. Test si l'utilisateur a choisi un fichier					//
// 2. Test si le fichier choisi est valide (si taille <> 0)		//
// 3. Test si le taille du fichier est inférieure à la taille	//
//    max														//
// 4. Test si l'extension est autorisée.						//
// ############################################################ //
// Paramètrage :												//
// -------------												//
// Ce script peut facilement être paramètré selon les besoins.	//
// Le paramètrage se fait principalement par la définition des	//
// variables globales. Voici les différentes variables :		//
//																//
//  - $DESTINATION_FOLDER : contient le répertoire dans lequel	//
//    le fichier sera uploadé. Il est par défaut récupéré du	//
//    formulaire, mais peut très bien être remplacé par un url	//
//    en dur.													//
//																//
//  - $MAX_SIZE : spécifie la taille maximale que le fichier à	//
//    uploader peut avoir. Attention, le taille est spécifiée	//
//    en octets.												//
//																//
//  - $RETURN_LINK : Récupère automatiquement l'url de la page	//
//    web qui appelle ce script. Ce lien sert à créer des liens	//
//    de retour, qui sont toujours utiles.						//
//																//
//  - $AUTH_EXT : Ce tableau contient toutes les extensions qui	//
//    peuvent être uploadées. On peut en rajouter ou en			//
//    supprimer si besoin est.									//
// ############################################################ //

// #########################################################################################	//
// Définition des variable globales, modifiables a volonté										//
// #########################################################################################	//
// Récupération du dossier dans lequel le fichier sera uploadé									//
$DESTINATION_FOLDER = "photos/";						//
// Taille maximale de fichier, valeur en bytes													//
$MAX_SIZE = 5000000;																			//
// Récupération de l'url de retour																//												//
// Définition des extensions de fichier autorisées (avec le ".")								//
$AUTH_EXT = array(".jpg",".gif",".png",".jpeg");	
$MIME_EXT = array("image/jpg","image/jpeg","image/gif","image/png");															//
// #########################################################################################	//

// Fonction permettant de créer un lien de retour automatique

// Fonction permettant de vérifier si l'extension du fichier est
// autorisée.

function isExtAuthorized($ext, $type_mime){
	global $AUTH_EXT;
	global $MIME_EXT;
	
	switch(@$_SESSION["niveau"])
	{
		// On vérifie le MIME
		case NIVEAU_1;	
			if(in_array($type_mime, $MIME_EXT)){return true;}else{return false;}
		break;
		
		// On vérifie l'extention
		case NIVEAU_2;	
			if(in_array($ext, $AUTH_EXT)){return true;}else{return false;}
		break;
		
		// On vérifie l'extention ET le MIME
		case NIVEAU_3;
			if(in_array($ext, $AUTH_EXT)){return in_array($ext, $AUTH_EXT);}else{return false;}
			
		break;		

		default:
		break;
	}
}

// On vérifie que le champs contenant le chemin du fichier soit
// bien rempli.

if(!empty($_FILES["fichier_a_uploader"]["name"])){
	
	// Nom du fichier choisi:;
	$nomFichier = str_replace(" ", "_",$_FILES["fichier_a_uploader"]["name"]) ;
	
	// On adjoute des slashes pour le niveau 3
	switch(@$_SESSION["niveau"])
	{
		case NIVEAU_1;	
		break;
		
		case NIVEAU_2;	
			$nomFichier = addslashes($nomFichier);
		break;
		
		case NIVEAU_3;
			$nomFichier = addslashes($nomFichier);
		break;		

		default:
		break;
	}

	// Nom temporaire sur le serveur:
	$nomTemporaire = $_FILES["fichier_a_uploader"]["tmp_name"] ;
	
	// Type du fichier choisi:
	$typeFichier = $_FILES["fichier_a_uploader"]["type"] ;
	
	// Poids en octets du fichier choisit:
	$poidsFichier = $_FILES["fichier_a_uploader"]["size"] ;
	
	// Code de l'erreur si jamais il y en a une:
	$codeErreur = $_FILES["fichier_a_uploader"]["error"] ;
	
	// Extension du fichier
	$extension = strrchr($nomFichier, ".");
	
	// Si le poids du fichier est de 0 bytes, le fichier est
	// invalide (ou le chemin incorrect) => message d'erreur
	// sinon, le script continue.
	if($poidsFichier <> 0){
	
		// Si la taille du fichier est supérieure à la taille
		// maximum spécifiée => message d'erreur
		if($poidsFichier < $MAX_SIZE){
		
			// On teste ensuite si le fichier a une extension autorisée
			if(isExtAuthorized($extension, $typeFichier)){
			
				// Ensuite, on copie le fichier uploadé ou bon nous semble.
				$uploadOk = move_uploaded_file($nomTemporaire, $DESTINATION_FOLDER.$nomFichier);
				if($uploadOk){
					
					if( ($_SESSION["niveau"] != NIVEAU_3) || !preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file) )
					{
						include("include/modif_photos_maj.php");
						echo("<font color=blue>L'upload a réussi !<br><br></font>");
					}else{
						echo("<font color=red>L'upload a échoué !<br><br></font>");
					}
				}else{
					echo("<font color=red>L'upload a échoué !<br><br></font>");
				}
			}else{
				echo ("<font color=red>Les fichiers avec l'extension $extension ne peuvent pas être uploadés !<br></font>");
			}
		}else{
			$tailleKo = $MAX_SIZE / 1000;
			echo("<font color=red>Vous ne pouvez pas uploader de fichiers dont la taille est supérieure à : $tailleKo Ko.<br></font>");
		}		
	}else{
		echo("<font color=red>Le fichier choisi est invalide !</font><br>");
	}
}else{
	echo("<font color=red>Vous n'avez pas choisi de fichier !</font><br>");

}
?>