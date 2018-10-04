$(document).ready(function() {
    
    $("#btn_save").unbind("click");
    $("#btn_save").click(function() {
   	        
        var id = $("#id").val();
        var titolosezione = $('#titolosezione').val();
		var testo_editor = $('#summernote').code();
		$('#testosezione').html(testo_editor);
		var testosezione = $('#testosezione').val();
        var costosezione = $('#costosezione').val();
        
        //alert(testosezione); return false;
             
        if(id == "") {//INSERIMENTO
            if (titolosezione == '') {
                toastr.error("Compila tutti i campi con *", "ERRORE");
                return false;
            }
        } else {//MODIFICA
            if (titolosezione == '') {
                toastr.error("Compila tutti i campi con *", "ERRORE");
                return false;
            }
        }

        $("#formNewSezione").submit();

    });


    $("#formNewSezione").ajaxForm({
    	
        success : function(data) {
        	
        	//alert(data); return false;
        	if(data > 0) {
        		window.location = "pagina_sezioni.php";
        	} else {
        		toastr.error("Errore nella formattazione testo", "ERRORE");
        	}

        }
        
    });
    
    $('.btn_elimina_allegato').unbind("click");
    $('.btn_elimina_allegato').click(function () {
    	
		var id = $(this).attr("id");
		
		$("#id_da_eliminare").val(id);

	});
	
	$("#btn_elimina_conferma").unbind("click");
	$("#btn_elimina_conferma").click(function(){
		
		var id = $("#id_da_eliminare").val();
				
		$.ajax({
			url: "lib/operazioni_sezione.lib.php",
			type: 'POST',
			data: { tipo: "elimina_allegato", id: id },
			success: function(data, textStatus, xhr) {
				//alert(data); return false;
				if(data > 0){
					$('#dialog_elimina').modal('hide');
					$("#div_nuova_sezione").load("php/div_nuova_sezione.php?id="+id);	
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
