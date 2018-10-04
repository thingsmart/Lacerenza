//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
    $("#btn_nuovo_documento_cliente").click(function () {
		if($("#formNewDocumento").valid() == false){
			return 
		}
		
	
		
		$("#formNewDocumento").submit();
	});//chiudo $("#btn_nuovo_documento_cliente")
	
	//se clicco il bottone conferma nuovo_utente
    $("#btn_modifica_documento_cliente").click(function () {
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewDocumento").valid() == false){
			return 
		}
				
		
		
		$("#formNewDocumento").submit();
	});//chiudo $("#btn_modifica_documento_cliente")
	
	
		
	

	
	
}); // chiudo $(document).ready
