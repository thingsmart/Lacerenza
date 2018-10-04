//JS relativo a pagina tabella_utenti.php

$(document).ready(function() {
	
	//se clicco il bottone cerca
	$(".elimina_utente").unbind("click");
	$(".elimina_utente").click(function(){
		var id_utente = $(this).attr("id_utente");
		var username = $(this).attr("username");
		$("#username_da_eliminare").html(username);
		$("#id_da_eliminare").html(id_utente);
		
	});//chiudo $("#elimina_utente")
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").html();
		var username = $("#username_da_eliminare").html();
		
		$.ajax({
			url: "lib/operazioni_utente.lib.php",
			type: 'POST',
			data: {tipo: "elimina", id:id, username:username},
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_utenti").load("php/tabella_utenti.php");
						$("#testo_cerca_utente").val("");

					} else if(data == "error"){
						$('#dialog_elimina').modal('hide');
						alert("ERRORE: Non puoi eliminare l'utente con cui ti sei loggato");
					}else {
						alert("Errore: "+data);
					}
				},
				error: function(xhr, textStatus, errorThrown) {
					alert("Errore generico riprovare!");
				}
		});//chiudo $.ajax		
		
	});
	
	
}); // chiudo $(document).ready


