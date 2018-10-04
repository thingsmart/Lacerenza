//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_veicolo").click(function(){
	    var id_commessa = $("#id_commessa").val();
	    var filtro_veicolo = $("#testo_cerca_veicolo").val();
		filtro_veicolo = filtro_veicolo.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_veicoli").load("php/tabella_veicoli.php?id_commessa=" + id_commessa + "&filtro_veicolo=" + filtro_veicolo);
	});//chiudo $("#cerca_veicolo")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_veicolo").keypress(function (e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_veicolo").click();
			//}
	});//chiudo $("#testo_cerca_veicolo")
	
}); // chiudo $(document).ready