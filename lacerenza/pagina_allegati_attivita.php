<?php
include("header.php");

$fade = ($browser == 0) ? "fade" : "";	
$id_commessa = $_GET['id_commessa'];
$id_attivita = $_GET['id_attivita'];

?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_allegati_attivita.js" type="text/javascript"></script>

<script>
    $(document).ready(function () {
        $("#tabella_allegati_attivita").load("php/tabella_allegati_attivita.php?id_commessa=<?=$id_commessa?>&id_attivita=<?=$id_attivita?>");
    });
</script>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
        	
        	<!-- TITOLO -->
			<div class="col-lg-12">
				<div class="page-title">
					<h1>Allegati Attivit&agrave; <small></small> <a class="close pull-right" href="pagina_attivita.php?id=<?=$id_commessa?>"><i class="fa fa-backward"></i> Indietro</a></h1>
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
            <form class="form-horizontal" id="formNewAllegato" name="formNewAllegato" enctype="multipart/form-data" action='lib/operazioni_attivita.lib.php' method='POST'>
			
			<div class="row">
                <div class="col-sm-6 col-lg-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Descrizione*:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Descrizione" id="descrizione" name="descrizione">
                            <input type="hidden" id="tipo" name="tipo" value="inserisci_allegato" />
                            <input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>
                            <input type="hidden" id="id_attivita" name="id_attivita"  value="<?=$id_attivita?>"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Ricevuto in data*:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control data_picker" placeholder="Ricevuto in data" value="<?=date("d-m-Y");?>" id="data_ricevuto" name="data_ricevuto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Inviato in data*:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control data_picker" placeholder="Inviato in data" value="<?=date("d-m-Y");?>" id="data_inviato" name="data_inviato">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                    <div class="form-group">
                        <label class="col-md-4 control-label">A*:</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="A" id="inviato_a" name="inviato_a">
                        </div>
                    </div>                    
                </div>                
              </div>
              <div class="row">
              	<div class="col-sm-6 col-lg-6">
                    <div>
                        <label class="col-md-4 control-label">Allega un file:</label>
                        <div class="col-md-6">
                            <input class="btn" type="file" id="files" name="files" />
                        </div>
                        <div class="btn btn-default col-md-2" id="nuovo_allegato" type="button"><i class="fa fa-paperclip"></i> Allega File</div>
                    </div>                    
                </div>
                <!-- <div class="col-lg-12">
                    <div>
                        <div class="form-group">
                            <input class="btn col-lg-6" type="file" id="files" name="files" />
                            <div class="btn col-lg-6" id="nuovo_allegato" type="button"><i class="fa fa-paperclip"></i> Allega File</div>
                        </div>
                    </div>
                </div> -->
             </div>
            </form>
            <br>
           
            <div class="col-lg-12 " style="margin-top:10px">
                <div id="tabella_allegati_attivita">
                    <div style="text-align: center">
                        <img src="img/load.gif" style="width: 100px" />
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <br>
        <br>
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
            <div class="modal-body" id="modal_body">Sei sicuro di voler eliminare l'allegato? </div>
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
