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
    	$("#tabella_mezzi").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");	
    	$("#tabella_mezzi").load("php/tabella_mezzi.php?data_inizio="+data_inizio+"&data_fine="+data_fine);	
    });
    
    $("#data_fine").change(function(){
    	var data_inizio = $("#data_inizio").val();
    	var data_fine = $("#data_fine").val();
    	$("#tabella_mezzi").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");	
    	$("#tabella_mezzi").load("php/tabella_mezzi.php?data_inizio="+data_inizio+"&data_fine="+data_fine);	
    });
    
	//se clicco il bottone cerca
	$("#cerca_mezzo").click(function(){
		$("#tabella_mezzi").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");
		var data_inizio = $("#data_inizio").val();
    	var data_fine = $("#data_fine").val();
		var filtro_mezzo = $("#testo_cerca_mezzo").val();
		filtro_mezzo = filtro_mezzo.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_mezzi").load("php/tabella_mezzi.php?filtro_mezzo="+filtro_mezzo+"&data_inizio="+data_inizio+"&data_fine="+data_fine);
	});//chiudo $("#cerca_utente")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_mezzo").keypress(function(e)
		{
			if(e.keyCode == 13) {
				$("#cerca_mezzo").click();
			}
		});//chiudo $("#testo_cerca_utente")
	
}); // chiudo $(document).ready