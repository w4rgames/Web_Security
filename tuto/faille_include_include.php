<?php
    // Si il y un variable 'page' dans l'URL, on inclut cette page
    // ( On prends le contenu de la page et on le colle à l'emplacement de l'inclusion )
    if ( isset( $_GET[“page”] ) )
    {
         include ( $_GET[“page”] );
    }
?>