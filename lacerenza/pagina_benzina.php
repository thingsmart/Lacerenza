<?php
include("header.php");
include("lib/verificaConvertiData.php");

$fade = ($browser == 0) ? "fade" : "";	
$id_mezzo = $_GET['id'];
$targa = $_GET['targa'];
$data_inizio = isset($_GET['data_inizio']) ? $_GET['data_inizio'] : date("Y-01-01");
$data_fine = isset($_GET['data_fine']) ? $_GET['data_fine'] : date("Y-12-31");

$data_inizio = CapovolgiData($data_inizio);
$data_fine = CapovolgiData($data_fine);

?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_benzina.js" type="text/javascript"></script>

<script>
    $(document).ready(function () {
        $("#tabella_benzina").load("php/tabella_benzina.php?id=<?=$id_mezzo?>&data_inizio=<?=$data_inizio?>&data_fine=<?=$data_fine?>");
    });
</script>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
        		<!-- TITOLO -->
        	<div class="col-lg-12">
				<div class="page-title">
					<h1>Ticket Esso Card <small> Veicolo targato: <span class="text-green"><?=$targa?></span></small><a class="close pull-right" href="pagina_mezzi.php?data_inizio=<?=$data_inizio?>&data_fine=<?=$data_fine?>"><i class="fa fa-backward"></i> Indietro</a></h1>
					<div class="clearfix"></div>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-tint fa-lg"></i> Carburanti
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
        	<div class="col-lg-2">
        		<a class="btn btn-success btn-block" href="nuova_benzina.php?nome=nuovo&id_mezzo=<?=$id_mezzo?>&targa=<?=$targa?>&data_inizio=<?=$data_inizio?>&data_fine=<?=$data_fine?>"><span class="number-left">+</span> Aggiungi</a>
        		<br>
        	</div>
            <div class="col-lg-10 ">
                <div class="input-group">
                    <input type="text" id="testo_cerca_benzina" placeholder="Cerca ticket esso card" class="form-control">
                    <span class="input-group-btn">
                        <button class="btn btn-default" id="cerca_benzina" type="button">cerca</button>
                    </span>
                </div>
                <!-- /input-group -->
                <br>
               
            </div>
        </div>
        <!-- /.row -->
        <br>
         <div id="tabella_benzina">
                    <div style="text-align: center">
                        <img src="img/load.gif" />
                    </div>
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
            <div class="modal-body" id="modal_body">Sei sicuro di voler eliminare questa riga? </div>
            <div class="modal-footer">
                <input id="id_da_eliminare" type="hidden" />
                <input id="nome_da_eliminare" type="hidden" />
                <div id="username_da_eliminare" style="display: none"></div>
                <button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
                <button type="submit" id="btn_elimina_conferma" class="btn btn-danger">Conferma</button>
            </div>
        </div>
    </div>
</div>
<!--FINE modal elimina-->

<!--Modal dettagli-->
<div class="modal <?=$fade?> bs-dettagli" tabindex="-1" role="dialog" id="dialog_dettagli" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Dettagli</h4>
            </div>
            <div class="modal-body" id="modal_body" style="text-align: center">
                <div style="margin: auto">
                    <div class="form-group" style="display:none">
                        <label class="col-md-4 control-label">N.Carta:</label>
                        <div class="col-md-8">
                            <input type="text" id="numero_carta_modal" disabled />
                        </div>
                    </div>
                    <br />
                    <br />
                    <div class="form-group">
                        <label class="col-md-4 control-label">Titolare Carta:</label>
                        <div class="col-md-8">
                            <input type="text" id="titolare_carta_modal" disabled />
                        </div>
                    </div>
                    <br />
                    <br />
                    <div class="form-group">
                        <label class="col-md-4 control-label">Localit&agrave;:</label>
                        <div class="col-md-8">
                            <input type="text" id="localita_modal" disabled />
                        </div>
                    </div>
                </div>
                <br />
                <br />
                <div class="form-group">
                    <label class="col-md-4 control-label">Targa:</label>
                    <div class="col-md-8">
                        <input type="text" id="targa_modal" disabled />
                    </div>
                </div>
               
                <div class="form-group" style="display:none">
                    <label class="col-md-4 control-label">Codice autista:</label>
                    <div class="col-md-8">
                        <input type="text" id="codice_autista_modal" disabled />
                    </div>
                </div>
                <br />
                <br />
                 <div class="form-group">
                    <label class="col-md-4 control-label">Km veicolo:</label>
                    <div class="col-md-8">
                        <input type="text" id="km_veicolo_modal" disabled />
                    </div>
                </div>
                <br />
                <br />
                 <div class="form-group" style="display:none">
                    <label class="col-md-4 control-label">Servizio:</label>
                    <div class="col-md-8">
                        <input type="text" id="servizio_modal" disabled />
                    </div>
                </div>
               
                 <div class="form-group" style="display:none">
                    <label class="col-md-4 control-label">Sconto:</label>
                    <div class="col-md-8">
                        <input type="text" id="sconto_modal" disabled />
                    </div>
                </div>
               
                <div class="form-group" style="display:none">
                    <label class="col-md-4 control-label">Pr. Unit. escl. IVA:</label>
                    <div class="col-md-8">
                        <input type="text" id="prezzo_escluso_iva_modal" disabled />
                    </div>
                </div>
                <br />
                <br />
                <div class="form-group" style="display:none">
                    <label class="col-md-4 control-label">Aliq. IVA:</label>
                    <div class="col-md-8">
                        <input type="text" id="aliq_iva_modal" disabled />
                    </div>
                </div>
                
                <div class="form-group" style="display:none">
                    <label class="col-md-4 control-label">Importo IVA:</label>
                    <div class="col-md-8">
                        <input type="text" id="importo_iva_modal" disabled />
                    </div>
                </div>
            </div>
          
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
</div>
</div>
<!--FINE modal dettagli-->
<input type="hidden" value="<?=$id_mezzo?>" id="id_mezzo_search" />

<!-- footer -->
<?php
include("footer.php");
?>


</body>

</html>
