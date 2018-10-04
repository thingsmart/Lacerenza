$(document).ready(function() {
	

	
	//se clicco il bottone cerca
    $(".btn_elimina_materiale").unbind("click");
    $(".btn_elimina_materiale").click(function () {
        var id_materiale = $(this).attr("id");
        var nome = $(this).attr("nome");
        $("#id_da_eliminare").val(id_materiale);
        $("#nome_da_eliminare").val(nome);
    });//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_commessa = $("#id_commessa").val();
		var nome = $("#nome_da_eliminare").val();
		
		$.ajax({
			url: "lib/operazioni_materiale.lib.php",
			type: 'POST',
			data: { tipo: "elimina", id: id, id_commessa: id_commessa, nome: nome },
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_materiali").load("php/tabella_materiali.php?id=" + id_commessa);
						$("#testo_cerca_materiale").val("");
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