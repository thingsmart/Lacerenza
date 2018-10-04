$(document).ready(function() {
	//inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });
    
    $("#data").change(function(){
    	var data = $("#data").val();
    	$("#tabella_programmazione_cantiere").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");	
    	$("#tabella_programmazione_cantiere").load("php/tabella_programmazione_cantiere.php?data="+data);	
    });
    
	//se clicco il bottone cerca
	$(".btn_elimina").unbind("click");
	$(".btn_elimina").click(function(){
		var id = $(this).attr("id");
		$("#id_da_eliminare").val(id);
					
	});//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
    	var data_select = $("#data").val();
		$.ajax({
			url: "lib/operazioni_programmazione_cantiere.lib.php",
			type: 'POST',
			data: {tipo: "elimina", id:id},
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_programmazione_cantiere").load("php/tabella_programmazione_cantiere.php?data="+data_select);
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