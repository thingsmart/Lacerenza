$(document).ready(function() {
	//inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });
    
    $("#data").change(function(){
    	var data = $("#data").val();
    	$("#data_header").html(data);
    	var id_commessa = $("#id_commessa_ruolino").val();
    	$("#tabella_ruolino_giornaliero_commessa").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");	
    	$("#tabella_ruolino_giornaliero_commessa").load("php/tabella_ruolino_giornaliero_commessa.php?data="+data+"&id="+id_commessa);	
    });
    
	//se clicco il bottone cerca
	$(".btn_elimina").unbind("click");
	$(".btn_elimina").click(function(){
		var id = $(this).attr("id");
		var id_commessa_da_eliminare = $(this).attr("id_commessa");
		$("#id_da_eliminare").val(id);
		$("#id_commessa_da_eliminare").val(id_commessa_da_eliminare);
	});//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_commessa = $("#id_commessa_da_eliminare").val();
    	var data_select = $("#data").val();
		$.ajax({
			url: "lib/operazioni_ruolino_giornaliero.lib.php",
			type: 'POST',
			data: {tipo: "elimina", id:id, data:data_select, id_commessa:id_commessa},
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_ruolino_giornaliero_commessa").load("php/tabella_ruolino_giornaliero_commessa.php?data="+data_select);
						$("#ul_log").load("php/ul_log.php");	
					} else {
						alert("Errore: "+data);
					}
				},
				error: function(xhr, textStatus, errorThrown) {
					alert("Errore generico riprovare!");
				}
		});//chiudo $.ajax		
		
	});
	
});