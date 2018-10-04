<?php
    include("lib/controllaSessione.php");

	
	include("header.php");
	
	$id=$_GET['id'];

	$titolo = ($_GET['nome'] == "nuovo") ? "Nuovo Mezzo" : "Modifica Mezzo";
?>


<!--SCRIPT SITO-->
<script src="js/sito/nuovo_mezzo.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
	$("#div_nuovo_mezzo").load("php/div_nuovo_mezzo.php?id=<?=$id?>");	
	
	<? if($titolo == "Nuovo Mezzo"){ ?>
		$("#btn_nuovo_mezzo").show();	
	<? } else {?>
		$("#btn_modifica_mezzo").show();	
	<? } ?>
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	<div class="col-lg-12">
						<div class="page-title">
							<h1><?=$titolo?> <small> aggiungi mezzo</small>  <a class="close pull-right" href="pagina_mezzi.php"><i class="fa fa-backward"></i> Indietro</a></h1>
							<div class="clearfix"></div>
							<ol class="breadcrumb">
								<li class="active">
									<i class="fa fa-truck fa-lg"></i> Dashboard
								</li>
								<li class="pull-right">
		
								</li>
							</ol>
						</div>               	
                   
                </div>
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <div class="col-lg-12 ">
                    	<div id="div_nuovo_mezzo">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <br>
				<div class="btn btn-success btn-block" id="btn_nuovo_mezzo" style="display:none"><i class="fa fa-save"></i> Salva</div>
                <div class="btn btn-success btn-block" id="btn_modifica_mezzo" style="display:none"><i class="fa fa-save"></i> Salva</div>

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
