//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//inizializzo datepicker
	 $('.data_picker').datepicker({
	   language: 'it',
	   autoclose: true
	});
	
	$("#elimina_scadenza").click(function(){
		$("#data_scadenza").val("");
	});
	
		//se clicco il bottone cerca
	 $("#btn_elimina_spesa").unbind("click");
	 $("#btn_elimina_spesa").click(function () {
		var nome = $(this).attr("nome");
		var id_tagliando = $(this).attr("id_tagliando");
		$("#id_da_eliminare").val(id_tagliando);
		$("#nome_da_eliminare").val(nome);


	});//chiudo $("#btn_elimina_commessa")
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_mezzo = $("#id_mezzo_da_eliminare").val();
		var nome = $("#nome_da_eliminare").val();
		$.ajax({
			url: "lib/operazioni_libretto.lib.php",
			type: 'POST',
			data: {tipo: "elimina_allegato", id:id, nome:nome, id_mezzo:id_mezzo},
				success: function(data, textStatus, xhr) {
					if(data >= 0){
						$('#dialog_elimina').modal('hide');
						$("#div_nuovo_libretto").load("php/div_nuovo_libretto.php?id=" + id + "&id_mezzo=" + id_mezzo);
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
	
	$("#formNewSpesa").ajaxForm({
		success: function(data){
			var tipo = $("#tipo").val();
			var id_mezzo = $("#id_mezzo").val();
			if(tipo != "modifica"){
				if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuova_spesa").hide();	
					$("#btn_modifica_spesa").show();	
					$("#titolo_h1").html("Modifica Libretto");
					$("#div_nuovo_libretto").load("php/div_nuovo_libretto.php?id="+data+"&id_mezzo="+id_mezzo);	
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			} else { // sono in modifica
				if(data >= 0){
					var id = $("#id_tagliando_modifica").val();
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuova_spesa").hide();	
					$("#btn_modifica_spesa").show();	
					$("#titolo_h1").html("Modifica Libretto");
					$("#div_nuovo_libretto").load("php/div_nuovo_libretto.php?id="+id+"&id_mezzo="+id_mezzo);	
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			}
		}
	});//chiudo $("#formUpdate")
		
	
	//validazione campi
	$("#formNewSpesa").validate({
		rules: {
			descrizione: {
				required: true
			}
		},
		messages:{
			descrizione:{
				required: "<strong style='color:red; font-size:10px'>mezzo</strong>"
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


