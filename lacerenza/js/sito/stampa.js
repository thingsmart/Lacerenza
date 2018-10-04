$(document).ready(function() {
	
	$("#btn_stampa").click(function(){
		var mese = $("#mese").val();
		var anno = $("#anno").val();
		var cerca_commessa = $("#cerca_commessa").val();
		var dal = $("#dal").val();
		var al = $("#al").val();
		var tl = $("#tl").val();
		$("#btn_stampa").attr("href", "stampa_ruolino.php?mese="+mese+"&anno="+anno+"&commessa="+cerca_commessa + "&tl=" + tl+"&dal="+dal+"&al="+al);
	});
	
	$("#btn_stampa_economia").click(function(){
		var mese = $("#mese").val();
		var anno = $("#anno").val();
		var cerca_commessa = $("#cerca_commessa").val();
		var dal = $("#dal").val();
		var al = $("#al").val();
		var tl = $("#tl").val();
		$("#btn_stampa_economia").attr("href", "stampa_ruolino_economia.php?mese="+mese+"&anno="+anno+"&commessa="+cerca_commessa + "&tl=" + tl+"&dal="+dal+"&al="+al);
	});
	
}); // chiudo $(document).ready

