$(document).ready(function() {

    $(".btn_elimina").unbind("click");
    $(".btn_elimina").click(function () {
    	
        var id = $(this).attr("id");

        $("#id_da_eliminare").val(id);
        

    });
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		
		var id = $("#id_da_eliminare").val();
						
		$.ajax({
			url: "lib/operazioni_preventivo_master.lib.php",
			type: 'POST',
			data: { tipo: "elimina", id: id },
			success: function(data, textStatus, xhr) {
				if(data > 0){
					$('#dialog_elimina').modal('hide');
					$("#tabella_preventivi_master").load("php/tabella_preventivi_master.php");	
					$("#testo_cerca").val("");	
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