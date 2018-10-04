//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo_ordine").click(function(){
		if($("#formNewOrdine").valid() == false){
			return 
		}
		
		
		$("#formNewOrdine").submit();
	});//chiudo $("#btn_nuovo_ordine")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_ordine").click(function(){
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewOrdine").valid() == false){
			return 
		}	
		
		$("#formNewOrdine").submit();
	});//chiudo $("#btn_modifica_ordine")
	
	
		
	

	
	
}); // chiudo $(document).ready
