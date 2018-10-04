//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuova_regolarita").click(function(){
	    if ($("#formNewRegolarita").valid() == false) {
			return; 
		}
		
		
	    $("#formNewRegolarita").submit();
	});//chiudo $("#btn_nuova_regolarita")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_regolarita").click(function(){
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewRegolarita").valid() == false){
			return;
		}
				
		
		$("#formNewRegolarita").submit();
	});//chiudo $("#btn_modifica_regolarita")
	

}); // chiudo $(document).ready
