//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuova_commessa").click(function(){
		registraCommessa();
	});//chiudo $("#btn_nuovo_utente")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_commessa").click(function(){
		modificaCommessa();
	});//chiudo $("#btn_nuovo_utente")
	
		
	

	
	
}); // chiudo $(document).ready


var registraCommessa = function() {
	if($("#formNewCommessa").valid() == false){
		window.location = "#";
		return;
	}

	var codice = $("#codice").val();
	var localita = $("#localita").val();
	var data_inizio = $("#data_inizio").val();
	var data_fine = $("#data_fine").val();
	var descrizione = $("#descrizione").val();
	var annotazioni = $("#annotazioni").val();
	var campo1 = $("#campo1").val();
	var campo2 = $("#campo2").val();
	var campo3 = $("#campo3").val();
	var campo4 = $("#campo4").val();
	var campo5 = $("#campo5").val();
	var campo6 = $("#campo6").val();


	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_commessa.lib.php",
        type: 'POST',
        data: {tipo: "inserimento", campo6:campo6, campo1:campo1, campo2:campo2, campo3:campo3, campo4:campo4, campo5:campo5, codice:codice, localita:localita, data_inizio:data_inizio, data_fine:data_fine, descrizione:descrizione, annotazioni:annotazioni},
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuova_commessa").hide();	
					$("#btn_modifica_commessa").show();	
					$("#titolo_h1").html("Modifica Commessa");
					$("#div_nuova_commessa").load("php/div_nuova_commessa.php?id="+data);	
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
				window.location = "#";
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
            }
    });//chiudo $.ajax	
};


var modificaCommessa = function() {
	if($("#formNewCommessa").valid() == false){
		return; 
	}

	var id = $("#id_commessa_da_modificare").val();
	var codice = $("#codice").val();
	var localita = $("#localita").val();
	var data_inizio = $("#data_inizio").val();
	var data_fine = $("#data_fine").val();
	var descrizione = $("#descrizione").val();
	var annotazioni = $("#annotazioni").val();
	var campo1 = $("#campo1").val();
	var campo2 = $("#campo2").val();
	var campo3 = $("#campo3").val();
	var campo4 = $("#campo4").val();
	var campo5 = $("#campo5").val();
	var campo6 = $("#campo6").val();

	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_commessa.lib.php",
        type: 'POST',
        data: {tipo: "modifica", id:id, campo6:campo6, campo1:campo1, campo2:campo2, campo3:campo3, campo4:campo4, campo5:campo5, codice:codice, localita:localita, data_inizio:data_inizio, data_fine:data_fine, descrizione:descrizione, annotazioni:annotazioni},
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuova_commessa").hide();	
					$("#btn_modifica_commessa").show();	
					$("#titolo_h1").html("Modifica Commessa");
					$("#div_nuova_commessa").load("php/div_nuova_commessa.php?id="+id);	
					$("#ul_log").load("php/ul_log.php");	
				}  else if(data == "error_data"){
					$("#messaggio").hide();
					$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Controlla le date inserite.");
					$("#messaggio_errore").show();
					setTimeout(function(){
						$('#messaggio_errore').hide(1000);
					}, 4000);
				}  else {
					alert("Errore: "+data);	
				}
				window.location = "#";
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
            }
    });//chiudo $.ajax
		 
		
};

