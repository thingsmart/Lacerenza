//JS relativo a pagina commesse.php

$(document).ready(function() {

		$('.data_picker').datepicker({
			language: 'it',
			autoclose: true
		});
	//se clicco il bottone cerca
	$("#cerca_ral").click(function(){
	    var id_commessa = $("#id_commessa").val();
	    var filtro_ral = $("#testo_cerca_ral").val();
		var da_data = $("#da_data").val();
		var a_data = $("#a_data").val();
		var tipologia =  $("#tipologia_cerca").val();

		filtro_ral = filtro_ral.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		tipologia = tipologia.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET

		if(da_data == "" && a_data == "") {

			$("#tabella_contabilita").load("php/tabella_contabilita.php?id=" + id_commessa+"&filtro_ral=" + filtro_ral+"&tipologia="+tipologia);
		} else {
			if(da_data == "" || a_data == ""){
				alert("seleziona entrambe le data");
				return;
			}
			$("#tabella_contabilita").load("php/tabella_contabilita.php?id=" + id_commessa+"&filtro_ral=" + filtro_ral + "&da_data="+da_data+"&a_data="+a_data+"&tipologia="+tipologia);
		}
	});//chiudo $("#cerca_utente")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_ral").keypress(function (e)
		{
			//if(e.keyCode == 13) {
	    $("#cerca_ral").click();
			//}
		});//chiudo $("#testo_cerca_utente")
	
}); // chiudo $(document).ready