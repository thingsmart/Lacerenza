//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_riserva").click(function(){
	    var id_commessa = $("#id_commessa").val();
		var filtro_riserva = $("#testo_cerca_riserva").val();
		filtro_riserva = filtro_riserva.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_riserve").load("php/tabella_riserve.php?id="+id_commessa+"&filtro_riserva=" + filtro_riserva);
	});//chiudo $("#cerca_riserva")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_riserva").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_riserva").click();
			//}
	});//chiudo $("#testo_cerca_riserva")
	
}); // chiudo $(document).ready