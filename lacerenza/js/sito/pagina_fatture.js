//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_fattura").click(function(){
	    var id_commessa = $("#id_commessa").val();
		var filtro_fattura = $("#testo_cerca_fattura").val();
		filtro_fattura = filtro_fattura.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_fatture").load("php/tabella_fatture.php?id="+id_commessa+"&filtro_fattura=" + filtro_fattura);
	});//chiudo $("#cerca_fattura")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_fattura").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_fattura").click();
			//}
	});//chiudo $("#testo_cerca_fattura")
	
}); // chiudo $(document).ready