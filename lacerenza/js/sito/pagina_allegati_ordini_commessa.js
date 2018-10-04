//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//inizializzo datepicker
	 $('.data_picker').datepicker({
	   language: 'it',
	   autoclose: true
	});
	
	//se clicco il bottone cerca
	$("#cerca").click(function(){
	    var id_commessa = $("#id_commessa").val();
	    var id_ordine = $("#id_ordine").val();
		var filtro = $("#testo_cerca").val();
		filtro = filtro.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_allegati_ordini_commessa").load("php/tabella_allegati_ordini_commessa.php?id_ordine="+id_ordine+"&id_commessa="+id_commessa+"&filtro=" + filtro);
	});//chiudo 
	
	
	//se premo invio oppure live change
	$("#testo_cerca").keypress(function(e)
		{
			if(e.keyCode == 13) {
				$("#cerca").click();
			}
	});//chiudo $("#testo_cerca")
		
	
	$("#btn_allega").click(function(){
		var id_gara = $("#id_da_modificare").val();
		var descrizione_file = $("#descrizione_file").val();
		var files = $("#files").val();

		if(descrizione_file == ""){
			alert("Inserire una descrizione per il file da allegare");
			return false;
		}
		if(files == ""){
			alert("Seleziona il file da allegare");
			return false;
		}
		
		$("#formAllega").submit();
		
	});
	
	$("#formAllega").ajaxForm({
		success: function(data){
			var id_ordine = $("#id_ordine").val();
			var id_commessa = $("#id_commessa").val();
		    var tipo = $("#tipo").val();
			if(tipo != "modifica"){
			    if (data >= 0) {
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />File allegato con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#descrizione_file").val("");
					$("#files").val("");
					$("#tabella_allegati_ordini_commessa").load("php/tabella_allegati_ordini_commessa.php?id_ordine=" + id_ordine + "&id_commessa=" + id_commessa);
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			}
		}
	});//chiudo
	
	
		
	
	
	
	
}); // chiudo $(document).ready


