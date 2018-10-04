<?php
	include("header.php");
include("lib/verificaConvertiData.php");

	$fade = ($browser == 0) ? "fade" : "";	
	$id_mezzo = $_GET['id'];
$data_inizio = isset($_GET['data_inizio']) ? $_GET['data_inizio'] : date("Y-01-01");
$data_fine = isset($_GET['data_fine']) ? $_GET['data_fine'] : date("Y-12-31");
$targa = $_GET['targa'];
$data_inizio = CapovolgiData($data_inizio);
$data_fine = CapovolgiData($data_fine);
?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_libretto.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#tabella_libretto").load("php/tabella_libretto.php?id=<?=$id_mezzo?>&data_inizio=<?=$data_inizio?>&data_fine=<?=$data_fine?>&targa=<?=$targa?>");
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">

                		<!-- TITOLO -->
			        	<div class="col-lg-12">
							<div class="page-title">
								<h1>Libretto <small> aggiungi libretto al veicolo <?=$targa?></small><a class="close pull-right" href="pagina_mezzi.php?data_inizio=<?=$data_inizio?>&data_fine=<?=$data_fine?>"><i class="fa fa-backward"></i> Indietro</a></h1>
								<div class="clearfix"></div>
								<ol class="breadcrumb">
									<li class="active">
										<i class="fa fa-book fa-lg"></i> Libretto
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
                	<div class="col-lg-2">
                		<a class="btn btn-success btn-block" href="nuovo_libretto.php?nome=nuovo&id_mezzo=<?=$id_mezzo?>&data_inizio=<?=$data_inizio?>&data_fine=<?=$data_fine?>&targa=<?=$targa?>"><span class="number-left">+</span> Aggiungi libretto</a>
                		<br>
                	</div>
<!--                	<div class="col-lg-4">-->
<!--                		 <div class="col-lg-6"><input id="data_inizio" class="data_picker form-control" value="--><?//=$data_inizio?><!--" readonly></div>-->
<!--                 		<div class="col-lg-6"><input id="data_fine" class="data_picker form-control" value="--><?//=$data_fine?><!--" readonly></div>-->
<!--                	</div>	-->
<!--                    <div class="col-lg-6">-->
<!--                    	<div class="input-group">-->
<!--                      		<span class="input-group-btn">-->
<!--                        		<button class="btn btn-default" id="cerca_spesa" type="button">cerca</button>-->
<!--                      		</span>-->
<!--                    	</div>-->
<!--                       -->
<!--                    </div>-->
                </div>
                <!-- /.row -->
				<br>
				<div id="tabella_libretto">
                    	<div style="text-align:center"><img src="img/load.gif"/></div>
                </div>
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare questa spesa? </div>
      <div class="modal-footer">
        <input id="id_da_eliminare" type="hidden" />
        <input id="nome_da_eliminare" type="hidden" />
        <div id="username_da_eliminare" style="display:none"></div>
        <button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_elimina_conferma" class="btn btn-danger">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->

<input type="hidden" value="<?=$id_mezzo?>" id="id_mezzo_search" />

<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
