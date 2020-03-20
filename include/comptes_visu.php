<?php
	// Verification : Si on a les droits pour voir la page ou que le niveau de sureté soit suffisant
	if(($_SESSION["droits"]== '1') || ($_SESSION["niveau"] != NIVEAU_3))
	{
?>

<center>
	<b>Liste des comptes</b>
	<hr>
</center>
<br>
<?php
	// Juste pour faire comprendre que toutes les erreures de la page sont voulues
	if(!isset($_SESSION["droits"]))
	{
		echo "<center><font color='red'>[ Les erreurs sont normales ]</font></center>";
	}
?>

<center>
<table width="60%">
	<tr>
		<td align="center"><b>Id</b></td>
		<td align="center"><b>Login</b></td>
		<td align="center"><b>Droits</b></td>
<?php
		// Si le mec a pas les droits, si le niveau de protection est faible, on accepte la visu
		if(($_SESSION["droits"]== '1') || ($_SESSION["niveau"] == NIVEAU_1))
		{
?>			<td align="center"><b>Action</b></td>
<?php	} ?>
	</tr>
<?php
	// Récupération des news dans la bdd
	$sql = mysqli_query("SELECT * FROM comptes");
	while($data=mysqli_fetch_assoc($sql))
	{
?>
	<tr>
		<td align="center"><?php echo $data["id"];?></td>
		<td align="center"><?php echo $data["login"];?></td>
		<td align="center"><?php echo type_droit($data["droits"]);?></td>
<?php
		// Si le mec a pas les droits, si le niveau de protection est faible, on accepte la visu
		if(($_SESSION["droits"]== '1') || ($_SESSION["niveau"] == NIVEAU_1))
		{
?>			<td align="center"><a href='index.php?page=include/comptes_visu&&action=supprimer_compte&&id=<?php echo $data["id"];?>'><img src="img/supprimer.png" onmouseover="afficher_fenetre('Action','Supprimer le compte','auto');" onmouseout="cacher_fenetre();" />&nbsp;&nbsp;<a href='index.php?page=include/comptes_visu&&action=supprimer_compte&&id=<?php echo $data["id"];?>'><img src="img/modifier.png" onmouseover="afficher_fenetre('Action','Modifier le compte','auto');" onmouseout="cacher_fenetre();" /></a></td>
<?php	} ?>
	</tr>
<?php
	}
?>
</table>
</center>

<?php
	}
	else
	{
		include("include/gestion_piratage.php");
	}
?>
