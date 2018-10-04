<?php
    include("lib/controllaSessione.php");

	
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	

	$id=$_GET['id'];
$id_commessa=$_GET['id_commessa'];
$tipologia=$_GET['tipologia'];
$data_ultimo = $_GET['data_ultimo'];

	$titolo = ($_GET['nome'] == "nuovo") ? "Nuova Fattura" : "Modifica Fattura";
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
<script src="js/sito/nuova_fattura_materiali_esterni.js?1" type="text/javascript"></script>


<script>
$(document).ready(function() {
    $("#div_nuova_fattura_materiali_esterni").load("php/div_nuova_fattura_materiali_esterni.php?id=<?=$id?>&id_commessa=<?=$id_commessa?>&tipologia=<?=$tipologia?>&data_ultimo=<?=$data_ultimo?>");
	
	<? if($titolo == "Nuova Fattura"){ ?>
		$("#btn_nuova_fattura").show();	
	<? } else {?>
    $("#btn_modifica_fattura").show();
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
							<h1> <?=$titolo?> <small></small><a class="close pull-right" href="pagina_materiali_esterni.php?id=<?=$id_commessa?>&tipologia=<?=$tipologia?>"><i class="fa fa-backward"></i> Indietro</a></h1>
							<div class="clearfix"></div>
							<ol class="breadcrumb">
								<li class="active">
									
								</li>
								<li class="pull-right">
		
								</li>
							</ol>
						</div>
					</div>
					<!-- / TITOLO -->             	
                
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <div class="col-lg-12 ">
                    	<div id="div_nuova_fattura_materiali_esterni">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<br>
				 <div class="btn btn-success btn-block" id="btn_nuova_fattura" style="display:none"><i class="fa fa-save"></i> Salva e allega</div>
                                 <div class="btn btn-success btn-block" id="btn_modifica_fattura" style="display:none"><i class="fa fa-save"></i> Salva e allega</div>

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
