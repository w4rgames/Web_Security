
<center><font size=5 color=red>-[ ATTENTION ]-</font></center>

<br>

<style type="text/css">
body{
	font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
	color: #000000;
}
#myContent, #myContent blink{
	width:530px;
	height:200px;
	font-family:courier;
}    
blink{
	display:inline;

}
</style>
	
<script type="text/javascript">
    var charIndex = -1;
    var stringLength = 0;
    var inputText;
    function writeContent(init){
    	if(init){
    		inputText = document.getElementById("contentToWrite").innerHTML;
    	}
        if(charIndex==-1){
            charIndex = 0;
            stringLength = inputText.length;
        }
        var initString = document.getElementById("myContent").innerHTML;
		initString = initString.replace(/<SPAN.*$/gi,"");
        
        var theChar = inputText.charAt(charIndex);
       	var nextFourChars = inputText.substr(charIndex,4);
       	if(nextFourChars=="<BR>" || nextFourChars=="<br>"){
       		theChar  = "<BR>";
       		charIndex+=3;
       	}
        initString = initString + theChar + "<SPAN id=\"blink\">_</SPAN>";
        document.getElementById("myContent").innerHTML = initString;

        charIndex = charIndex/1 +1;
		if(charIndex%2==1){
             document.getElementById("blink").style.display="none";
        }else{
             document.getElementById("blink").style.display="inline";
        }
                
        if(charIndex<=stringLength){
            setTimeout("writeContent(false)",150);
        }else{
        	blinkSpan();
        }  
    }
    
    var currentStyle = "inline";
    function blinkSpan(){
    	if(currentStyle=="inline"){
    		currentStyle="none";
    	}else{
    		currentStyle="inline";
    	}
    	document.getElementById("blink").style.display = currentStyle;
    	setTimeout("blinkSpan()",500);
    	
    }
</script>


<center>

  <div id="myContent">

<span style="display: inline;" id="blink">_</span></div>
<div id="contentToWrite" style="display: none;">
	<br><br><br><br><br>

	Tu essais de pirater ce site.<br><br>
	Ton IP a été enregistrée et un mail a été envoyé à ton fournisseur d'accés !<br>
             
</div>
</center>

<div align=center>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____\<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;_&nbsp;_\<br>
__________________/&nbsp;&nbsp;&nbsp;\_________________<br>
&nbsp;\_______&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_______/<br>
&nbsp;&nbsp;\________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________/<br>
&nbsp;&nbsp;&nbsp;&nbsp;\_______&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;________/<br>
&nbsp;&nbsp;&nbsp;\_____/\&nbsp;&nbsp;&nbsp;/\_____/<br>
&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;\<br>
&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\<br>
&nbsp;&nbsp;&nbsp;`"==="`<br>
</div>

<script type="text/javascript">
writeContent(true);
</script>
