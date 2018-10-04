//JS relativo a pagina commesse.php

$(document).ready(function() {
	$(".elimina_foto").unbind("click");
	$(".elimina_foto").click(function(){
		var nome_file = $(this).attr("nome_file");
	    var id_commessa = $("#id_commessa").val();
	    cancella = $(this);
		$("#id_da_eliminare").val(id_commessa);
		$("#nome_da_eliminare").val(nome_file);
		$("#btn_elimina_conferma_tutto").hide();
		$("#btn_elimina_conferma").show();
	});
	
	
	//se clicco il bottone cerca
    $("#btn_elimina_conferma").click(function () {
	    // var nome_file = $(this).attr("nome_file");
	    // var id_commessa = $("#id_commessa").val();
	    // var cancella = $(this);
	    var nome_file = $("#nome_da_eliminare").val();;
	    var id_commessa = $("#id_da_eliminare").val();
	    var cartella = $("#cartella_cancella").val();
	    //var cancella = $("#cancella").val();

		$.ajax({
			url: "lib/operazioni_foto.lib.php",
			type: 'POST',
			data: { tipo: "elimina_foto", nome_file: nome_file, id_commessa: id_commessa, cartella:cartella },
			success: function (data, textStatus, xhr) {
				$('#dialog_elimina').modal('hide');
					cancella.parent().hide( "slow");
					var bar = $('.bar');
					bar.width(0);
					bar.html(0);
				},
				error: function(xhr, textStatus, errorThrown) {
					alert("Errore generico riprovare!");
				}
		});//chiudo $.ajax
		
	});//chiudo $("#cerca_fattura")
	
	
	
	
}); // chiudo $(document).ready