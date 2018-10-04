$(document).ready(function() {

	$(".btn_archiviazione").unbind("click");
	$(".btn_archiviazione").click(function(){

		var id_commessa = $(this).attr("id");
		var operazione = $(this).attr("operazione");
		var datafine = $(this).attr("datafine");
		var da_data = $(this).attr("da_data");
		var a_data = $(this).attr("a_data");
		var filtro = $(this).attr("filtro");

		if(operazione == "archivia") {
			if (datafine == '--' || datafine == null || datafine == 'null' || datafine == 'NULL') {
				alert("Inserire una data di fine");
				return;
			}
		}

		$.ajax({
			url: "lib/operazioni_commessa.lib.php",
			type: 'POST',
			data: {tipo: "archivia", id:id_commessa, operazione:operazione},
			success: function(data, textStatus, xhr) {
				if(data > 0){

					if(operazione == "archivia") {
						$("#tabella_commesse").load("php/tabella_commesse.php?da_data=" + da_data + "&a_data=" + a_data + "&filtro=" + filtro);
					} else {
						$("#tabella_commesse").load("php/tabella_commesse.php?da_data=" + da_data + "&a_data=" + a_data + "&filtro=" + filtro+"&op=anno&archiviato=1");
					}
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

	$(".riepilogo_icona").unbind("click");
	$(".riepilogo_icona").click(function(){
		var id_commessa = $(this).attr("id");
		$(".tr_all").css("background", "none");
		$("#tr_"+id_commessa).css("background", "#C1C5C7");

	});//chiudo $("#btn_elimina_commessa")

	//se clicco il bottone cerca
	$(".btn_elimina_commessa").unbind("click");
	$(".btn_elimina_commessa").click(function(){
		var id_commessa = $(this).attr("id");
		$("#id_da_eliminare").val(id_commessa);
					
	});//chiudo $("#btn_elimina_commessa")
	
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();

		$.ajax({
			url: "lib/operazioni_commessa.lib.php",
			type: 'POST',
			data: {tipo: "elimina", id:id},
				success: function(data, textStatus, xhr) {
					if(data > 0){
						$('#dialog_elimina').modal('hide');
						$("#tabella_commesse").load("php/tabella_commesse.php");
						$("#testo_cerca_commessa").val("");
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

	$(".tr_all").click(function(){
		var row_num = $(this).attr("row_number");
		highlight(parseInt(row_num)-1);
	});

	//window.addEventListener("keydown", function(e) {
	//	// space and arrow keys
	//	if([32, 37, 38, 39, 40].indexOf(e.keyCode) > -1) {
	//		e.preventDefault();
	//	}
	//}, false);
});

function highlight(tableIndex) {
	// Just a simple check. If .highlight has reached the last, start again
	if( (tableIndex+1) > $('#data tbody tr').length )
		tableIndex = 0;

	// Element exists?
	if($('#data tbody tr:eq('+tableIndex+')').length > 0)
	{
		// Remove other highlights
		$('#data tbody tr').removeClass('highlight');

		// Highlight your target
		$('#data tbody tr:eq('+tableIndex+')').addClass('highlight');
	}
}

$('#goto_first').click(function() {
	highlight(0);
});

$('#goto_prev').click(function() {
	highlight($('#data tbody tr.highlight').index() - 1);
});

$('#goto_next').click(function() {
	highlight($('#data tbody tr.highlight').index() + 1);
});

$('#goto_last').click(function() {
	highlight($('#data tbody tr:last').index());
});

$(document).keydown(function (e) {

	switch(e.which)
	{
		case 38:
			$('#goto_prev').trigger('click');
			break;
		case 40:
			$('#goto_next').trigger('click');
			break;
	}

});
