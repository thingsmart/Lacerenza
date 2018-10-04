//JS relativo a pagina tabella_dipendenti.php

$(document).ready(function() {
	
	//se clicco il bottone cerca
	$(".elimina_utente").unbind("click");
	$(".elimina_utente").click(function(){
	    var id_utente = $(this).attr("id_dipendente");
	    
		$("#id_da_eliminare").html(id_utente);
		
	});//chiudo $("#elimina_utente")
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").html();
		$.ajax({
			url: "lib/operazioni_dipendente.lib.php",
			type: 'POST',
			data: {tipo: "elimina", id:id},
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_dipendenti").load("php/tabella_dipendenti.php");
						$("#testo_cerca_dipendente").val("");

					} else {
						alert("Errore: "+data);
					}
				},
				error: function(xhr, textStatus, errorThrown) {
					alert("Errore generico riprovare!");
				}
		});//chiudo $.ajax		
		
	});
	
	
}); // chiudo $(document).ready


