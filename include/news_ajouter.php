
<?php
	// Verification : Si on a les droits pour voir la page ou que le niveau de sureté soit suffisant
	if(($_SESSION["droits"]== '1') || ($_SESSION["niveau"] != NIVEAU_3))
	{
?>

<center>
	<b>Ajouter news</b>
	<hr>
</center>
<br>

<blockquote>
<?php

// En fonction de l'action voulue
switch(@$_GET["action"])
{
	case "ajouter_news";

		// Si les variables minimales sont définies
		if(isset($_POST["news_titre"]) && isset($_POST["news_message"]))
		{
			switch(@$_SESSION["niveau"])
			{
				// Insertion de news pour niveau 1 :
				case NIVEAU_1;
					$requete = "INSERT INTO news VALUES('','" . addslashes($_POST["news_titre"]) . "','" . addslashes($_POST["news_message"]) . "')";
				break;

				case NIVEAU_2;
					$requete = 'INSERT INTO news VALUES("","' . $_POST["news_titre"] . '","' . $_POST["news_message"] . '")';
				break;

				case NIVEAU_3;
					$requete = "INSERT INTO news VALUES('','" . addslashes(htmlentities($_POST["news_titre"])) . "','" . addslashes(htmlentities($_POST["news_message"])) . "')";
				break;
			}
			$resultat = mysqli_query($requete);
			if($resultat){
				echo "<font color=blue>-> News insérée</font>";
			}else{
				echo "<font color=red>-> News non insérée</font>";
			}
		}
		else
		{
			include("include/gestion_piratage.php");
		}
	break;

	default:
	echo "
			<b><i>Vous pouvez ici créer des news</i></b><br><br>
	";

	break;
}
?>
</blockquote>


<form action="index.php?page=include/news_ajouter&&action=ajouter_news" method="POST">

	<center>
	<table width="80%">
		<tr>
			<td align="right" width="40%">Titre : </td>
			<td width="60%"><input type="text" name=news_titre size="26" class="input_colore"></td>
		</tr>
		<tr>
			<td align="right" width="40%">Texte : </td>
			<td width="60%"><textarea width="20" name=news_message height="15" class="input_colore"></textarea></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><br><input type="submit" value="Valider"></td>
		</tr>
	</table>
	</center>

</form>

<?php
	}
	else
	{
		// Comme c'est une page admin, le niveau 3 a pas le droit
		// d'accéder à cette page si pas connecté
		include("include/gestion_piratage.php");
	}
?>
