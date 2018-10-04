//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_personale").click(function(){
	    var id_commessa = $("#id_commessa").val();
	    var filtro_personale = $("#testo_cerca_personale").val();
		filtro_personale = filtro_personale.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_personale").load("php/tabella_personale.php?id_commessa=" + id_commessa + "&filtro_personale=" + filtro_personale);
	});//chiudo $("#cerca_personale")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_personale").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_personale").click();
			//}
	});//chiudo $("#testo_cerca_personale")
	
}); // chiudo $(document).ready