<?php
	if(isset($_SESSION["id"]))
	{
		// Ici, on récupére les variables ID et DROITS conservées dans les cookies
		switch(@$_SESSION["niveau"])
		{
			case NIVEAU_1;	
				// Les données des cookies deviennent les nouvelles valeurs
				$_SESSION["id"] = $_COOKIE["id"];
				$_SESSION["droits"] = $_COOKIE["droits"];
			break;
			
			case NIVEAU_2;	
				// On test juste le cas ou le droits vaut 1 -> admin sinon, Mr c'est tout le monde
				if($_COOKIE["droits"] == "c4ca4238a0b923820dcc509a6f75849b"){
					$_SESSION["droits"] = 1;
				}else{
					$_SESSION["droits"] = 0;
				}
			break;
			
			case NIVEAU_3;	
			break;			
		}	
	}
?>