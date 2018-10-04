//JS relativo a pagina commesse.php

$(document).ready(function() {
	
	
	$("#btn_allega").click(function(){
		var cartella = $("#cartella").val();
		if(cartella == ""){
			alert("Inserire il nome della cartella");
			return false;
		}
		$("#formAllega").submit();
	});
	
	//se inserisco foto va a buon fine
	$("#formAllega").ajaxForm({
		
		success: function (data) {
			var id_commessa = $("#id_commessa").val();
			$("#cartella").val("");
			$("#elenco_cartelle_foto").load("php/elenco_cartelle_foto.php?id="+id_commessa);	
			//window.location = "foto.php?id="+id_commessa;
		}
	});//chiudo $("#formGalleria")
	
	
	
	
}); // chiudo $(document).ready