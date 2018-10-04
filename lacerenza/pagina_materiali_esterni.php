<?php
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	
	$id_commessa = $_GET['id'];

include ("classi/class.Commesse.php");
include ("databases/db_function.php");
require_once("lib/verificaConvertiData.php");
require_once("classi/class.MaterialiEsterni.php");
$c = new Commesse();
$e_query_c = $c->caricaCommesseById($id_commessa);
$row_c = $e_query_c->fetch_array();


$da_data = isset($_GET['da_data']) ? CapovolgiData($_GET['da_data']) : "";
$a_data = isset($_GET['a_data']) ? CapovolgiData($_GET['a_data']) : "";
$tipologia = isset($_GET['tipologia']) ? $_GET['tipologia'] : "";
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : "";
$da_data = ($da_data == "--") ? "" : $da_data;
$a_data = ($a_data == "--") ? "" : $a_data;

$fatture = new MaterialiEsterni();

$query_fatture = "SELECT * FROM tb_fattura_materiali_esterni WHERE id_commessa = $id_commessa AND tipo_documento LIKE '%$tipologia%'  ORDER BY data_pagamento DESC  LIMIT 1;";
$e_query_fattura = EseguiQuery($query_fatture,"selezione");

if($e_query_fattura->num_rows > 0){
    $dati_fatture = $e_query_fattura->fetch_array();
    $data_passo_ultimo = CapovolgiData($dati_fatture['data_pagamento']);
}
?>
<script>
$(document).ready(function() {
	$("#nome_commessa").html("<?=$row_c['descrizione']?>");
});
</script>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_materiali_esterni.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $("#tabella_materiali_esterni").load("php/tabella_materiali_esterni.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=<?=$tipologia?>&tipo=<?=$tipo?>");
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	
                	<!-- TITOLO -->
		        	<div class="col-lg-12">
						<div class="page-title">
							<h1>Costo Forniture Esterne <small></small></h1>
							<div class="clearfix"></div>
							<ol class="breadcrumb">
								<li class="active">
									
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
                	<div class="col-lg-3">
                    		<a class="btn btn-success btn-block" href="nuova_fattura_materiali_esterni.php?nome=nuovo&id_commessa=<?=$id_commessa?>&tipologia=<?=$tipologia?>&data_ultimo=<?=$data_passo_ultimo?>"><i class="fa fa-plus-circle fa-lg"></i> Aggiungi Fattura</a>
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
                    <div class="col-lg-3">
                    	<div class="input-group">
                      		<input type="text" id="testo_cerca_fattura" placeholder="Cerca per tipo o fornitore" value="<?=$tipologia?>" class="form-control">
                      		<span class="input-group-btn">
                        		<button class="btn btn-default" id="cerca_fattura" type="button">cerca</button>
                      		</span>
                    	</div><!-- /input-group -->
                        <br>
                    	
                    </div>
                </div>
                <!-- /.row -->
				<br>
				<div id="tabella_materiali_esterni">
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare la fattura? </div>
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
