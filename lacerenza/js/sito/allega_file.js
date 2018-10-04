//JS relativo a pagina allegaFile.php

$(document).ready(function() {
	
	//inizializzo datepicker
	 $('.data_picker').datepicker({
	   language: 'it',
	   autoclose: true
	});
	
	$("#allega_file").click(function(){
		$("#formUpdate").submit();
	});//chiudo $("#allega_file")
	
	// //validazione campi
	// $("#formUpdate").validate({
		// rules: {
			// verbale_n: {
				// required: true
			// }
		// },
		// messages:{  
			// verbale_n:{  
				// required: "<strong style='color:red; font-size:10px'>Verbale N. obbligatorio.</strong>"
			// }
		// },
		// errorPlacement: function(error, element){
			// $("#messaggio").hide();
			// $("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Il Campo 'Verbale N.' &egrave; obbligatorio.");
			// $("#messaggio_errore").show();
			// setTimeout(function(){
			   	// $('#messaggio_errore').hide(1000);
			// }, 4000);
        // }
	// });	
	
	$("#formUpdate").ajaxForm({
		success: function(msg){
			processUpdate(msg);
		}
	});//chiudo $("#formUpdate")
	
});//chiudo $(document).ready


var processUpdate = function(data)
{
    
	if(data == ""){
		$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Selezionare un File");
		$("#messaggio_errore").show();
		setTimeout(function(){
			   	$('#messaggio_errore').hide(1000);
			}, 4000);
	} else {
		var id_commessa = $("#id_commessa").html();
		window.open("dettaglio_commessa.php?id="+id_commessa,"_self");
	}
	
}//end processUpdate
