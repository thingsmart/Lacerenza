//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
    $("#cerca").click(function () {
    	var mese = $("#mese").val();
    	var anno = $("#anno").val();
    	
		$("#tabella_gara").load("php/tabella_gara.php?mese=" + mese + "&anno=" + anno);
	});//chiudo 
	
	
	//se premo invio oppure live change
    $("#testo_cerca").keypress(function (e)
		{
			if(e.keyCode == 13) {
	    	$("#cerca").click();
			}
	});//chiudo 
	
}); // chiudo $(document).ready