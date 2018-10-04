//JS relativo a pagina commesse.php

$(document).ready(function() {



	$(".btn_modifica").click(function(){
		var percorso = $(this).attr("percorso");
		var nome = $(this).attr("nome");
		var id_commessa = $(this).attr("id_commessa");
		$("#nuovo_nome_modifica").val(nome);
		$("#percorso_modifica").val(percorso);
		$("#nome_modifica").val(nome);
		$("#id_commessa_modifica").val(id_commessa);
		//$.ajax({
		//	url: "lib/operazioni_foto.lib.php",
		//	type: 'POST',
		//	data: { tipo: "rinomina_cartella", percorso: percorso, nome:nome },
		//	success: function (data, textStatus, xhr) {
		//		$('#dialog_elimina').modal('hide');
		//		$("#elenco_cartelle_foto").load("php/elenco_cartelle_foto.php?id="+id_commessa);
        //
		//	},
		//	error: function(xhr, textStatus, errorThrown) {
		//		alert("Errore generico riprovare !");
		//	}
		//});//chiudo $.ajax
	});

	$("#btn_modifica_conferma").click(function () {
		var percorso = $("#percorso_modifica").val();
		var nome = $("#nome_modifica").val();
		var nome_nuovo = $("#nuovo_nome_modifica").val();
		var id_commessa = $("#id_commessa_modifica").val();

		$.ajax({
			url: "lib/operazioni_foto.lib.php",
			type: 'POST',
			data: { tipo: "rinomina_cartella", percorso: percorso, nome:nome, nome_nuovo:nome_nuovo },
			success: function (data, textStatus, xhr) {
				$('#dialog_modifica').modal('hide');
				$("#elenco_cartelle_foto").load("php/elenco_cartelle_foto.php?id="+id_commessa);

			},
			error: function(xhr, textStatus, errorThrown) {
				alert("Errore generico riprovare !");
			}
		});//chiudo $.ajax
	});


	$(".elimina_cartella").unbind("click");
	$(".elimina_cartella").click(function(){
		var cartella = $(this).attr("cartella");
	    var id_commessa = $("#id_commessa").val();

		$("#id_da_eliminare").val(id_commessa);
		$("#nome_da_eliminare").val(cartella);
		
	});
	
	
	//se clicco il bottone cerca
    $("#btn_elimina_conferma").click(function () {

	    var cartella = $("#nome_da_eliminare").val();;
	    var id_commessa = $("#id_da_eliminare").val();

		$.ajax({
			url: "lib/operazioni_foto.lib.php",
			type: 'POST',
			data: { tipo: "elimina_tutte_foto", id_commessa: id_commessa, cartella:cartella },
			success: function (data, textStatus, xhr) {
				$('#dialog_elimina').modal('hide');
					// window.location = "cartelle_foto.php?id="+id_commessa;
					$("#elenco_cartelle_foto").load("php/elenco_cartelle_foto.php?id="+id_commessa);	
					
				},
				error: function(xhr, textStatus, errorThrown) {
					alert("Errore generico riprovare !");
				}
		});//chiudo $.ajax
		
	});//chiudo $("#cerca_fattura")
	
	
	
	
}); // chiudo $(document).ready