//JS relativo a pagina utenti.php

$(document).ready(function() {
	
    
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuova_benzina").click(function(){
		if($("#formNewBenzina").valid() == false){
			return 
		}
		
		var km_veicolo = $("#km_veicolo").val();
		var quantita_litri = $("#quantita_litri").val();
		var prezzo_pompa = $("#prezzo_pompa").val();
		var aliq_iva = $("#aliq_iva").val();
		var importo_ticket = $("#importo_ticket").val();
		var totale_iva_inclusa = $("#totale_iva_inclusa").val();

		var sconto = $("#sconto").val();
		var prezzo_escluso_iva = $("#prezzo_escluso_iva").val();
		var importo_netto = $("#importo_netto").val();
		var importo_iva = $("#importo_iva").val();

		if (IsNumber(km_veicolo) == false && km_veicolo != "") {
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per i Km");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
			return; 
		}

		// if (IsNumber(quantita_litri) == false) {
		    // $("#messaggio").hide();
		    // $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per i litri");
		    // $("#messaggio_errore").show();
		    // //NASCONDO MESSAGGIO
		    // setTimeout(function () {
		        // $('#messaggio_errore').hide(1000);
		    // }, 4000);
		    // return;
		// }

		// if (IsNumber(prezzo_pompa) == false) {
		    // $("#messaggio").hide();
		    // $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per il prezzo pompa");
		    // $("#messaggio_errore").show();
		    // //NASCONDO MESSAGGIO
		    // setTimeout(function () {
		        // $('#messaggio_errore').hide(1000);
		    // }, 4000);
		    // return
		// }

		// if (IsNumber(aliq_iva) == false && aliq_iva != "") {
		    // $("#messaggio").hide();
		    // $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per Aliq. IVA");
		    // $("#messaggio_errore").show();
		    // //NASCONDO MESSAGGIO
		    // setTimeout(function () {
		        // $('#messaggio_errore').hide(1000);
		    // }, 4000);
		    // return
		// }

		// if (IsNumber(importo_ticket) == false) {
		    // $("#messaggio").hide();
		    // $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per Importo Ticket");
		    // $("#messaggio_errore").show();
		    // //NASCONDO MESSAGGIO
		    // setTimeout(function () {
		        // $('#messaggio_errore').hide(1000);
		    // }, 4000);
		    // return
		// }

		if (IsNumber(totale_iva_inclusa) == false) {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per Totale incluso IVA");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
		    return;
		}

		if (IsNumber(sconto) == false && sconto != "") {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per lo sconto");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
		    return
		}

		if (IsNumber(prezzo_escluso_iva) == false && prezzo_escluso_iva != "") {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per iol prezzo escluso IVA");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
		    return
		}

		if (IsNumber(importo_netto) == false && importo_netto != "") {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per Importo netto");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
		    return
		}

		if (IsNumber(importo_iva) == false && importo_iva != "") {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per Importo IVA");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
		    return
		}
		
		$("#formNewBenzina").submit();
	});//chiudo $("#btn_nuova_benzina")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_benzina").click(function(){
	    $("#tipo").val("modifica");

		//valido campi
		if($("#formNewBenzina").valid() == false){
			return 
		}
		
		var km_veicolo = $("#km_veicolo").val();
		var quantita_litri = $("#quantita_litri").val();
		var prezzo_pompa = $("#prezzo_pompa").val();
		var aliq_iva = $("#aliq_iva").val();
		var importo_ticket = $("#importo_ticket").val();
		var totale_iva_inclusa = $("#totale_iva_inclusa").val();

		var sconto = $("#sconto").val();
		var prezzo_escluso_iva = $("#prezzo_escluso_iva").val();
		var importo_netto = $("#importo_netto").val();
		var importo_iva = $("#importo_iva").val();

		if (IsNumber(km_veicolo) == false) {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per i Km");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
		    return
		}

		// if (IsNumber(quantita_litri) == false) {
		    // $("#messaggio").hide();
		    // $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per i litri");
		    // $("#messaggio_errore").show();
		    // //NASCONDO MESSAGGIO
		    // setTimeout(function () {
		        // $('#messaggio_errore').hide(1000);
		    // }, 4000);
		    // return
		// }
// 
		// if (IsNumber(prezzo_pompa) == false) {
		    // $("#messaggio").hide();
		    // $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per il prezzo pompa");
		    // $("#messaggio_errore").show();
		    // //NASCONDO MESSAGGIO
		    // setTimeout(function () {
		        // $('#messaggio_errore').hide(1000);
		    // }, 4000);
		    // return
		// }
// 
		// if (IsNumber(aliq_iva) == false && aliq_iva != "") {
		    // $("#messaggio").hide();
		    // $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per Aliq. IVA");
		    // $("#messaggio_errore").show();
		    // //NASCONDO MESSAGGIO
		    // setTimeout(function () {
		        // $('#messaggio_errore').hide(1000);
		    // }, 4000);
		    // return
		// }
// 
		// if (IsNumber(importo_ticket) == false) {
		    // $("#messaggio").hide();
		    // $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per Importo Ticket");
		    // $("#messaggio_errore").show();
		    // //NASCONDO MESSAGGIO
		    // setTimeout(function () {
		        // $('#messaggio_errore').hide(1000);
		    // }, 4000);
		    // return
		// }

		if (IsNumber(totale_iva_inclusa) == false) {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per Totale incluso IVA");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
		    return
		}

		if (IsNumber(sconto) == false && sconto != "") {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per lo sconto");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
		    return
		}

		if (IsNumber(prezzo_escluso_iva) == false && prezzo_escluso_iva != "") {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per iol prezzo escluso IVA");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
		    return
		}

		if (IsNumber(importo_netto) == false && importo_netto != "") {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per Importo netto");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
		    return
		}

		if (IsNumber(importo_iva) == false && importo_iva != "") {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per Importo IVA");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
		    return
		}
		
		
		
		$("#formNewBenzina").submit();
	});//chiudo $("#btn_modifica_tagliando")
	
	
		
	

	
	
}); // chiudo $(document).ready
