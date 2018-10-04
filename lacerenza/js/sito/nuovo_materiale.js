//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo_materiale").click(function(){
	    if ($("#formNewMateriale").valid() == false) {
			return 
		}
		
	    var costo = $("#costo").val();

	    if (IsNumber(costo) == false) {
	        $("#messaggio").hide();
	        $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per il costo");
	        $("#messaggio_errore").show();
	        //NASCONDO MESSAGGIO
	        setTimeout(function () {
	            $('#messaggio_errore').hide(1000);
	        }, 4000);
	        return
	    }

	    var quantita = $("#quantita").val();

	    if (IsNumber(quantita) == false) {
	        $("#messaggio").hide();
	        $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per la quantita");
	        $("#messaggio_errore").show();
	        //NASCONDO MESSAGGIO
	        setTimeout(function () {
	            $('#messaggio_errore').hide(1000);
	        }, 4000);
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
		
	    $("#formNewMateriale").submit();
	});//chiudo $("#btn_nuovo_materiale")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_materiale").click(function(){
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewMateriale").valid() == false){
			return 
		}
				
		var costo = $("#costo").val();

		if (IsNumber(costo) == false) {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per il costo");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
		    return
		}

		var quantita = $("#quantita").val();

		if (IsNumber(quantita) == false) {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per la quantita");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
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
		
		$("#formNewMateriale").submit();
	});//chiudo $("#btn_modifica_materiale")
	

}); // chiudo $(document).ready
