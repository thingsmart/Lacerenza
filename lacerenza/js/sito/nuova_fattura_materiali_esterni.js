//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuova_fattura").click(function(){
		$("#btn_nuova_fattura").attr("disabled", "disabled");
		if($("#formNewFattura").valid() == false){
			$("#btn_nuova_fattura").attr("disabled", false);
			return 
		}
		
		var importo = $("#importo_totale").val();

		if (IsNumber(importo) == false) {
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per l'importo");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
			$("#btn_nuova_fattura").attr("disabled", false);
			return 
		}
		
		$("#formNewFattura").submit();
	});//chiudo $("#btn_nuova_fattura")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_fattura").click(function(){
		$("#btn_modifica_fattura").attr("disabled", "disabled");
		$("#tipo").val("modifica");
	    //valido campi
		if($("#formNewFattura").valid() == false){
			$("#btn_modifica_fattura").attr("disabled", false);
			return 
		}
		
		var importo = $("#importo_totale").val();

		if (IsNumber(importo) == false) {
		    $("#messaggio").hide();
		    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per l'importo");
		    $("#messaggio_errore").show();
		    //NASCONDO MESSAGGIO
		    setTimeout(function () {
		        $('#messaggio_errore').hide(1000);
		    }, 4000);
			$("#btn_modifica_fattura").attr("disabled", false);
		    return
		}


		
		$("#formNewFattura").submit();
	});//chiudo $("#btn_modifica_fattura")
	
	
		
	

	
	
}); // chiudo $(document).ready

/*
var registraTagliando = function() {
	if($("#formNewFattura").valid() == false){
		return 
	}

	var tipo_tagliando = $("#tipo_tagliando").val();
	var data_tagliando = $("#data_tagliando").val();
	var costo = $("#costo").val();
	var id_mezzo = $("#id_mezzo").val();
	var file = $("#files").val();
	
	if(IsNumber(costo) == false){
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per i costo");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
			return 
		}
		
		
	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_tagliando.lib.php",
        type: 'POST',
        data: {tipo: "inserimento", tipo_tagliando:tipo_tagliando, data_tagliando:data_tagliando, costo:costo, id_mezzo:id_mezzo, file:file},
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuova_fattura").hide();	
					$("#btn_modifica_fattura").show();	
					$("#titolo_h1").html("Modifica Tagliando");
					$("#div_nuovo_tagliando").load("php/div_nuovo_tagliando.php?id="+data);	
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
            }
    });//chiudo $.ajax	
}


var modificaMezzo = function() {
	if($("#formNewMezzo").valid() == false){
		return 
	}

	var id = $("#id_da_modificare").val();
	var mezzo = $("#mezzo").val();
	var targa = $("#targa").val();
	var km_percorsi = $("#km_percorsi").val();
	var km_percorsi_vecchi = $("#km_percorsi_vecchi").val();
	var tagliando_ogni = $("#tagliando_ogni").val();
	
	if(IsNumber(km_percorsi) == false || (IsNumber(tagliando_ogni) == false && tagliando_ogni != "")){
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per i km");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
			return 
		}
		
	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_mezzo.lib.php",
        type: 'POST',
        data: {tipo: "modifica", id:id, mezzo:mezzo, targa:targa, km_percorsi:km_percorsi, km_percorsi_vecchi:km_percorsi_vecchi, tagliando_ogni:tagliando_ogni},
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuova_fattura").hide();	
					$("#btn_modifica_fattura").show();	
					$("#titolo_h1").html("Modifica Mezzo");
					$("#div_nuovo_mezzo").load("php/div_nuovo_mezzo.php?id="+id);	
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
            }
    });//chiudo $.ajax
		 
		
}

*/