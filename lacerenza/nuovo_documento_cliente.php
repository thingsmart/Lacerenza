<?php
    include("lib/controllaSessione.php");

	
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	

	$id=$_GET['id'];
	$id_commessa=$_GET['id_commessa'];

	$titolo = ($_GET['nome'] == "nuovo") ? "Nuovo Documento" : "Modifica Documento";

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
<script src="js/sito/nuovo_documento_cliente.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
    $("#div_nuovo_documento_cliente").load("php/div_nuovo_documento_cliente.php?id=<?=$id?>&id_commessa=<?=$id_commessa?>");	
	
	<? if($titolo == "Nuovo Documento"){ ?>
		$("#btn_nuovo_documento_cliente").show();	
	<? } else {?>
    $("#btn_modifica_documento_cliente").show();
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
							<h1><?=$titolo?> <small></small> <a class="close pull-right" href="pagina_documenti_cliente.php?id=<?=$id_commessa?>"><i class="fa fa-backward"></i> Indietro</a></h1>
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
                    	<div id="div_nuovo_documento_cliente">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<br>
				 	<div class="btn btn-success btn-block" id="btn_nuovo_documento_cliente" style="display:none"><i class="fa fa-save"></i> Salva e allega</div>
                    <div class="btn btn-success btn-block" id="btn_modifica_documento_cliente" style="display:none"><i class="fa fa-save"></i> Salva e allega</div>
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
