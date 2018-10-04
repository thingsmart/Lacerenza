//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_documentazione").click(function(){
	    var id_commessa = $("#id_commessa").val();
		var filtro_documentazione = $("#testo_cerca_documentazione").val();
		filtro_documentazione = filtro_documentazione.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_documentazioni").load("php/tabella_documentazioni.php?id="+id_commessa+"&filtro_documentazione=" + filtro_documentazione);
	});//chiudo $("#cerca_documentazione")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_documentazione").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_documentazione").click();
			//}
	});//chiudo $("#testo_cerca_documentazione")
	
}); // chiudo $(document).ready