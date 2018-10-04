<?php
    include("lib/controllaSessione.php");
	
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	

	$id_preventivo = $_GET['id'];
	$id_modello = $_GET['model'];
	$id_preventivo_master = $_GET['prev'];

	$titolo = ($_GET['nome'] == "nuovo") ? "Nuovo Testo" : "Modifica Testo";
?>


<!--SCRIPT SITO
<script src="js/sito/nuova_tecnica.js" type="text/javascript"></script>-->

<script src="js/JQuery/jquery.form.js" type="text/javascript"></script>
<script src="js/JQuery/jquery.validate.min.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	<? if($id_preventivo != '') {?>
    	$("#div_modifica_testo").load("php/div_modifica_testo.php?id=<?=$id_preventivo?>&model=<?=$id_modello?>&prev=<?=$id_preventivo_master?>");	
    <? } else { ?>
    	$("#div_modifica_testo").load("php/div_modifica_testo.php?model=<?=$id_modello?>&prev=<?=$id_preventivo_master?>");
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
						<h1><?=$titolo?> <small></small> <a class="btn btn-default pull-right" href="dettagli_preventivo.php?id=<?=$id_preventivo_master?>"><i class="fa fa-arrow-left"></i> Indietro</a></h1>
						<div class="clearfix"></div>
						<ol class="breadcrumb">
							<li class="active">
								<i class="fa fa-file-pdf-o fa-lg"></i> Preventivi -> Modifica Testo
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
                    	<div id="div_modifica_testo">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<br>
				
				<div class="btn btn-success btn-block" id="btn_save"><i class="fa fa-save"></i> Salva</div>
                <!-- <div class="btn btn-success btn-block" id="btn_save" style="display:none"><i class="fa fa-save"></i> Salva</div> -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


<?php
	include("footer.php");
?>

</body>

</html>
