$(document).ready(function() {
	//se clicco il bottone cerca
	$(".btn_elimina_mezzo").unbind("click");
	$(".btn_elimina_mezzo").click(function(){
		var id_mezzo = $(this).attr("id");
		$("#id_da_eliminare").val(id_mezzo);
					
	});//chiudo $("#btn_elimina_commessa")
	
	$("#venduti").click(function(){
		if($('#venduti').is(':checked') == true){
			$(".VENDUTO").show();
			$(".IN_POSSESSO").hide();
			$("#testo_mostra").html("Mostra mezzi in possesso");
		} else {
			$(".VENDUTO").hide();
			$(".IN_POSSESSO").show();
			$("#testo_mostra").html("Mostra mezzi venduti");
		}
	});
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		
		$.ajax({
			url: "lib/operazioni_mezzo.lib.php",
			type: 'POST',
			data: {tipo: "elimina", id:id},
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_mezzi").load("php/tabella_mezzi.php");
						$("#testo_cerca_mezzo").val("");
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

	$(".btn_tagliandi_mezzo").unbind("click");
	$(".btn_tagliandi_mezzo").click(function(){

		var id_mezzo = $(this).attr("id");
		var targa_mezzo = $(this).attr("targa");

		$("#titoloDettaglio").html("Ultime Operazioni "+targa_mezzo);

		$.ajax({
			url: "lib/operazioni_mezzo.lib.php",
			type: 'POST',
			data: {tipo: "ottienidettagli", id:id_mezzo},
			success: function(data, textStatus, xhr) {

				$("#bodyDettaglio").html(data);

			},
			error: function(xhr, textStatus, errorThrown) {
				alert("Errore generico riprovare!");
			}
		});//chiudo $.ajax


	});
	
});