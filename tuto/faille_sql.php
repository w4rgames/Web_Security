<center><font size=5>FAILLE SQL</font></center><br>

<blockquote>
Les informations qui vont suivre vont vous apprendre ce que je sais sur l'injection SQL avec MySQL.<br>
Rappelons que l'injection SQL consiste à changer le contenu d'une requête SQL grâce à des variables modifiables par l'utilisateur.
</blockquote>

Tout d'abords vous devez savoir comment faire des commentaires sous MySQL :<br>
<ul>
	<li><font color="green"># pour mettre en commentaire le reste de la ligne</font> ou</li>
	<li><font color="green">/* pour mettre en commentaire plusieures lignes */ </font></li>
</ul>
il peut y avoir une nuance entre les 2, c'est rarement le cas, mais ça arrive.<br><br>

Dans la suite, nous utiliseront 
<ul>
	<li><font color="blue">le bleu pour la requête initiale</font>, </li>
	<li><font color="red">le rouge pour les données variables</font>, </li>
	<li><font color="green">le vert pour les commentaires</font>.</li>
</ul>
Mais vous devez aussi connaître la logique dite ' toujours vrai ' : 
<blockquote>
nous savons tous que 1 = ............... 1 !!!!<br>
ou que 1 < 2 <br>
ou plus simplement que vrai = true !<br>
</blockquote>

Tout cela nous sera utile pour la suite ...<br>
<u>A présent, regardons le code :</u><br><br>
-> Lors d'une connexion, on vous demande vos login et mot de passe.<br>
La requête de vérification du login et mot de passe que vous aurez alors envoyés sera de la forme :
<center><font color="blue">SELECT id FROM admins WHERE login=</font>'<font color="red"> $POST['login'] </font>'<font color="blue"> AND password=</font>'<font color="red"> $POST['login'] </font><font color="blue">'</font></center><br>

Bien, maintenant, nous allons nous servir de nos maigres connaissances pour faire en sorte que le mot de passe ne soit plus un problème :<br>
donnons pour valeur au login : <font color="red">toto' #</font><br>
et au password : '(rien)'<br><br>

la requête devient : <br>
<center><font color="blue">SELECT id FROM admins WHERE login='</font><font color="red">toto' </font><font color="green">#' AND password=''</font></center><br>

ainsi, la requête renverra la liste des personnes ayant pour login 'toto'<br>
Le problème, c'est que toto n'existe certainement pas, et que nous ne connaissons aucun login...<br><br>

La question que l'on se pose devient : comment peut-on faire en sorte que le mot de passe ne soit plus un problème, et que le login non plus ne soit plus un problème ... ?<br>
<u>Pour résumer :</u> comment faire pour que le site nous donne un compte, n'importe lequel, mais au moins un compte !!<br><br>

En se souvenant des astuces vues plus haut, (logique imparable) : 
Nous allons donner pour valeur au login : <font color="red">' or 1=1 #</font><br>
La requête devient donc : 

<center><font color="blue">SELECT id FROM admins WHERE login='</font><font color="red">' or 1=1 </font><font color="green">#' AND password=''</font></center><br>

Nous demandons ainsi les membres dont le login est '(rien)' OU que .... vrai (1=1) !<br>
En gros : on demande le premier compte créé (on aurait aussi pu réaliser un ORDER BY pour choisir le numéro de compte voulu)<br>
Comme de par hasard, les administrateurs ont souvent le premier compte...<br><br>

<center><font color="green">NOUS VOICI ADMINISTRATEUR !!</font></center><br>

Je n'ai pas envi de m'étendre sur le sujet, il y a beaucoup de tutoriels sur le net pour les curieux.<br>

<u>Comment s'en protéger ?</u><br>
<blockquote>
<ul style="list-style-type:lower-greek ;">
	<li>Vérifiez chaque donnée récupérée par POST, GET, ou cookie. N'hésitez pas à caster les variables.</li>
	<li>Utilisez des fonctions pour échapper les caractères spéciaux comme addslashes() ou mysql_escape_string()</li>
	<li>Evitez au maximum d'envoyer des données en GET</li>
	<li>Ne sauvegardez pas vos données en cookies</li>
	<li>Cryptez les données que vous envoyez</li>
</ul>
</blockquote>

J'allais oublier, cela parait évident, mais c'est une faille trés connue car souvent remarquée :<br>
les comptes de test ... <br>
login : <i>Test</i>, Password : <i>Test</i>.<br>
login : <i>admin</i>, Password : <i>admin</i>.<br>
...<br>
Purgez bien la Base de Données avant de mettre en production une application !!<br><br>

<blockquote>
Les injections SQL sont trés dangereuses pour la base de données surtout, 
mais elles permettent de se connecter à des comptes administrateurs, 
voir, sous SQL serveur de réaliser des choses improbables (je n'en dirai pas plus tellement ça me parait aberrant)...
</blockquote>