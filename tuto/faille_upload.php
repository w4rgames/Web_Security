<center><font size=5>FAILLE UPLOAD</font></center><br>

<blockquote>
Bien, la faille upload est un peu sp�ciale.<br>
Lorsque sur un site on vous propose d'uploader une image, ou un fichier, vous pouvez uploader tous les fichiers que vous voulez si le site n'a pas g�rer certaines failles...
</blockquote><br>

Personnellement, je ne connais que 3 fa�ons de pouvoir contourner les protections :<br>
<ul>
	<li>la faille MIME</li>
	<li>la faille extension</li>
	<li>la faille interpr�tation</li>
</ul><br>

La <b>faille MIME</b> concerne le type MIME du fichier que vous envoyez.<br>
En effet, lorsque vous s�lectionnez un fichier sur votre disque dur et validez l'envoi, le navigateur envoi les donn�es contenues dans le fichier ainsi que certaines donn�es directement li�es au fichier : sa taille, son nom, son type MIME, etc.<br><br>

En alt�rant les donn�es que votre navigateur envoi, vous modifiez le type MIME du fichier
	<center>( par exemple : remplacer <font color="blue">application/octet-stream</font> par <font color="blue">image/jpg</font> )</center><br>

-> Certains sites ne v�rifient que ce type, d'o� le fait d'envoyer un fichier d'extension '.php' et de modifier son type MIME lors de l'envoi des donn�es par le navigateur... <br><br>
le site upload donc votre fichier sans probl�me et vous pouvez faire ce que vous voulez du site � partir de votre fichier upload�. Le danger pour le site est le m�me que pour la faille include.<br><br><br>


La <b>faille extension</b>, comme je l'appelle, suis le m�me principe que la faille MIME sauf que le site ne v�rifie que l'extension du fichier.<br>
Et bien s�r, il y a une fa�on de d�tourner ce genre de v�rifications : le caract�re <font color="red"><i>NULL</i></font>.<br>
Le caract�re <font color="red"><i>NULL</i></font>, tous ceux qui ont fait du C s'en souviennent, se traduit par '<font color="red">\0</font>' et marque la fin d'une cha�ne de caract�res...<br><br>

Vous avez compris la faille ? Non ? <br>
Je vous explique : si vous introduisez un '<font color="red">\0</font>' au bon endroit dans le nom du fichier, vous pouvez faire croire au serveur distant que le fichier que vous proposez a une extension qu'il accepte !<br>
<u>Voyons voir :</u> rempla�ons le nom de fichier suivant : <font color="blue">monfichier.php</font> par celui-ci : <font color="blue">monfichier.php</font>'<font color="red">\0</font>'<font color="red">.jpg</font><br><br>

vous allez me dire : <i>�si je met '<font color="red">\0</font>' dans le titre du fichier, �a ne marchera pas ! �</i><br>
et je r�pondrais que vous avez raison ! La difficult� de cette faille r�side dans la capacit� du hacker � r�ussir � mettre un caract�re <font color="red"><i>NULL</i></font> dans le nom de fichier !<br><br>
<u>Il y a plusieurs solutions :</u> copier-coller, mettre %00 (valeur du '<font color="red">\0</font>' lors des remplacements de  caract�res par certains navigateurs), etc...<br><br><br>


La <b>faille interpr�tation</b> ( j'aime bien donner des surnoms aux failles le samedi soir entre deux �pisodes de derricks ... ) consiste � cr�er une image, puis d'ajouter du code php dans cette image avec notepad.<br><br>
Apr�s avoir upload� l'image le plus l�galement possible, vous rentrez l'URL de votre fichier dans la barre d'adresse de votre navigateur, avec un peu de chance ( je sais pas trop de quoi �a d�pend... ) le code php contenu dans le fichier est interpr�t� !!!<br><br>

Enfin, tout cela est un peu flou, mais ce que vous devez savoir, c'est que cette faille existe !<br><br>

<u>Comment s'en prot�ger ?</u><br>
<blockquote>
	<ul style="list-style-type:lower-greek ;">
		<li>Utiliser la fonction addslashes sur le nom du fichier</li>
		<li>V�rifier l'extension ET le type MIME</li>
		<li>Utiliser la fonction getimagesize() de php pour v�rifier la validit� de l'image</li>
		<li>Utiliser la fonction imagecreatefrom[...] pour obliger la validit� de l'image</li>
	</ul>
</blockquote>