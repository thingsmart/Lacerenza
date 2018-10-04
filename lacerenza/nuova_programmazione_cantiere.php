<?php
include ("lib/controllaSessione.php");
require_once ("lib/verificaConvertiData.php");

include ("header.php");

$id = $_GET['id'];
$data = isset($_GET['data']) ? $_GET['data'] : date("Y-m-d");
$data_indietro = ($data != "") ? capovolgiData($data) : date("d-m-Y");

$titolo = ($_GET['nome'] == "nuovo") ? "Nuova Programmazione Cantiere" : "Modifica Programmazione Cantiere";
?>

<!--SCRIPT SITO-->
<script src="js/sito/nuova_programmazione_cantiere.js" type="text/javascript"></script>


<script>
	$(document).ready(function() {
$("#div_nuovo").load("php/div_nuova_programmazione_cantiere.php?id=<?=$id?>&data=<?=$data_indietro?>
	");

<? if($titolo == "Nuova Programmazione Cantiere"){ ?>$("#btn_nuovo").show();<? } else { ?>$("#btn_modifica").show();<? } ?>});</script>

<!-- <script type="text/javascript" src="js/tags/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="js/tags/bootstrap-tagsinput-angular.js"></script>
<script type="text/javascript" src="js/tags/tags.js"></script>
<link rel="stylesheet" type="text/css" href="css/tags/bootstrap-tagsinput.css" /> -->

<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			
			<div class="col-lg-12">
				<div class="page-title">
					<h1><?=$titolo?> <small></small><a class="close pull-right" href="pagina_programmazione_cantiere.php?data=<?=$data_indietro?>"><i class="fa fa-backward"></i> Indietro</a></h1>
					<div class="clearfix"></div>
					<ol class="breadcrumb">
						<li class="active">
							
						</li>
						<li class="pull-right">

						</li>
					</ol>
				</div>	
					
		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-lg-12 ">
				<div id="div_nuovo">
					<div style="text-align:center"><img src="img/load.gif" style="width:100px"/>
					</div>
				</div>
			</div>
			
		</div>
		<!-- /.row -->
		<br>
			<div class="col-lg-12 ">
			<div class="btn btn-success btn-block" id="btn_nuovo" style="display:none">
							<i class="fa fa-save"></i> Salva
						</div>
						<div class="btn btn-success btn-block" id="btn_modifica" style="display:none">
							<i class="fa fa-save"></i> Salva
						</div>
			</div>
			<div class="col-lg-12 ">
				<br>
			</div>

	</div>
	<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- footer -->
<?php
include ("footer.php");
?>

</body>

</html>
