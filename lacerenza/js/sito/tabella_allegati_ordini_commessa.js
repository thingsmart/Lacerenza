//JS relativo a pagina tabella_home.php

$(document).ready(function() {
	$(".elimina_allegato").unbind("click");
	$(".elimina_allegato").click(function(){
		var id_allegato = $(this).attr("id_allegato");
		var id_ordine = $(this).attr("id_ordine");
		var id_commessa = $(this).attr("id_commessa");
		var nome = $(this).attr("nome");
		
		$("#id_allegato_da_eliminare").val(id_allegato);
		$("#id_ordine_da_eliminare").val(id_ordine);
		$("#id_commessa_da_eliminare").val(id_commessa);
		$("#nome_da_eliminare").val(nome);
		
	});
	
	//Elimino il file allegato
	$("#btn_elimina_conferma").click(function(){
		var id_allegato = $("#id_allegato_da_eliminare").val();
		var id_ordine = $("#id_ordine_da_eliminare").val();
		var id_commessa = $("#id_commessa_da_eliminare").val();
		var nome = $("#nome_da_eliminare").val();

		 $.ajax({
         	url: "lib/operazioni_allegati_ordine_commessa.lib.php",
            type: 'POST',
            data: {tipo_allegato:"elimina_allegato", id_ordine: id_ordine, nome:nome, id:id_allegato, id_commessa:id_commessa},
            	success: function(data, textStatus, xhr) {
	 				$("#tabella_allegati_ordini_commessa").load("php/tabella_allegati_ordini_commessa.php?id_ordine="+id_ordine + "&id_commessa="+id_commessa);
					$('#dialog_elimina').modal('hide');
                },
                error: function(xhr, textStatus, errorThrown) {
 					alert("Errore generico riprovare!");
                }
            });//chiudo $.ajax
	});	//Chiudo $(".elimina_allegato")

});//chiudo $(document).ready

