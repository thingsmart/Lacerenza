$(document).ready(function() {
	

       
    
	
	//se clicco il bottone cerca
    $(".btn_elimina_allegato").unbind("click");
    $(".btn_elimina_allegato").click(function () {
        var id_allegato = $(this).attr("id");
        var nome = $(this).attr("nome");
        $("#id_da_eliminare").val(id_allegato);
        $("#nome_da_eliminare").val(nome);
    });//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_commessa = $("#id_commessa").val();
		var id_attivita = $("#id_attivita").val();
		var nome = $("#nome_da_eliminare").val();

		$.ajax({
			url: "lib/operazioni_attivita.lib.php",
			type: 'POST',
			data: { tipo: "elimina_allegato", id: id, id_commessa: id_commessa, nome: nome, id_attivita: id_attivita },
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_allegati_attivita").load("php/tabella_allegati_attivita.php?id_comessa=" + id_commessa + "&id_attivita=" + id_attivita);
						$("#testo_cerca_allegato").val("");
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