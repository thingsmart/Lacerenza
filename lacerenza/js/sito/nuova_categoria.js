//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuova_categoria").click(function(){
		if($("#formNewCategoria").valid() == false){
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
		
		$("#formNewCategoria").submit();
	});//chiudo $("#btn_nuova_categoria")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_categoria").click(function(){
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewCategoria").valid() == false){
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
		
		
		
		$("#formNewCategoria").submit();
	});//chiudo $("#btn_modifica_categoria")
	
	
}); // chiudo $(document).ready
