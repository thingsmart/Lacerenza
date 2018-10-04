<?php
include("header.php");

include("lib/verificaConvertiData.php");

	$fade = ($browser == 0) ? "fade" : "";	
	$data = isset($_GET['data']) ? $_GET['data'] : date("Y-m-d");
	$data = ($data != "") ? capovolgiData($data) : date("d-m-Y");
$a_data = isset($_GET['a_data']) ? $_GET['a_data'] : date("Y-m-d");
$a_data = ($a_data != "") ? capovolgiData($a_data) : date("d-m-Y");

?>

<!--SCRIPT SITO-->
<script src="js/sito/magazzino.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#tabella_magazzino").load("php/tabella_magazzino.php?data=<?=$data?>&a_data=<?=$a_data?>");
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Carico giornaliero");
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	
                	
                    <!-- TITOLO -->
		        	<div class="col-lg-12">
						<div class="page-title">
							<h1>Carico giornaliero <small> gestione magazzino</small></h1>
							<ol class="breadcrumb">
								<li class="active">
									<i class="fa fa-building fa-lg"></i> Carico giornaliero
								</li>
								<li class="pull-right">
		
								</li>
							</ol>
						</div>
					</div>
            		<!-- / END: TITOLO  -->        
          		</div>
                    
        
                <div class="row">
                    <div class="col-lg-12">                  	
                      <div class="row">
 <div class="col-lg-2">
                            <br>
                          	<div class="btn btn-success btn-block" id="btn_nuovo_magazzino"><span class="number-left">+</span> Nuovo</div>
                          	<br>
                          </div>
                          <div class="col-lg-2">
                              <div style="float:left">Da: </div>
                            <input id="data" class="data_picker form-control" value="<?=$data?>" readonly>
                            <br>
                          </div>
                          <div class="col-lg-2">
                              <div style="float:left">A: </div>
                              <input id="a_data" class="data_picker form-control" value="<?=$a_data?>" readonly>
                              <br>
                          </div>
                          <div class="col-lg-2">
                                <br>
                              <div id="cerca" class="btn btn-success">Cerca</div>
                              <br>
                          </div>
                       </div>
                    	<div id="tabella_magazzino" style="overflow:auto">
                        	<div style="text-align:center"><img src="img/load.gif"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
			
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
