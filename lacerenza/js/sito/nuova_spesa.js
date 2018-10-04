//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_nuova_spesa").click(function(){
		if($("#formNewSpesa").valid() == false){
			return 
		}
		
		var costo = $("#costo").val();

		if(IsNumber(costo) == false){
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per i costo");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
			return;
		}
		
		$("#formNewSpesa").submit();
	});//chiudo $("#btn_nuovo_tagliando")
	
	//se clicco il bottone conferma nuovo_utente
	$("#btn_modifica_spesa").click(function(){
		$("#tipo").val("modifica");
		
		//valido campi
		if($("#formNewSpesa").valid() == false){
			return 
		}
		
		var costo = $("#costo").val();

		if(IsNumber(costo) == false){
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Inserire un valore numerico per i costo");
			$("#messaggio_errore").show();
			//NASCONDO MESSAGGIO
			setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
			return;
		}
		
		
		
		$("#formNewSpesa").submit();
	});//chiudo $("#btn_modifica_tagliando")
	
	
		
	

	
	
}); // chiudo $(document).ready

