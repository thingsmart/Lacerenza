//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_polizza").click(function(){
	    var id_commessa = $("#id_commessa").val();
		var filtro_polizza = $("#testo_cerca_polizza").val();
		filtro_polizza = filtro_polizza.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_polizze").load("php/tabella_polizze.php?id="+id_commessa+"&filtro_polizza=" + filtro_polizza);
	});//chiudo $("#cerca_polizza")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_polizza").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_polizza").click();
			//}
	});//chiudo $("#testo_cerca_polizza")
	
}); // chiudo $(document).ready