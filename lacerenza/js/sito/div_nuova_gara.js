//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//inizializzo datepicker
	 $('.data_picker').datepicker({
	   language: 'it',
	   autoclose: true
	});
	
		
	
	$("#btn_allega").click(function(){
		var id_gara = $("#id_da_modificare").val();
		var descrizione_file = $("#descrizione_file").val();
		var files = $("#files").val();
		if(descrizione_file == ""){
			alert("Inserire una descrizione per il file da allegare");
			return false;
		}
		if(files == ""){
			alert("Seleziona il file da allegare");
			return false;
		}
		
		$("#formAllega").submit();
	});
	
	$("#formAllega").ajaxForm({
		success: function(data){
			var id_gara = $("#id_gara").val();
		    var tipo = $("#tipo").val();
			if(tipo != "modifica"){
			    if (data >= 0) {
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />File allegato con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#descrizione_file").val("");
					$("#files").val("");
					$("#tabella_allegati_gara").load("php/tabella_allegati_gara.php?id=" + id_gara);
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			}
		}
	});//chiudo
	
	$("#formNewGara").ajaxForm({
		success: function(data){
		    var tipo = $("#tipo").val();
			if(tipo != "modifica"){
			    if (data >= 0) {
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo").hide();	
					$("#btn_modifica").show();
					$("#titolo_h1").html("Modifica Gara");
					$("#div_nuova_gara").load("php/div_nuova_gara.php?id=" + data);
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			} else { // sono in modifica
				if(data >= 0){
				    var id = $("#id_modifica").val();
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo").hide();	
					$("#btn_modifica").show();	
					$("#titolo_h1").html("Modifica Gara");
					$("#div_nuova_gara").load("php/div_nuova_gara.php?id=" + id);
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			}
		}
	});//chiudo $("#formUpdate")
		
	
	//validazione campi
	$("#formNewGara").validate({
		rules: {
		    descrizione: {
				required: true
			},
		    polizze: {
				required: true
		    }
		},
		messages:{  
		    tipo_documento: {
				required: "<strong style='color:red; font-size:10px'>tipo</strong>"
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


