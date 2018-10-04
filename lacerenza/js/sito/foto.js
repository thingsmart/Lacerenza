//JS relativo a pagina commesse.php

$(document).ready(function() {
	var bar = $('.bar');
	
	$("#btn_elimina_tutto").unbind("click");
	$("#btn_elimina_tutto").click(function(){
	    var id_commessa = $("#id_commessa").val();
		$("#id_da_eliminare").val(id_commessa);
		$("#btn_elimina_conferma_tutto").show();
		$("#btn_elimina_conferma").hide();
	});
	
	
	//se clicco il bottone cerca
    $("#btn_elimina_conferma_tutto").click(function () {
	    var id_commessa = $("#id_da_eliminare").val();
	    var cartella = $("#cartella").val();

		$.ajax({
			url: "lib/operazioni_foto.lib.php",
			type: 'POST',
			data: { tipo: "elimina_tutte_foto", id_commessa: id_commessa, cartella:cartella },
			success: function (data, textStatus, xhr) {
				$('#dialog_elimina').modal('hide');
					$("#imgs").val("");
					$("#elenco_foto").html("");	
					var bar = $('.bar');
					bar.width(0);
					bar.html(0);
				},
				error: function(xhr, textStatus, errorThrown) {
					alert("Errore generico riprovare!");
				}
		});//chiudo $.ajax
		
	});//chiudo $("#cerca_fattura")
	
	$("#btn_allega").click(function(){
		var imgs = $("#imgs").val();
		if(imgs == ""){
			alert("seleziona delle foto da allegare");
			return false;
		}
		$("#formAllega").submit();
	});
	
	//se inserisco foto va a buon fine
	$("#formAllega").ajaxForm({
		
		beforeSend: function () {
			bar.width(0);
			bar.html(0);
		},
		uploadProgress: function (event, position, total, percentComplete) {
			var percentVal = percentComplete + '%';
			bar.width(percentVal);
			bar.html(percentVal);
		},
		complete: function (xhr) {
			
		},
		success: function (data) {
			var id_commessa = $("#id_commessa").val();
			 var cartella = $("#cartella").val();
			$("#imgs").val("");
			// $("#elenco_foto").load("php/elenco_foto.php?id="+id_commessa);	
			window.location = "foto.php?id="+id_commessa+"&cartella="+cartella;
		}
	});//chiudo $("#formGalleria")
	
	
	
	
}); // chiudo $(document).ready