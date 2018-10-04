$(document).ready(function() {
    
    $("#btn_save").unbind("click");
    $("#btn_save").click(function() {

		var testo_editor = $('#summernote').code();
		$('#testosezione').html(testo_editor);
		var testosezione = $('#testosezione').val();
        
        if (testosezione == '') {
            toastr.error("Compila tutti i campi con *", "ERRORE");
            return false;
        }

        $("#formNewModifica").submit();

    });


    $("#formNewModifica").ajaxForm({
    	
        success : function(data) {

			var idpreventivomaster = $('#idpreventivomaster').val();
			//alert(data);
        	window.location = "dettagli_preventivo.php?id="+idpreventivomaster;

        }
        
    });
    
});
