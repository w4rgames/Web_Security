
<form action="index.php?action=niveau_choix" method="post" name="niveau_choix">

	<br>
	<blockquote>
		<font color="#880000"><b>Veuillez choisir le niveau de sécurité du site.</b></font>
	<blockquote><br>
	
	<center>
	<table id="table_choix_niveau">
		<tr>
			<td><center><b>Niveau</b></center></td>
			<td><center><b>Etat du site</b></center></td>
		</tr>	
		<tr><td colspan=3><hr></td></tr>
		<tr>
			<td><center><?php echo NIVEAU_1; ?></center></td>
			<td>
				<blockquote>
					- Aucune difficulté à rentrer dans le systeme.
				</blockquote>
			</td>
			<td><center><input type="submit" name="niveau" value="<?php echo NIVEAU_1; ?>" class="input_colore"></center></td>
		</tr>
		<tr><td colspan=3><hr></td></tr>
		<tr>
			<td><center><?php echo NIVEAU_2; ?></center></td>
			<td>
				<blockquote>
					- Les concepteurs du site ont un peu plus réfléchi, mais il reste des erreurs
				</blockquote>
			</td>
			<td><center><input type="submit" name="niveau" value="<?php echo NIVEAU_2; ?>" class="input_colore"></center></td>
		</tr>	
		<tr><td colspan=3><hr></td></tr>
		<tr>
			<td><center><?php echo NIVEAU_3; ?></center></td>
			<td>
				<blockquote>
					- Sécurisé ( à priori... )
				</blockquote>
			</td>
			<td><center><input type="submit" name="niveau" value="<?php echo NIVEAU_3; ?>" class="input_colore"></center></td>
		</tr>
	</table>
	</center>

</form>