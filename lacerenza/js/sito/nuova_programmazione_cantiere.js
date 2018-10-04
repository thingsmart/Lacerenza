//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo").click(function(){
		inserisciProgrammazione();
	});//chiudo $("#btn_nuovo")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica").click(function(){
		modificaProgrammazione();
	});//chiudo $("#btn_modifica")
	
		
	

	
	
}); // chiudo $(document).ready


var inserisciProgrammazione = function() {
	if($("#formNewProgrammazione").valid() == false){
		return;
	}

	var dettagli_commessa = $("#dettagli_commessa").val();
	var dettagli_lavoro = $("#dettagli_lavoro").val();
	var addetti = $("#addetti").val();
	var mezzo = $("#mezzo").val();
	var note = $("#note").val();
	var data = $("#data").val();
	var tipologia_lavoro = $("#tipologia_lavoro").val();

	if(addetti == ""){
		window.location = "#";
    		$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Compila tutti i campi con *");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio_errore').hide(1000);
					}, 4000);
			return false;
	}
	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_programmazione_cantiere.lib.php",
        type: 'POST',
        data: { tipologia_lavoro: tipologia_lavoro, tipo: "inserimento", data:data, dettagli_commessa: dettagli_commessa, dettagli_lavoro: dettagli_lavoro, addetti: addetti, mezzo: mezzo, note:note },
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#id_da_modificare").val(data);
					$("#btn_nuovo").hide();	
					$("#btn_modifica").show();	
					$("#titolo_h1").html("Modifica Programmazione Giornaliera Cantiere");
					// $("#div_nuovo").load("php/div_nuova_programmazione_cantiere.php?id="+data);	
					$("#ul_log").load("php/ul_log.php");	
				} else if(data.indexOf("MEZZO") != -1) {
					$("#messaggio").hide();
					$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Dati salvati ma il mezzo non corrisponde al carico giornaliero");
					$("#messaggio_errore").show();
					var id = data.split("-"); 
					$("#id_da_modificare").val(id[0]);
					
					$("#btn_nuovo").hide();	
					$("#btn_modifica").show();	
					$("#titolo_h1").html("Modifica Programmazione Giornaliera Cantiere");
					window.location = "#";
				}  else {
					alert("Errore1: "+data);	
				}
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
            }
    });//chiudo $.ajax	
};


var modificaProgrammazione = function() {
	if($("#formNewProgrammazione").valid() == false){
		return;
	}

	var id = $("#id_da_modificare").val();
	var dettagli_commessa = $("#dettagli_commessa").val();
	var dettagli_lavoro = $("#dettagli_lavoro").val();
	var addetti = $("#addetti").val();
	var mezzo = $("#mezzo").val();
	var note = $("#note").val();
	var data = $("#data").val();
	var tipologia_lavoro = $("#tipologia_lavoro").val();
	if(addetti == ""){
		window.location = "#";
    		$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Compila tutti i campi con *");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio_errore').hide(1000);
					}, 4000);
			return false;
	}	
	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_programmazione_cantiere.lib.php",
        type: 'POST',
        data: { tipologia_lavoro:tipologia_lavoro, tipo: "modifica", id: id, data:data, dettagli_commessa: dettagli_commessa, dettagli_lavoro: dettagli_lavoro, addetti: addetti, mezzo: mezzo, note:note },
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
					$("#titolo_h1").html("Modifica Programmazione Giornaliera Cantiere");
					// $("#div_nuovo").load("php/div_nuova_programmazione_cantiere.php?id="+id);	
					$("#ul_log").load("php/ul_log.php");	
				} else if(data.indexOf("MEZZO") != -1) {
					$("#messaggio").hide();
					$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Dati salvati ma il mezzo non corrisponde al carico giornaliero");
					$("#messaggio_errore").show();
					
					$("#btn_nuovo").hide();	
					$("#btn_modifica").show();	
					$("#titolo_h1").html("Modifica Programmazione Giornaliera Cantiere");
					window.location = "#";
				}   else {
					alert("Errore: "+data);	
				}
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
            }
    });//chiudo $.ajax
		 
		
};

