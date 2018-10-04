<?php
    include("lib/controllaSessione.php");
require_once("lib/verificaConvertiData.php");

	
	include("header.php");
	
	$id=$_GET['id'];
$data = isset($_GET['data']) ? $_GET['data'] : date("Y-m-d");
$a_data = isset($_GET['a_data']) ? $_GET['a_data'] : date("Y-m-d");
$data_indietro = ($data != "") ? capovolgiData($data) : date("d-m-Y");
$a_data_indietro = ($a_data != "") ? capovolgiData($a_data) : date("d-m-Y");

//verifico formato data
$esplodi_a_data_indietro =explode("-", $a_data_indietro);
if(strlen($esplodi_a_data_indietro[0]) == 2){
	$a_data_indietro = CapovolgiData($a_data_indietro);
}

	$titolo = ($_GET['nome'] == "nuovo") ? "Aggiungi Cantiere" : "Modifica Cantiere";
?>


<!--SCRIPT SITO-->
<script src="js/sito/nuovo_magazzino.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
	$("#div_nuovo").load("php/div_nuovo_magazzino.php?id=<?=$id?>&data=<?=$data_indietro?>");	
	
	<? if($titolo == "Aggiungi Cantiere"){ ?>
		$("#btn_nuovo").show();	
	<? } else {?>
		$("#btn_modifica").show();	
	<? } ?>
});
</script>
	<script type="text/javascript" src="http://xoxco.com/projects/code/tagsinput/jquery.tagsinput.js"></script>
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="http://xoxco.com/projects/code/tagsinput/jquery.tagsinput.css" />

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	
                	<!-- TITOLO -->
					<div class="col-lg-12">
						<div class="page-title">
							<h1><?=$titolo?> <small></small> <a class="close pull-right" href="magazzino.php?data=<?=$data_indietro?>&a_data=<?=$a_data_indietro?>"><i class="fa fa-backward"></i> Indietro</a></h1>
							<div class="clearfix"></div>
							<ol class="breadcrumb">
							<li class="active">
								
							</li>
								<li class="pull-right">
							</li>
							</ol>
						</div>
					</div>
					
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <div class="col-lg-12 ">
                    	<div id="div_nuovo">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<br>
				<div class="btn btn-success btn-block" id="btn_nuovo" style="display:none"><i class="fa fa-save"></i> Salva</div>
                                 <div class="btn btn-success btn-block" id="btn_modifica" style="display:none"><i class="fa fa-save"></i> Salva</div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
