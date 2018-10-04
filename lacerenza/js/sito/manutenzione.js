$(document).ready(function() {
	//inizializzo datepicker
    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });
    
 $("#mese").change(function(){
		$("#tabella_manutenzione").html("<div style='text-align:center'><img src='img/load.gif' /></div>");
		var mese = $("#mese").val();
		var anno = $("#anno").val();
		var id = $("#id_mezzo_cerca").val();
		$("#tabella_manutenzione").load("php/tabella_manutenzione.php?mese=" + mese + "&anno="+anno + "&id="+id);
	});
	
	$("#anno").change(function(){
		$("#tabella_manutenzione").html("<div style='text-align:center'><img src='img/load.gif' /></div>");
		var mese = $("#mese").val();
		var anno = $("#anno").val();
		var id = $("#id_mezzo_cerca").val();
		$("#tabella_manutenzione").load("php/tabella_manutenzione.php?mese=" + mese + "&anno="+anno + "&id="+id);
	});
 
 	$("#btn_clona").click(function(){
 		var mese = $("#mese").val();
		var anno = $("#anno").val();
 		var id_mezzo = $("#id_mezzo_cerca").val();
 		$.ajax({
			url: "lib/operazioni_manutenzione.lib.php",
			type: 'POST',
			data: { tipo: "clona", mese: mese, id_mezzo: id_mezzo, anno:anno},
			success: function (data, textStatus, xhr) {
					if(data >= 0){
						$("#tabella_manutenzione").load("php/tabella_manutenzione.php?mese=" + mese + "&anno="+anno + "&id="+id_mezzo);
					} else if(data.indexOf("ERRORE") != -1){
						alert("Nessun dato trovato nel mese precedente");
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