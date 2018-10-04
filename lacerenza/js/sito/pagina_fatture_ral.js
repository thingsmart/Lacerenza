//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_ral").click(function(){
	    var id_commessa = $("#id_commessa").val();
	    var id_ral = $("#id_ral").val();
	    var filtro_ral = $("#testo_cerca_ral").val();
		filtro_ral = filtro_ral.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_fatture_ral").load("php/tabella_fatture_ral.php?id_ral=" + id_ral + "&id_commessa=" + id_commessa + "&filtro_ral=" + filtro_ral);
	});//chiudo $("#cerca_utente")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_ral").keypress(function (e)
		{
			//if(e.keyCode == 13) {
	    $("#cerca_ral").click();
			//}
		});//chiudo $("#testo_cerca_utente")
	
}); // chiudo $(document).ready