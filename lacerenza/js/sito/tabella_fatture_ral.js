$(document).ready(function() {
    
	
	//se clicco il bottone cerca
	$(".btn_elimina_fattura_ral").unbind("click");
	$(".btn_elimina_fattura_ral").click(function () {
	    var id = $(this).attr("id");
	    var nome = $(this).attr("nome");
	    $("#id_da_eliminare").val(id);
	    $("#nome_da_eliminare").val(nome);

	});//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
	    var id = $("#id_da_eliminare").val();
	    var id_commessa = $("#id_commessa").val();
	    var id_ral = $("#id_ral").val();
	    var nome = $("#nome_da_eliminare").val();
	    $.ajax({
			url: "lib/operazioni_fattura_ral.lib.php",
			type: 'POST',
			data: { tipo: "elimina", id: id, nome: nome, id_commessa: id_commessa, id_ral: id_ral },
				success: function(data, textStatus, xhr) {
				    if (data > 0) {
						$('#dialog_elimina').modal('hide');
						$("#tabella_fatture_ral").load("php/tabella_fatture_ral.php?id_ral=" + id_ral + "&id_commessa=" + id_commessa);
						$("#testo_cerca_ral").val("");
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