<?php
	include("header.php");
include("lib/verificaConvertiData.php");

	$fade = ($browser == 0) ? "fade" : "";	
	$anno_prima = date("Y")-1;
	$data_inizio = isset($_GET['data_inizio']) ? $_GET['data_inizio'] : date("01-01-".$anno_prima);
$data_fine = isset($_GET['data_fine']) ? $_GET['data_fine'] : date("31-12-Y");


?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_mezzi.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#tabella_mezzi").load("php/tabella_mezzi.php?data_inizio=<?=$data_inizio?>&data_fine=<?=$data_fine?>");	
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Anagrafica Mezzi");
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	<div class="col-lg-12">
                        <div class="page-title">
                            <h1>Mezzi
                                <small>controllo automezzi</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li class="active"><i class="fa fa-truck fa-lg"></i> Mezzi</li>
                                <li class="pull-right">
                                    
                                </li>
                            </ol>
                        </div>
                    </div>
                      
                    <div class="">
                    
                          <div class="col-lg-3">
                          	<a class="btn btn-success btn-block" href="nuovo_mezzo.php?nome=nuovo"><i class="fa fa-plus-circle fa-lg"></i> Nuovo Mezzo</a>
                          	<br>
                          </div>
                          <div class="col-lg-2">
                            <input id="data_inizio" class="data_picker form-control" value="<?=$data_inizio?>" readonly>
                            <br>
                          </div>
                          <div class="col-lg-2">
                            <input id="data_fine" class="data_picker form-control" value="<?=$data_fine?>" readonly>
                            <br>
                          </div>
                          <div class="col-lg-5">
							<div class="input-group">
                      		<input type="text" id="testo_cerca_mezzo" placeholder="Cerca per mezzo o targa" class="form-control">
                      		<span class="input-group-btn">
                        		<button class="btn btn-default" id="cerca_mezzo" type="button">cerca</button>
                      		</span>
                    	</div><!-- /input-group -->
                    	
                          </div>
                        <!-- <ol class="breadcrumb">
                            <li class="active">
                                 <a class="btn btn-success" href="nuovo_mezzo.php?nome=nuovo">Nuovo Mezzo</a>
                            </li>
                            <div class="btn"><input id="data_inizio" class="data_picker form-control" value="<?=date("01-01-Y")?>" readonly></div>
                            <div class="btn"><input id="data_fine" class="data_picker form-control" value="<?=date("31-12-Y")?>" readonly></div>
                        </ol> -->
                    </div>
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <div class="col-lg-12">
                    	<!-- <div class="input-group">
                      		<input type="text" id="testo_cerca_mezzo" placeholder="Cerca per mezzo o targa" class="form-control">
                      		<span class="input-group-btn">
                        		<button class="btn btn-default" id="cerca_mezzo" type="button">cerca</button>
                      		</span>
                    	</div>-->
                        <br>
                    	<div id="tabella_mezzi">
                        	<div style="text-align:center"><img src="img/load.gif"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<br><br>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


<!--Modal elimina-->
<div class="modal <?=$fade?> bs-elimina" tabindex="-1" role="dialog" id="dialog_elimina" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Elimina</h4>
      </div>
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare il mezzo e tutti i dati relativi ad esso? </div>
      <div class="modal-footer">
        <input id="id_da_eliminare" type="hidden" />
        <div id="username_da_eliminare" style="display:none"></div>
        <button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_elimina_conferma" class="btn btn-danger">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->


<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
