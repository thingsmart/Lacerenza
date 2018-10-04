$(document).ready(function() {
	//inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });
    
    // $("#data").change(function(){
    	// var data = $("#data").val();
    	// $("#tabella_comunicazioni_commessa").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");	
    	// $("#tabella_comunicazioni_commessa").load("php/tabella_comunicazioni_commessa.php?data="+data);	
    // });
    
    $("#cerca").unbind("click");
    $("#cerca").click(function(){
		var data = $("#data").val();
		var a_data = $("#a_data").val();
		var id_commessa = $("#id_commessa_cerca").val();
		$("#tabella_comunicazioni_commessa").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");	
    	$("#tabella_comunicazioni_commessa").load("php/tabella_comunicazioni_commessa.php?data="+data+"&a_data="+a_data+"&id="+id_commessa);	
					
	});//chiudo
    
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
    	var a_data_select = $("#a_data").val();
		$.ajax({
			url: "lib/operazioni_comunicazioni.lib.php",
			type: 'POST',
			data: {tipo: "elimina", id:id},
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_comunicazioni_commessa").load("php/tabella_comunicazioni_commessa.php?data="+data_select+"&a_data="+a_data_select);
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