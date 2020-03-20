
<br>
<div id="menu_titre">Menu</div>
<div id="menu_navigation">
	<div class="text_menu">
<?php
echo "
	<table width='100%'>
";
// On construit le menu en fonction de l'état et des droits de l'utilisateur
if(isset($_SESSION["ustilisateur_connecte"]))
{
	// droits : au moins connecté
	if($_SESSION["droits"] >= 0)
	{
		echo "<tr><td><a href='index.php?page=include/modif_photos'>Modifier ma photo</a></td></tr>";
	}
	// droits : admin
	if($_SESSION["droits"] > 0)
	{
		echo "
			<tr><td><hr></td></tr>	
			<tr><td><a href='index.php?page=include/news_ajouter'>Ajouter News</a></td></tr>
			<tr><td><a href='index.php?page=include/vis_log'>Visualiser log</a></td></tr>
			<tr><td><a href='index.php?page=include/comptes_visu'>Voir les comptes</a></td></tr>
		";
	}	
	// droits : connecté
	echo "
		<tr><td><hr></td></tr>
		<tr><td><a href='index.php?page=include/niveau_choix'>Choix du niveau</a></td></tr>
		<tr><td><a href='index.php?page=include/news'>News</a></td></tr>
		<tr><td><br><form method='POST' action='index.php?page=deconnexion' name='deconnexion'><center><input type='submit' value='deconnexion'></center></form></td></tr>
	";
}
else
{
	// droits : pas connecté
	echo "
		<tr><td><a href='index.php?page=include/niveau_choix'>Choix du niveau</a></td></tr>
		<tr><td><a href='index.php?page=include/compte_creer'>Créer un compte</a></td></tr>
		<tr><td><a href='index.php?page=include/news'>News</a></td></tr>
	";
}

echo "
</table>
";

?>
	</div>
</div>