//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo_mezzo").click(function(){
		registraMezzo();
	});//chiudo $("#btn_nuovo_mezzo")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_mezzo").click(function(){
		modificaMezzo();
	});//chiudo $("#btn_modifica_mezzo")
	
		
	

	
	
}); // chiudo $(document).ready


var registraMezzo = function() {
	if($("#formNewMezzo").valid() == false){
		return; 
	}

	var mezzo = $("#mezzo").val();
	var targa = $("#targa").val();
	var km_percorsi = $("#km_percorsi").val();
	var tagliando_ogni = $("#tagliando_ogni").val();
	var venduto = $("#venduto").val();
	var immatricolazione = $("#immatricolazione").val();

	if(IsNumber(km_percorsi) == false){
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per i km");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
			return; 
	}

	if (IsNumber(tagliando_ogni) == false) {
	    $("#messaggio").hide();
	    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per i km tagliando");
	    $("#messaggio_errore").show();
	    //NASCONDO MESSAGGIO
	    setTimeout(function () {
	        $('#messaggio_errore').hide(1000);
	    }, 4000);
	    return
	}
		
		
	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_mezzo.lib.php",
        type: 'POST',
        data: { tipo: "inserimento", venduto:venduto, mezzo: mezzo, targa: targa, km_percorsi: km_percorsi, tagliando_ogni: tagliando_ogni, immatricolazione:immatricolazione },
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo_mezzo").hide();	
					$("#btn_modifica_mezzo").show();	
					$("#titolo_h1").html("Modifica Mezzo");
					$("#div_nuovo_mezzo").load("php/div_nuovo_mezzo.php?id="+data);	
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
		return; 
	}

	var id = $("#id_da_modificare").val();
	var mezzo = $("#mezzo").val();
	var targa = $("#targa").val();
	var km_percorsi = $("#km_percorsi").val();
	var km_percorsi_vecchi = $("#km_percorsi_vecchi").val();
	var tagliando_ogni = $("#tagliando_ogni").val();
	var venduto = $("#venduto").val();
	var immatricolazione = $("#immatricolazione").val();
	
	if(IsNumber(km_percorsi) == false){
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per i km");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
			return 
	}

	if (IsNumber(tagliando_ogni) == false) {
	    $("#messaggio").hide();
	    $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per i km tagliando");
	    $("#messaggio_errore").show();
	    //NASCONDO MESSAGGIO
	    setTimeout(function () {
	        $('#messaggio_errore').hide(1000);
	    }, 4000);
	    return
	}
		
	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_mezzo.lib.php",
        type: 'POST',
        data: { tipo: "modifica", venduto:venduto, id: id, mezzo: mezzo, targa: targa, km_percorsi: km_percorsi, km_percorsi_vecchi: km_percorsi_vecchi, tagliando_ogni: tagliando_ogni, immatricolazione : immatricolazione },
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo_mezzo").hide();	
					$("#btn_modifica_mezzo").show();	
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

