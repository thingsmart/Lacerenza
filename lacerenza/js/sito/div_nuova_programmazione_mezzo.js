//JS relativo a pagina utenti.php

$(document).ready(function() {
	//inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });
	//validazione campi
	$("#formNewProgrammazione").validate({
		rules: {
			dettagli_commessa: {
				required: true
			},
			dettagli_lavoro: {
				required: true
			},
			addetti: {
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


