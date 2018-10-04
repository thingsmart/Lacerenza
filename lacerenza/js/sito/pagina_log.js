//JS relativo a pagina commesse.php

$(document).ready(function() {
	
    //inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });

    $("#data").change(function () {
        $("#testo_cerca_log").val("");
        $("#tabella_log").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");
        $("#tabella_log").load("php/tabella_log.php?data=" + $("#data").val());
    });

	//se clicco il bottone cerca
	$("#cerca_log").click(function(){
		var filtro_log = $("#testo_cerca_log").val();
		filtro_log = filtro_log.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_log").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");
		$("#tabella_log").load("php/tabella_log.php?filtro_log=" + filtro_log + "&data=" + $("#data").val());
	});//chiudo $("#cerca_utente")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_log").keypress(function(e)
		{
			if(e.keyCode == 13) {
				$("#cerca_log").click();
			}
		});//chiudo $("#testo_cerca_utente")
	
}); // chiudo $(document).ready