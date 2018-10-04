<?php
include ("lib/controllaSessione.php");
require_once ("lib/verificaConvertiData.php");

include ("header.php");

$id = $_GET['id'];
$data = isset($_GET['data']) ? $_GET['data'] : date("Y-m-d");
$data_indietro = ($data != "") ? capovolgiData($data) : date("d-m-Y");
$clima_giorno = isset($_GET['clima']) ? $_GET['clima'] : "";
$titolo = ($_GET['nome'] == "nuovo") ? "Nuovo Ruolino Giornaliero" : "Modifica Ruolino Giornaliero";
$clona = ($_GET['clona'] == "clona") ? $_GET['clona'] : "";
$dettagli_commessa = isset($_GET['dettagli_commessa']) ? $_GET['dettagli_commessa'] : "";
$autista = isset($_GET['autista']) ? $_GET['autista'] : "";
$tipologia = isset($_GET['tipologia']) ? $_GET['tipologia'] : "";
$quantita = isset($_GET['quantita']) ? $_GET['quantita'] : "";


?>

<!--SCRIPT SITO-->
<script src="js/sito/nuovo_ruolino_giornaliero.js" type="text/javascript"></script>

<script>
	$(document).ready(function() {
		
		<? if($clona == "")
		
		{ ?>
$("#div_nuovo").load("php/div_nuovo_ruolino_giornaliero.php?id=<?=$id?>&data=<?=$data_indietro?>&clima=<?=$clima_giorno?>");
<? } else { ?>
$("#div_nuovo").load("php/div_nuovo_ruolino_giornaliero.php?note=<?=$note?>&ore_terzi=<?=$ore_terzi?>&terzi=<?=$terzi?>&quantita=<?=$quantita?>&dettagli_lavoro=<?=$dettagli_lavoro?>&tipologia=<?=$tipologia?>&autista=<?=$autista?>&clona=<?=$clona?>&id=<?=$id?>&data=<?=$data_indietro?>&clima=<?=$clima_giorno?>&dettagli_commessa=<?=$dettagli_commessa?>");<? } ?><? if($titolo == "Nuovo Ruolino Giornaliero"){ ?>$("#btn_nuovo").show();<? } else { ?>
	$("#btn_modifica").show();
	$("#btn_clona").show();

<? } ?>});</script>

<!-- <script type="text/javascript" src="js/tags/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="js/tags/bootstrap-tagsinput-angular.js"></script>
<script type="text/javascript" src="js/tags/tags.js"></script>
<link rel="stylesheet" type="text/css" href="css/tags/bootstrap-tagsinput.css" /> -->


<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">

				<!-- TITOLO -->
				<div class="page-title">
					<h1>Ruolino <small> nuovo ruolino giornaliero</small><a class="close pull-right" href="ruolino_giornaliero.php?data=<?=$data_indietro?>"><i class="fa fa-backward"></i> Indietro</a></h1>
					<div class="clearfix"></div>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-dashboard fa-lg"></i> Ruolino
						</li>
						<li class="pull-right">

						</li>
					</ol>
				</div>
				<!-- / END: TITOLO  -->

				<div class="btn btn-warning btn-block" id="btn_clona" style="display:none">
					<i class="fa fa-external-link"></i> Clona
				</div>
				<br>

			</div>
		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-lg-12">
				<div id="div_nuovo">
					<div style="text-align:center"><img src="img/load.gif" style="width:100px"/>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->

		<div class="btn btn-success btn-block" id="btn_nuovo" style="display:none">
			<i class="fa fa-save"></i> Salva
		</div>
		<div class="btn btn-success btn-block" id="btn_modifica" style="display:none">
			<i class="fa fa-save"></i> Salva
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
