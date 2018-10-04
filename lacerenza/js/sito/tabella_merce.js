$(document).ready(function() {
	
	
	
	//se clicco il bottone modifica
	$(".btn_modifica").unbind("click");
	$(".btn_modifica").click(function(){
		var id = $(this).attr("id");
		var quantita = $(this).attr("quantita");
		var descrizione = $(this).attr("materiale");
		var id_testata_da_modificare = $(this).attr("id_testata_magazzino");
		$("#id_da_modificare").val(id);
		$("#quantita_da_modificare").val(quantita);
		$("#descrizione_da_modificare").val(descrizione);
		$("#id_testata_da_modificare").val(id_testata_da_modificare);
					
	});//chiudo 
	
	$("#btn_modifica_conferma").unbind("click");
	$("#btn_modifica_conferma").click(function(){
		var id = $("#id_da_modificare").val();
    	var quantita = $("#quantita_da_modificare").val();
    	var materiale = $("#descrizione_da_modificare").val();
		var id_testata_magazzino = $("#id_testata_da_modificare").val();
		var data_select = $("#data").val();
		if(quantita == "" || materiale == ""){
			alert("Inserire la quantita' e la descrizione'");
			return false;
		}
		$.ajax({
			url: "lib/operazioni_merce.lib.php",
			type: 'POST',
			data: {tipo: "modifica", id:id, id_testata_magazzino:id_testata_magazzino, materiale:materiale, quantita:quantita},
				success: function(data, textStatus, xhr) {
					if(data >= 0){
						$('#dialog_modifica').modal('hide');
						$("#tabella_merce").load("php/tabella_merce.php?data="+data_select + "&id_magazzino=" + id_testata_magazzino);
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
	
    
	//se clicco il bottone elimina
	$(".btn_elimina").unbind("click");
	$(".btn_elimina").click(function(){
		var id = $(this).attr("id");
		$("#id_da_eliminare").val(id);
					
	});//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
    	var data_select = $("#data").val();
    	var id_magazzino_testata = $("#id_magazzino_testata").val();

		$.ajax({
			url: "lib/operazioni_merce.lib.php",
			type: 'POST',
			data: {tipo: "elimina", id:id},
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_merce").load("php/tabella_merce.php?data="+data_select + "&id_magazzino=" + id_magazzino_testata);
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