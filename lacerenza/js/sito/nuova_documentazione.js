//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuova_documentazione").click(function(){
		if($("#formNewDocumentazione").valid() == false){
			return 
		}
		
		
		
		$("#formNewDocumentazione").submit();
	});//chiudo $("#btn_nuova_documentazione")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_documentazione").click(function(){
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewDocumentazione").valid() == false){
			return 
		}
		
		
		
		$("#formNewDocumentazione").submit();
	});//chiudo $("#btn_modifica_documentazione")
	

}); // chiudo $(document).ready
