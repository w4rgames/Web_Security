

<center><font size="4">Mot de passe oublié</font></center><hr><br><br>
<blockquote>
<?php
// Demande de renvoi de mot de passe
if (isset($_POST["action"]) && ($_POST["action"]== "send"))
{
	$requete = "SELECT password FROM comptes WHERE email='" . $_POST["email"] . "'";
	$resultat = mysqli_query($requete);

	// On dit qu'on a un résultat en fonction de
	// ' si il y a pas eu d'erreurs '
	if(mysqli_num_rows($resultat) != 0){
		$password="xxxxxx";
	}else{
		$password="on ne sait pas";
	}

	// Création du faux header
	$msg_From = "monsite@serveur.com";
	$msg_To = $_POST['email'];
	$msg_Cc = '';
	$msg_Bcc = '';
	$msg_ReplyTo = '';
	$msg_subject = 'Identifiants';
	$msg_message = 'votre mot de passe est le : '.$password;

	//entete pour envoie de mail simple (tou en spécifient l'adresse de retour )
	echo "
		<blockquote>
			Voici le header du mail qui vient d'être envoyé : <br><br>
			<font color=blue>
				<b>From:</b> ".$msg_From."<br>
				<b>Cc:</b> ".$msg_Cc."<br>
				<b>Bcc:</b> ".$msg_Bcc."<br>
				<b>to:</b> </font><font color=red>".str_replace('\n',"<br>",$msg_To)."</font><br><font color=blue>
				<b>subject:</b> ".$msg_subject."<br><br>

				".$msg_message."</font>\n</blockquote>";
}
else
{
	// Pas eu encore de demande de renvoi de mdp
	echo "
		Veuillez renseigner les champs
	";
}
?>
</blockquote>
<br>

<form action="" method="post">
	<input type="hidden" name="action" value="send">

	<center>
	<table width="50%" border=0>
		<tr>
			<td><b>E-Mail</b></td>
			<td><input type="text" name="email" size=50 class="input_colore"></td>
		</tr>
		<tr>
			<td colspan=2><br><center><input type="submit" value="valider"></center></td>
		</tr>
	</table>
	</center>

</form>
