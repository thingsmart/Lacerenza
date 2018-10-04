//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuova_riserva").click(function(){
	    if ($("#formNewRiserva").valid() == false) {
			return 
		}
		
		
	    $("#formNewRiserva").submit();
	});//chiudo $("#btn_nuova_riserva")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_riserva").click(function(){
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewRiserva").valid() == false){
			return 
		}
				
		
		$("#formNewRiserva").submit();
	});//chiudo $("#btn_modifica_riserva")
	

}); // chiudo $(document).ready
