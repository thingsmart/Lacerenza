//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo_noleggio").click(function(){
		if($("#formNewNoleggio").valid() == false){
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
		
		$("#formNewNoleggio").submit();
	});//chiudo $("#btn_nuovo_noleggio")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_noleggio").click(function(){
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewNoleggio").valid() == false){
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
		
		
		
		$("#formNewNoleggio").submit();
	});//chiudo $("#btn_modifica_noleggio")
	
	

}); // chiudo $(document).ready
