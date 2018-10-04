$(document).ready(function() {
	

	//se clicco il bottone cerca
    $(".btn_elimina_allegato").unbind("click");
    $(".btn_elimina_allegato").click(function () {
        var id_allegato = $(this).attr("id");
        var nome = $(this).attr("nome");
        $("#id_da_eliminare").val(id_allegato);
        $("#nome_da_eliminare").val(nome);
    });//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_commessa = $("#id_commessa").val();
		var id_dipendente = $("#id_dipendente").val();
		var nome = $("#nome_da_eliminare").val();

		$.ajax({
			url: "lib/operazioni_dipendente.lib.php",
			type: 'POST',
			data: { tipo: "elimina_allegato", id: id, id_commessa: id_commessa, nome: nome, id_dipendente: id_dipendente },
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_allegati_dipendenti").load("php/tabella_allegati_dipendenti.php?id_comessa=" + id_commessa + "&id_dipendente=" + id_dipendente);
						$("#testo_cerca_allegato").val("");
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


	$(".btn_modifica").unbind("click");
	$(".btn_modifica").click(function(){

		var idallegato = $(this).attr("id");
		var descrizione = $(this).attr("descrizione");
		var controllascadenza = $(this).attr("controllascadenza");
		var iniziomodale = $(this).attr("inizio");
		var finemodale = $(this).attr("fine");

		$("#idmodale").val(idallegato);
		$("#descrizionemodale").val(descrizione);
		$("#controllamodale").val(controllascadenza);
		$("#iniziomodale").val(iniziomodale);
		$("#finemodale").val(finemodale);

	});

	$(".btn_salva_modifiche").unbind("click");
	$(".btn_salva_modifiche").click(function(){

		var idallegato = $("#idmodale").val();
		var descrizione = $("#descrizionemodale").val();
		var controllascadenza = $("#controllamodale").val();
		var iniziomodale = $("#iniziomodale").val();
		var finemodale = $("#finemodale").val();

		$.ajax({
			url: "lib/operazioni_dipendente.lib.php",
			type: 'POST',
			data: {tipo: "salva_modifiche", id:idallegato, desc:descrizione, controlla: controllascadenza, iniziomodale: iniziomodale, finemodale: finemodale},
			success: function(data, textStatus, xhr) {

				location.reload();

			},
			error: function(xhr, textStatus, errorThrown) {
				alert("Errore generico riprovare!");
			}
		});

	});

});