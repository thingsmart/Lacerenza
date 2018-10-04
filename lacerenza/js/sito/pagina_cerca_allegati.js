//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_allegato").click(function(){
	    var filtro_allegato = $("#testo_cerca_allegato").val();
		filtro_allegato = filtro_allegato.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_allegati").load("php/tabella_allegati.php?filtro_allegato=" + filtro_allegato);
	});//chiudo $("#cerca_utente")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_allegato").keypress(function (e)
		{
			//if(e.keyCode == 13) {
	    $("#cerca_allegato").click();
			//}
		});//chiudo $("#testo_cerca_utente")
	
}); // chiudo $(document).ready