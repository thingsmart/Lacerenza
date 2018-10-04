//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo").click(function(){
		$("#btn_nuovo").attr("disabled","disabled");
		inserisci();
	});//chiudo $("#btn_nuovo")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica").click(function(){
		$("#btn_modifica").attr("disabled","disabled");
		modifica();
	});//chiudo $("#btn_modifica")
	
	

	
	
}); // chiudo $(document).ready


var inserisci = function() {
	if($("#formNew").valid() == false){
		return;
	}

	var dettagli_commessa = $("#dettagli_commessa").val();
	var tipo_comunicazione = $("#tipo_comunicazione").val();
	var testo = $("#testo").val();
	var note = $("#note").val();
	var destinatario = $("#destinatario").val();
	var destinatario_reale = $("#destinatario_reale").val();
	var data = $("#data").val();
	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_comunicazioni.lib.php",
        type: 'POST',
        data: { tipo: "inserimento", data:data, destinatario_reale:destinatario_reale, destinatario:destinatario, dettagli_commessa: dettagli_commessa, tipo_comunicazione: tipo_comunicazione, note: note, testo:testo },
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo").hide();	
					$("#btn_modifica").show();	
					$("#titolo_h1").html("Modifica Comunicazione");
					$("#div_nuovo").load("php/div_nuova_comunicazione.php?id="+data);	
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
				$("#btn_nuovo").attr("disabled", false);
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
 				$("#btn_nuovo").attr("disabled", false);
            }
    });//chiudo $.ajax	
};


var modifica = function() {
	if($("#formNew").valid() == false){
		return;
	}

	var id = $("#id_da_modificare").val();
	var dettagli_commessa = $("#dettagli_commessa").val();
	var tipo_comunicazione = $("#tipo_comunicazione").val();
	var testo = $("#testo").val();
	var note = $("#note").val();
	var destinatario = $("#destinatario").val();
	var data = $("#data").val();
	var destinatario_reale = $("#destinatario_reale").val();
	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_comunicazioni.lib.php",
        type: 'POST',
        data: { tipo: "modifica", id: id, data:data, destinatario_reale:destinatario_reale, destinatario:destinatario, dettagli_commessa: dettagli_commessa, tipo_comunicazione: tipo_comunicazione, note: note, testo:testo },
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo").hide();	
					$("#btn_modifica").show();	
					$("#titolo_h1").html("Modifica Comunicazione");
					$("#div_nuovo").load("php/div_nuova_comunicazione.php?id="+id);	
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
				$("#btn_modifica").attr("disabled", false);
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
 				$("#btn_modifica").attr("disabled", false);
            }
    });//chiudo $.ajax
		 
		
};

