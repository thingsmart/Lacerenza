//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//inizializzo datepicker
	 $('.data_picker').datepicker({
	   language: 'it',
	   autoclose: true
	});
	

	 $("#quantita").change(function () {
	     var costo = $("#costo").val();
	     var quantita = $("#quantita").val();
	     costo = costo.replace(",", ".");
	     quantita = quantita.replace(",", ".")

	     var tot = parseFloat(costo) * parseFloat(quantita);
	     $("#importo").val(roundTo(tot, 2));
	 });

		//se clicco il bottone cerca
	$("#btn_elimina_materiale").unbind("click");
	$("#btn_elimina_materiale").click(function () {
		var nome = $(this).attr("nome");
		var id_materiale = $(this).attr("id_materiale");
		var id_commessa = $(this).attr("id_commessa");
		
		$("#id_da_eliminare").val(id_materiale);
		$("#id_commessa_da_eliminare").val(id_commessa);
		$("#nome_da_eliminare").val(nome);

	});//chiudo $("#btn_elimina_commessa")
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_commessa = $("#id_commessa_da_eliminare").val();
		var nome = $("#nome_da_eliminare").val();

		$.ajax({
			url: "lib/operazioni_materiale.lib.php",
			type: 'POST',
			data: { tipo: "elimina_allegato", id: id, nome: nome, id_commessa: id_commessa },
			success: function (data, textStatus, xhr) {
					if(data >= 0){
						$('#dialog_elimina').modal('hide');
						$("#div_nuovo_materiale").load("php/div_nuovo_materiale.php?id=" + id + "&id_commessa=" + id_commessa);
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
	
	$("#formNewMateriale").ajaxForm({
		success: function(data){
		    var tipo = $("#tipo").val();
		    var id_commessa = $("#id_commessa").val();
			if(tipo != "modifica"){
			    if (data >= 0) {
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo_materiale").hide();
					$("#btn_modifica_materiale").show();
					$("#titolo_h1").html("Modifica Materiale");
					$("#div_nuovo_materiale").load("php/div_nuovo_materiale.php?id=" + data + "&id_commessa=" + id_commessa);
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			} else { // sono in modifica
				if(data >= 0){
				    var id = $("#id_materiale_modifica").val();
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo_materiale").hide();
					$("#btn_modifica_materiale").show();	
					$("#titolo_h1").html("Modifica Materiale");
					$("#div_nuovo_materiale").load("php/div_nuovo_materiale.php?id=" + id + "&id_commessa=" + id_commessa);
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			}
		}
	});//chiudo $("#formUpdate")
		
	
	//validazione campi
	$("#formNewMateriale").validate({
		rules: {
		    tipo_materiale: {
				required: true
		    },
		    fornitore: {
		        required: true
		    },
		    quantita: {
		        required: true
		    },
		    costo: {
		        required: true
		    },
		    importo: {
		        required: true
		    }

		},
		messages:{  
		    tipo_materiale: {
		        required: "<strong style='color:red; font-size:10px'>tipo_materiale</strong>"
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



function roundTo(value, decimalpositions) {
    var i = value * Math.pow(10, decimalpositions);
    i = Math.round(i);
    return i / Math.pow(10, decimalpositions);
}