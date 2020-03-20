<script language="javascript">
function devoiler(id_div) 
{
	// désolé pour ce code moche, manque de motivation :)
	if(id_div == "div_include")
	{
		document.getElementById("div_sql").style.display = 'none';
		document.getElementById("div_upload").style.display = 'none';
		document.getElementById("div_xss").style.display = 'none';
		document.getElementById("div_include").style.display = 'block';
		document.getElementById("div_divers").style.display = 'none';
	}
	if(id_div == "div_sql")
	{
		document.getElementById("div_sql").style.display = 'block';
		document.getElementById("div_upload").style.display = 'none';
		document.getElementById("div_xss").style.display = 'none';
		document.getElementById("div_include").style.display = 'none';
		document.getElementById("div_divers").style.display = 'none';
	}
	if(id_div == "div_upload")
	{
		document.getElementById("div_sql").style.display = 'none';
		document.getElementById("div_upload").style.display = 'block';
		document.getElementById("div_xss").style.display = 'none';
		document.getElementById("div_include").style.display = 'none';
		document.getElementById("div_divers").style.display = 'none';
	}
	if(id_div == "div_xss")
	{
		document.getElementById("div_sql").style.display = 'none';
		document.getElementById("div_upload").style.display = 'none';
		document.getElementById("div_xss").style.display = 'block';
		document.getElementById("div_include").style.display = 'none';
		document.getElementById("div_include").style.display = 'none';
		document.getElementById("div_divers").style.display = 'none';
	}
	if(id_div == "div_divers")
	{
		document.getElementById("div_sql").style.display = 'none';
		document.getElementById("div_upload").style.display = 'none';
		document.getElementById("div_xss").style.display = 'none';
		document.getElementById("div_include").style.display = 'none';
		document.getElementById("div_divers").style.display = 'block';
	}
	
}
</script>

<center>
<table style="text-align:center;">
	<tr>
		<td width="20%"><a href="#" onclick="devoiler('div_include');">Faille include</a></a></td>
		<td width="20%"><a href="#" onclick="devoiler('div_sql');">Faille SQL</a></td>
		<td width="20%"><a href="#" onclick="devoiler('div_upload');">Faille upload</a></td>
		<td width="20%"><a href="#" onclick="devoiler('div_xss');">Faille XSS</a></td>
		<td width="20%"><a href="#" onclick="devoiler('div_divers');">Faille autre</a></td>
	</tr>
</table><hr>
</center>
<blockquote>
	Ceci est une liste des failles que j'ai vu et utilisé sur ce site.<br>
	Cette liste n'est surement pas compléte, alors n'hésitez pas me prévenir si vous en trouvez !<br>
	<font color="red"><u><b>ATTENTION :</b></u> </font>cette page concerne les failles de niveau <font color="blue">MOYEN</font> !
</blockquote><br>

<div id="div_include" style="display:block;">
<center>

<table id='news_table'>
	<tr>
		<td id='news_titre'><b>Utiliser la faille include</b></td>
	</tr>
	<tr>
		<td id='news_message'>Pour cela, vous n'avez juste qu'à modifier la page passée en paramétre.<center>(<i>Pour + d'info, se réferer au tuto</i>)</center></td>
	</tr>
</table>

</center>
</div>

<div id="div_sql" style="display:none;">
<center>

<table id='news_table'>
	<tr>
		<td id='news_titre'><b>Pour se connecter</b></td>
	</tr>
	<tr>
		<td id='news_message'>login : test<br>Pass : test</td>
	</tr>
</table><br>

</center>
</div>

<div id="div_upload" style="display:none;">
<center>

<table id='news_table'>
	<tr>
		<td id='news_titre'><b>Importer un fichier autre que ceux autorisés</b></td>
	</tr>
	<tr>
		<td id='news_message'>Dans la page <i>modifier ma photo</i>, séléctionner votre fichier : <center>Altérer les données envoyées par votre navigateur :<br>Ajouter un '\0' entre .php et l'extension fake.</center></td>
	</tr>
</table>

</center>
</div>

<div id="div_xss" style="display:none;">
<center>

<table id='news_table'>
	<tr>
		<td id='news_titre'><b>Afficher les cookies</b></td>
	</tr>
	<tr>
		<td id='news_message'>Dans la page <i>ajouter une news</i>, entrer le message suivant en supprimant les espaces : <center>< script >alert(document.cookie);< / script ></center></td>
	</tr>
</table>

</center>
</div>

<div id="div_divers" style="display:none;">
<center>

<table id='news_table'>
	<tr>
		<td id='news_titre'><b>Accéder à une page admin sans connexion</b></td>
	</tr>
	<tr>
		<td id='news_message'>Dans l'URL, modifier la variable page par : <center>include/comptes_visu ou include/news_ajouter</center></td>
	</tr>
</table>


</center>
</div>
<br>