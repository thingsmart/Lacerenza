//JS relativo a pagina tabella_home.php

$(document).ready(function() {
	
	$(".elimina_allegato").click(function(){
		var id_allegato = $(this).attr("id_allegato");
		var id_commessa = $(this).attr("id_commessa");
		var nome = $(this).attr("nome");
		$("#id_allegato_da_eliminare").val(id_allegato);
		$("#id_commessa_da_eliminare").val(id_commessa);
		$("#nome_da_eliminare").val(nome);
		
	});
	
	//Elimino il file allegato
	$("#btn_elimina_conferma").click(function(){
		var id_allegato = $("#id_allegato_da_eliminare").val();
		var id_commessa = $("#id_commessa_da_eliminare").val();
		var nome = $("#nome_da_eliminare").val();
		 $.ajax({
         	url: "lib/elimina_allegato.lib.php",
            type: 'POST',
            data: {tipo:"cantiere", cartella:"commesse", id: id_commessa, nome:nome, id_allegato:id_allegato},
            	success: function(data, textStatus, xhr) {
	 				$("#tabella_allegati_commessa").load("php/tabella_allegati_commessa.php?id="+id_commessa);
					$('#dialog_elimina').modal('hide');
                },
                error: function(xhr, textStatus, errorThrown) {
 					alert("Errore generico riprovare!");
                }
            });//chiudo $.ajax
	});	//Chiudo $(".elimina_allegato")

});//chiudo $(document).ready

