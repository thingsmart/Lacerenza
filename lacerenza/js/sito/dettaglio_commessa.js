//JS relativo a pagina home.php

$(document).ready(function() {
	

	 //TAB SWITCH
	 activaTab('cantiere_tab');
	 
	 $("#btn_salva_cantiere").click(function(){
		if($("#formCantiere").valid() == false){
			return; 
		}
		
		var id=$("#id_commessa").html();
		var cantiere = $("#cantiere").val();
		var localita = $("#localita").val();
		var importo = $("#importo").val();
		var tipologia_lavori = $("#tipologia_lavori").val();
		var referente = $("#referente").val();
		var telefono = $("#telefono").val();
		var fax = $("#fax").val();
		var cellulare = $("#cellulare").val();
		var data_inizio = $("#data_inizio").val();
		var data_fine = $("#data_fine").val();
		var email = $("#email").val();
		var indirizzo_referente = $("#indirizzo_referente").val();
		var pi = $("#pi").val();
		var pec = $("#pec").val();
		//controlo se l'importo è numerico
		if(IsNumber(importo) == false){
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un importo valido");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
			return; 
		}

		//modifico la commessa
		$.ajax({
    	url: "lib/salva_commessa_cantiere.lib.php",
        type: 'POST',
        data: {id:id, email:email, pi:pi, pec:pec, indirizzo_referente:indirizzo_referente, cantiere:cantiere, localita:localita, importo:importo, tipologia_lavori:tipologia_lavori, referente:referente, telefono:telefono, fax:fax, cellulare:cellulare, data_inizio:data_inizio, data_fine:data_fine},
        	success: function(data, textStatus, xhr) {
				if(data == "ERRORE_TEMPO"){
					$("#messaggio").hide();
					$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Verificare la validita' delle date.");
					$("#messaggio_errore").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
						$('#messaggio_errore').hide(1000);
					}, 4000);
				} else if(data >= 0){
					
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					$("#tabella_commessa").load("php/tabella_commessa.php?id="+id);
					$("#ul_log").load("php/ul_log.php");
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
				}  else {
					alert("Errore: "+data);	
				}
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
            }
    });//chiudo $.ajax
	 });
	 
	 $(".close").click(function(){
		$("#messaggio").hide();
	 });
	 

	
}); // chiudo $(document).ready

function activaTab(tab){
	$('.nav-tabs a[href="#' + tab + '"]').tab('show');
};