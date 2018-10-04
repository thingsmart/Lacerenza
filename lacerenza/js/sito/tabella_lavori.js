$(document).ready(function() {
	

       
    
	
	//se clicco il bottone cerca
    $(".btn_elimina").unbind("click");
    $(".btn_elimina").click(function () {
        var id = $(this).attr("id");
        $("#id_da_eliminare").val(id);
    });//chiudo 
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();

		$.ajax({
			url: "lib/operazioni_lavori.lib.php",
			type: 'POST',
			data: { tipo: "elimina", id: id},
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_lavori").load("php/tabella_lavori.php");
						$("#testo_cerca").val("");
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