$(document).ready(function() {
	

    //se clicco il bottone cerca
    $(".btn-dettagli").unbind("click");
    $(".btn-dettagli").click(function () {
        var numero_carta = $(this).attr("numero_carta");
        var titolare_carta = $(this).attr("titolare_carta");
        var localita = $(this).attr("localita");
        var targa = $(this).attr("targa");
        var codice_autista = $(this).attr("codice_autista");
        var km_veicolo = $(this).attr("km_veicolo");
        var servizio = $(this).attr("servizio");
        var sconto = $(this).attr("sconto");
        var prezzo_escluso_iva = $(this).attr("prezzo_escluso_iva");
        var aliq_iva = $(this).attr("aliq_iva");
        var importo_iva = $(this).attr("importo_iva");
        $("#numero_carta_modal").val(numero_carta);
        $("#titolare_carta_modal").val(titolare_carta);
        $("#localita_modal").val(localita);
        $("#targa_modal").val(targa);
        $("#codice_autista_modal").val(codice_autista);
        $("#km_veicolo_modal").val(km_veicolo);
        $("#servizio_modal").val(servizio);
        $("#sconto_modal").val(sconto);
        $("#prezzo_escluso_iva_modal").val(prezzo_escluso_iva);
        $("#aliq_iva_modal").val(aliq_iva);
        $("#importo_iva_modal").val(importo_iva);

    });//chiudo $("#btn_elimina_commessa")
    
	
	//se clicco il bottone cerca
	$(".btn_elimina_benzina").unbind("click");
	$(".btn_elimina_benzina").click(function(){
		var id = $(this).attr("id");
		$("#id_da_eliminare").val(id);
					
	});//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
	    var id = $("#id_da_eliminare").val();
	    var id_mezzo = $("#id_mezzo").val();
		$.ajax({
			url: "lib/operazioni_benzina.lib.php",
			type: 'POST',
			data: {tipo: "elimina", id:id},
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_benzina").load("php/tabella_benzina.php?id=" + id_mezzo);
						$("#testo_cerca_tagliando").val("");
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