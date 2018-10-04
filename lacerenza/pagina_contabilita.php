<?php
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";
$id_commessa = $_GET['id'];
$tipologia = isset($_GET['tipologia']) ? $_GET['tipologia'] : "";

include ("classi/class.Commesse.php");
include ("databases/db_function.php");
require_once("lib/verificaConvertiData.php");
$c = new Commesse();
$e_query_c = $c->caricaCommesseById($id_commessa);
$row_c = $e_query_c->fetch_array();


$da_data = isset($_GET['da_data']) ? CapovolgiData($_GET['da_data']) : "";
$a_data = isset($_GET['a_data']) ? CapovolgiData($_GET['a_data']) : "";

$da_data = ($da_data == "--") ? "" : $da_data;
$a_data = ($a_data == "--") ? "" : $a_data;
?>
<script>
$(document).ready(function() {
	$("#nome_commessa").html("<?=$row_c['descrizione']?>");
});
</script>
<!--SCRIPT SITO-->
<script src="js/sito/pagina_contabilita.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $("#tabella_contabilita").load("php/tabella_contabilita.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=<?=$tipologia?>");
});
</script>
<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Contabilità");
});
</script>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	<div class="col-lg-12">
                	<div class="page-title">
						<h1> Contabilit&agrave; <small> gestione contabile</small></h1>
						<ol class="breadcrumb">
							<li class="active">
								<i class="fa fa-calculator fa-lg"></i> Sal
							</li>
							<li class="pull-right">
	
							</li>
						</ol>
						</div>
					</div>
				</div>               
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-2">
                		<a class="btn btn-success btn-block" href="nuova_ral.php?nome=nuovo&id_commessa=<?=$id_commessa?>"><i class="fa fa-plus-circle fa-lg"></i> Aggiungi SAL</a>                		
                	</div>
                    <div class="col-lg-3">
                        <? if($da_data != ""){ ?>
                            <input class="form-control data_picker" type="text" id="da_data" value="<?=$da_data?>" readonly/>
                        <? } else { ?>
                            <input class="form-control data_picker" type="text" id="da_data"  readonly/>
                        <? } ?>
                    </div>
                    <div class="col-lg-3">
                        <? if($a_data != ""){ ?>
                            <input class="form-control data_picker" type="text" id="a_data" value="<?=$a_data?>" readonly/>
                        <? } else { ?>
                            <input class="form-control data_picker" type="text" id="a_data"  readonly/>
                        <? } ?>
                    </div>
                    <div class="col-lg-4 ">
                    	<div class="input-group">
                      		<input type="text" id="testo_cerca_ral" placeholder="Cerca per SAL" class="form-control">
                      		<span class="input-group-btn">
                        		<button class="btn btn-default" id="cerca_ral" type="button">cerca</button>
                      		</span>                      		
                    	</div><!-- /input-group -->
                        <br>
                    	
                    </div>
                </div>
                <!-- /.row -->
				<div id="tabella_contabilita">
                       <div style="text-align:center"><img src="img/load.gif"/></div>
                 </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<input type="hidden" id="tipologia_cerca" value="<?=$tipologia?>"/>
<!--Modal elimina-->
<div class="modal <?=$fade?> bs-elimina" tabindex="-1" role="dialog" id="dialog_elimina" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Elimina</h4>
      </div>
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare questa SAL? </div>
      <div class="modal-footer">
        <input id="id_da_eliminare" type="hidden" />
        <input id="nome_da_eliminare" type="hidden" />
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
