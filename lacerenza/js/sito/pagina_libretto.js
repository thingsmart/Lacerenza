//JS relativo a pagina commesse.php

$(document).ready(function() {
	//inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });
    
    $("#data_inizio").change(function(){
    	var data_inizio = $("#data_inizio").val();
    	var data_fine = $("#data_fine").val();
    	var id = $("#id_mezzo_search").val();
    	$("#tabella_libretto").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");	
    	$("#tabella_libretto").load("php/tabella_libretto.php?id=" + id + "&data_inizio="+data_inizio+"&data_fine="+data_fine);	
    });
    
    $("#data_fine").change(function(){
    	var data_inizio = $("#data_inizio").val();
    	var data_fine = $("#data_fine").val();
    	var id = $("#id_mezzo_search").val();    	
    	$("#tabella_libretto").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");	
    	$("#tabella_libretto").load("php/tabella_libretto.php?id=" + id + "&data_inizio="+data_inizio+"&data_fine="+data_fine);	
    });
		
	//se clicco il bottone cerca
    $("#cerca_spesa").click(function () {
		var id_mezzo = $("#id_mezzo").val();
		var filtro_spesa = $("#testo_cerca_spesa").val();
		var data_inizio = $("#data_inizio").val();
    	var data_fine = $("#data_fine").val();
		filtro_spesa = filtro_spesa.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_libretto").load("php/tabella_libretto.php?id=" + id_mezzo + "&filtro_spesa=" + filtro_spesa + "&data_inizio="+data_inizio+"&data_fine="+data_fine);
	});//chiudo $("#cerca_utente")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_spesa").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_spesa").click();
			//}
		});//chiudo $("#testo_cerca_utente")
	
}); // chiudo $(document).ready