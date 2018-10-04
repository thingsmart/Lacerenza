//JS relativo a pagina utenti.php

$(document).ready(function() {
	//inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });
    
    $("#inserisci_mezzo").unbind("click");
    $("#inserisci_mezzo").click(function(){
    	var dettagli_commessa = $("#dettagli_commessa").val();
    	var dati_commessa = dettagli_commessa.split("-");
    	var id_commessa = dati_commessa[0];
    	var mezzo = $("#mezzo").val();
    	var costo = $("#costo").val();
    	var km = $("#km").val();
    	var data_giorno = $("#data").val();
    	
    	if(dettagli_commessa == ""){
    		window.location = "#";
    		$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Compila tutti i campi con * prima di procedere all'inserimento di un mezzo");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio_errore').hide(1000);
					}, 4000);
			return false;
    	}
    	
    	if(mezzo == ""){
    		// window.location = "#";
    		// $("#messaggio").hide();
			// $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un mezzo");
			// $("#messaggio_errore").show();
// 			
			// return false;
			alert("Inserire un mezzo");
			return false;
    	}
		
    	//ajax insert user
		$.ajax({
	    	url: "lib/operazioni_ruolino_giornaliero.lib.php",
	        type: 'POST',
	        data: { tipo: "inserimento_mezzo", dettagli_commessa:dettagli_commessa, costo:costo, km:km, mezzo:mezzo, data:data_giorno },
	        	success: function(data, textStatus, xhr) {
		 			if(data >= 0){
						$("#messaggio").hide();
						$("#messaggio_errore").hide();
						
						$("#tabella_mezzi_ruolino").load("php/tabella_mezzi_ruolino.php?data="+data_giorno + "&id_commessa="+id_commessa);	
						$("#ul_log").load("php/ul_log.php");	
						$("#mezzo").val("");
						$("#costo").val("");
						$("#km").val("");
					}else if(data.indexOf("Duplicate") != -1){
						alert("Errore: mezzo gia' inserita");	
					}  else {
						alert("Errore: "+data);	
					}
	            },
	            error: function(xhr, textStatus, errorThrown) {
	 				alert("Errore generico riprovare!");
	            }
	    });//chiudo $.ajax	
    });
    
    $("#inserisci_terzi").unbind("click");
    $("#inserisci_terzi").click(function(){
    	var dettagli_commessa = $("#dettagli_commessa").val();
    	var dati_commessa = dettagli_commessa.split("-");
    	var id_commessa = dati_commessa[0];
    	var descrizione = $("#descrizione_tb_terzi").val();
    	var ore = $("#ore_tb_terzi").val();
    	var data_giorno = $("#data").val();
    	
    	if(dettagli_commessa == ""){
    		window.location = "#";
    		$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Compila tutti i campi con * prima di procedere all'inserimento della lavorazione terzi");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio_errore').hide(1000);
					}, 4000);
			return false;
    	}
    	
    	if(descrizione == "" || ore == ""){
			alert("Inserire una descrizione e le ore per la lavorazione terzi");
			return false;
    	}
		
    	//ajax insert user
		$.ajax({
	    	url: "lib/operazioni_ruolino_giornaliero.lib.php",
	        type: 'POST',
	        data: { tipo: "inserimento_terzi", dettagli_commessa:dettagli_commessa, descrizione:descrizione, ore:ore, data:data_giorno },
	        	success: function(data, textStatus, xhr) {
		 			if(data >= 0){
						$("#messaggio").hide();
						$("#messaggio_errore").hide();
						
						$("#tabella_terzi_ruolino").load("php/tabella_terzi_ruolino.php?data="+data_giorno + "&id_commessa="+id_commessa);	
						$("#descrizione_tb_terzi").val("");
						$("#ore_tb_terzi").val("");
					}  else {
						alert("Errore: "+data);	
					}
	            },
	            error: function(xhr, textStatus, errorThrown) {
	 				alert("Errore generico riprovare!");
	            }
	    });//chiudo $.ajax	
    });
    
	//validazione campi
	$("#formNewRuolino").validate({
		rules: {
			dettagli_commessa: {
				required: true
			},
			dettagli_lavoro: {
				required: true
			},
			addetti: {
				required: true
			},
			ore: {
				required: true
			},
			autista: {
				required: true
			},
			clima: {
				required: true
			}
		},
		messages:{  
			mezzo:{  
				required: "<strong style='color:red; font-size:10px'>dettagli_commessa</strong>"
			}
		},
		errorPlacement: function(error, element){
			
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Compila tutti i campi con *");
			$("#messaggio_errore").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio_errore').hide(1000);
					}, 4000);
        }
	});	
	
	
}); // chiudo $(document).ready


