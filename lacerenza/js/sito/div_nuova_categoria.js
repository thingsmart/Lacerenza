//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	$("#formNewCategoria").ajaxForm({
		success: function(data){
		    var tipo = $("#tipo").val();
		    var id_commessa = $("#id_commessa").val();
		    var id_verbale = $("#id_verbale").val();
		    if (tipo != "modifica") {
			    if (data >= 0) {
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuova_categoria").hide();	
					$("#btn_modifica_categoria").show();
					$("#titolo_h1").html("Modifica Categoria");
					$("#div_nuova_categoria").load("php/div_nuova_categoria.php?id=" + data + "&id_commessa=" + id_commessa + "&id_verbale=" + id_verbale);
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			} else { // sono in modifica
				if(data >= 0){
				    var id = $("#id_categoria_modifica").val();
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuova_categoria").hide();	
					$("#btn_modifica_categoria").show();	
					$("#titolo_h1").html("Modifica Categoria");
					$("#div_nuova_categoria").load("php/div_nuova_categoria.php?id=" + id + "&id_commessa=" + id_commessa + "&id_verbale=" + id_verbale);
					$("#ul_log").load("php/ul_log.php");	
				}  else {
					alert("Errore: "+data);	
				}
			}
		}
	});//chiudo $("#formUpdate")
		
	
	//validazione campi
	$("#formNewCategoria").validate({
		rules: {
		    descrizione: {
				required: true
			},
		    importo: {
				required: true
		    }
		},
		messages:{  
		    descrizione: {
		        required: "<strong style='color:red; font-size:10px'>descrizione</strong>"
			}
		},
		errorPlacement: function(error, element){
			
			$("#messaggio").hide();
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Compila tutti i campi con *");
			$("#messaggio_errore").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio_errore').hide(1000);
					}, 4000);
        }
	});	
	
	
}); // chiudo $(document).ready


