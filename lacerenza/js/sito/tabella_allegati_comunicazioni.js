//JS relativo a pagina tabella_home.php

$(document).ready(function() {
	
	$(".elimina_allegato").click(function(){
		var id_allegato = $(this).attr("id_allegato");
		var id_comunicazione = $(this).attr("id_comunicazione");
		var nome = $(this).attr("nome");
		$("#id_allegato_da_eliminare").val(id_allegato);
		$("#id_commessa_da_eliminare").val(id_comunicazione);
		$("#nome_da_eliminare").val(nome);
		$('#dialog_elimina').modal('show');
		
	});
	
	//Elimino il file allegato
	$("#btn_elimina_conferma").click(function(){
		var id_allegato = $("#id_allegato_da_eliminare").val();
		var id_comunicazione = $("#id_commessa_da_eliminare").val();
		var nome = $("#nome_da_eliminare").val();
		 $.ajax({
         	url: "lib/operazioni_comunicazioni.lib.php",
            type: 'POST',
            data: {tipo:"elimina_allegato", id_comunicazione: id_comunicazione, nome:nome, id_allegato:id_allegato},
            	success: function(data, textStatus, xhr) {
	 				$("#tabella_allegati_comunicazioni").load("php/tabella_allegati_comunicazioni.php?id="+id_comunicazione);
					$('#dialog_elimina').modal('hide');
                },
                error: function(xhr, textStatus, errorThrown) {
 					alert("Errore generico riprovare!");
                }
            });//chiudo $.ajax
	});	//Chiudo $(".elimina_allegato")

});//chiudo $(document).ready

