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
    	$("#tabella_tagliandi").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");	
    	$("#tabella_tagliandi").load("php/tabella_tagliandi.php?id=" + id + "&data_inizio="+data_inizio+"&data_fine="+data_fine);	
    });
    
    $("#data_fine").change(function(){
    	var data_inizio = $("#data_inizio").val();
    	var data_fine = $("#data_fine").val();
    	var id = $("#id_mezzo_search").val();    	
    	$("#tabella_tagliandi").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");	
    	$("#tabella_tagliandi").load("php/tabella_tagliandi.php?id=" + id + "&data_inizio="+data_inizio+"&data_fine="+data_fine);	
    });
		
	//se clicco il bottone cerca
	$("#cerca_tagliando").click(function(){
		var id_mezzo = $("#id_mezzo").val();
		var filtro_tagliando = $("#testo_cerca_tagliando").val();
		var data_inizio = $("#data_inizio").val();
    	var data_fine = $("#data_fine").val();
		filtro_tagliando = filtro_tagliando.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_tagliandi").load("php/tabella_tagliandi.php?id="+id_mezzo+"&filtro_tagliando="+filtro_tagliando+ "&data_inizio="+data_inizio+"&data_fine="+data_fine);
	});//chiudo $("#cerca_utente")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_tagliando").keypress(function(e)
		{
			//if(e.keyCode == 13) {
				$("#cerca_tagliando").click();
			//}
		});//chiudo $("#testo_cerca_utente")
	
}); // chiudo $(document).ready