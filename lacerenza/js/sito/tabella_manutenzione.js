$(document).ready(function() {
	//inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });
    
    $("#data").change(function(){
    	var data = $("#data").val();
    	var id = $("#id_mezzo").val();
    	$("#tabella_programmazione_cantiere").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");	
    	$("#tabella_programmazione_cantiere").load("php/tabella_programmazione_cantiere.php?data="+data+"&id="+id);	
    });
    
	
	$("#btn_modifica").click(function(){
 	var libretto = $('input:radio[name=libretto]:checked').val();
 	var assicurazione = $('input:radio[name=assicurazione]:checked').val();
 	var olio_cambio = $('input:radio[name=olio_cambio]:checked').val();
 	var olio_motore = $('input:radio[name=olio_motore]:checked').val();
 	var estintori = $('input:radio[name=estintori]:checked').val();
 	var pneumatici = $('input:radio[name=pneumatici]:checked').val();
 	var elettrico = $('input:radio[name=elettrico]:checked').val();
 	var triangolo = $('input:radio[name=triangolo]:checked').val();
 	var giubbino = $('input:radio[name=giubbino]:checked').val();
 	var vetri = $('input:radio[name=vetri]:checked').val();
 	var pronto_soccorso = $('input:radio[name=pronto_soccorso]:checked').val();
 	var carrozzeria  = $('input:radio[name=carrozzeria]:checked').val();
 	var freni = $('input:radio[name=freni]:checked').val();
 	var luci = $('input:radio[name=luci]:checked').val();
 	var tergicristalli = $('input:radio[name=tergicristalli]:checked').val();
 	var indicatori = $('input:radio[name=indicatori]:checked').val();
 	var climatizzatore = $('input:radio[name=climatizzatore]:checked').val();
 	var altro = $('input:radio[name=altro]:checked').val();
 	var note = $("#note").val();
 	var id = $("#id_modifica").val();
 	var dettagli_mezzo = $("#dettagli_mezzo").val();
 	var data_giorno = $("#data").val();
 	var mese = $("#mese").val();
 	var anno = $("#anno").val();
	var id_mezzo = $("#id_mezzo").val();
 	if(altro == null || climatizzatore == null || indicatori == null || tergicristalli == null || luci == null || freni == null || carrozzeria == null || pronto_soccorso == null || vetri == null || giubbino == null || triangolo == null || elettrico == null || pneumatici == null || estintori == null || olio_motore == null || libretto == null || assicurazione == null || olio_cambio == null){
 		alert("Selezionare tutti i campi");
 		return false;
 	}
 	
 	if(dettagli_mezzo == ""){
 		alert("seleziona un mezzo");
 		return false;
 	}
 	
 	
 	$.ajax({
    	url: "lib/operazioni_manutenzione.lib.php",
		type: 'POST',
        data: {tipo: "modifica", id:id, mese:mese, anno:anno, data:data_giorno, assicurazione:assicurazione, olio_motore:olio_motore, pneumatici:pneumatici, vetri:vetri, pronto_soccorso:pronto_soccorso, altro:altro, note:note, climatizzatore:climatizzatore, indicatori:indicatori, tergicristalli:tergicristalli, luci:luci, freni:freni, carrozzeria:carrozzeria, giubbino:giubbino, triangolo:triangolo, elettrico:elettrico, estintori:estintori, olio_cambio:olio_cambio, libretto:libretto, dettagli_mezzo:dettagli_mezzo},
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					var mese = $("#mese").val();
 					var anno = $("#anno").val();
					$("#tabella_manutenzione").load("php/tabella_manutenzione.php?mese="+mese+"&anno="+anno+"&id="+id_mezzo);	
				} else {
					alert("Errore: "+data);	
				}
				window.location = "#";
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
            }
    });//chiudo $.ajax
 });
     
     
 $("#btn_nuovo").click(function(){
 	var libretto = $('input:radio[name=libretto]:checked').val();
 	var assicurazione = $('input:radio[name=assicurazione]:checked').val();
 	var olio_cambio = $('input:radio[name=olio_cambio]:checked').val();
 	var olio_motore = $('input:radio[name=olio_motore]:checked').val();
 	var estintori = $('input:radio[name=estintori]:checked').val();
 	var pneumatici = $('input:radio[name=pneumatici]:checked').val();
 	var elettrico = $('input:radio[name=elettrico]:checked').val();
 	var triangolo = $('input:radio[name=triangolo]:checked').val();
 	var giubbino = $('input:radio[name=giubbino]:checked').val();
 	var vetri = $('input:radio[name=vetri]:checked').val();
 	var pronto_soccorso = $('input:radio[name=pronto_soccorso]:checked').val();
 	var carrozzeria  = $('input:radio[name=carrozzeria]:checked').val();
 	var freni = $('input:radio[name=freni]:checked').val();
 	var luci = $('input:radio[name=luci]:checked').val();
 	var tergicristalli = $('input:radio[name=tergicristalli]:checked').val();
 	var indicatori = $('input:radio[name=indicatori]:checked').val();
 	var climatizzatore = $('input:radio[name=climatizzatore]:checked').val();
 	var altro = $('input:radio[name=altro]:checked').val();
 	var note = $("#note").val();
 	var dettagli_mezzo = $("#dettagli_mezzo").val();
 	var data_giorno = $("#data").val();
	var id = $("#id_mezzo").val();
	var mese = $("#mese").val();
 	var anno = $("#anno").val();
 	if(altro == null || climatizzatore == null || indicatori == null || tergicristalli == null || luci == null || freni == null || carrozzeria == null || pronto_soccorso == null || vetri == null || giubbino == null || triangolo == null || elettrico == null || pneumatici == null || estintori == null || olio_motore == null || libretto == null || assicurazione == null || olio_cambio == null){
 		alert("Selezionare tutti i campi");
 		return false;
 	}
 	
 	if(dettagli_mezzo == ""){
 		alert("seleziona un mezzo");
 		return false;
 	}
 	
 	$.ajax({
    	url: "lib/operazioni_manutenzione.lib.php",
		type: 'POST',
        data: {tipo: "inserimento", mese:mese, anno:anno, data:data_giorno, assicurazione:assicurazione, olio_motore:olio_motore, pneumatici:pneumatici, vetri:vetri, pronto_soccorso:pronto_soccorso, altro:altro, note:note, climatizzatore:climatizzatore, indicatori:indicatori, tergicristalli:tergicristalli, luci:luci, freni:freni, carrozzeria:carrozzeria, giubbino:giubbino, triangolo:triangolo, elettrico:elettrico, estintori:estintori, olio_cambio:olio_cambio, libretto:libretto, dettagli_mezzo:dettagli_mezzo},
        	success: function(data, textStatus, xhr) {
	 			if(data >= 0){
					$("#contenuto_messaggio").html("<img src='img/caricato.png' style='width:20px; margin-right:10px' />Salvataggio avvenuto con successo.");
					$("#messaggio_errore").hide();
					$("#messaggio").show();
					//NASCONDO MESSAGGIO
					setTimeout(function(){
				    	$('#messaggio').hide(1000);
					}, 3000);
					$("#btn_nuovo").hide();	
					$("#btn_modifica").show();	
					$("#tabella_manutenzione").load("php/tabella_manutenzione.php?data="+data_giorno+"&id="+id+"&mese="+mese+"&anno="+anno);	
				} else {
					alert("Errore: "+data);	
				}
				window.location = "#";
            },
            error: function(xhr, textStatus, errorThrown) {
 				alert("Errore generico riprovare!");
            }
    });//chiudo $.ajax
 	
 });
});