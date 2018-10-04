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
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_clona").click(function(){
		var data = $("#data").val();
		var clima  = $("#clima").val();
		clima = clima.replace(/ /ig, '_'); //sostituisco gli spazi coj %20 per passarlo al GET
		var commessa  = $("#clima").val();
		var dettagli_commessa  = $("#dettagli_commessa").val();
		dettagli_commessa = dettagli_commessa.replace(/ /ig, '_'); //sostituisco gli spazi coj %20 per passarlo al GET
		var autista  = $("#autista").val();
		autista = autista.replace(/ /ig, '_'); //sostituisco gli spazi coj %20 per passarlo al GET
		autista = autista.replace(/&#39;/ig, '[accento]'); //sostituisco gli spazi coj %20 per passarlo al GET
		var tipologia  = $("#tipologia").val();
		tipologia = tipologia.replace(/ /ig, '_'); //sostituisco gli spazi coj %20 per passarlo al GET
		// var dettagli_lavoro  = $("#dettagli_lavoro").val();
		// dettagli_lavoro = dettagli_lavoro.replace(/ /ig, '_'); //sostituisco gli spazi coj %20 per passarlo al GET
		var quantita  = $("#quantita").val();
		quantita = quantita.replace(/ /ig, '_'); //sostituisco gli spazi coj %20 per passarlo al GET
		// var terzi  = $("#terzi").val();
		// terzi = terzi.replace(/ /ig, '_'); //sostituisco gli spazi coj %20 per passarlo al GET
		// var ore_terzi  = $("#ore_terzi").val();
		// ore_terzi = ore_terzi.replace(/ /ig, '_'); //sostituisco gli spazi coj %20 per passarlo al GET
		// var note  = $("#note").val();
		// note = note.replace(/ /ig, '_'); //sostituisco gli spazi coj %20 per passarlo al GET
		var clona = "clona";
		// window.location = "nuovo_ruolino_giornaliero.php?nome=nuovo&autista="+ autista + "&data="+data+"&clima="+clima+"&clona="+clona+"&dettagli_commessa="+dettagli_commessa+"&dettagli_lavoro="+dettagli_lavoro + "&tipologia="+tipologia + "&quantita="+quantita + "&terzi="+terzi + "&ore_terzi=" + ore_terzi + "&note="+note;
		window.location = "nuovo_ruolino_giornaliero.php?nome=nuovo&autista="+ autista + "&data="+data+"&clima="+clima+"&clona="+clona+"&dettagli_commessa="+dettagli_commessa + "&tipologia="+tipologia + "&quantita="+quantita;
		
		
	});//chiudo $("#btn_modifica")
	

	
	
}); // chiudo $(document).ready


var inserisciProgrammazione = function() {
	 if($("#formNewRuolino").valid() == false){
		 window.location = "#";
		 return;
	 }

	var dettagli_commessa = $("#dettagli_commessa").val();
	var dettagli_lavoro = $("#dettagli_lavoro").val();
	var addetti = $("#addetti").val();
	
	var mezzo = $("#mezzo").val();
	var note = $("#note").val();
	var data = $("#data").val();
	var ore = $("#ore").val();
	var autista = $("#autista").val();
	var quantita = $("#quantita").val();
	var terzi = $("#terzi").val();
	var ore_terzi = $("#ore_terzi").val();
	var km = $("#km").val();
	var clima = $("#clima").val();
	var tipologia = $("#tipologia").val(); 
	var data_giorno = $("#data").val();
	var dati_commessa = dettagli_commessa.split("-");
    var id_commessa = dati_commessa[0];	
	
	if(addetti == "" || autista == ""){
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
    	url: "lib/operazioni_ruolino_giornaliero.lib.php",
        type: 'POST',
        data: { tipo: "inserimento", tipologia:tipologia, clima:clima, km:km, ore_terzi:ore_terzi, terzi:terzi, quantita:quantita, autista:autista, ore:ore, data:data, dettagli_commessa: dettagli_commessa, dettagli_lavoro: dettagli_lavoro, addetti: addetti, mezzo: mezzo, note:note },
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
	 				window.location = "#";
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
					$("#btn_clona").show();	
					$("#titolo_h1").html("Modifica Ruolino Giornaliero");
					$("#tabella_mezzi_ruolino").load("php/tabella_mezzi_ruolino.php?data="+data_giorno + "&id_commessa="+id_commessa);	
					
					// $("#div_nuovo").load("php/div_nuovo_ruolino_giornaliero.php?id="+data);	
					$("#ul_log").load("php/ul_log.php");	
					}else if(data.indexOf("foreign key") != -1 &&  data.indexOf("id_commessa") != -1){
						window.location = "#";
			    		$("#messaggio").hide();
						$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Errore: Devi selezionare una commessa dall'elenco");
						$("#messaggio_errore").show();
						$("#id_da_modificare").val(data);
					$("#btn_nuovo").hide();	
					$("#btn_modifica").show();	
					$("#btn_clona").show();	
					$("#titolo_h1").html("Modifica Ruolino Giornaliero");
					$("#tabella_mezzi_ruolino").load("php/tabella_mezzi_ruolino.php?data="+data_giorno + "&id_commessa="+id_commessa);	
					
					}  else {
					alert("Errore: "+data);	
				}
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
            }
    });//chiudo $.ajax	
};


var modificaProgrammazione = function() {
	if($("#formNewRuolino").valid() == false){
		window.location = "#";
		return;
	}

	var id = $("#id_da_modificare").val();
	var dettagli_commessa = $("#dettagli_commessa").val();
	var dettagli_lavoro = $("#dettagli_lavoro").val();
	var addetti = $("#addetti").val();
	
	var mezzo = $("#mezzo").val();
	var note = $("#note").val();
	var data = $("#data").val();
	var ore = $("#ore").val();
	var autista = $("#autista").val();
	var quantita = $("#quantita").val();
	var terzi = $("#terzi").val();
	var ore_terzi = $("#ore_terzi").val();
	var km = $("#km").val();
	var clima = $("#clima").val();
	var tipologia = $("#tipologia").val(); 
	if(addetti == "" || autista == ""){
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
    	url: "lib/operazioni_ruolino_giornaliero.lib.php",
        type: 'POST',
        data: { tipo: "modifica", id: id, tipologia:tipologia, clima:clima, km:km, ore_terzi:ore_terzi, terzi:terzi, quantita:quantita, autista:autista, ore:ore, data:data, dettagli_commessa: dettagli_commessa, dettagli_lavoro: dettagli_lavoro, addetti: addetti, mezzo: mezzo, note:note },
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
	 				window.location = "#";
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo").hide();	
					$("#btn_modifica").show();	
					$("#btn_clona").show();	
					
					$("#titolo_h1").html("Modifica Ruolino Giornaliero");

					// $("#div_nuovo").load("php/div_nuovo_ruolino_giornaliero.php?id="+id);	
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
            }
    });//chiudo $.ajax
		 
		
};

