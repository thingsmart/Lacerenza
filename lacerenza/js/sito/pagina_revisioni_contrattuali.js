//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
    $("#cerca_revisione_contrattuale").click(function () {
	    var id_commessa = $("#id_commessa").val();
	    var filtro_revisioni_contrattuali = $("#testo_cerca_revisione_contrattuale").val();
		filtro_revisioni_contrattuali = filtro_revisioni_contrattuali.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_revisioni_contrattuali").load("php/tabella_revisioni_contrattuali.php?id=" + id_commessa + "&filtro_revisioni_contrattuali=" + filtro_revisioni_contrattuali);
	});//chiudo $("#cerca_fattura")
	
	
	//se premo invio oppure live change
    $("#testo_cerca_revisione_contrattuale").keypress(function (e)
		{
			//if(e.keyCode == 13) {
	    $("#cerca_revisione_contrattuale").click();
			//}
	});//chiudo $("#testo_cerca_fattura")
	
}); // chiudo $(document).ready