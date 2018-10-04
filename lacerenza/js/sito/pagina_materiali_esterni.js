//JS relativo a pagina commesse.php

$(document).ready(function() {
	$('.data_picker').datepicker({
		language: 'it',
		autoclose: true
	});
		
	//se clicco il bottone cerca
	$("#cerca_fattura").click(function(){
	    var id_commessa = $("#id_commessa").val();
		var filtro_fattura = $("#testo_cerca_fattura").val();
		var da_data = $("#da_data").val();
		var a_data = $("#a_data").val();
		filtro_fattura = filtro_fattura.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		if(da_data == "" && a_data == "") {

			$("#tabella_materiali_esterni").load("php/tabella_materiali_esterni.php?id=" + id_commessa + "&filtro_fattura=" + filtro_fattura);
		} else {
			if(da_data == "" || a_data == ""){
				alert("seleziona entrambe le data");
				return;
			}
			$("#tabella_materiali_esterni").load("php/tabella_materiali_esterni.php?id=" + id_commessa + "&filtro_fattura=" + filtro_fattura + "&da_data="+da_data+"&a_data="+a_data);
		}
	});//chiudo $("#cerca_fattura")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_fattura").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_fattura").click();
			//}
	});//chiudo $("#testo_cerca_fattura")
	
}); // chiudo $(document).ready