<?php
	include("header.php");
    include("lib/controllaSessione.php");
	include("databases/db_function.php");
	require_once("lib/verificaConvertiData.php");
	require_once("classi/class.PreventivoMaster.php");
	require_once("classi/class.Sezione.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
	
	if($id != ""){
		
		$preventivo_master = new PreventivoMaster();
		$dati_prev_master = $preventivo_master->getById($id);
		
		$id = $dati_prev_master->id;
		$numpreventivo = $dati_prev_master->numpreventivo;
		$datapreventivo = CapovolgiData($dati_prev_master->datapreventivo);
		$cliente = $dati_prev_master->cliente;
		$descrizione = $dati_prev_master->descrizione;
		
	} else {

	}
	
	$fade = ($browser == 0) ? "fade" : "";	
	
	$titolo = "Dettagli Preventivo";
	
?>
<style>
.page-title {
    margin: 30px 0px;
}
</style>

<script>
$(document).ready(function() {
    $("#tabella_dettagli_preventivo").load("php/tabella_dettagli_preventivo.php?id=<?=$id?>");	
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Dettaglio Preventivo");
});
</script>

	<div id="page-wrapper">

    	<div class="container-fluid">
	
	        <!-- Page Heading -->
	        <div class="row">
                  
		        <!-- TITOLO -->
				<div class="col-lg-12">
					<div class="page-title">
						<h1>Preventivi <small>dettaglio preventivo </small> <a class="btn btn-default pull-right" href="pagina_riepilogo_preventivi.php"><i class="fa fa-arrow-left"></i> Indietro</a></h1>
						<ol class="breadcrumb">
							<li class="active">
								<i class="fa fa-file-pdf-o fa-lg"></i> Preventivi -> Dettaglio Preventivo
							</li>

						</ol>
					</div>
					<a href="print_pdf.php?id=<?=$id?>&page=print_preventivo" target="_blank" class="btn btn-danger pull-right" style="margin-bottom: 10px"><i class="fa fa-file-pdf-o"></i> Stampa Preventivo</a> 
				</div>
		        <!-- / END: TITOLO  -->     
     
			</div>
            <!-- /.row -->
            
            <div class="row">
            	
            	<div class="col-lg-12">
            		
            		<div class="col-lg-12 text-center" style="background: #e0e7e8; border-radius: 4px; padding: 10px;">
					
						Dettagli Preventivo
						<br>
						<font style="font-size: 25px; margin-top: 10px"><b><?=$numpreventivo?></b> <small>del</small> <b><?=$datapreventivo?></b></font>
						<br>
						<font style="font-size: 25px; margin-top: 10px"><b><?=$cliente?></b></font>
						<br>
						<?=$descrizione?>
					</div>

            	</div>
            	
            </div>
            
            <br><br>

			<div class="row">
			    <div class="col-lg-12">
			    	
		    		<div id="tabella_dettagli_preventivo" style="overflow: auto">
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


<!-- INIZIO: Modale Elimina -->
<div class="modal <?=$fade?> bs-elimina" tabindex="-1" role="dialog" id="dialog_elimina" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       			<h4 class="modal-title" id="myModalLabel">Modifica Importo</h4>
      		</div>
      		<div class="modal-body" id="modal_body" >
      			<label>Importo:</label>
      			<input type="text" class="form-control" id="valore_importo" name="valore_importo"/>
      		</div>
      		<div class="modal-footer">
        		<input id="id_da_modificare" type="hidden" />
        		<input id="id_modello" type="hidden" />
        		<input id="id_prev_master" type="hidden" />
        		<button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        		<button type="submit" id="btn_conferma_importo" class="btn btn-danger">Conferma</button>
      		</div>
    	</div>
	</div>
</div>
<!-- FINE: Modale Elimina -->

<!-- INIZIO: Modale Quantità -->
<div class="modal <?=$fade?> bs-quantita" tabindex="-1" role="dialog" id="dialog_elimina" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       			<h4 class="modal-title" id="myModalLabel">Modifica Quantit&agrave;</h4>
      		</div>
      		<div class="modal-body" id="modal_body" >
      			<label>Quantit&agrave;:</label>
      			<input type="text" class="form-control" id="valore_quantita" name="valore_quantita"/>
      		</div>
      		<div class="modal-footer">
        		<input id="id_da_modificare_qta" type="hidden" />
        		<input id="id_modello_qta" type="hidden" />
        		<input id="id_prev_master_qta" type="hidden" />
        		<button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        		<button type="submit" id="btn_conferma_quantita" class="btn btn-danger">Conferma</button>
      		</div>
    	</div>
	</div>
</div>
<!-- FINE: Modale Quantità -->

<!-- INIZIO: Modale Descrizione -->
<div class="modal <?=$fade?> bs-descrizione" tabindex="-1" role="dialog" id="dialog_elimina" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       			<h4 class="modal-title" id="myModalLabel">Modifica Descrizione</h4>
      		</div>
      		<div class="modal-body" id="modal_body" >
      			<label>Descrizione:</label>
				<div id="summernote"></div>
				<textarea style="display: none" class="form-control" id="testosezione" name="testosezione"></textarea>
      		</div>
      		<div class="modal-footer">
        		<input id="id_da_modificare_desc" type="hidden" />
        		<input id="id_modello_desc" type="hidden" />
        		<input id="id_prev_master_desc" type="hidden" />
        		<button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        		<button type="submit" id="btn_conferma_descrizione" class="btn btn-danger">Conferma</button>
      		</div>
    	</div>
	</div>
</div>
<!-- FINE: Modale Descrizione -->


<?php
	include("footer.php");
?>

<!-- <script>
	$(document).ready(function() {
		
		$('#summernote').summernote({
			'lang': 'it-IT'
		});
		
	});
</script> -->


</body>

</html>
