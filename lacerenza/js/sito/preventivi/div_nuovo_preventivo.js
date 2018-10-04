$(document).ready(function() {
	
	//inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });
    
    $("#btn_save").unbind("click");
    $("#btn_save").click(function() {
    	        
        var id = $("#id").val();
        var numpreventivo = $('#numpreventivo').val();
        var datapreventivo = $('#datapreventivo').val();
        var cliente = $('#cliente').val();
        
        var idmodellomaster2 = $("#idmodellomaster2").val();
        $("#idmodellomaster").val(idmodellomaster2);
        var idmodellomaster = $('#idmodellomaster').val();
        
        var descrizione = $('#descrizione').val();
                
        if(id == "") {//INSERIMENTO
        	
            if (numpreventivo == '') {
                toastr.error("Compila tutti i campi con *", "ERRORE");
                return false;
            }
            
        } else {//MODIFICA
            if (numpreventivo == '') {
                toastr.error("Compila tutti i campi con *", "ERRORE");
                return false;
            }
        }

        $("#formNewPreventivo").submit();

    });


    $("#formNewPreventivo").ajaxForm({
    	
        success : function(data) {

        	var id = $("#id").val();
        	if(id != '') {
        		window.location = "pagina_riepilogo_preventivi.php";
        	} else {
        		window.location = "nuovo_preventivo.php?id="+id;
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
			url: "lib/operazioni_preventivo_master.lib.php",
			type: 'POST',
			data: { tipo: "elimina_allegato", id: id },
			success: function(data, textStatus, xhr) {
				if(data > 0){
					$('#dialog_elimina').modal('hide');
					$("#div_nuovo_preventivo").load("php/div_nuovo_preventivo.php?id="+id);	
				} else {
					alert("Errore: "+data);
				}
			},
			error: function(xhr, textStatus, errorThrown) {
				alert("Errore generico riprovare!");
			}
		});
		
	});

});