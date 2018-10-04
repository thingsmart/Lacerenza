//JS relativo a pagina utenti.php

$(document).ready(function() {
	//inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });
	//validazione campi
	$("#formNew").validate({
		rules: {

			tipo_comunicazione: {
				required: true
			},
			destinatario: {
				required: true
			},
			testo: {
				required: true
			}
		},
		messages:{  
			testo:{  
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
	
	
	$("#inserisci_allegato").click(function(){
		var descrizione = $("#descrizione_allegato").val();
		var file = $("#files").val();
		if(descrizione == ""){
			alert("Inserire una descrizione dell'allegato");
			return false;
		}
		if(file == ""){
			alert("Seleziona un file da  allegare");
			return false;
		}
		$("#formAllega").submit();
	});//chiudo $("#inserisci_allegato")
	
$("#formAllega").ajaxForm({
		success: function(data){
		    var tipo = $("#tipo").val();
		    var id = $("#id_da_modificare").val();
			    if (data >= 0) {
					
				$("#descrizione_allegato").val("");
					$("#files").val("");
					$("#tabella_allegati_comunicazioni").load("php/tabella_allegati_comunicazioni.php?id=" + id);
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
					
				}
			
		}
	});//chiudo 
}); // chiudo $(document).ready


