//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo").click(function(){
		if($("#formNewLavori").valid() == false){
			return; 
		}
		
		
		
		$("#formNewLavori").submit();
	});//chiudo $("#btn_nuovo")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica").click(function(){
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewLavori").valid() == false){
			return; 
		}
		
		
		
		
		
		$("#formNewLavori").submit();
	});//chiudo $("#btn_modifica")
	
	
	
}); // chiudo $(document).ready
