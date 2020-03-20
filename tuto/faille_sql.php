<center><font size=5>FAILLE SQL</font></center><br>

<blockquote>
Les informations qui vont suivre vont vous apprendre ce que je sais sur l'injection SQL avec MySQL.<br>
Rappelons que l'injection SQL consiste � changer le contenu d'une requ�te SQL gr�ce � des variables modifiables par l'utilisateur.
</blockquote>

Tout d'abords vous devez savoir comment faire des commentaires sous MySQL :<br>
<ul>
	<li><font color="green"># pour mettre en commentaire le reste de la ligne</font> ou</li>
	<li><font color="green">/* pour mettre en commentaire plusieures lignes */ </font></li>
</ul>
il peut y avoir une nuance entre les 2, c'est rarement le cas, mais �a arrive.<br><br>

Dans la suite, nous utiliseront 
<ul>
	<li><font color="blue">le bleu pour la requ�te initiale</font>, </li>
	<li><font color="red">le rouge pour les donn�es variables</font>, </li>
	<li><font color="green">le vert pour les commentaires</font>.</li>
</ul>
Mais vous devez aussi conna�tre la logique dite ' toujours vrai ' : 
<blockquote>
nous savons tous que 1 = ............... 1 !!!!<br>
ou que 1 < 2 <br>
ou plus simplement que vrai = true !<br>
</blockquote>

Tout cela nous sera utile pour la suite ...<br>
<u>A pr�sent, regardons le code :</u><br><br>
-> Lors d'une connexion, on vous demande vos login et mot de passe.<br>
La requ�te de v�rification du login et mot de passe que vous aurez alors envoy�s sera de la forme :
<center><font color="blue">SELECT id FROM admins WHERE login=</font>'<font color="red"> $POST['login'] </font>'<font color="blue"> AND password=</font>'<font color="red"> $POST['login'] </font><font color="blue">'</font></center><br>

Bien, maintenant, nous allons nous servir de nos maigres connaissances pour faire en sorte que le mot de passe ne soit plus un probl�me :<br>
donnons pour valeur au login : <font color="red">toto' #</font><br>
et au password : '(rien)'<br><br>

la requ�te devient : <br>
<center><font color="blue">SELECT id FROM admins WHERE login='</font><font color="red">toto' </font><font color="green">#' AND password=''</font></center><br>

ainsi, la requ�te renverra la liste des personnes ayant pour login 'toto'<br>
Le probl�me, c'est que toto n'existe certainement pas, et que nous ne connaissons aucun login...<br><br>

La question que l'on se pose devient : comment peut-on faire en sorte que le mot de passe ne soit plus un probl�me, et que le login non plus ne soit plus un probl�me ... ?<br>
<u>Pour r�sumer :</u> comment faire pour que le site nous donne un compte, n'importe lequel, mais au moins un compte !!<br><br>

En se souvenant des astuces vues plus haut, (logique imparable) : 
Nous allons donner pour valeur au login : <font color="red">' or 1=1 #</font><br>
La requ�te devient donc : 

<center><font color="blue">SELECT id FROM admins WHERE login='</font><font color="red">' or 1=1 </font><font color="green">#' AND password=''</font></center><br>

Nous demandons ainsi les membres dont le login est '(rien)' OU que .... vrai (1=1) !<br>
En gros : on demande le premier compte cr�� (on aurait aussi pu r�aliser un ORDER BY pour choisir le num�ro de compte voulu)<br>
Comme de par hasard, les administrateurs ont souvent le premier compte...<br><br>

<center><font color="green">NOUS VOICI ADMINISTRATEUR !!</font></center><br>

Je n'ai pas envi de m'�tendre sur le sujet, il y a beaucoup de tutoriels sur le net pour les curieux.<br>

<u>Comment s'en prot�ger ?</u><br>
<blockquote>
<ul style="list-style-type:lower-greek ;">
	<li>V�rifiez chaque donn�e r�cup�r�e par POST, GET, ou cookie. N'h�sitez pas � caster les variables.</li>
	<li>Utilisez des fonctions pour �chapper les caract�res sp�ciaux comme addslashes() ou mysql_escape_string()</li>
	<li>Evitez au maximum d'envoyer des donn�es en GET</li>
	<li>Ne sauvegardez pas vos donn�es en cookies</li>
	<li>Cryptez les donn�es que vous envoyez</li>
</ul>
</blockquote>

J'allais oublier, cela parait �vident, mais c'est une faille tr�s connue car souvent remarqu�e :<br>
les comptes de test ... <br>
login : <i>Test</i>, Password : <i>Test</i>.<br>
login : <i>admin</i>, Password : <i>admin</i>.<br>
...<br>
Purgez bien la Base de Donn�es avant de mettre en production une application !!<br><br>

<blockquote>
Les injections SQL sont tr�s dangereuses pour la base de donn�es surtout, 
mais elles permettent de se connecter � des comptes administrateurs, 
voir, sous SQL serveur de r�aliser des choses improbables (je n'en dirai pas plus tellement �a me parait aberrant)...
</blockquote>