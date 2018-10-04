//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone cerca
	$("#cerca_utente").click(function(){
		var filtro_utente = $("#testo_cerca_utente").val();
		filtro_utente = filtro_utente.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_utenti").load("php/tabella_utenti.php?filtro_utente="+filtro_utente);
	});//chiudo $("#cerca_utente")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_utente").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_utente").click();
			//}
		});//chiudo $("#testo_cerca_utente")
		

	
	
}); // chiudo $(document).ready

