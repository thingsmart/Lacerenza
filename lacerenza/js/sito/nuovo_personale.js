//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo_personale").click(function(){
	    if ($("#formNewPersonale").valid() == false) {
			return 
		}
		
		
	    $("#formNewPersonale").submit();
	});//chiudo $("#btn_nuovo_personale")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_personale").click(function(){
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewPersonale").valid() == false){
			return 
		}
				
		
		$("#formNewPersonale").submit();
	});//chiudo $("#btn_modifica_personale")
	

}); // chiudo $(document).ready
