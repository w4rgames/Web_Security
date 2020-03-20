<center><font size=5>FAILLE XSS</font></center><br>

<blockquote>
Dernière faille que nous verrons : la faille appelée <b>XSS</b> ou <b>CSS</b> pour <b>C</b>ross-<b>S</b>ite <b>S</b>cripting.<br>
Je vais être bref avec cette faille car je ne la connais pas entièrement.<br>
En gros ( en énorme )  vous pouvez faire exécuter au site du code javascript qu'il n'avait pas prévu.
</blockquote><br>

<u>Par exemple :</u> si dans un forum, vous mettez dans un message le texte suivant :
<center>
<?php
	show_source("tuto/faille_xss_javascript.php");
?></center>
<br>
et que vous validez. Si, lorsque vous allez voir votre message dans ce forum, une fenêtre apparaît avec le message “toto”, c'est que le site n'est pas protégé !<br><br>

L'<b>enjeu</b> d'une telle faille me direz-vous ?<br>
Outre le fait de passer des messages en emmer<font color="red">[CENSURE]</font>dant le monde, vous pouvez accéder à bon nombre d'informations tels que les cookies, le numéro de session, etc.<br><br>

mais cette faille se situe aussi dans les variables passées en paramétre dans l'URL : <br>
si la valeur de cette variable est transcrite telle qu'elle dans la page, vous pouvez l'utiliser pour injecter votre code pirate : 

<center><font color="blue">http://www.un_site.fr/une_page?var_mal_protégée=</font><?php show_source("tuto/faille_xss_javascript.php"); ?></center><br>

ainsi, si une fenêtre avec ' toto ' apparaît, le site est mal protégé et vous pouvez voir des données qui ne vous concernent pas !<br><br>


<u>Comment s'en protéger ?</u><br>
<blockquote>
	<ul style="list-style-type:lower-greek ;">
		<li>Utiliser la fonction addslashes sur le nom du fichier</li>
		<li>Utiliser la fonction htmlentities lors de l'enregistrement des messages</li>
	</ul>
</blockquote>