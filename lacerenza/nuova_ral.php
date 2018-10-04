<?php
    include("lib/controllaSessione.php");

	
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	

	$id=$_GET['id'];
	$id_commessa=$_GET['id_commessa'];

	$titolo = ($_GET['nome'] == "nuovo") ? "Nuova SAL" : "Modifica SAL";
include ("classi/class.Commesse.php");
include ("databases/db_function.php");
$c = new Commesse();
$e_query_c = $c->caricaCommesseById($_SESSION['id_commessa']);
$row_c = $e_query_c->fetch_array();
?>
<script>
$(document).ready(function() {
	$("#nome_commessa").html("<?=$row_c['descrizione']?>");
});
</script>


<!--SCRIPT SITO-->
<script src="js/sito/nuova_ral.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
    $("#div_nuova_ral").load("php/div_nuova_ral.php?id=<?=$id?>&id_commessa=<?=$id_commessa?>");	
	
	<? if($titolo == "Nuova SAL"){ ?>
		$("#btn_nuova_ral").show();	
	<? } else {?>
    $("#btn_modifica_ral").show();
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
							<h1><?=$titolo?> <small> gestione singola sal</small><a class="close pull-right" href="pagina_contabilita.php?id=<?=$id_commessa?>"><i class="fa fa-backward"></i> Indietro</a>  </h1>
							<div class="clearfix"></div>
							<ol class="breadcrumb">
								<li class="active">
									<i class="fa fa-file-text-o fa-lg"></i> Modifica Sal
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
                    	<div id="div_nuova_ral">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
                        <div class="btn btn-success btn-block" id="btn_nuova_ral" style="display:none"><i class="fa fa-save"></i> Salva e allega</div>
                		<div class="btn btn-success btn-block" id="btn_modifica_ral" style="display:none"><i class="fa fa-save"></i> Salva e allega</div>   
                    </div>
                </div>
                <!-- /.row -->
			
				
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
        <input id="id_commessa_da_eliminare" type="hidden" value="<?=$id_commessa?>"/>
        <input id="nome_da_eliminare" type="hidden" />
        <button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_elimina_conferma" class="btn btn-danger">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->

<input type="hidden" id="id_commessa" value="<?=$id_commessa?>"/>
<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>