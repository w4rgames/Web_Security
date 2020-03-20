<?php
session_start();
include "admin/config.php";

// Connexion à la Bdd
$connexion_hote = mysqli_connect($host,$log,$mdp);
$connexion = mysqli_select_db($bdd);

// En fonction de l'action passée en param
switch(@$_GET["action"])
{
	// Choix du niveau de sécurité
	case "niveau_choix";
		if(isset($_POST["niveau"])){
			$_SESSION["niveau"] = $_POST["niveau"];
		}
	break;

	// Demande de connexion
	case "connexion";
		include("connexion.php");
	break;

	// Par défaut : on vérifie juste les données des cookies
	default:
		include("gestion_cookies.php");
	break;
}

?>
<script language="Javascript" src="javascript/divers.js"></script>
<head>
	<title>[ Web Security ]</title>
	<link rel="stylesheet" href="css/default.css" type="text/css">
	<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" href="css/ie.css" media="screen">
	<![endif]-->

</head>

<!-- DEBUT DE LA PAGE -->
<body>

<div id="my_fenetre"></div>
<script language="Javascript" src="javascript/my_popup.js"></script>


<!-- BANNIERE -->
<div id="banniere">

	<object>
		<param name="wmode" value="transparent">
		<param name="movie" value="img/banniere.swf?titre=<?php if(isset($_SESSION["niveau"])){echo $_SESSION["niveau"];}else{echo "????";} ?>">
		<embed src="img/banniere.swf?titre=<?php if(isset($_SESSION["niveau"])){echo $_SESSION["niveau"];}else{echo "????";} ?>" quality="high" width="700" heigth="190" align="middle" type="application/x-shockwave-flash" wmode="transparent" >
	</object>

</div>


<!-- ----------------------------------------------------------------------------------------
				MENUS DE GAUCHE
-->
<div id="bloc_gauche">

<?php
	// MENU IDENTITE
	include("identite.php");
?>

<?php
// Les tutos ne sont accessibles que si on a choisit le niveau
if(isset($_SESSION["niveau"]))
{
	include("menu.php");
}
?>

<!-- FIN MENU GAUCHE -->
</div>


<!-- ----------------------------------------------------------------------------------------
				MENUS DE DROITE
-->
<?php
// Les tutos ne sont accessibles que si on a choisit le niveau
if(isset($_SESSION["niveau"]))
{
?>
<!-- DEBUT MENU DROITE -->
<div id="bloc_droite">

	<?php
		include("tutoriels.php");
	?>

	<br>
	<center><a href="http://www.securitycompass.com/" target="_blank"><img src="img/security_compass.png" style="border:1px #333333 solid;" alt="Lien vers le site Security compass" title="Security compass"></a></center>

<!-- FIN MENU DROITE -->
</div>
<?php
}
?>


<!-- ----------------------------------------------------------------------------------------
				BLOC CENTRAL
-->

<div id="bloc_centre">

	<div id="menu_titre"></div>
	<div id="bloc_centre_div">

		<div class="text_centre">
<?php

	// ---- GESTION DE LA PAGE ----

	//  Le niveau a été choisi
	if(!isset($_SESSION["niveau"]))
	{
		include("include/niveau_choix.php");
	}
	else
	{
		// premiere venu sur le site
		if(!isset($_GET["page"]))
		{
			include("include/accueil.php");
		}
		else
		{
			//  ----------- NIVEAU FAIBLE
			if($_SESSION["niveau"] == NIVEAU_1)
			{
				include($_GET["page"] . ".php");
			}
			//  ----------- NIVEAU MOYEN & ELEVE
			else
			{
				// Gestion de la faille include
				if((file_exists($_GET['page'].".php"))
					&& (substr($_GET['page'], 0, 4) != "http")
					&& (substr($_GET['page'], 0, 3) != "ftp"))
				{
					include($_GET["page"] . ".php");
				}
				else
				{
					// Au cas où la page n'est pas prévu
					include("include/gestion_piratage.php");
				}
			}
		}
	}

	?>
		</div>
	</div>
</div>

</body>
</html>
