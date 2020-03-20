/***********************************************
* Script my_popup  developpé par Harry et Bitou pour
* POLYTECH'TOURS
***********************************************/

var offset_X=-60; // offset X
var offset_Y=25; //    offset Y
var ie=document.all;
var ns6=document.getElementById && !document.all
var enable_fenetre=false;

// Variables du titre
var titre_bgcolor="#000000";
var titre_textcolor="#FFFFFF";
var titre_textsize="15";
var titre_textfont="arial, sans-serif";

// Variables du message
var msg_bgcolor="#FFFFFF";
var msg_textcolor="#000000";
var msg_textsize="14";
var msg_textfont="arial, sans-serif";
var msg_margin_whithout="margin-left:-3px;margin-right:-3px;margin-top:-3px;margin-bottom:-3px;";
var msg_margin_whithin="margin-left:-1px;margin-right:-1px;margin-top:0px;margin-bottom:-1px;";

// Variables de la frame
var decalage=0;

// On récupére la fenetre
if (ie||ns6)
var ma_fenetre=document.all? document.all["my_fenetre"] : document.getElementById? document.getElementById("my_fenetre") : ""

function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

// On affiche la fenetre
function afficher_fenetre(p_titre, p_msg, p_largeur, p_theme){
	if (ns6||ie){
	
	// Si on a définit une hauteur ou un theme, on applique !!
	if (typeof p_largeur!="undefined") ma_fenetre.style.width=p_largeur;
	if (typeof p_theme!="undefined" && p_theme!="") gerer_theme(p_theme)
	else gerer_theme("defaut");
	
	var titre='';
	var msg='';
	
	// On crée le titre du popup si il y en a un
	if (p_titre!=0){
		titre="<div style='background:"+titre_bgcolor+";font-family:"+titre_textfont+";margin-left:-3px;margin-right:-3px;margin-top:-3px;color:"+titre_textcolor+";'>";
		titre=titre+"&nbsp;"+p_titre+"";
		titre=titre+"</div>";
		
		// Si il n'y a pas de message, on affiche un ligne
		if((p_msg=='')){
			titre=titre+"<div style='background:"+msg_bgcolor+";font-size:0px;width:100%;'>&nbsp;</div>";
		}
	}
	
	// On crée le texte si il y en a un
	if (p_msg!=0){
		if(p_titre!=0){
			msg="<div style='background:"+msg_bgcolor+";font-family:"+msg_textfont+";color:"+msg_textcolor+";"+msg_margin_whithin+"'>";
		}else{
			msg="<div style='background:"+msg_bgcolor+";font-family:"+msg_textfont+";color:"+msg_textcolor+";"+msg_margin_whithout+"'>";		
		}
		msg=msg+"<div style='margin-left:3px;margin-right:3px;'>"+p_msg+"</div>";
		msg=msg+"</div>";
	}	
	
	// On affiche les titres et textes
	if(titre!='') ma_fenetre.innerHTML=ma_fenetre.innerHTML+titre;
	if(msg!='') ma_fenetre.innerHTML=ma_fenetre.innerHTML+msg;
	
	enable_fenetre=true
	return false
	}
}

// On gére le mouvement de la fenetre
function position_fenetre(e){
	if (enable_fenetre){
		// On técupére la position de la souris
		var curseur_left=(ns6)? e.pageX : event.clientX+ietruebody().scrollLeft;
		var curseur_top=(ns6)? e.pageY : event.clientY+ietruebody().scrollTop;
		
		var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offset_X : window.innerWidth-e.clientX-offset_X-20;
		var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offset_Y : window.innerHeight-e.clientY-offset_Y-20;
		var leftedge=(offset_X<0)? offset_X*(-1) : -1000;
		
		//Si la distance horizontale n'est pas suffisante pour accomoder la largeur de la fenetre
		if (rightedge<ma_fenetre.offsetWidth){
			// déplacer la position horizontale du menu vers la droite par sa largeur 
			ma_fenetre.style.left=ie? ietruebody().scrollLeft+event.clientX-ma_fenetre.offsetWidth+"px" : window.pageXOffset+e.clientX-ma_fenetre.offsetWidth+"px";
		}
		else if (curseur_left<leftedge){
				ma_fenetre.style.left="5px";
			}
			else{
				ma_fenetre.style.left=curseur_left+offset_X+"px";
			}
		
		// Pareil pour la distance verticale
		if (bottomedge<ma_fenetre.offsetHeight){
			ma_fenetre.style.top=ie? ietruebody().scrollTop+event.clientY-ma_fenetre.offsetHeight-offset_Y+"px" : window.pageYOffset+e.clientY-ma_fenetre.offsetHeight-offset_Y+"px";
		}
		else{
			ma_fenetre.style.top=curseur_top+offset_Y+"px";
		}
		ma_fenetre.style.visibility="visible";
	}
}

// On gére le theme demndé
function gerer_theme(p_theme){
	switch(p_theme){
		case "defaut" :
			ma_fenetre.style.backgroundColor=titre_bgcolor;
		break;			
		
		case "noir_banc" :
			ma_fenetre.style.backgroundColor="#ffffff";
			msg_bgcolor="#FFFFFF";
			msg_textcolor="#000000";
			titre_bgcolor="#FFFFFF";
			titre_textcolor="#000000";
		break;		
	}
}

// On efface la fenetre
function cacher_fenetre(){
	if (ns6||ie){
		enable_fenetre=false;
		ma_fenetre.style.visibility="hidden";
		ma_fenetre.style.left="-1000px";
		ma_fenetre.style.backgroundColor='';
		ma_fenetre.style.width='';
		ma_fenetre.innerHTML="";
	}
}
document.onmousemove=position_fenetre;