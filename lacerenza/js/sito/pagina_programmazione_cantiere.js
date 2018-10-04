//JS relativo a pagina commesse.php

$(document).ready(function() {
	
	//se clicco 
	$("#btn_nuova_programmazione").unbind("click");
	$("#btn_nuova_programmazione").click(function(){
		var data = $("#data").val();
		window.location = "nuova_programmazione_cantiere.php?nome=nuovo&data="+data;
					
	});//chiudo 
	
	$("#btn_stampa").click(function(){
		var data = $("#data").val();
		
		$("#btn_stampa").attr("href", "stampa_programmazione.php?data="+data);
	});
    
    $("#btn_clona_ieri").unbind("click");
    $("#btn_clona_ieri").click(function(){
    	var data_clona = $("#data_clona").val();
    	var data_oggi = $("#data").val();
    	
    	if(data_clona == ""){
    		alert("seleziona una data da clonare");
    		return false;
    	}
    	$.ajax({
			url: "lib/operazioni_programmazione_cantiere.lib.php",
			type: 'POST',
			data: { tipo: "clona_ieri", data: data_clona, data_oggi:data_oggi},
			success: function (data, textStatus, xhr) {
				if(data == "NO"){
					alert("Niente da clonare per la data inserita");
				} else {
					$("#tabella_programmazione_cantiere").load("php/tabella_programmazione_cantiere.php?data=" + data_oggi);	
				}
					
					$("#data_clona").val("");
				},
				error: function(xhr, textStatus, errorThrown) {
					alert("Errore generico riprovare!");
				}
		});//chiudo $.ajax		
    });
	
}); // chiudo $(document).ready