//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//inizializzo datepicker
	 $('.data_picker').datepicker({
	   language: 'it',
	   autoclose: true
	});
	
		
	
	$("#formNewVeicolo").ajaxForm({
		success: function(data){
		    var tipo = $("#tipo").val();
		    var id_commessa = $("#id_commessa").val();
		    if (tipo != "modifica") {
		        if (data >= 0) {
		            $("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
		            $("#messaggio_errore").hide();
		            $("#messaggio").show();
		            //NASCONDO MESSAGGIO
		            setTimeout(function(){
		                $('#messaggio').hide(1000);
		            }, 3000);
		            $("#btn_nuovo_veicolo").hide();	
		            $("#btn_modifica_veicolo").show();
		            $("#titolo_h1").html("Modifica Mezzo");
		            $("#div_nuovo_veicolo").load("php/div_nuovo_veicolo.php?id=" + data + "&id_commessa=" + id_commessa);
		            $("#ul_log").load("php/ul_log.php");	
		        } else if (data.indexOf("errore_veicolo") != -1) {
		            $("#messaggio").hide();
		            $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un mezzo presente in anagrafica");
		            $("#messaggio_errore").show();
		            //NASCONDO MESSAGGIO
		            setTimeout(function () {
		                $('#messaggio_errore').hide(1000);
		            }, 4000);
		        } else if (data.indexOf("Duplicate entry") != -1) {
		            $("#messaggio").hide();
		            $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Non puoi inserire lo stesso mezzo pi&ugrave; volte per la stessa commessa");
		            $("#messaggio_errore").show();
		            //NASCONDO MESSAGGIO
		            
		        
		        } else {
					alert("Errore: "+data);	
				}
			} else { // sono in modifica
				if(data >= 0){
				    var id = $("#id_veicolo_modifica").val();
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo_veicolo").hide();	
					$("#btn_modifica_veicolo").show();	
					$("#titolo_h1").html("Modifica Mezzo");
					$("#div_nuovo_veicolo").load("php/div_nuovo_veicolo.php?id=" + id + "&id_commessa=" + id_commessa);
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			}
		}
	});//chiudo $("#formUpdate")
		
	
	//validazione campi
	$("#formNewVeicolo").validate({
		rules: {
		    costo_h: {
				required: true
		    },
		    veicolo_dati: {
		        required: true
		    }
		},
		messages:{  
		    veicolo_dati: {
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


