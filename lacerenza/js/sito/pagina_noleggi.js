//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_noleggio").click(function(){
	    var id_commessa = $("#id_commessa").val();
		var filtro_noleggio = $("#testo_cerca_noleggio").val();
		filtro_noleggio = filtro_noleggio.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_noleggi").load("php/tabella_noleggi.php?id="+id_commessa+"&filtro_noleggio=" + filtro_noleggio);
	});//chiudo $("#cerca_noleggio")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_noleggio").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_noleggio").click();
			//}
	});//chiudo $("#testo_cerca_noleggio")
	
}); // chiudo $(document).ready