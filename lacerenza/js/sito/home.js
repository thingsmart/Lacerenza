$(document).ready(function() {
	//se clicco il bottone cerca
    $(".btn_eseguito").unbind("click");
    $(".btn_eseguito").click(function () {
        var id_mezzo = $(this).attr("id_mezzo");
        var id = $(this).attr("id");
        var tabella = $(this).attr("tabella");
        $("#id_da_modificare").val(id);
        $("#id_mezzo").val(id_mezzo);
        $("#tabella").val(tabella);

	});//chiudo $("#btn_elimina_commessa")
	
	
    $("#btn_eseguito_conferma").unbind("click");
    $("#btn_eseguito_conferma").click(function () {
	    var id = $("#id_da_modificare").val();
	    var id_mezzo = $("#id_mezzo").val();
	    var tabella = $("#tabella").val();

		$.ajax({
			url: "lib/operazioni_home.lib.php",
			type: 'POST',
			data: { tipo: "allarme", id: id, id_mezzo: id_mezzo, tabella: tabella },
				success: function(data, textStatus, xhr) {
					if(data >= 0){
					    $('#dialog_eseguito').modal('hide');
					    $("#allarmi").load("allarmi.php");
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