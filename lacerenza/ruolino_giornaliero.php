<?php
include ("header.php");
include ("lib/verificaConvertiData.php");

$fade = ($browser == 0) ? "fade" : "";
$data = isset($_GET['data']) ? $_GET['data'] : date("Y-m-d");
$data = ($data != "") ? capovolgiData($data) : date("d-m-Y");
?>

<!--SCRIPT SITO-->
<script src="js/sito/ruolino_giornaliero.js" type="text/javascript"></script>

<script>
	$(document).ready(function() {
$("#tabella_ruolino_giornaliero").load("php/tabella_ruolino_giornaliero.php?data=<?=$data?>
	");
	});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Ruolino | <?=$data?>");
});
</script>

<div id="page-wrapper">

	<div class="container-fluid">
	
	<div class="">
		<!-- Page Heading -->
		<div class="row">
		
		<!-- TITOLO -->
        	<div class="col-lg-12 head-fix">
				<div class="page-title">
					<h1>Ruolino <small> ruolino giornaliero</small></h1>
					<ol class="breadcrumb">
						<li class="active">
						    <i class="fa fa-calendar fa-lg">  <strong id="data_header"><?=$data?></strong></i>
						</li>
<!--						<li>-->
<!--								<input id="data" class="data_picker form-control" value="--><?//=$data ?><!--" readonly>-->
<!--						</li>-->
					</ol>
					<hr>
				</div>				
			</div>
            <!-- / END: TITOLO  --> 

		</div>
		<!-- /.row -->
		
		<div class="row">
			<div class="col-lg-12">
				
				<div id="tabella_ruolino_giornaliero" style="overflow:auto; padding-top:170px;">
					<div style="text-align:center"><img src="img/load.gif"/>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
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
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">Elimina</h4>
			</div>
			<div class="modal-body" id="modal_body" >
				Sei sicuro di voler eliminare questo dato?
			</div>
			<div class="modal-footer">
				<input id="id_da_eliminare" type="hidden" />
				<input id="id_commessa_da_eliminare" type="hidden" />
				<div id="username_da_eliminare" style="display:none"></div>
				<button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">
					Annulla
				</button>
				<button type="submit" id="btn_elimina_conferma" class="btn btn-danger">
					Conferma
				</button>
			</div>
		</div>
	</div>
</div>
<!--FINE modal elimina-->

<!-- footer -->
<?php
include ("footer.php");
?>

</body>

</html>
