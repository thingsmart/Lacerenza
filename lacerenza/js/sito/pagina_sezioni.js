//JS relativo a pagina commesse.php

$(document).ready(function() {

	// Se clicco il bottone cerca
    $("#cerca").click(function () {
    	
    	var testo_cerca = $("#testo_cerca").val();
    	$("#tabella_sezioni").load("php/tabella_sezioni.php?q=" + testo_cerca);
		
	});

	//se premo invio oppure live change
    $("#testo_cerca").keypress(function (e)
		{
			if(e.keyCode == 13) {
	    	$("#cerca").click();
			}
	});//chiudo 
	
}); // chiudo $(document).ready