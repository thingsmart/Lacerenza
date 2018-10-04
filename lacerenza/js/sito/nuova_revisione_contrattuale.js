//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuova_revisione_contrattuale").click(function(){
		if($("#formNewRevisioneContrattuale").valid() == false){
			return 
		}
		
		
		
		$("#formNewRevisioneContrattuale").submit();
	});//chiudo $("#btn_nuova_revisione_contrattuale")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_revisione_contrattuale").click(function(){
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewRevisioneContrattuale").valid() == false){
			return 
		}
		
		
		
		
		
		$("#formNewRevisioneContrattuale").submit();
	});//chiudo $("#btn_modifica_revisione_contrattuale")
	
	
	
}); // chiudo $(document).ready
