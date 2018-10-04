//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_verbale").click(function(){
	    var id_commessa = $("#id_commessa").val();
		var filtro_verbale = $("#testo_cerca_verbale").val();
		filtro_verbale = filtro_verbale.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_verbali").load("php/tabella_verbali.php?id="+id_commessa+"&filtro_verbale=" + filtro_verbale);
	});//chiudo $("#cerca_verbale")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_verbale").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_verbale").click();
			//}
	});//chiudo $("#testo_cerca_verbale")
	
}); // chiudo $(document).ready