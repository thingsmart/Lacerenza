//JS relativo a pagina commesse.php

$(document).ready(function() {
	
	
    
	//se clicco il bottone cerca
	$("#cerca_mezzo").click(function(){
		$("#tabella_mezzi").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");
		var filtro_mezzo = $("#testo_cerca_mezzo").val();
		filtro_mezzo = filtro_mezzo.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_mezzi_manutenzione").load("php/tabella_mezzi_manutenzione.php?filtro_mezzo="+filtro_mezzo);
	});//chiudo $("#cerca_utente")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_mezzo").keypress(function(e)
		{
			if(e.keyCode == 13) {
				$("#cerca_mezzo").click();
			}
		});//chiudo $("#testo_cerca_utente")
	
}); // chiudo $(document).ready