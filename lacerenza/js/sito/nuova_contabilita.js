//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo").click(function(){
		var prezzo = $("#prezzo").val();
		if (IsNumber(prezzo) == false && prezzo != "") {
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per il prezzo");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
				$('#messaggio_errore').hide(1000);
			}, 4000);
			return
		}

		var importo = $("#importo").val();
		if (IsNumber(importo) == false && importo != "") {
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per l'importo");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
				$('#messaggio_errore').hide(1000);
			}, 4000);
			return
		}
		$("#formNew").submit();
	});//chiudo $("#btn_nuova_revisione_contrattuale")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica").click(function(){
		$("#tipo").val("modifica");

		var prezzo = $("#prezzo").val();
		if (IsNumber(prezzo) == false && prezzo != "") {
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per il prezzo");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
				$('#messaggio_errore').hide(1000);
			}, 4000);
			return
		}

		var importo = $("#importo").val();
		if (IsNumber(importo) == false && importo != "") {
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per l'importo");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
				$('#messaggio_errore').hide(1000);
			}, 4000);
			return
		}

		$("#formNew").submit();
	});//chiudo $("#btn_modifica_revisione_contrattuale")
	
	
	
}); // chiudo $(document).ready
