<?php
include("lib/controllaSessione.php");
include("databases/db_function.php");
include("classi/class.Mezzi.php");
require_once("lib/verificaConvertiData.php");

	
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	
$data_inizio = isset($_GET['data_inizio']) ? $_GET['data_inizio'] : "";
$data_fine = isset($_GET['data_fine']) ? $_GET['data_fine'] : "";



	$id=$_GET['id'];
	$id_mezzo=$_GET['id_mezzo'];
	$targa=$_GET['targa'];

    if($targa == ""){
        $mezzo = new Mezzi();
        $targa = $mezzo->estraiTargaMezzoById($id_mezzo);
    }
	$titolo = ($_GET['nome'] == "nuovo") ? "Nuovo Tiket" : "Modifica Tiket";
	
		if($_GET['nome'] == "nuovo"){
		$data_inizio = ($data_inizio != "") ? capovolgiData($data_inizio) : date("Y-01-01");
		$data_fine = ($data_fine != "") ? capovolgiData($data_fine) : date("Y-12-31");
	}
?>


<!--SCRIPT SITO-->
<script src="js/sito/nuova_benzina.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
    $("#div_nuova_benzina").load("php/div_nuova_benzina.php?id=<?=$id?>&id_mezzo=<?=$id_mezzo?>&targa=<?=$targa?>");	
	
	<? if($titolo == "Nuovo Tiket"){ ?>
		$("#btn_nuova_benzina").show();	
	<? } else {?>
		$("#btn_modifica_benzina").show();	
	<? } ?>
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	
                		<!-- TITOLO -->
			        	<div class="col-lg-12">
							<div class="page-title">
								<h1><?=$titolo?> <small> scheda benzina</small> <a class="close pull-right" href="pagina_benzina.php?id=<?=$id_mezzo?>&targa=<?=$targa?>&data_inizio=<?=$data_inizio?>&data_fine=<?=$data_fine?>"><i class="fa fa-backward"></i> Indietro</a></h1>
								<div class="clearfix"></div>
								<ol class="breadcrumb">
									<li class="active">
										<i class="fa fa-automobile fa-lg"></i> Tiket
									</li>
									<li class="pull-right">
			
									</li>
								</ol>
							</div>
						</div>
			            <!-- / END: TITOLO  --> 
                	
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <div class="col-lg-12 ">
                    	<div id="div_nuova_benzina">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<br>
                    <div class="btn btn-success btn-block" id="btn_nuova_benzina" style="display:none"><i class="fa fa-save"></i> Salva</div>
                    <div class="btn btn-success btn-block" id="btn_modifica_benzina" style="display:none"><i class="fa fa-save"></i> Salva</div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



<input type="hidden" id="id_mezzo" value="<?=$id_mezzo?>"/>
<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
