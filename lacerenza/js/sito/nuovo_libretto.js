//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuova_spesa").click(function(){
		if($("#formNewSpesa").valid() == false){
			return 
		}
		


		
		$("#formNewSpesa").submit();
	});//chiudo $("#btn_nuovo_tagliando")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_spesa").click(function(){
		$("#tipo").val("modifica");
		
		//valido campi
		if($("#formNewSpesa").valid() == false){
			return 
		}
		

		
		
		
		$("#formNewSpesa").submit();
	});//chiudo $("#btn_modifica_tagliando")
	
	
		
	

	
	
}); // chiudo $(document).ready

