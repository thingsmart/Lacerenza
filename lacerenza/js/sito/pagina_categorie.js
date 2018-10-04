//JS relativo a pagina commesse.php

$(document).ready(function() {
	
		
	//se clicco il bottone cerca
	$("#cerca_categoria").click(function(){
	    var id_commessa = $("#id_commessa").val();
	    var id_verbale = $("#id_verbale").val();
	    var filtro_categoria = $("#testo_cerca_categoria").val();
		filtro_categoria = filtro_categoria.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_categorie").load("php/tabella_categorie.php?id_commessa=" + id_commessa + "&id_verbale=" + id_verbale + "&filtro_categoria=" + filtro_categoria);
	});//chiudo $("#cerca_categoria")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_categoria").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_categoria").click();
			//}
	});//chiudo $("#testo_cerca_categoria")
	
}); // chiudo $(document).ready