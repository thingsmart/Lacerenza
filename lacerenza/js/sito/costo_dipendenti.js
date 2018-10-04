$(document).ready(function() {

	$("#id_commessa2").change(function(){
		var id_commessa = $("#id_commessa2").val();
		var id_dipendente = $("#id_dipendente").val();
		$("#id_commessa").val(id_commessa);
		$("#tabella_costi").load("php/tabella_costi.php?id_dipendente="+id_dipendente+"&id_commessa="+id_commessa);
	});
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuovo_costo").click(function(){
		$("#btn_nuovo_costo").html("Inserimento...");
			$("#btn_nuovo_costo").attr("disabled", "disabled");
		
		if($("#formNewCosto").valid() == false){
			return; 
		}
		
		var costo = $("#costo").val();
		var id_commessa = $("#id_commessa2").val();

		$("#id_commessa").val(id_commessa);

		//if(id_commessa == ""){
		//	$("#messaggio").hide();
		//	$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Seleziona una commessa");
		//	$("#messaggio_errore").show();
		//	//NASCONDO MESSAGGIO
		//	setTimeout(function(){
		//		$('#messaggio_errore').hide(1000);
		//	}, 4000);
		//	$("#btn_nuovo_costo").html("Inserisci costo");
		//	$("#btn_nuovo_costo").attr("disabled", false);
		//	return;
		//}
		if (IsNumber(costo) == false) {
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per il costo");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
			$("#btn_nuovo_costo").html("Inserisci costo");
			$("#btn_nuovo_costo").attr("disabled", false);
			return; 
		}

		$("#formNewCosto").submit();
	});//chiudo $("#btn_nuova_fattura")
	
	
	
		
	$("#formNewCosto").ajaxForm({
	    success: function (data) {
	        var id_dipendente = $("#id_dipendente").val();
	        if (data >= 0) {
	                $("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
	                $("#messaggio_errore").hide();
	                $("#messaggio").show();
	                //NASCONDO MESSAGGIO
	                setTimeout(function () {
	                    $('#messaggio').hide(1000);
	                }, 3000);
				var id_commessa = $("#id_commessa2").val();
	                $("#tabella_costi").load("php/tabella_costi.php?id_dipendente=" + id_dipendente+"&id_commessa="+id_commessa);
	                $("#ul_log").load("php/ul_log.php");
	         } else if(data.indexOf("Duplicate") != -1){
	         	$("#messaggio").hide();
		        $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Non puoi inserire due volte il costo per lo stesso mese e anno");
		        $("#messaggio_errore").show();
		        //NASCONDO MESSAGGIO
		        setTimeout(function () {
		            $('#messaggio_errore').hide(1000);
		        }, 4000);
	         } else {
	            alert("Errore: " + data);
	         }
	         $("#btn_nuovo_costo").html("Inserisci costo");
			$("#btn_nuovo_costo").attr("disabled", false);
	          $("#costo").val("");
	          window.location = "#";
	    }
	});//chiudo $("#formUpdate")


    //validazione campi
	$("#formNewCosto").validate({
	    rules: {
	        costo: {
	            required: true
	        }
	    },
	    messages: {
	        costo: {
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
	        $("#btn_nuovo_costo").html("Inserisci costo");
			$("#btn_nuovo_costo").attr("disabled", false);
	        window.location = "#";
	    }
	});

	
	
}); // chiudo $(document).ready
