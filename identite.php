

<?php

// Si l'utilisateur est connecté, on affiche son identité, son statut et sa photo
if(isset($_SESSION["ustilisateur_connecte"]))
{
	echo "
	<div id='menu_titre'>Identité : <a href='#' onclick='Afficher_Cacher(\"ma_photo\");'>" . $_SESSION["login"] . "</a></div>
	<div id='menu_identite'>	
		
		<table width='100%'>
			<tr><td>Statut : <b>" . type_droit($_SESSION["droits"]) . "</b></center></td></tr>	
			<tr><td><div id=ma_photo style='display:none'><center><img src='photos/" . $_SESSION["photo"] . "' width='140px' height='140px'></center></div></td></tr>
		</table>
	</div>
	";
}

// utilisateur non connecté
elseif(isset($_SESSION["niveau"]))
{
?>
	<div id="menu_titre">Connectez-vous</div>
	<div id="menu_identite">	
	
	<div class="text_menu">
		<form method="POST" action="index.php?action=connexion" name="connexion">
			<table>
				<tr><td colspan=2></td></tr>
				<tr><td align="right">Login : </td><td><input type="text" name="login" size="10" class="input_colore"></td></tr>
				<tr><td align="right">Pass : </td><td><input type="password" name="password" size="10" class="input_colore"></td></tr>
				<tr><td colspan=2><center><a href='index.php?page=include/password_lost'>Mot de passe oublié ?</a></center></td></tr>
				<tr><td colspan="2" align="center"><br><input type="submit" value="Valider" class="input_colore"></td></tr>
			</table>
		</form>
	</div>
	
	</div>
<?php
}
else
{
	// Si la variable $_SESSION["niveau"] n'est pas crée, on demande le choix du niveau
	echo '<div id="menu_titre">choix du niveau</div>';
}
?>