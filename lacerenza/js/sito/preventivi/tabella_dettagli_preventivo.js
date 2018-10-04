$(document).ready(function() {

	// Pulsanti relativi alla modifica importo
    $(".btn_importo").unbind("click");
    $(".btn_importo").click(function () {
    	
    	var id_da_modificare = $(this).attr("id");
        var costo = $(this).attr("costo");
        var id_modello = $(this).attr("idmodmaster");
        var id_prev_master = $(this).attr("idprevmaster");

		$("#id_da_modificare").val(id_da_modificare);
        $("#valore_importo").val(costo);
        $("#id_modello").val(id_modello);
        $("#id_prev_master").val(id_prev_master);

    });
	
	$("#btn_conferma_importo").unbind("click");
	$("#btn_conferma_importo").click(function(){
		
		var id_da_modificare = $("#id_da_modificare").val();
		var costo = $("#valore_importo").val();
		var id_modello = $("#id_modello").val();
		var id_prev_master = $("#id_prev_master").val();
						
		$.ajax({
			url: "lib/operazioni_preventivo.lib.php",
			type: 'POST',
			data: { tipo: "save", id: id_da_modificare, idpreventivomaster: id_prev_master, idmodello: id_modello, costo: costo  },
			success: function(data, textStatus, xhr) {

				window.location = "dettagli_preventivo.php?id="+id_prev_master;

			},
			error: function(xhr, textStatus, errorThrown) {
				alert("Errore generico riprovare!");
			}
		});		
		
	});
	
	
	// Pulsanti relativi alla modifica quantita
    $(".btn_quantita").unbind("click");
    $(".btn_quantita").click(function () {
    	
    	var id_da_modificare = $(this).attr("id");
        var quantita = $(this).attr("quantita");
        var id_modello = $(this).attr("idmodmaster");
        var id_prev_master = $(this).attr("idprevmaster");
        
        //alert(id_da_modificare); return false;

		$("#id_da_modificare_qta").val(id_da_modificare);
        $("#valore_quantita").val(quantita);
        $("#id_modello_qta").val(id_modello);
        $("#id_prev_master_qta").val(id_prev_master);

    });
	
	$("#btn_conferma_quantita").unbind("click");
	$("#btn_conferma_quantita").click(function(){
		
		var id_da_modificare = $("#id_da_modificare_qta").val();
		var quantita = $("#valore_quantita").val();
		var id_modello = $("#id_modello_qta").val();
		var id_prev_master = $("#id_prev_master_qta").val();
				
		$.ajax({
			url: "lib/operazioni_preventivo.lib.php",
			type: 'POST',
			data: { tipo: "save_quantita", id: id_da_modificare, idpreventivomaster: id_prev_master, idmodello: id_modello, quantita: quantita  },
			success: function(data, textStatus, xhr) {
			
				window.location = "dettagli_preventivo.php?id="+id_prev_master;

			},
			error: function(xhr, textStatus, errorThrown) {
				alert("Errore generico riprovare!");
			}
		});	
		
	});
	
	
	
	// Pulsanti relativi alla modifica quantita
    $(".btn_descrizione").unbind("click");
    $(".btn_descrizione").click(function () {

    	var id_da_modificare = $(this).attr("id");
        var descrizione = $(this).attr("descrizione");
        var id_modello = $(this).attr("idmodmaster");
        var id_prev_master = $(this).attr("idprevmaster");
        
    	$('#summernote').summernote({
			'lang': 'it-IT'
		});
		
		$('#summernote').code(descrizione);
		
		$("#id_da_modificare_desc").val(id_da_modificare);
		$("#testosezione").text(descrizione);
        $("#id_modello_desc").val(id_modello);
        $("#id_prev_master_desc").val(id_prev_master);

    });
	
	$("#btn_conferma_descrizione").unbind("click");
	$("#btn_conferma_descrizione").click(function(){
		
		var id_da_modificare = $("#id_da_modificare_desc").val();
		var testo_editor = $('#summernote').code();
		$('#testosezione').html(testo_editor);
		var descrizione = $('#testosezione').val();
		var id_modello = $("#id_modello_desc").val();
		var id_prev_master = $("#id_prev_master_desc").val();
		
		$.ajax({
			url: "lib/operazioni_preventivo.lib.php",
			type: 'POST',
			data: { tipo: "save_descrizione", id: id_da_modificare, idpreventivomaster: id_prev_master, idmodello: id_modello, descrizione: descrizione  },
			success: function(data, textStatus, xhr) {
				
				window.location = "dettagli_preventivo.php?id="+id_prev_master;

			},
			error: function(xhr, textStatus, errorThrown) {
				alert("Errore generico riprovare!");
			}
		});		
		
	});
	
});