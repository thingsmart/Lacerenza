//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo").click(function(){
		if($("#formNewGara").valid() == false){
			return; 
		}
		
		
		
		$("#formNewGara").submit();
	});//chiudo $("#btn_nuovo")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica").click(function(){
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewGara").valid() == false){
			return; 
		}
		
		
		
		
		
		$("#formNewGara").submit();
	});//chiudo $("#btn_modifica")
	
	
	
}); // chiudo $(document).ready
