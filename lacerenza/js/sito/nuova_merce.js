$(document).ready(function() {
	
	
	
	$("#aggiungi").unbind("click");
	$("#aggiungi").click(function(){
		var id_testata_magazzino = $("#id_testata_magazzino").val();
    	var materiale = $("#materiale").val();
    	var quantita = $("#quantita").val();
    	var data_select = $("#data").val();
    	
    	if(IsNumber(quantita) == false){
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per la quantita'");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
			return false;
		}
    	
		if(materiale == "" || quantita == ""){
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserisci la quantita' e la descrizione del materiale");
			$("#messaggio_errore").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio_errore').hide(1000);
					}, 4000);
			return false;
		}
		$.ajax({
			url: "lib/operazioni_merce.lib.php",
			type: 'POST',
			data: {tipo: "inserimento", id_testata_magazzino:id_testata_magazzino, materiale:materiale, quantita:quantita},
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_merce").load("php/tabella_merce.php?data="+data_select + "&id_magazzino=" + id_testata_magazzino);
						$("#ul_log").load("php/ul_log.php");	
						$("#quantita").val("");
						$("#materiale").val("");
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