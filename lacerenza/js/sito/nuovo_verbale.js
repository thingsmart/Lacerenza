//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo_verbale").click(function(){
		if($("#formNewVerbale").valid() == false){
			return 
		}
		
		var importo = $("#importo").val();

		if (IsNumber(importo) == false) {
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per l'importo");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
			return 
		}
		
		$("#formNewVerbale").submit();
	});//chiudo $("#btn_nuovo_verbale")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_verbale").click(function(){
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewVerbale").valid() == false){
			return 
		}
		
		var importo = $("#importo").val();

		if (IsNumber(importo) == false) {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per l'importo");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
		    return
		}
		
		
		
		$("#formNewVerbale").submit();
	});//chiudo $("#btn_modifica_verbale")
	
	
		
	

	
	
}); // chiudo $(document).ready
