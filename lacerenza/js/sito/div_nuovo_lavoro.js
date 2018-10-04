//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	
	
	$("#formNewLavori").ajaxForm({
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
					$("#titolo_h1").html("Modifica Attivit&agrave;");
					$("#div_nuovo_lavoro").load("php/div_nuovo_lavoro.php?id=" + data);
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
					$("#titolo_h1").html("Modifica Attivit&agrave;");
					$("#div_nuovo_lavoro").load("php/div_nuovo_lavoro.php?id=" + id);
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			}
		}
	});//chiudo $("#formUpdate")
		
	
	//validazione campi
	$("#formNewLavori").validate({
		// rules: {
		    // tipo_documento: {
				// required: true
			// },
		    // numero_documento: {
				// required: true
		    // }
		// },
		// messages:{  
		    // tipo_documento: {
				// required: "<strong style='color:red; font-size:10px'>tipo</strong>"
			// }
		// },
		// errorPlacement: function(error, element){
// 			
			// $("#messaggio").hide();
			// $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Compila tutti i campi con *");
			// $("#messaggio_errore").show();
					// //NASCONDO MESSAGGIO
					// setTimeout(function(){
				    	// $('#messaggio_errore').hide(1000);
					// }, 4000);
        // }
	});	
	
	
}); // chiudo $(document).ready


