<?php
	include("header.php");

	$fade = ($browser == 0) ? "fade" : "";	
	
?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_modelli.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
    $("#tabella_modelli").load("php/tabella_modelli.php");	
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Modelli Preventivi");
});
</script>

	<div id="page-wrapper">

    	<div class="container-fluid">
	
	        <!-- Page Heading -->
	        <div class="row">
                  
		        <!-- TITOLO -->
				<div class="col-lg-12">
					<div class="page-title">
						<h1>Preventivi <small>modelli preventivi </small> <a class="btn btn-default pull-right" href="pagina_preventivi.php"><i class="fa fa-arrow-left"></i> Indietro</a></h1>
						<ol class="breadcrumb">
							<li class="active">
								<i class="fa fa-file-pdf-o fa-lg"></i> Preventivi -> Modelli Preventivi
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
			        <div class="col-lg-2">
			            <a class="btn btn-success btn-block" href="nuovo_modello.php?nome=nuovo"><span class="number-left">+</span> Aggiungi</a>
			            <br>
			        </div>
			        <div class="col-lg-10">
				    	<div class="input-group">
				      		<input type="text" id="testo_cerca" placeholder="Cerca.." class="form-control">
				      		<span class="input-group-btn">
				        		<button class="btn btn-default" id="cerca" type="button"><i class="fa fa-search"></i> Cerca</button>
				      		</span>
				    	</div><!-- /input-group -->
			        </div>
			        <div class="col-lg-12 ">&nbsp;</div>
			        <div class="col-lg-12 ">
			    		<div id="tabella_modelli" style="overflow: auto">
			        		<div style="text-align:center"><img src="img/load.gif"/></div>
			        	</div>
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare la sezione? </div>
      <div class="modal-footer">
        <input id="id_da_eliminare" type="hidden" />
        <button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_elimina_conferma" class="btn btn-danger">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->

<!-- INIZIO: Modale Descrizione -->
<div class="modal <?=$fade?> bs-descrizione" tabindex="-1" role="dialog" id="dialog_elimina" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       			<h4 class="modal-title" id="myModalLabel">Riepilogo Modello</h4>
      		</div>
      		<div class="modal-body" id="modal_body" >
      			<div id="testo_riepilogo" name="testo_riepilogo" style="color: #000"></div> 			
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Ho Letto!</button>
      		</div>
    	</div>
	</div>
</div>
<!-- FINE: Modale Descrizione -->

<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
