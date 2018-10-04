<?php
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	
	$id_commessa = $_GET['id_commessa'];
	$id_mezzo = $_GET['id_mezzo'];
	$nome_mezzo = $_GET['nome_mezzo'];

?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_utilizzo.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $("#tabella_utilizzo").load("php/tabella_utilizzo.php?id_commessa=<?=$id_commessa?>&id_mezzo=<?=$id_mezzo?>");	
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Utilizzo per <?=$nome_mezzo?>
                   
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                 <a class="btn btn-info" href="pagina_veicoli.php?id_commessa=<?=$id_commessa?>"><i class="fa fa-reply"></i> Indietro</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <form class="form-horizontal" id="formNewUtilizzo" name="formNewUtilizzo" enctype="multipart/form-data" action='lib/operazioni_utilizzo.lib.php' method='POST'>
                        <div class="col-sm-3 col-lg-3">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Data*:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control data_picker" placeholder="Data" value="<?=date("d-m-Y");?>" id="data" name="data">
                        </div>
                    </div>
                </div>
                        <div class="col-sm-3 col-lg-3">
                    <div class="form-group">
                        <label class="col-md-4 control-label">N. Ore.*:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="N. Ore."  id="n_ore" name="n_ore">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Dettagli:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Dettagli" id="dettagli" name="dettagli">
                            <input type="hidden" id="tipo" name="tipo" value="inserimento" />
                            <input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>
                            <input type="hidden" id="id_mezzo" name="id_mezzo"  value="<?=$id_mezzo?>"/>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-lg-12" style="margin-bottom:10px">
                    <div style="text-align: center">
                        <div style="margin: auto; text-align: center">
                            <div style="margin-left: 10px; margin-top: 2px;" class="btn btn-success" id="btn_nuovo_utilizzo" type="button">Inserisci utilizzo</div>
                        </div>
                    </div>
                </div>
                
            </form>
            <br><br />
            <hr />
                    <div class="col-lg-12 ">
                    	<div id="tabella_utilizzo">
                        	<div style="text-align:center"><img src="img/load.gif"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<br><br>

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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare l'utilizzo del mezzo? </div>
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
