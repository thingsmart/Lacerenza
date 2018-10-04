$(document).ready(function() {
	
	//inizializzo datepicker
	 $('.data_picker').datepicker({
	   language: 'it',
	   autoclose: true
	});
	
	$("#btn_stampa").click(function(){
		var da_data = $("#da_data").val();
		var a_data = $("#a_data").val();
		var cerca_commessa = $("#cerca_commessa").val();
		var tl = $("#tl").val();
		if(da_data == "" || a_data == ""){
			alert("Seleziona entrambe le date");
			return false;
		}
		$("#btn_stampa").attr("href", "stampa_ruolino_per_data.php?cerca_commessa=" +cerca_commessa+"&da_data="+da_data+"&a_data="+a_data + "&tl="+tl);
	});
	
	$("#btn_stampa_economia").click(function(){
		var da_data = $("#da_data").val();
		var a_data = $("#a_data").val();
		var cerca_commessa = $("#cerca_commessa").val();
		var tl = $("#tl").val();
		if(da_data == "" || a_data == ""){
			alert("Seleziona entrambe le date");
			return false;
		}
		$("#btn_stampa_economia").attr("href", "stampa_ruolino_per_data_economia.php?cerca_commessa=" +cerca_commessa+"&da_data="+da_data+"&a_data="+a_data + "&tl="+tl);
	});
	
}); // chiudo $(document).ready

