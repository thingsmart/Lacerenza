$(document).ready(function() {
	

       
    
	
	//se clicco il bottone cerca
    $(".btn_elimina_ordine").unbind("click");
    $(".btn_elimina_ordine").click(function () {
        var id_ordine = $(this).attr("id");
        $("#id_da_eliminare").val(id_ordine);
    });//chiudo 
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_commessa = $("#id_commessa").val();
		
		$.ajax({
			url: "lib/operazioni_ordine_commessa.lib.php",
			type: 'POST',
			data: { tipo: "elimina", id: id, id_commessa: id_commessa },
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_ordini_commessa").load("php/tabella_ordini_commessa.php?id=" + id_commessa);
						$("#testo_cerca").val("");
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