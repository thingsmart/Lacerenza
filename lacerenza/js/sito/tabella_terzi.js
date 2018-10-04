$(document).ready(function() {
	

       
    
	
	//se clicco il bottone cerca
    $(".btn_elimina_terzi").unbind("click");
    $(".btn_elimina_terzi").click(function () {
        var id_veicolo = $(this).attr("id");
        var nome = $(this).attr("nome");
        $("#id_da_eliminare").val(id_veicolo);
        $("#nome_da_eliminare").val(nome);
    });//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_commessa = $("#id_commessa").val();
		var data_giorno = $("#data").val();

		$.ajax({
			url: "lib/operazioni_ruolino_giornaliero.lib.php",
			type: 'POST',
			data: { tipo: "elimina_terzi", id: id, id_commessa: id_commessa },
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						// $("#tabella_veicoli").load("php/tabella_veicoli.php?id_commessa=" + id_commessa);
						$("#tabella_terzi_ruolino").load("php/tabella_terzi_ruolino.php?data="+data_giorno + "&id_commessa="+id_commessa);	

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