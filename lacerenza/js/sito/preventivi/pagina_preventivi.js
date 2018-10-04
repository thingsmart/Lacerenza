//JS relativo a pagina commesse.php

$(document).ready(function() {

	$('.data_picker').datepicker({
		language: 'it',
		autoclose: true
	});

	
	// Se clicco il bottone cerca
    $("#cerca").click(function () {
    	
		var da_data = $("#data").val();
		var a_data = $("#a_data").val();

    	//var testo_cerca = $("#testo_cerca").val();
    	//$("#tabella_preventivi_master").load("php/tabella_preventivi_master.php?q=" + testo_cerca);
    	$("#tabella_preventivi_master").html('<div style="margin:auto; text-align:center"><img src="img/load.gif"/></div>');
    	$("#tabella_preventivi_master").load("php/tabella_preventivi_master.php?data="+da_data+"&a_data="+a_data);
		
	});

	//se premo invio oppure live change
    $("#testo_cerca").keypress(function (e)
		{
			if(e.keyCode == 13) {
	    	$("#cerca").click();
			}
	});//chiudo 
	
}); // chiudo $(document).ready