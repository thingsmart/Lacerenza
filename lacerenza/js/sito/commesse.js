//JS relativo a pagina commesse.php

$(document).ready(function() {
	//inizializzo datepicker
	$('.data_picker').datepicker({
		language: 'it',
		autoclose: true
	});

	$("#da_data").unbind("change");
	$("#da_data").change(function(){
		var da_data = $("#da_data").val();
		$.ajax({
			url: "lib/operazioni_commessa.lib.php",
			type: 'POST',
			data: {da_data:da_data, tipo:"aggiorna_data"},
			success: function(data, textStatus, xhr) {
			},
			error: function(xhr, textStatus, errorThrown) {
				alert("Errore generico riprovare!");
			}
		});//chiudo $.ajax
	});
		
	//se clicco il bottone cerca
	$("#cerca_commessa").click(function(){
		var filtro_commessa = $("#testo_cerca_commessa").val();
		//filtro_commessa = filtro_commessa.replace(/'/g, '&#39;');
		var da_data = $("#da_data").val();
		var a_data = $("#a_data").val();
		var mostra = $("#mostra").val();

		filtro_commessa = filtro_commessa.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_commesse").html('<div style="margin:auto; text-align:center"><img src="img/load.gif"/></div>');
		$("#tabella_commesse").load("php/tabella_commesse.php?filtro_commessa="+filtro_commessa+"&da_data="+da_data+"&a_data="+a_data+"&mostra="+mostra+"&archiviato=0");
	});//chiudo $("#cerca_utente")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_commessa").keypress(function(e)
		{
			if(e.keyCode == 13) {
				$("#cerca_commessa").click();
			}
		});//chiudo $("#testo_cerca_utente")
	
}); // chiudo $(document).ready