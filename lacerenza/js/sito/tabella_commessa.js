$(document).ready(function() {
	
	$('.data_picker').datepicker({
		 language: 'it',
    	 autoclose: true
	 });

	$("#clear_data").click(function(){
		$("#data_fine").val("");
	});
	 
	 //validazione campi
	$("#formCantiere").validate({
		rules: {
			localita: {
				required: true
			},
			cantiere: {
				required: true
			},
			importo: {
				required: true,
			},
			tipologia_lavori: {
				required: true,
			},
			referente: {
				required: true,
			},
			telefono: {
				required: true,
			},
			fax: {
				required: true,
			},
			cellulare: {
				required: true,
			}
		},
		messages:{  
			importo:{  
				required: "<strong style='color:red; font-size:10px'>Username obbligatorio.</strong>"
			}
			
		},
		errorPlacement: function(error, element){
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Compila tutti i campi");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
        }
	});	
});