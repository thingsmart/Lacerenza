//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuova_ral").click(function(){
		if($("#formNewRal").valid() == false){
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

		//var tipologia = $("#tipologia").val();
		//if(tipologia == ""){
		//	$("#messaggio").hide();
		//	$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Selezionare una tipologia");
		//	$("#messaggio_errore").show();
		//	//NASCONDO MESSAGGIO
		//	setTimeout(function(){
		//		$('#messaggio_errore').hide(1000);
		//	}, 4000);
		//	return
		//}

		$("#formNewRal").submit();
	});//chiudo $("#btn_nuova_ral")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_ral").click(function(){
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewRal").valid() == false){
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
		
		
		
		$("#formNewRal").submit();
	});//chiudo $("#btn_modifica_ral")
	
	
		
	

	
	
}); // chiudo $(document).ready
