<?php
    include("lib/controllaSessione.php");
require_once("lib/verificaConvertiData.php");

	
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	

	$id=$_GET['id'];
	$id_mezzo=$_GET['id_mezzo'];
$data_inizio = isset($_GET['data_inizio']) ? $_GET['data_inizio'] : "";
$data_fine = isset($_GET['data_fine']) ? $_GET['data_fine'] : "";
$targa = isset($_GET['targa']) ? $_GET['targa'] : "";


	$titolo = ($_GET['nome'] == "nuovo") ? "Nuovo Tagliando" : "Modifica Tagliando";
	
	if($_GET['nome'] == "nuovo"){
		$data_inizio = ($data_inizio != "") ? capovolgiData($data_inizio) : date("Y-01-01");
		$data_fine = ($data_fine != "") ? capovolgiData($data_fine) : date("Y-12-31");
	}
?>


<!--SCRIPT SITO-->
<script src="js/sito/nuovo_tagliando.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
	$("#div_nuovo_tagliando").load("php/div_nuovo_tagliando.php?id=<?=$id?>&id_mezzo=<?=$id_mezzo?>");	
	
	<? if($titolo == "Nuovo Tagliando"){ ?>
		$("#btn_nuovo_tagliando").show();	
	<? } else {?>
		$("#btn_modifica_tagliando").show();	
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
				<h1><?=$titolo?> <small> aggiungi tagliando veicolo: <?=$targa?></small><a class="close pull-right" href="pagina_tagliandi.php?id=<?=$id_mezzo?>&data_fine=<?=$data_fine?>&data_inizio=<?=$data_inizio?>&targa=<?=$targa?>"><i class="fa fa-backward"></i> Indietro</a>
</h1>
					<div class="clearfix"></div>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-dashboard fa-lg"></i> Tagliando
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
                    	<div id="div_nuovo_tagliando">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<br>
				<div class="btn btn-success btn-block" id="btn_nuovo_tagliando" style="display:none"><i class="fa fa-save"></i> Salva e allega</div>
                <div class="btn btn-success btn-block" id="btn_modifica_tagliando" style="display:none"><i class="fa fa-save"></i> Salva e allega</div>
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare l'allegato? </div>
      <div class="modal-footer">
        <input id="id_da_eliminare" type="hidden" value="<?=$id?>"/>
        <input id="id_mezzo_da_eliminare" type="hidden" value="<?=$id_mezzo?>"/>
        <input id="nome_da_eliminare" type="hidden" />
        <button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_elimina_conferma" class="btn btn-danger">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->

<input type="hidden" id="id_mezzo" value="<?=$id_mezzo?>"/>
<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
