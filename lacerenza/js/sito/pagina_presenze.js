//JS relativo a pagina utenti.php

$(document).ready(function() {

    //inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });
	
	/*Gestion presenza, malattia o ferie*/
	$("#tipo_presenza").change(function(){
		var valore = $("#tipo_presenza").val();
		
		if(valore == "Malattia"){
			$("#n_ore").val("0");
			$("#costo").val("0");
			$("#costo").attr("disabled", false);
			$("#dettagli").val("Malattia");
		} else if(valore == "Ferie"){
			$("#n_ore").val("0");
			$("#costo").val("0");
			$("#costo").attr("disabled", false);
			$("#dettagli").val("Ferie");
		} else {
			$("#n_ore").val("");
			$("#dettagli").val("");
			$("#costo").attr("disabled", "disabled");
			$("#costo").val($("#costo_orario_lavoratore").val());
		}
	});
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuova_presenza").click(function(){
		$("#btn_nuova_presenza").html("Inserimento...");
		$("#btn_nuova_presenza").attr("disabled", "disabled");
		if($("#formNewPresenza").valid() == false){
			return; 
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
			$("#btn_nuova_presenza").html("Inserisci presenza");
			$("#btn_nuova_presenza").attr("disabled", false);
			return; 
		}
		
		var costo = $("#costo").val();
		if (IsNumber(costo) == false) {
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per il Costo");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
			$("#btn_nuova_presenza").html("Inserisci presenza");
			$("#btn_nuova_presenza").attr("disabled", false);
			return; 
		}
		
		$("#formNewPresenza").submit();
	});//chiudo $("#btn_nuova_fattura")
	
	
	
		
	$("#formNewPresenza").ajaxForm({
	    success: function (data) {
	        var tipo = $("#tipo").val();
	        var data_reload = $("#data_reload").val();
	        var id_dipendente = $("#id_dipendente").val();
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
	                $("#dettagli_commessa").val("");
	                $("#tipo_presenza").html("");
	                var code_select ='<option>Presenza</option>' +
                            		'<option>Malattia</option>' +
                            		'<option>Ferie</option>';
	                $("#tipo_presenza").html(code_select);
	                $("#tabella_presenze").load("php/tabella_presenze.php?data="+ data_reload + "&id_dipendente=" + id_dipendente);
	                $("#ul_log").load("php/ul_log.php");
	         } else if(data.indexOf("Duplicate") != -1){
	         	$("#messaggio").hide();
		        $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Non puoi inserire due volte la stessa commessa");
		        $("#messaggio_errore").show();
		        //NASCONDO MESSAGGIO
		        setTimeout(function () {
		            $('#messaggio_errore').hide(1000);
		        }, 4000);
	         } else if(data.indexOf("FOREIGN") != -1){
	         	$("#messaggio").hide();
		        $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Seleziona una commessa dall'elenco");
		        $("#messaggio_errore").show();
		        //NASCONDO MESSAGGIO
		        setTimeout(function () {
		            $('#messaggio_errore').hide(1000);
		        }, 4000);
	         } else {
	            alert("Errore: " + data);
	         }
	         $("#btn_nuova_presenza").html("Inserisci presenza");
			$("#btn_nuova_presenza").attr("disabled", false);
	          
	          window.location = "#";
	    }
	});//chiudo $("#formUpdate")


    //validazione campi
	$("#formNewPresenza").validate({
	    rules: {
	        n_ore: {
	            required: true
	        },
	        dettagli_commessa: {
	            required: true
	        },
	        costo: {
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
	        $("#btn_nuova_presenza").html("Inserisci presenza");
			$("#btn_nuova_presenza").attr("disabled", false);
	        window.location = "#";
	    }
	});

	
	
}); // chiudo $(document).ready
