$(document).ready(function() {




    $("#cerca").unbind("click");
    $("#cerca").click(function(){
        var data = $("#data").val();
        var a_data = $("#a_data").val();
        $("#tabella_magazzino").html("<div style='margin:auto; text-align:center'><img src='img/load.gif' /></div>");
        $("#tabella_magazzino").load("php/tabella_magazzino.php?data="+data+"&a_data="+a_data);
    });
	
	
});