<?php
    include("lib/controllaSessione.php");
	

	
	include("header.php");
	
	$id=$_GET['id'];
    $_SESSION['id_commessa'] = $id;

	$titolo = ($_GET['nome'] == "nuovo") ? "Nuova Commessa" : "Modifica Commessa";
?>


<!--SCRIPT SITO-->
<script src="js/sito/nuova_commessa.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
	$("#div_nuova_commessa").load("php/div_nuova_commessa.php?id=<?=$id?>");	
	
	<? if($titolo == "Nuova Commessa"){ ?>
		$("#btn_nuova_commessa").show();	
	<? } else {?>
		$("#btn_modifica_commessa").show();	
	<? } ?>
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	<div class="page-title">
					<h1><?=$titolo?> <small> nuova commessa</small><a class="close pull-right" href="commesse.php"><i class="fa fa-backward"></i> Indietro</a></h1>
						<div class="clearfix"></div>
						<ol class="breadcrumb">
							<li class="active">
								<i class="fa fa-edit fa-lg"></i> commessa
							</li>
							<li class="pull-right">
	
							</li>
						</ol>
					</div>                
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12 ">
                    	<div id="div_nuova_commessa">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				  <div class="row">                       
                      <div class="btn btn-success btn-block" id="btn_nuova_commessa" style="display:none"><i class="fa fa-save"></i> Salva</div>
                      <div class="btn btn-success btn-block" id="btn_modifica_commessa" style="display:none"><i class="fa fa-save"></i> Salva</div>                          
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
