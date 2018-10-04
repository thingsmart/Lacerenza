<?php
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	
	$id_commessa = $_GET['id_commessa'];
	$id_verbale = $_GET['id_verbale'];

?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_categorie.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $("#tabella_categorie").load("php/tabella_categorie.php?id_commessa=<?=$id_commessa?>&id_verbale=<?=$id_verbale?>");	
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	
                	<!-- TITOLO -->
		        	<div class="col-lg-12">
						<div class="page-title">
							<h1>Categorie <small></small><a class="close pull-right" href="pagina_verbali.php?id=<?=$id_commessa?>"><i class="fa fa-backward"></i> Indietro</a></h1>
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
                	 <a class="btn btn-success btn-block" href="nuova_categoria.php?nome=nuovo&id_commessa=<?=$id_commessa?>&id_verbale=<?=$id_verbale?>"><i class="fa fa-plus-circle fa-lg"></i> Aggiungi Categoria</a>
                	</div>
                    <div class="col-lg-9">
                    	<div class="input-group">
                      		<input type="text" id="testo_cerca_categoria" placeholder="Cerca per descrizione" class="form-control">
                      		<span class="input-group-btn">
                        		<button class="btn btn-default" id="cerca_categoria" type="button">cerca</button>
                      		</span>
                    	</div><!-- /input-group -->
                        <br>
                    	
                    </div>
                </div>
                <!-- /.row -->
				<br>
				<div id="tabella_categorie">
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare la categoria? </div>
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
