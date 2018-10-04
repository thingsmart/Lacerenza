//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_attivita").click(function(){
	    var id_commessa = $("#id_commessa").val();
		var filtro_attivita = $("#testo_cerca_attivita").val();
		filtro_attivita = filtro_attivita.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_attivita").load("php/tabella_attivita.php?id="+id_commessa+"&filtro_attivita=" + filtro_attivita);
	});//chiudo $("#cerca_attivita")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_attivita").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_attivita").click();
			//}
	});//chiudo $("#testo_cerca_attivita")
	
}); // chiudo $(document).ready