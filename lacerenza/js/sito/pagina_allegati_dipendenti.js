//JS relativo a pagina utenti.php

$(document).ready(function() {
    //inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });

    //se clicco il bottone conferma nuovo_utente
    $("#nuovo_allegato").click(function () {
        if ($("#formNewAllegato").valid() == false) {
            return
        }

        
        $("#formNewAllegato").submit();
    });//chiudo $("#btn_nuova_fattura")
	
	$("#formNewAllegato").ajaxForm({
		success: function(data){
		    var tipo = $("#tipo").val();
		    var id_commessa = $("#id_commessa").val();
		    var id_dipendente = $("#id_dipendente").val();
		    if (data >= 0) {
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Allegato inserito.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#tabella_allegati_dipendenti").load("php/tabella_allegati_dipendenti.php?id_dipendente=" + id_dipendente + "&id_commessa=" + id_commessa);
					$("#descrizione").val("");
					$("#inviato_a").val("");
					$("#files").val("");
					$("#ul_log").load("php/ul_log.php");
				}  else {
					alert("Errore: "+data);	
				}
		}
	});//chiudo $("#formUpdate")
		
	
	//validazione campi
	$("#formNewAllegato").validate({
		rules: {
		    descrizione: {
				required: true
			},
		    files: {
				required: true
		    }
		},
		messages:{  
		    descrizione: {
		        required: "<strong style='color:red; font-size:10px'>descrizione</strong>"
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


