$(document).ready(function() {
	

       
    
	
	//se clicco il bottone cerca
    $(".btn_elimina_presenza").unbind("click");
    $(".btn_elimina_presenza").click(function () {
        var id_presenza = $(this).attr("id");
        var nome = $(this).attr("nome");
        $("#id_da_eliminare").val(id_presenza);
        $("#nome_da_eliminare").val(nome);
    });//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_commessa = $("#id_commessa").val();
		var id_dipendente = $("#id_dipendente").val();
		var nome = $("#nome_da_eliminare").val();
		var data_reload = $("#data_reload").val();
		$.ajax({
			url: "lib/operazioni_presenze.lib.php",
			type: 'POST',
			data: { tipo: "elimina", id: id, id_commessa: id_commessa, nome: nome },
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_presenze").load("php/tabella_presenze.php?data="+data_reload+"&id_commessa=" + id_commessa + "&id_dipendente=" + id_dipendente);
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