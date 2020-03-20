<?php
// ############################################################ //
//   Script pour Upload de fichier quelconque sur un serveur	//
// ############################################################ //
// Infos :														//
// -------														//
// Auteur : Fabien Guillod										//
// Email de l'auteur : f_guillod@bluewin.ch						//
// Date de cr�ation : 8 mars 2005								//
// Derni�re modification : 10 mars 2005							//
// Version : 1.0.0												//
// ############################################################ //
// Fonctionnement :												//
// ----------------												//
// 1. Test si l'utilisateur a choisi un fichier					//
// 2. Test si le fichier choisi est valide (si taille <> 0)		//
// 3. Test si le taille du fichier est inf�rieure � la taille	//
//    max														//
// 4. Test si l'extension est autoris�e.						//
// ############################################################ //
// Param�trage :												//
// -------------												//
// Ce script peut facilement �tre param�tr� selon les besoins.	//
// Le param�trage se fait principalement par la d�finition des	//
// variables globales. Voici les diff�rentes variables :		//
//																//
//  - $DESTINATION_FOLDER : contient le r�pertoire dans lequel	//
//    le fichier sera upload�. Il est par d�faut r�cup�r� du	//
//    formulaire, mais peut tr�s bien �tre remplac� par un url	//
//    en dur.													//
//																//
//  - $MAX_SIZE : sp�cifie la taille maximale que le fichier �	//
//    uploader peut avoir. Attention, le taille est sp�cifi�e	//
//    en octets.												//
//																//
//  - $RETURN_LINK : R�cup�re automatiquement l'url de la page	//
//    web qui appelle ce script. Ce lien sert � cr�er des liens	//
//    de retour, qui sont toujours utiles.						//
//																//
//  - $AUTH_EXT : Ce tableau contient toutes les extensions qui	//
//    peuvent �tre upload�es. On peut en rajouter ou en			//
//    supprimer si besoin est.									//
// ############################################################ //

// #########################################################################################	//
// D�finition des variable globales, modifiables a volont�										//
// #########################################################################################	//
// R�cup�ration du dossier dans lequel le fichier sera upload�									//
$DESTINATION_FOLDER = "photos/";						//
// Taille maximale de fichier, valeur en bytes													//
$MAX_SIZE = 5000000;																			//
// R�cup�ration de l'url de retour																//												//
// D�finition des extensions de fichier autoris�es (avec le ".")								//
$AUTH_EXT = array(".jpg",".gif",".png",".jpeg");	
$MIME_EXT = array("image/jpg","image/jpeg","image/gif","image/png");															//
// #########################################################################################	//

// Fonction permettant de cr�er un lien de retour automatique

// Fonction permettant de v�rifier si l'extension du fichier est
// autoris�e.

function isExtAuthorized($ext, $type_mime){
	global $AUTH_EXT;
	global $MIME_EXT;
	
	switch(@$_SESSION["niveau"])
	{
		// On v�rifie le MIME
		case NIVEAU_1;	
			if(in_array($type_mime, $MIME_EXT)){return true;}else{return false;}
		break;
		
		// On v�rifie l'extention
		case NIVEAU_2;	
			if(in_array($ext, $AUTH_EXT)){return true;}else{return false;}
		break;
		
		// On v�rifie l'extention ET le MIME
		case NIVEAU_3;
			if(in_array($ext, $AUTH_EXT)){return in_array($ext, $AUTH_EXT);}else{return false;}
			
		break;		

		default:
		break;
	}
}

// On v�rifie que le champs contenant le chemin du fichier soit
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
	
		// Si la taille du fichier est sup�rieure � la taille
		// maximum sp�cifi�e => message d'erreur
		if($poidsFichier < $MAX_SIZE){
		
			// On teste ensuite si le fichier a une extension autoris�e
			if(isExtAuthorized($extension, $typeFichier)){
			
				// Ensuite, on copie le fichier upload� ou bon nous semble.
				$uploadOk = move_uploaded_file($nomTemporaire, $DESTINATION_FOLDER.$nomFichier);
				if($uploadOk){
					
					if( ($_SESSION["niveau"] != NIVEAU_3) || !preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file) )
					{
						include("include/modif_photos_maj.php");
						echo("<font color=blue>L'upload a r�ussi !<br><br></font>");
					}else{
						echo("<font color=red>L'upload a �chou� !<br><br></font>");
					}
				}else{
					echo("<font color=red>L'upload a �chou� !<br><br></font>");
				}
			}else{
				echo ("<font color=red>Les fichiers avec l'extension $extension ne peuvent pas �tre upload�s !<br></font>");
			}
		}else{
			$tailleKo = $MAX_SIZE / 1000;
			echo("<font color=red>Vous ne pouvez pas uploader de fichiers dont la taille est sup�rieure � : $tailleKo Ko.<br></font>");
		}		
	}else{
		echo("<font color=red>Le fichier choisi est invalide !</font><br>");
	}
}else{
	echo("<font color=red>Vous n'avez pas choisi de fichier !</font><br>");

}
?>