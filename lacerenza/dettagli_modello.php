<?php
	include("lib/controllaSessione.php");
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	

	$id=$_GET['model'];

	$titolo = "Dettagli Modello";
	
?>

<!-- <script src="js/JQuery/jquery.form.js" type="text/javascript"></script>
<script src="js/JQuery/jquery.validate.min.js" type="text/javascript"></script> -->

<script>
$(document).ready(function() {
	$("#div_nuovo_dettaglio_modello").load("php/div_nuovo_dettaglio_modello.php?model=<?=$id?>");
    $("#tabella_dettagli_modello").load("php/tabella_dettagli_modello.php?model=<?=$id?>");	
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Dettagli Modello Preventivo");
});
</script>

<style>
	span{
		color: #000;
	}
</style>

	<div id="page-wrapper">

    	<div class="container-fluid">
	
	        <!-- Page Heading -->
	        <div class="row">
                  
		        <!-- TITOLO -->
				<div class="col-lg-12">
					<div class="page-title">
						<h1>Preventivi <small>dettagli modello preventivo</small> <a class="btn btn-default pull-right" href="pagina_modelli.php"><i class="fa fa-arrow-left"></i> Indietro</a></h1>
						<ol class="breadcrumb">
							<li class="active">
								<i class="fa fa-file-pdf-o fa-lg"></i> Preventivi -> Dettagli Modelli Preventivi
							</li>
							<li class="pull-right">
			
							</li>
						</ol>
					</div>
				</div>
		        <!-- / END: TITOLO  -->      
                         
			</div>
            <!-- /.row -->

	        <div class="col-lg-12 ">
	    		<div id="div_nuovo_dettaglio_modello">
	        		<div style="text-align:center"><img src="img/load.gif"/></div>
	        	</div>
	        </div>
	        
			<!-- INIZIO: Pannelli Sezioni -->
			<div class="col-lg-12 ">&nbsp;</div>
	        <div class="col-lg-12 ">
	    		<div id="tabella_dettagli_modello" style="overflow: auto">
	        		<div style="text-align:center"><img src="img/load.gif"/></div>
	        	</div>
	        </div>
	        <!-- FINE: Pannelli Sezioni -->

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
      		<div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare la sezione? </div>
      		<div class="modal-footer">
        		<input id="id_da_eliminare" type="hidden" />
        		<input id="id_box" type="hidden" />
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

<script>
$(document).ready(function() {

});

	var config = {
	    '.chosen-select': { width: "100%"},
	    '.chosen-select-deselect': {allow_single_deselect: true},
	    '.chosen-select-no-single': {disable_search_threshold: 10},
	    '.chosen-select-no-results': {no_results_text: 'Oops, nessun risultato..!'},
	    '.chosen-select-width': {width: "95%"}
	}
	for (var selector in config) {
	    $(selector).chosen(config[selector]);
	}
	
</script>

</body>

</html>
