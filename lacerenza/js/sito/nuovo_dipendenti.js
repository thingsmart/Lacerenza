//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo_dipendente").click(function(){
		registraUtente();
	});//chiudo $("#btn_nuovo_dipendente")
	
		//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_dipendente").click(function(){
		modificaUtente();
	});//chiudo $("#btn_nuovo_dipendente_conferma")
	
	

	
	
}); // chiudo $(document).ready


var registraUtente = function() {
	if($("#formNewDipendente").valid() == false){
		return 
	}

	var nome = $("#nome_utente").val();
	var cognome = $("#cognome_utente").val();
	var attivo = $("#attivo").val();
	
	
	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_dipendente.lib.php",
        type: 'POST',
        data: {tipo: "inserimento", nome:nome, cognome:cognome, attivo:attivo},
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo_dipendente").hide();	
					$("#btn_modifica_dipendente").show();	
					$("#titolo_h1").html("Modifica Dipendente");
					$("#div_nuovo_dipendente").load("php/div_nuovo_dipendente.php?id="+data);	
				} else {
					alert("Errore: "+data);	
				}
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
            }
    });//chiudo $.ajax
		 
		
}


var modificaUtente = function() {
	if($("#formNewDipendente").valid() == false){
		return 
	}
	
	
	var nome = $("#nome_utente").val();
	var id = $("#id").val();
	var cognome = $("#cognome_utente").val();
	var attivo = $("#attivo").val();
	
	//ajax insert user
	$.ajax({
	    url: "lib/operazioni_dipendente.lib.php",
        type: 'POST',
        data: {tipo: "modifica", nome:nome, cognome:cognome, id:id, attivo:attivo},
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo_dipendente").hide();	
					$("#btn_modifica_dipendente").show();	
					$("#titolo_h1").html("Modifica Dipendente");
				} else {
					alert("Errore: "+data);	
				}
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
            }
    });//chiudo $.ajax
		 
		
}