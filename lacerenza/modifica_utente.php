<?php
    include("lib/controllaSessione.php");
	//include("lib/controllaAutorizzazioni.php");

	
	include("header.php");
	
	$id=$_GET['id'];

	$titolo = ($_GET['nome'] == "nuovo") ? "Nuovo Utente" : "Modifica Utente";
?>


<!--SCRIPT SITO-->
<script src="js/sito/modifica_utente.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
	$("#div_nuovo_utente").load("php/div_nuovo_utente.php?id=<?=$id?>");	
	
	<? if($titolo == "Nuovo Utente"){ ?>
		$("#btn_nuovo_utente").show();	
	<? } else {?>
		$("#btn_modifica_utente").show();	
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
					<h1> <?=$titolo?> <small> gestione dell'utente</small><a class="close pull-right" href="utenti.php"><i class="fa fa-backward"></i> Indietro</a></h1>
					<div class="clearfix"></div>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-users fa-lg"></i>  <?=$titolo?>
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
                    	<div id="div_nuovo_utente">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
                        <div class="row">
                        	<div class="col-lg-12">                   
				            	
								<div class="btn btn-success btn-block" id="btn_nuovo_utente" style="display:none"><i class="fa fa-save"></i> Salva</div>
				                <div class="btn btn-success btn-block" id="btn_modifica_utente" style="display:none"><i class="fa fa-save"></i> Salva</div>
			                </div>            	                   
                		</div>
                    </div>
                </div>
                <!-- /.row -->
                 
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare l'utente? </div>
      <div class="modal-footer">
        <div id="id_da_eliminare" style="display:none"></div>
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
