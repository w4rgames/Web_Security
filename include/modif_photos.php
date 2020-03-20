<center>
	<b>Modifier ma photo</b>
	<hr>
</center>
<br>

<blockquote>
<?php
switch(@$_GET["action"])
{
	// Demande de modification de la photo
	case "modifier_photo";
	
		// Si le fichier à bien été envoyé
		if(!empty($_FILES["fichier_a_uploader"]["name"]))
		{
			include("include/modif_photos_uploader.php");
		}
		else
		{
			include("include/gestion_piratage.php");
		}
	break;			

	default:
	echo "	
		<b><i>Vous pouvez modifier ici votre photo.</i></b><br>
		<font color=red><b><u>ATTENTION :</u></b></font> seule extension autorisée : ' .jpg ', ' .jpeg ', ' .gif ', ' .png '<br>
	";
	
	break;
}
?>
</blockquote>	

<center>
<form action="index.php?page=include/modif_photos&&action=modifier_photo" method="POST" enctype="multipart/form-data">
	<input type="file" name="fichier_a_uploader" size="20"><br><br>
	<input type="submit" Value="Valider">
</form>
</center>