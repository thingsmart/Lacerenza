//JS relativo a pagina utenti.php

$(document).ready(function() {
	//inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });
	
	$("#data_giorno").change(function(){
		$("#tabella_ruolino").html("<div style='text-align:center'><img src='img/load.gif' /></div>");
		var data = $("#data_giorno").val();
		$("#a_data_giorno").val(data);
		var a_data = $("#a_data_giorno").val();
		var id_commessa = $("#cerca_commessa").val();
		$("#tabella_ruolino").load("php/tabella_ruolino.php?data="+data+"&id_commessa="+id_commessa+"&a_data="+a_data);
	});
	
	$("#cerca_commessa").change(function(){
		$("#tabella_ruolino").html("<div style='text-align:center'><img src='img/load.gif' /></div>");
		var id_commessa = $("#cerca_commessa").val();
		var filtro_ruolino = $("#testo_cerca_ruolino").val();
		var data = $("#data_giorno").val();
		filtro_ruolino = filtro_ruolino.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_ruolino").load("php/tabella_ruolino.php?data="+data+"&filtro_ruolino="+filtro_ruolino+"&id_commessa="+id_commessa);
	});
	
	//se clicco il bottone cerca
	$("#cerca_ruolino").click(function(){
		$("#tabella_ruolino").html("<div style='text-align:center'><img src='img/load.gif' /></div>");
		var filtro_ruolino = $("#testo_cerca_ruolino").val();
		var id_commessa = $("#cerca_commessa").val();
		var data = $("#data_giorno").val();
		var a_data = $("#a_data_giorno").val();
		filtro_ruolino = filtro_ruolino.replace(/ /ig, '%20'); //sostituisco gli spazi coj %20 per passarlo al GET
		$("#tabella_ruolino").load("php/tabella_ruolino.php?data="+data+"&filtro_ruolino="+filtro_ruolino+"&id_commessa="+id_commessa+"&a_data="+a_data);
	});//chiudo $("#cerca_ruolino")
	
	
	//se premo invio oppure live change
	$("#testo_cerca_ruolino").keypress(function(e)
		{
			if(e.keyCode == 13) {
				$("#cerca_ruolino").click();
			}
		});//chiudo $("#testo_cerca_ruolino")
		

	
	
}); // chiudo $(document).ready

