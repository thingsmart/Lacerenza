$(document).ready(function() {


	//se clicco il bottone cerca
    $(".btn_modifica_costo").unbind("click");
    $(".btn_modifica_costo").click(function () {
        var id_costo = $(this).attr("id");
        var costo = $(this).attr("costo");
        
        $("#id_da_modificare").val(id_costo);
        $("#costo_modifica").val(costo);
        
    });//chiudo 
    
    
    $("#btn_modifica_conferma").unbind("click");
	$("#btn_modifica_conferma").click(function(){
		var id = $("#id_da_modificare").val();
		var costo = $("#costo_modifica").val();
		var id_dipendente = $("#id_dipendente").val();
		var id_commessa = $("#id_commessa").val();

		if(costo == ""){
        	alert("inserire un costo valido");
        	return false;
        }
		$.ajax({
			url: "lib/operazioni_costo.lib.php",
			type: 'POST',
			data: { tipo: "modifica", id: id, costo:costo},
				success: function(data, textStatus, xhr) {
					if(data >= 0){
						$('#dialog_modifica').modal('hide');
						$("#tabella_costi").load("php/tabella_costi.php?id_dipendente=" + id_dipendente+"&id_commessa="+id_commessa);
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
    
	//se clicco il bottone cerca
    $(".btn_elimina_costo").unbind("click");
    $(".btn_elimina_costo").click(function () {
        var id_costo = $(this).attr("id");
        $("#id_da_eliminare").val(id_costo);
        
    });//chiudo 
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_dipendente = $("#id_dipendente").val();
		var id_commessa = $("#id_commessa").val();

		$.ajax({
			url: "lib/operazioni_costo.lib.php",
			type: 'POST',
			data: { tipo: "elimina", id: id},
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_costi").load("php/tabella_costi.php?id_dipendente=" + id_dipendente+"&id_commessa="+id_commessa);
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