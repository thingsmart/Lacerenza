$(document).ready(function() {
	

       
    
	
	//se clicco il bottone cerca
    $(".btn_elimina").unbind("click");
    $(".btn_elimina").click(function () {
        var id = $(this).attr("id");
        var nome = $(this).attr("nome");
        
        $("#id_da_eliminare").val(id);
        $("#nome_da_eliminare").val(nome);
    });//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var nome = $("#nome_da_eliminare").val();
		
		$.ajax({
			url: "lib/operazioni_tecnica.lib.php",
			type: 'POST',
			data: { tipo: "elimina", id: id, nome: nome },
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_tecnica").load("php/tabella_tecnica.php");
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