<?php
	include("header.php");
include("lib/verificaConvertiData.php");
include("databases/db_function.php");
require_once("classi/class.ProgrammazioneCantiere.php");

	$fade = ($browser == 0) ? "fade" : "";	
	$data = isset($_GET['data']) ? $_GET['data'] : date("Y-m-d");
	$data = ($data != "") ? capovolgiData($data) : date("d-m-Y");

$data_select = CapovolgiData($data);
$cantiere = new ProgrammazioneCantiere();

$e_query = $cantiere->carica($data_select);

$numero = $cantiere->numero();

if($numero > 0){
	$data_query = CapovolgiData($data);
	$query_operatore = "SELECT utente FROM tb_programmazione_cantiere WHERE data = '$data_query' GROUP BY data;";
	$e_query_operatore = EseguiQuery($query_operatore, 'selezione');
	$row_operatore = $e_query_operatore->fetch_array();
	$operatore = $row_operatore['utente'];
	
	
}
?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_programmazione_cantiere.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#tabella_programmazione_cantiere").load("php/tabella_programmazione_cantiere.php?data=<?=$data?>");	
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Programmazione Giornaliera");
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <!-- TITOLO -->
        	<div class="col-lg-12">
				<div class="page-title">
					<h1>Programmazione Giornaliera<small> programmazione cantiere</small></h1>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-clock-o fa-lg"></i> Programmazione
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
                    <div class="col-lg-12">
                    	<div class="row">
                    		 <? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN" ){?>
 						<div class="col-lg-2" id="nuova_prog">
                          	<div class="btn btn-success btn-block" id="btn_nuova_programmazione"><i class="fa fa-plus-circle fa-lg"></i> Nuovo</div>
                          	<br>
                          </div>
                          <? } ?>
                           <? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN" ){?>
                          <div class="col-lg-2 clona_ieri">
                          	<div class="btn btn-success btn-block" id="btn_clona_ieri"><i class="fa fa-external-link fa-lg"></i> Clona</div>
                          	<br>
                          </div>
                          
                          <div class="col-lg-2 clona_ieri">
                            <input id="data_clona" class="data_picker form-control" placeholder="Data da clonare" readonly>
                            <br>
                          </div>
                          <? } ?>
                          <div class="col-lg-2" id="data_prog">
                            <input id="data" class="data_picker form-control" value="<?=$data?>" readonly>
                            <br>
                          </div>
                          <div class="col-lg-2">
                            <input id="data" class="form-control" value="Operatore: <?=$operatore?>" readonly>
                            <br>
                          </div>
                          <div class="col-lg-2">
                            <a id="btn_stampa" target="_blank" href="#" class="btn btn-default btn-block"><i class="fa fa-print"></i> Stampa</a>
                          </div>
                          
                       </div>
                        <br>
                    	<div id="tabella_programmazione_cantiere" style="overflow:auto">
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare questo dato? </div>
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
