$(document).ready(function() {
	

       
    
	
	//se clicco il bottone cerca
	$(".btn_elimina_mezzo").unbind("click");
	$(".btn_elimina_mezzo").click(function(){
		var id_mezzo = $(this).attr("id");
		var nome = $(this).attr("nome");
		$("#id_da_eliminare").val(id_mezzo);
		$("#nome_da_eliminare").val(nome);
					
	});//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_mezzo = $("#id_mezzo").val();
		var nome = $("#nome_da_eliminare").val();

		$.ajax({
			url: "lib/operazioni_tagliando.lib.php",
			type: 'POST',
			data: {tipo: "elimina", id:id, id_mezzo:id_mezzo, nome:nome},
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_tagliandi").load("php/tabella_tagliandi.php?id="+id_mezzo);
						$("#testo_cerca_tagliando").val("");
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