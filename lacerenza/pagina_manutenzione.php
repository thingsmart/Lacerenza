<?php
	include("header.php");
include("lib/verificaConvertiData.php");
	include("databases/db_function.php");
require_once("classi/class.Manutenzione.php");




?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_manutenzione.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#tabella_mezzi_manutenzione").load("php/tabella_mezzi_manutenzione.php");	
});
</script>
<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Manutenzione");
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                   <!-- TITOLO -->
                   
        	<div class="col-lg-12">
				<div class="page-title">
					<h1>Manutenzione <small> configurazione opzioni</small></h1>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-gears fa-lg"></i> Manutenzione
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
							<div class="input-group">
                      		<input type="text" id="testo_cerca_mezzo" placeholder="Cerca per mezzo o targa" class="form-control">
                      		<span class="input-group-btn">
                        		<button class="btn btn-default" id="cerca_mezzo" type="button">cerca</button>
                      		</span>
                    	</div><!-- /input-group -->
                    	
                         
                	</div>
           </div><br>
                <div class="row">
                	
                    <div class="col-lg-12">
						
                       <div id="tabella_mezzi_manutenzione" style="overflow:auto">
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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare questo dato? </div>
      <div class="modal-footer">
        <input id="id_da_eliminare" type="hidden" />
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
