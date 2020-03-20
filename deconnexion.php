<?php

// Deconnexion : on défait les session
unset($_SESSION["ustilisateur_connecte"]);
unset($_SESSION["droits"]);
unset($_SESSION["id"]);
unset($_SESSION["login"]);
header("location:index.php");

?>