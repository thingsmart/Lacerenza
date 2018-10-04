$(document).ready(function() {
    
    $("#btn_save").unbind("click");
    $("#btn_save").click(function() {
    	        
        var id = $("#id").val();
        var titolosezione = $('#titolosezione').val();

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

        $("#formNewModello").submit();

    });


    $("#formNewModello").ajaxForm({
    	
        success : function(data) {
        	
        	var id = $("#id").val();
        	
        	if(id == '') {
        		
        		var id_update = (id != "") ? id : data;
        		window.location = "dettagli_modello.php?model="+id_update;
        		
        	} else {

        		window.location = "pagina_modelli.php";
        		
        	}

        }
        
    });

});