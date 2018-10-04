//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo").click(function(){
		$("#btn_nuovo").attr("disabled","disabled");
		inserisciMagazzino();
	});//chiudo $("#btn_nuovo")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica").click(function(){
		$("#btn_modifica").attr("disabled","disabled");
		modificaMagazzino();
	});//chiudo $("#btn_modifica")
	
		
	

	
	
}); // chiudo $(document).ready


var inserisciMagazzino = function() {
	if($("#formNewMagazzino").valid() == false){
		return;
	}

	var dettagli_commessa = $("#dettagli_commessa").val();
	var dettagli_mezzo = $("#dettagli_mezzo").val();
	var data = $("#data").val();
	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_magazzino.lib.php",
        type: 'POST',
        data: { tipo: "inserimento", data:data, dettagli_commessa: dettagli_commessa, dettagli_mezzo: dettagli_mezzo },
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
					$("#titolo_h1").html("Modifica Cantiere");
					// $("#div_nuovo").load("php/div_nuovo_magazzino.php?id="+data);	
					$("#ul_log").load("php/ul_log.php");	
				} else if(data.indexOf("MEZZO") != -1) {
					$("#messaggio").hide();
					$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Dati salvati ma il mezzo non corrisponde alla programmazione giornaliera");
					$("#messaggio_errore").show();
					$("#btn_nuovo").hide();	
					$("#btn_modifica").show();	
					var id = data.split("-"); 
					$("#id_da_modificare").val(id[0]);
					
					$("#titolo_h1").html("Modifica Cantiere");
					// $("#div_nuovo").load("php/div_nuovo_magazzino.php?id="+id[0]);	
					$("#ul_log").load("php/ul_log.php");	
					window.location = "#";
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


var modificaMagazzino = function() {
	if($("#formNewMagazzino").valid() == false){
		return;
	}

	var id = $("#id_da_modificare").val();
	var dettagli_commessa = $("#dettagli_commessa").val();
	var dettagli_mezzo = $("#dettagli_mezzo").val();
	
	var data = $("#data").val();

		
	//ajax insert user
	$.ajax({
    	url: "lib/operazioni_magazzino.lib.php",
        type: 'POST',
        data: { tipo: "modifica", id: id, data:data, dettagli_commessa: dettagli_commessa, dettagli_mezzo: dettagli_mezzo},
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
					$("#titolo_h1").html("Modifica Cantiere");
					//$("#div_nuovo").load("php/div_nuovo_magazzino.php?id="+id);	
					$("#ul_log").load("php/ul_log.php");	
				} else if(data.indexOf("MEZZO") != -1) {
					$("#messaggio").hide();
					$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Dati salvati ma il mezzo non compare nella programmazione giornaliera");
					$("#messaggio_errore").show();
					var id = data.split("-"); 
					$("#btn_nuovo").hide();	
					$("#btn_modifica").show();	
					$("#titolo_h1").html("Modifica Cantiere");
					//$("#div_nuovo").load("php/div_nuovo_magazzino.php?id="+id);	
					$("#ul_log").load("php/ul_log.php");	
					window.location = "#";
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

