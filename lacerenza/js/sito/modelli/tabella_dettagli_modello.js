$(document).ready(function() {
    
    // Elimina il Box
    
    $('.btn_elimina_box').unbind("click");
    $('.btn_elimina_box').click(function () {
    	
		var id = $(this).attr("id");
		var idmodello = $(this).attr("idmodello");
		
		$("#id_da_eliminare").val(id);
		$("#id_box").val(idmodello);

	});
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		
		var id = $("#id_da_eliminare").val();
		var idbox = $("#id_box").val();
				
		$.ajax({
			url: "lib/operazioni_modello.lib.php",
			type: 'POST',
			data: { tipo: "elimina", id: id },
			success: function(data, textStatus, xhr) {
				if(data > 0){
					$('#dialog_elimina').modal('hide');
					$("#tabella_dettagli_modello").load("php/tabella_dettagli_modello.php?model="+idbox);	
					//$("#testo_cerca").val("");	
				} else {
					alert("Errore: "+data);
				}
			},
			error: function(xhr, textStatus, errorThrown) {
				alert("Errore generico riprovare!");
			}
		});//chiudo $.ajax		
		
	});
	
	// Drag & Drop del Box
	
    $( "#rigaSpostabile" ).sortable({
    	
	    update: function(event, ui) {
	    	
	        var ordineItems = $(this).sortable('serialize');
	        var iddettagliomaster = $('#iddettagliomaster').val();
	        
			$.ajax({
				url : "lib/salva_ordine_items.php",
				type : 'POST',
				data : {
					tipo : "ordini",
					listaItem : ordineItems,
					iddettaglio : iddettagliomaster,
				},
				success : function(data, textStatus, xhr) {

					console.log(data);
					
				},
				error : function(xhr, textStatus, errorThrown) {
					
				}
			});
			
	    }
	    
	});
    
});