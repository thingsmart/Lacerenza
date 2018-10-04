$(document).ready(function() {
	//inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });
    
    //se clicco 
	$("#btn_nuovo_magazzino").unbind("click");
	$("#btn_nuovo_magazzino").click(function(){
		var data = $("#data").val();
		var a_data = $("#a_data").val();
		window.location = "nuovo_magazzino.php?nome=nuovo&data="+data+"&a_data="+a_data;
					
	});//chiudo 
	
    $("#data").change(function(){
    	var data = $("#data").val();
		$("#a_data").val(data);
		var a_data = $("#a_data").val();
    	$("#tabella_magazzino").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");	
    	$("#tabella_magazzino").load("php/tabella_magazzino.php?data="+data+"&a_data="+a_data);
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
			url: "lib/operazioni_magazzino.lib.php",
			type: 'POST',
			data: {tipo: "elimina", id:id},
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_magazzino").load("php/tabella_magazzino.php?data="+data_select);
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