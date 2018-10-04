//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//inizializzo datepicker
	 $('.data_picker').datepicker({
	   language: 'it',
	   autoclose: true
	});
	
	 $("#prezzo_pompa").change(function () {
	     var quantita_litri = $("#quantita_litri").val();
	     var importo_ticket = $("#importo_ticket").val();
	     var prezzo_pompa = $("#prezzo_pompa").val();
	     if (quantita_litri != "" && importo_ticket == "" && prezzo_pompa != "") {
	         prezzo_pompa = prezzo_pompa.replace(",", ".");
	         quantita_litri = quantita_litri.replace(",", ".");
	         var new_importo = (parseFloat(prezzo_pompa) / 100) * parseFloat(quantita_litri);
	         $("#importo_ticket").val(roundTo(new_importo,2));
	     }
	 });

	 $("#importo_netto").change(function () {
	     var importo_iva = $("#importo_iva").val();
	     var importo_netto = $("#importo_netto").val();
	     var aliq_iva = $("#aliq_iva").val();
	     if (aliq_iva != "" && importo_iva == "" && importo_netto != "") {
	         importo_netto = importo_netto.replace(",", ".");
	         aliq_iva = aliq_iva.replace(",", ".");
	         var new_importo = (parseFloat(importo_netto) / 100) * parseFloat(aliq_iva);
	         $("#importo_iva").val(roundTo(new_importo, 2));
	         $("#totale_iva_inclusa").val(roundTo(new_importo + parseFloat(importo_netto),2));
         }
	 });

	 $("#importo_iva").change(function () {
	     var importo_iva = $("#importo_iva").val();
	     var totale_iva_inclusa = $("#totale_iva_inclusa").val();
	     var importo_netto = $("#importo_netto").val();
	     if (importo_netto != "" && totale_iva_inclusa == "" && importo_iva != "") {
	         importo_iva = importo_iva.replace(",", ".");
	         importo_netto = importo_netto.replace(",", ".");
			 //var new_importo = parseFloat(importo_iva) + parseFloat(importo_netto);
			 var new_importo = parseFloat(importo_netto);
	         $("#totale_iva_inclusa").val(roundTo(new_importo, 2));
	     }
	 });
	
	
	$("#formNewBenzina").ajaxForm({
		success: function(data){
			var tipo = $("#tipo").val();
			var id_mezzo = $("#id_mezzo").val();
			var targa = $("#targa_da_modifica").val();
			if(tipo != "modifica"){
				if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuova_benzina").hide();	
					$("#btn_modifica_benzina").show();	
					$("#titolo_h1").html("Modifica Ticket");
					$("#div_nuova_benzina").load("php/div_nuova_benzina.php?id=" + data + "&id_mezzo=" + id_mezzo + "&targa=" + targa);
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			} else { // sono in modifica
				if(data >= 0){
					var id = $("#id_benzina_modifica").val();
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuova_benzina").hide();	
					$("#btn_modifica_benzina").show();	
					$("#titolo_h1").html("Modifica Ticket");
					$("#div_nuova_benzina").load("php/div_nuova_benzina.php?id=" + id + "&id_mezzo=" + id_mezzo + "&targa=" + targa);
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			}
		}
	});//chiudo $("#formUpdate")
		
	
	//validazione campi
	$("#formNewBenzina").validate({
		rules: {
		    km_veicolo: {
				required: true
			},
		    totale_iva_inclusa: {
		        required: true
		    }
		},
		messages:{  
		    km_veicolo: {
		        required: "<strong style='color:red; font-size:10px'>km_veicolo</strong>"
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