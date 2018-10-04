//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo_veicolo").click(function(){
	    if ($("#formNewVeicolo").valid() == false) {
			return 
		}
		
		
	    $("#formNewVeicolo").submit();
	});//chiudo $("#btn_nuovo_veicolo")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_veicolo").click(function(){
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewVeicolo").valid() == false){
			return 
		}
				
		
		$("#formNewVeicolo").submit();
	});//chiudo $("#btn_modifica_veicolo")
	

}); // chiudo $(document).ready
