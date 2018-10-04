//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca").click(function(){
	    var id_commessa = $("#id_commessa").val();
		var filtro = $("#testo_cerca").val();
		filtro = filtro.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_ordini_commessa").load("php/tabella_ordini_commessa.php?id="+id_commessa+"&filtro=" + filtro);
	});//chiudo 
	
	
	//se premo invio oppure live change
	$("#testo_cerca").keypress(function(e)
		{
			if(e.keyCode == 13) {
				$("#cerca").click();
			}
	});//chiudo $("#testo_cerca")
	
}); // chiudo 