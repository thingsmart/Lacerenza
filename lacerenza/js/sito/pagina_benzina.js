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
    	$("#tabella_benzina").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");	
    	$("#tabella_benzina").load("php/tabella_benzina.php?id=" + id + "&data_inizio="+data_inizio+"&data_fine="+data_fine);	
    });
    
    $("#data_fine").change(function(){
    	var data_inizio = $("#data_inizio").val();
    	var data_fine = $("#data_fine").val();
    	var id = $("#id_mezzo_search").val();    	
    	$("#tabella_benzina").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");	
    	$("#tabella_benzina").load("php/tabella_benzina.php?id=" + id + "&data_inizio="+data_inizio+"&data_fine="+data_fine);	
    });
    
		
    $("#btn_grafico_benzina").click(function () {
        var id_mezzo = $(this).attr("id_mezzo");
        $("#tabella_benzina").load("php/pagina_grafo_benzina.php?id=" + id_mezzo);
        $("#btn_grafico_benzina").hide();
        $(".input-group").hide();
        $("#btn_benzina").show();
        
    });

    $("#btn_benzina").click(function () {
        var id_mezzo = $(this).attr("id_mezzo");
        $("#tabella_benzina").load("php/tabella_benzina.php?id=" + id_mezzo);
        $("#btn_grafico_benzina").show();
        $(".input-group").show();
        $("#btn_benzina").hide();
    });

	//se clicco il bottone cerca
	$("#cerca_benzina").click(function(){
		var id_mezzo = $("#id_mezzo").val();
		var data_inizio = $("#data_inizio").val();
    	var data_fine = $("#data_fine").val();
		var filtro_benzina = $("#testo_cerca_benzina").val();
		filtro_benzina = filtro_benzina.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_benzina").load("php/tabella_benzina.php?id="+id_mezzo+"&filtro_benzina=" + filtro_benzina+ "&data_inizio="+data_inizio+"&data_fine="+data_fine);
	});//chiudo $("#cerca_utente")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_benzina").keypress(function (e)
		{
		if(e.keyCode == 13) {
	    	$("#cerca_benzina").click();
		}
		});//chiudo $("#testo_cerca_utente")
	
}); // chiudo $(document).ready