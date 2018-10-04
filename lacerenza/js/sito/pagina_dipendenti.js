//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone cerca
	$("#cerca_dipendente").click(function(){
		var filtro_dipendente = $("#testo_cerca_dipendente").val();
		filtro_dipendente = filtro_dipendente.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_dipendenti").load("php/tabella_dipendenti.php?filtro_dipendente="+filtro_dipendente);
	});//chiudo $("#cerca_dipendente")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_dipendente").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_dipendente").click();
			//}
		});//chiudo $("#testo_cerca_dipendente")
		

	
	
}); // chiudo $(document).ready

