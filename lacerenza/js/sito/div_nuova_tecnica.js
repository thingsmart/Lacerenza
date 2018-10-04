//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//inizializzo datepicker
	 $('.data_picker').datepicker({
	   language: 'it',
	   autoclose: true
	});
	
		//se clicco il bottone elimina
	$("#btn_elimina_allegato").unbind("click");
	$("#btn_elimina_allegato").click(function () {
		var nome = $(this).attr("nome");
		var id= $(this).attr("id_preventivo");
		
		$("#id_da_eliminare").val(id);
		$("#nome_da_eliminare").val(nome);

	});//chiudo 
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var nome = $("#nome_da_eliminare").val();
		
		$.ajax({
			url: "lib/operazioni_tecnica.lib.php",
			type: 'POST',
			data: { tipo: "elimina_allegato", id: id, nome: nome },
			success: function (data, textStatus, xhr) {
					if(data >= 0){
						$('#dialog_elimina').modal('hide');
						$("#div_nuova_tecnica").load("php/div_nuova_tecnica.php?id=" + id);
						$("#ul_log").load("php/ul_log.php");	
					} else {
						alert("Errore: "+data);
					}
				},
				error: function(xhr, textStatus, errorThrown) {
					alert("Errore generico riprovare!");
				}
		});//chiudo $.ajax		
	});
	
	$("#formNewTecnica").ajaxForm({
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
					$("#titolo_h1").html("Modifica Preventivo");
					$("#div_nuova_tecnica").load("php/div_nuova_tecnica.php?id=" + data);
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
					$("#titolo_h1").html("Modifica Preventivo");
					$("#div_nuova_tecnica").load("php/div_nuova_tecnica.php?id=" + id);
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			}
		}
	});//chiudo $("#formUpdate")
		
	
	//validazione campi
	$("#formNewTecnica").validate({
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


