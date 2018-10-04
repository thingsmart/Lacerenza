//JS relativo a pagina utenti.php

$(document).ready(function() {
	//inizializzo datepicker
	 $('.data_picker').datepicker({
	   language: 'it',
	   autoclose: true
	});


	$("#clear_data").click(function(){
		$("#data_fine").val("");
	});

	//validazione campi
	$("#formNewCommessa").validate({
		rules: {
			codice: {
				required: true
			},
			localita: {
				required: true
			},
			data_inizio: {
				required: true
			}
		},
		messages:{
			codice:{
				required: "<strong style='color:red; font-size:10px'>Codice</strong>"
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


