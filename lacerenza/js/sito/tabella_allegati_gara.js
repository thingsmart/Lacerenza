//JS relativo a pagina tabella_home.php

$(document).ready(function() {
	$(".elimina_allegato").unbind("click");
	$(".elimina_allegato").click(function(){
		var id_allegato = $(this).attr("id_allegato");
		var id_gara = $(this).attr("id_gara");
		var nome = $(this).attr("nome");
		$("#id_allegato_da_eliminare").val(id_allegato);
		$("#id_gara_da_eliminare").val(id_gara);
		$("#nome_da_eliminare").val(nome);
		
	});
	
	//Elimino il file allegato
	$("#btn_elimina_conferma").click(function(){
		var id_allegato = $("#id_allegato_da_eliminare").val();
		var id_gara = $("#id_gara_da_eliminare").val();
		var nome = $("#nome_da_eliminare").val();
		 $.ajax({
         	url: "lib/operazioni_allegati_gara.lib.php",
            type: 'POST',
            data: {tipo_allegato:"elimina_allegato", id_gara: id_gara, nome:nome, id:id_allegato},
            	success: function(data, textStatus, xhr) {
	 				$("#tabella_allegati_gara").load("php/tabella_allegati_gara.php?id="+id_gara);
					$('#dialog_elimina').modal('hide');
                },
                error: function(xhr, textStatus, errorThrown) {
 					alert("Errore generico riprovare!");
                }
            });//chiudo $.ajax
	});	//Chiudo $(".elimina_allegato")

});//chiudo $(document).ready

