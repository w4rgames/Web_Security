
<center>
	<b>News</b>
	<hr>
</center><br>

<?php

	// On récupére les news de la bdd
	$requete = "SELECT * FROM news";
	$resultat = mysqli_query($requete);

	// Et on les affiche
	$nb_news = 0;
	while($une_news = mysqli_fetch_array($resultat))
	{
		echo "
		<center>
			<table id='news_table'>
				<tr>
					<td id='news_titre'><b>sujet :</b> " . $une_news["news_titre"] . "</td>
				</tr>
				<tr>
					<td id='news_message'><blockquote><br>" . $une_news["news_message"] . "</blockquote></td>
				</tr>
			</table>
		</center><br>";
		$nb_news++;
	}

	if($nb_news == 0)
	{
		echo "<br><center>Pas de news</center><br>";
	}

?>
