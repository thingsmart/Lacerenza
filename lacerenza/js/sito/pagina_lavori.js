//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
    $("#cerca").click(function () {
	    var filtro = $("#testo_cerca").val();
		filtro = filtro.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_lavori").load("php/tabella_lavori.php?filtro=" + filtro);
	});//chiudo $("#cerca_fattura")
	
	
	//se premo invio oppure live change
    $("#testo_cerca").keypress(function (e)
		{
			if(e.keyCode == 13) {
	    $("#cerca").click();
			}
	});//chiudo $("#testo_cerca_fattura")
	
}); // chiudo $(document).ready