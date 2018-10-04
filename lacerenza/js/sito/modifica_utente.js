//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo_utente").click(function(){
		registraUtente();
	});//chiudo $("#btn_nuovo_utente")
	
		//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_utente").click(function(){
		modificaUtente();
	});//chiudo $("#btn_nuovo_utente_conferma")
	
	

	
	
}); // chiudo $(document).ready


var registraUtente = function() {
	if($("#formNewUser").valid() == false){
		return 
	}

	var username = $("#username_utente").val();
	var password = $("#password_utente").val();
	var ruolo = $("#ruolo_utente").val();
	var nome = $("#nome_utente").val();
	var cognome = $("#cognome_utente").val();
	var email = $("#email_utente").val();
	var mansione = $("#mansione_utente").val();
	
	
	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_utente.lib.php",
        type: 'POST',
        data: {tipo: "inserimento", username: username, password:password, ruolo:ruolo, nome:nome, cognome:cognome, mansione:mansione, email:email},
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo_utente").hide();	
					$("#btn_modifica_utente").show();	
					$("#titolo_h1").html("Modifica Utente");
					$("#div_nuovo_utente").load("php/div_nuovo_utente.php?id="+data);	
				} else if(data.indexOf("Duplicate entry") > -1){
					$("#messaggio").hide();
						$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Username non disponibile");
						$("#messaggio_errore").show();
						setTimeout(function(){
							$('#messaggio_errore').hide(2000);
						}, 4000);
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
	if($("#formNewUser").valid() == false){
		return 
	}
	
	var username = $("#username_utente").val();
	var password = $("#password_utente").val();
	var ruolo = $("#ruolo_utente").val();
	var id = $("#id_da_modificare").val();
	var nome = $("#nome_utente").val();
	var cognome = $("#cognome_utente").val();
	var email = $("#email_utente").val();
	var mansione = $("#mansione_utente").val();
	
	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_utente.lib.php",
        type: 'POST',
        data: {tipo: "modifica", username: username, password:password, ruolo:ruolo, id:id, nome:nome, cognome:cognome, email:email, mansione:mansione},
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo_utente").hide();	
					$("#btn_modifica_utente").show();	
					$("#titolo_h1").html("Modifica Utente");
				} else {
					alert("Errore: "+data);	
				}
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
            }
    });//chiudo $.ajax
		 
		
}