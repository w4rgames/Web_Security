	
/* -------------------------------------------
	Afficher_Cacher
	Sert � afficher ou a cacher une div de la page
*/
	function Afficher_Cacher(id_div) 
	{
		// Si elle est d�ja affich�e, on la cache, sinon, on l'affiche
		if(document.getElementById(id_div).style.display == 'block')
		{
			document.getElementById(id_div).style.display = 'none';
		}
		else
		{
			document.getElementById(id_div).style.display = 'block';
		}
	}