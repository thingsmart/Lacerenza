//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_materiale").click(function(){
	    var id_commessa = $("#id_commessa").val();
		var filtro_materiale = $("#testo_cerca_materiale").val();
		filtro_materiale = filtro_materiale.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_materiali").load("php/tabella_materiali.php?id="+id_commessa+"&filtro_materiale=" + filtro_materiale);
	});//chiudo $("#cerca_materiale")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_materiale").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_materiale").click();
			//}
	});//chiudo $("#testo_cerca_materiale")
	
}); // chiudo $(document).ready