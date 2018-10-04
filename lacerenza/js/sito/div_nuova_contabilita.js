//JS relativo a pagina nuova contabilita
$(document).ready(function() {
	

		//se clicco il bottone cerca
	$("#btn_elimina_allegato").unbind("click");
	$("#btn_elimina_allegato").click(function () {
		var nome = $(this).attr("nome");
		var id = $(this).attr("id_contabilita");
		var id_commessa = $(this).attr("id_commessa");
		$("#id_da_eliminare").val(id);
		$("#id_commessa_da_eliminare").val(id_commessa);
		$("#nome_da_eliminare").val(nome);

	});//chiudo $("#btn_elimina_commessa")
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		var id = $("#id_da_eliminare").val();
		var id_commessa = $("#id_commessa_da_eliminare").val();
		var nome = $("#nome_da_eliminare").val();
		$.ajax({
			url: "lib/operazioni_contabilita.lib.php",
			type: 'POST',
			data: { tipo: "elimina_allegato", id: id, nome: nome, id_commessa: id_commessa },
			success: function (data, textStatus, xhr) {
					if(data >= 0){
						$('#dialog_elimina').modal('hide');
						$("#div_nuova_contabilita").load("php/div_nuova_contabilita.php?id=" + id + "&id_commessa=" + id_commessa);
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
	
	$("#formNew").ajaxForm({
		success: function(data){
		    var tipo = $("#tipo").val();
		    var id_commessa = $("#id_commessa").val();
			if(tipo != "modifica"){
			    if (data >= 0) {
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo").hide();
					$("#btn_modifica").show();
					$("#titolo_h1").html("Modifica Contabilit&agrave;");
					//$("#div_nuova_contabilita").load("php/div_nuova_contabilita.php?id=" + data + "&id_commessa=" + id_commessa);
					$("#ul_log").load("php/ul_log.php");
					window.location = "pagina_contabilita_new.php?id="+id_commessa+"&id_contabilita="+data;
				}  else {
					alert("Errore: "+data);	
				}
			} else { // sono in modifica
				if(data >= 0){
				    var id = $("#id_contabilita").val();
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo").hide();
					$("#btn_modifica").show();
					$("#titolo_h1").html("Modifica Contabilit&agrave;");
					//$("#div_nuova_contabilita").load("php/div_nuova_contabilita.php?id=" + id + "&id_commessa=" + id_commessa);
					$("#ul_log").load("php/ul_log.php");
					window.location = "pagina_contabilita_new.php?id="+id_commessa+"&id_contabilita="+id;
				}  else {
					alert("Errore: "+data);	
				}
			}
		}
	});//chiudo $("#formUpdate")
		
	

	
	
}); // chiudo $(document).ready


