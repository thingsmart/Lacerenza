$(document).ready(function() {
	

       
    
	
	//se clicco il bottone cerca
    $(".btn_elimina_utilizzo").unbind("click");
    $(".btn_elimina_utilizzo").click(function () {
        var id_utilizzo = $(this).attr("id");
        var nome = $(this).attr("nome");
        $("#id_da_eliminare").val(id_utilizzo);
        $("#nome_da_eliminare").val(nome);
    });//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_commessa = $("#id_commessa").val();
		var id_mezzo = $("#id_mezzo").val();
		var nome = $("#nome_da_eliminare").val();
		
		$.ajax({
			url: "lib/operazioni_utilizzo.lib.php",
			type: 'POST',
			data: { tipo: "elimina", id: id, id_commessa: id_commessa, nome: nome },
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_utilizzo").load("php/tabella_utilizzo.php?id_commessa=" + id_commessa + "&id_mezzo=" + id_mezzo);
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