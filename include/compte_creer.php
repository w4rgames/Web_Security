
<center>
	<b>Créer un compte</b>
	<hr>
</center>
<br>

<blockquote>
<?php
$droit_par_defaut = 0;

switch(@$_GET["action"])
{
	// Demande de création de compte
	case "creer_compte";

		// Vérification de l'existance des variables minimales
		if(isset($_POST["login"]) && isset($_POST["password1"]) && ($_POST["password1"] != "") && isset($_POST["password2"]) && ($_POST["password1"]==$_POST["password2"]))
		{
			switch(@$_SESSION["niveau"])
			{
				case NIVEAU_1;
					$requete = "INSERT INTO comptes VALUES('','" . $_POST["login"] . "','" . md5($_POST["password1"]) . "','$droit_par_defaut','pas_de_photo.gif','" . $_POST["email"] . "')";
					$erreur = mysqli_error();
				break;

				case NIVEAU_2;
					$requete = "INSERT INTO comptes VALUES('','" . addslashes($_POST["login"]) . "','" . md5($_POST["password1"]) . "','$droit_par_defaut','pas_de_photo.gif','" . addslashes($_POST["email"]) . "')";
					$erreur = mysqli_error();
				break;

				case NIVEAU_3;
					$requete = "INSERT INTO comptes VALUES('','" . addslashes($_POST["login"]) . "','" . md5($_POST["password1"]) . "','$droit_par_defaut','pas_de_photo.gif','" . addslashes($_POST["email"]) . "')";
					$erreur = "";
				break;
			}
			$resultat = mysqli_query($requete);
			if($resultat){
				echo "<font color=blue>-> Compte créé</font>";
			}else{
				echo "<font color=red>-> Compte non créé </font>" . $erreur;
			}
		}
		else
		{
			// Les variables ne sont pas définies ? bizzare
			include("include/gestion_piratage.php");
		}
	break;

	default:
	echo "
			<b><i>Pour pouvoir vous connecter, vous devez créer un compte.</i></b><br><br>
	";
	break;
}
?>
</blockquote>

<center>
<form action="index.php?page=include/compte_creer&&action=creer_compte" method="POST">
	<table width="40%">
		<tr>
			<td align="right">Login : </td>
			<td><input type="text" name="login" size="20"></td>
		</tr>
		<tr>
			<td align="right">Password : </td>
			<td><input type="password" name="password1" size="20"></td>
		</tr>
		<tr>
			<td align="right">Confirmez : </td>
			<td><input type="password" name="password2" size="20"></td>
		</tr>
		<tr>
			<td align="right">E-Mail : </td>
			<td><input type="email" name="email" size="20"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><br><input type="submit" value="Valider"></td>
		</tr>
	</table>
</form>
</center>
