$(document).ready(function() {
    
    $("#btn_save").unbind("click");
    $("#btn_save").click(function() {
    	        
        var idmodellomaster = $("#idmodellomaster").val();
                
        var idsezioni2 = $("#idsezioni2").val();
        $("#idsezioni").val(idsezioni2);
        var idsezioni = $('#idsezioni').val();
        
        if(idsezioni == '') {
        	return false;
        }

        $("#formDettaglio").submit();

    });

    $("#formDettaglio").ajaxForm({
    	
        success : function(data) {
        	
        	var idmodellomaster = $("#idmodellomaster").val();
        	
        	$("#tabella_dettagli_modello").load("php/tabella_dettagli_modello.php?model="+idmodellomaster);

        }
        
    });
    
});