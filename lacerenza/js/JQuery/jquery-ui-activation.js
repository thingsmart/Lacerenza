//aggiunge l'autocomplete all'oggetto con id id utilizzando la lista lista

var addAutocomplete = function(id,lista){

/*
	$("#"+id).autocompleteOld(lista, {
				 autoFill: true,
				 minChars: 1,
				 matchContains: "word",
				 mustMatch: true,
				 scrollHeight: 220
	});//end $("#fornitore_articolo").autocomplete
*/
	$("#"+id).autocomplete({
			source: lista,
			selectFirst: true
		});	
				
}//end var addAutocomplete = function

//aggiunge il datepicker all'oggetto avente id id
var addDatepicker = function(id){
	
		$("#"+id).datepicker({ 
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy' 
		});//end $("#dataDDT").datepicker	
		
}

//inizializza un dialog in base alle informazioni passate
var creaDialog = function(id ,titolo ,larghezza ,altezza ,modale, bottoni){
	
	var	modale = typeof(modale) != 'undefined' ? modale : false,
		bottoni = typeof(bottoni) != 'undefined' ? bottoni : dialog_buttons,
		altezza = typeof(altezza) != 'undefined' ? altezza : "auto",
		larghezza = typeof(larghezza) != 'undefined' ? larghezza : "400";

	$("#"+id).dialog({
			title: titolo,
			autoOpen: true,
			bgiframe: true,
			resizable: false,
			width: larghezza,
			height: altezza,
			modal: modale,
			overlay: {
				backgroundColor: '#000',
				opacity: 0.5
				}
	});
		

	for(var bottone in bottoni){
		$("#"+id).dialog({ buttons: bottoni});
	}	
	
}//end var creaDialog = function

var Annulla = function() { $(this).dialog('close'); }