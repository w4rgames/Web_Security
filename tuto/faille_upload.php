<center><font size=5>FAILLE UPLOAD</font></center><br>

<blockquote>
Bien, la faille upload est un peu spéciale.<br>
Lorsque sur un site on vous propose d'uploader une image, ou un fichier, vous pouvez uploader tous les fichiers que vous voulez si le site n'a pas gérer certaines failles...
</blockquote><br>

Personnellement, je ne connais que 3 façons de pouvoir contourner les protections :<br>
<ul>
	<li>la faille MIME</li>
	<li>la faille extension</li>
	<li>la faille interprétation</li>
</ul><br>

La <b>faille MIME</b> concerne le type MIME du fichier que vous envoyez.<br>
En effet, lorsque vous sélectionnez un fichier sur votre disque dur et validez l'envoi, le navigateur envoi les données contenues dans le fichier ainsi que certaines données directement liées au fichier : sa taille, son nom, son type MIME, etc.<br><br>

En altérant les données que votre navigateur envoi, vous modifiez le type MIME du fichier
	<center>( par exemple : remplacer <font color="blue">application/octet-stream</font> par <font color="blue">image/jpg</font> )</center><br>

-> Certains sites ne vérifient que ce type, d'où le fait d'envoyer un fichier d'extension '.php' et de modifier son type MIME lors de l'envoi des données par le navigateur... <br><br>
le site upload donc votre fichier sans problème et vous pouvez faire ce que vous voulez du site à partir de votre fichier uploadé. Le danger pour le site est le même que pour la faille include.<br><br><br>


La <b>faille extension</b>, comme je l'appelle, suis le même principe que la faille MIME sauf que le site ne vérifie que l'extension du fichier.<br>
Et bien sûr, il y a une façon de détourner ce genre de vérifications : le caractère <font color="red"><i>NULL</i></font>.<br>
Le caractère <font color="red"><i>NULL</i></font>, tous ceux qui ont fait du C s'en souviennent, se traduit par '<font color="red">\0</font>' et marque la fin d'une chaîne de caractères...<br><br>

Vous avez compris la faille ? Non ? <br>
Je vous explique : si vous introduisez un '<font color="red">\0</font>' au bon endroit dans le nom du fichier, vous pouvez faire croire au serveur distant que le fichier que vous proposez a une extension qu'il accepte !<br>
<u>Voyons voir :</u> remplaçons le nom de fichier suivant : <font color="blue">monfichier.php</font> par celui-ci : <font color="blue">monfichier.php</font>'<font color="red">\0</font>'<font color="red">.jpg</font><br><br>

vous allez me dire : <i>“si je met '<font color="red">\0</font>' dans le titre du fichier, ça ne marchera pas ! ”</i><br>
et je répondrais que vous avez raison ! La difficulté de cette faille réside dans la capacité du hacker à réussir à mettre un caractère <font color="red"><i>NULL</i></font> dans le nom de fichier !<br><br>
<u>Il y a plusieurs solutions :</u> copier-coller, mettre %00 (valeur du '<font color="red">\0</font>' lors des remplacements de  caractères par certains navigateurs), etc...<br><br><br>


La <b>faille interprétation</b> ( j'aime bien donner des surnoms aux failles le samedi soir entre deux épisodes de derricks ... ) consiste à créer une image, puis d'ajouter du code php dans cette image avec notepad.<br><br>
Après avoir uploadé l'image le plus légalement possible, vous rentrez l'URL de votre fichier dans la barre d'adresse de votre navigateur, avec un peu de chance ( je sais pas trop de quoi ça dépend... ) le code php contenu dans le fichier est interprété !!!<br><br>

Enfin, tout cela est un peu flou, mais ce que vous devez savoir, c'est que cette faille existe !<br><br>

<u>Comment s'en protéger ?</u><br>
<blockquote>
	<ul style="list-style-type:lower-greek ;">
		<li>Utiliser la fonction addslashes sur le nom du fichier</li>
		<li>Vérifier l'extension ET le type MIME</li>
		<li>Utiliser la fonction getimagesize() de php pour vérifier la validité de l'image</li>
		<li>Utiliser la fonction imagecreatefrom[...] pour obliger la validité de l'image</li>
	</ul>
</blockquote>