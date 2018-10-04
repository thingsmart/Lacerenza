//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_regolarita").click(function(){
	    var id_commessa = $("#id_commessa").val();
		var filtro_regolarita = $("#testo_cerca_regolarita").val();
		filtro_regolarita = filtro_regolarita.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_regolarita").load("php/tabella_regolarita.php?id="+id_commessa+"&filtro_regolarita=" + filtro_regolarita);
	});//chiudo $("#cerca_regolarita")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_regolarita").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_regolarita").click();
			//}
	});//chiudo $("#testo_cerca_regolarita")
	
}); // chiudo $(document).ready