//JS relativo a pagina commesse.php
$(document).ready(function() {
	
	//se clicco il bottone cerca
	$("#cerca_documento_cliente").click(function(){
	    var id_commessa = $("#id_commessa").val();
	    var filtro_documento_cliente = $("#testo_cerca_documento_cliente").val();
	    filtro_documento_cliente = filtro_documento_cliente.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
	    $("#tabella_documenti_cliente").load("php/tabella_documenti_cliente.php?id=" + id_commessa + "&filtro_documento_cliente=" + filtro_documento_cliente);
	});//chiudo $("#testo_cerca_documento_cliente")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_documento_cliente").keypress(function(e)
		{
			//if(e.keyCode == 13) {
	    $("#cerca_documento_cliente").click();
			//}
	});//chiudo $("#testo_cerca_documento_cliente")
	
}); // chiudo $(document).ready