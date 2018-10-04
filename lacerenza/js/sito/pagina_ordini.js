//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_ordine").click(function(){
	    var id_commessa = $("#id_commessa").val();
		var filtro_ordine = $("#testo_cerca_ordine").val();
		filtro_ordine = filtro_ordine.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_ordini").load("php/tabella_ordini.php?id="+id_commessa+"&filtro_ordine=" + filtro_ordine);
	});//chiudo $("#cerca_ordine")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_ordine").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_ordine").click();
			//}
	});//chiudo $("#testo_cerca_ordine")
	
}); // chiudo $(document).ready