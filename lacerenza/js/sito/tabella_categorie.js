$(document).ready(function() {
	

       
    
	
	//se clicco il bottone cerca
    $(".btn_elimina_categoria").unbind("click");
    $(".btn_elimina_categoria").click(function () {
        var id_categoria = $(this).attr("id");
        $("#id_da_eliminare").val(id_categoria);
    });//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_commessa = $("#id_commessa").val();
		var id_verbale = $("#id_verbale").val();
		
		$.ajax({
			url: "lib/operazioni_categoria.lib.php",
			type: 'POST',
			data: { tipo: "elimina", id: id, id_commessa: id_commessa, id_verbale: id_verbale },
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_categorie").load("php/tabella_categorie.php?id_commessa=" + id_commessa + "&id_verbale=" + id_verbale);
						$("#testo_cerca_categoria").val("");
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