$(document).ready(function() {
	

       
    
	
	//se clicco il bottone cerca
    $(".btn_elimina_fattura").unbind("click");
    $(".btn_elimina_fattura").click(function () {
        var id_fattura = $(this).attr("id");
        var nome = $(this).attr("nome");
        $("#id_da_eliminare").val(id_fattura);
        $("#nome_da_eliminare").val(nome);
    });//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_commessa = $("#id_commessa").val();
		var nome = $("#nome_da_eliminare").val();
		
		$.ajax({
			url: "lib/operazioni_materiali_esterni.lib.php",
			type: 'POST',
			data: { tipo: "elimina", id: id, id_commessa: id_commessa, nome: nome },
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_materiali_esterni").load("php/tabella_materiali_esterni.php?id=" + id_commessa);
						$("#testo_cerca_fattura").val("");
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