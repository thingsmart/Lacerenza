<?php
    include("lib/controllaSessione.php");

	
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	

	$id=$_GET['id'];

	$titolo = ($_GET['nome'] == "nuovo") ? "Nuovo Modello" : "Modifica Modello";
?>


<!--SCRIPT SITO
<script src="js/sito/nuova_tecnica.js" type="text/javascript"></script>-->

<script src="js/JQuery/jquery.form.js" type="text/javascript"></script>
<script src="js/JQuery/jquery.validate.min.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $("#div_nuovo_modello").load("php/div_nuovo_modello.php?id=<?=$id?>");	
	

});
</script>


	<div id="page-wrapper">

    	<div class="container-fluid">
	
	        <!-- Page Heading -->
	        <div class="row">
                	
                <!-- TITOLO -->
				<div class="col-lg-12">
					<div class="page-title">
						<h1><?=$titolo?> <small></small> <a class="btn btn-default pull-right" href="pagina_modelli.php"><i class="fa fa-arrow-left"></i> Indietro</a></h1>
						<div class="clearfix"></div>
						<ol class="breadcrumb">
							<li class="active">
								<i class="fa fa-file-pdf-o fa-lg"></i> Preventivi -> Nuovo Modello
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
                    	<div id="div_nuovo_modello">
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
