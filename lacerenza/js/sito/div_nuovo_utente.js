//JS relativo a pagina utenti.php

$(document).ready(function() {
	
	
	//validazione campi
	$("#formNewUser").validate({
		rules: {
			username_utente: {
				required: true
			},
			password_utente: {
				required: true
			},
			nome_utente: {
				required: true
			},
			cognome_utente: {
				required: true
			},
			mansione_utente: {
				required: true
			},
			email_utente: {
				required: true,
				email:true
			}
		},
		messages:{  
			username_utente:{  
				required: "<strong style='color:red; font-size:10px'>Username obbligatorio.</strong>"
			},
			password_utente:{  
				required: "<strong style='color:red; font-size:10px'>Password obbligatoria.</strong>"
			},
			nome_utente:{  
				required: "<strong style='color:red; font-size:10px'>Nome obbligatorio.</strong>"
			},
			cognome_utente:{  
				required: "<strong style='color:red; font-size:10px'>Cognome obbligatorio.</strong>"
			},
			mansione_utente:{  
				required: "<strong style='color:red; font-size:10px'>Mansione obbligatoria.</strong>"
			},
			email_utente:{  
				required: "<strong style='color:red; font-size:10px'>Email obbligatoria.</strong>",
				email: "email"
			}
		},
		errorPlacement: function(error, element){
			
			$("#messaggio").hide();
			if(element.attr("id") == "email_utente"){
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Controlla il formato dell'email");
			} else {
			$("#messaggio_errore").html("<img src='img/danger.png' style='width:20px; margin-right:10px' />Compila tutti i campi con *");
			}
			$("#messaggio_errore").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio_errore').hide(1000);
					}, 4000);
        }
	});	
	
	
}); // chiudo $(document).ready


