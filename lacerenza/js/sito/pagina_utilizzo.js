//JS relativo a pagina utenti.php

$(document).ready(function() {

    //inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo_utilizzo").click(function(){
		if($("#formNewUtilizzo").valid() == false){
			return 
		}

		var n_ore = $("#n_ore").val();

		if (IsNumber(n_ore) == false) {
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per il N. ore");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
			return 
		}
		
		$("#formNewUtilizzo").submit();
	});//chiudo $("#btn_nuova_fattura")
	
	
	
		
	$("#formNewUtilizzo").ajaxForm({
	    success: function (data) {
	        var tipo = $("#tipo").val();
	        var id_commessa = $("#id_commessa").val();
	        var id_mezzo = $("#id_mezzo").val();
	        if (data >= 0) {
	                $("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
	                $("#messaggio_errore").hide();
	                $("#messaggio").show();
	                //NASCONDO MESSAGGIO
	                setTimeout(function () {
	                    $('#messaggio').hide(1000);
	                }, 3000);
	                $("#n_ore").val("");
	                $("#dettagli").val("");
	                $("#tabella_utilizzo").load("php/tabella_utilizzo.php?id_commessa=" + id_commessa + "&id_mezzo=" + id_mezzo);
	                $("#ul_log").load("php/ul_log.php");
	            } else {
	                alert("Errore: " + data);
	            }
	    }
	});//chiudo $("#formUpdate")


    //validazione campi
	$("#formNewUtilizzo").validate({
	    rules: {
	        n_ore: {
	            required: true
	        }
	    },
	    messages: {
	        n_ore: {
	            required: "<strong style='color:red; font-size:10px'>n_ore</strong>"
	        }
	    },
	    errorPlacement: function (error, element) {

	        $("#messaggio").hide();
	        $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Compila tutti i campi con *");
	        $("#messaggio_errore").show();
	        //NASCONDO MESSAGGIO
	        setTimeout(function () {
	            $('#messaggio_errore').hide(1000);
	        }, 4000);
	    }
	});

	
	
}); // chiudo $(document).ready
