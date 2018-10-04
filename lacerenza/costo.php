<?php
session_start();
include("header.php");

require_once("lib/funzioni_sito.php");
include("databases/db_function.php");
include("classi/class.Commesse.php");


$id_commessa = $_GET['id'];
if($id_commessa != "") {

	$commessa = new Commesse();
	$e_query = $commessa->caricaCommesseById($id_commessa);
	$row = $e_query->fetch_array();
}
//somma magazzino
$da_data = isset($_GET['da_data']) ? $_GET['da_data'] : "";
$a_data = isset($_GET['a_data']) ? $_GET['a_data'] : "";
$conn = connectIIS();

?>

<script>
	$(document).ready(function() {

		$(".mag").click(function(){

			var magazzino = $(this).attr("magazzino");
			var titolo = $(this).attr("titolo");
			$("#titolo_magazzino").html(magazzino);
			$("#tabella_costo_materiale").html('<div style="text-align:center"><img src="img/load.gif"/></div>');
			$("#tabella_costo_materiale").load("php/tabella_costo_materiale.php?id=<?=$id_commessa?>&magazzino="+magazzino+"&data_partenza=<?=$row['data_inizio']?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>");
		});

	});
</script>

<script>
	$(document).ready(function() {
		$("#titolo_page").html("Lacerenza | Costo materiale");
		$("#nome_commessa").html("<?=$row['descrizione']?>");
	});
</script>
<div id="page-wrapper">
	<?
	if($id_commessa == ""){
		echo "Errore: esci e rientra dalla commessa.";
		exit;
	}
	?>

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">

			<!-- TITOLO -->
			<div class="col-lg-12">
				<div class="page-title">
					<h1>Costo materiale <small>dati presi da adhoc <strong id="titolo_magazzino"></strong></small></h1>

				</div>
			</div>


			<div class="col-lg-12">
				<div class="col-lg-12">
					<div class="row" style="margin-bottom:10px; margin-top:-40px;">
						<? if($row['campo1'] == "" && $row['campo2'] == "" && $row['campo3'] == "" && $row['campo4'] == "" && $row['campo5'] == "" ){ ?>
							Compilare i campi relativi al magazzino adhoc nella commessa.
							<br><br>
							<a class="btn btn-info" href="nuova_commessa.php?id=<?=$id_commessa?>">Modifica ora</a>
						<? } ?>
						<table style="width:100%; text-align:center; ">
							<? if($row['campo1'] != ""){
//								$data_partenza = $row['data_inizio'];
								$magazzino = $row['campo1'];
//								$query_somma1 = "select DOC_MAST.MVDATREG,DOC_DETT.MVCODART,DOC_DETT.MVDESART,DOC_DETT.MVUNIMIS,DOC_DETT.MVCAUMAG,DOC_DETT.MVCODMAT,DOC_DETT.MVQTAMOV,SALDIART.SLVALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART=SALDIART.SLCODICE) where (DOC_DETT.MVCODMAT = '$magazzino' AND DOC_MAST.MVDATREG >= {d '$data_partenza'} AND SALDIART.SLCODMAG = '00')     order by  2, 1 ";
								if($da_data == "") {
									$data_partenza = $row['data_inizio'];
									$query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} ) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
								} else {
									$data_partenza = $da_data;
									$data_fine = $a_data;

									$query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'}) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'} AND MVM_MAST.MMDATREG <= {d '$data_fine'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
								}
								$params = array();
								$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
								$result_somma1 = sqlsrv_query($conn,$query_somma1, $params, $options);
								$somma = 0;
								while($row_somma1 = sqlsrv_fetch_array( $result_somma1, SQLSRV_FETCH_ASSOC)) {

									$somma += $row_somma1['TOTALE'];
								}
							?>
								<tr>
									<td><?=$row['campo1']?></td>
									<td>Tot: <?=number_format($somma, 3, ',', '.');?> &euro;</td>
									<td><i titolo="Magazzino 1" magazzino="<?=$row['campo1']?>"  class="fa fa-search btn mag"></i></td>
								</tr>
							<? } ?>
							<? if($row['campo2'] != ""){
//								$data_partenza = $row['data_inizio'];
								$magazzino = $row['campo2'];
//								$query_somma1 = "select DOC_MAST.MVDATREG,DOC_DETT.MVCODART,DOC_DETT.MVDESART,DOC_DETT.MVUNIMIS,DOC_DETT.MVCAUMAG,DOC_DETT.MVCODMAT,DOC_DETT.MVQTAMOV,SALDIART.SLVALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART=SALDIART.SLCODICE) where (DOC_DETT.MVCODMAT = '$magazzino' AND DOC_MAST.MVDATREG >= {d '$data_partenza'} AND SALDIART.SLCODMAG = '00')     order by  2, 1 ";
								if($da_data == "") {
									$data_partenza = $row['data_inizio'];
									$query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} ) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
								} else {
									$data_partenza = $da_data;
									$data_fine = $a_data;

									$query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'}) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'} AND MVM_MAST.MMDATREG <= {d '$data_fine'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
								}
								$params = array();
								$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
								$result_somma1 = sqlsrv_query($conn,$query_somma1, $params, $options);
								$somma = 0;
								while($row_somma1 = sqlsrv_fetch_array( $result_somma1, SQLSRV_FETCH_ASSOC)) {

									$somma += $row_somma1['TOTALE'];
								}
							?>
								<tr>
									<td><?=$row['campo2']?></td>
									<td>Tot:  <?=number_format($somma, 3, ',', '.');?> &euro;</td>
									<td><i titolo="Magazzino 2" magazzino="<?=$row['campo2']?>" class="fa fa-search btn mag"></i></td>
								</tr>
							<? } ?>
							<? if($row['campo3'] != ""){
//								$data_partenza = $row['data_inizio'];
								$magazzino = $row['campo3'];
//								$query_somma1 = "select DOC_MAST.MVDATREG,DOC_DETT.MVCODART,DOC_DETT.MVDESART,DOC_DETT.MVUNIMIS,DOC_DETT.MVCAUMAG,DOC_DETT.MVCODMAT,DOC_DETT.MVQTAMOV,SALDIART.SLVALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART=SALDIART.SLCODICE) where (DOC_DETT.MVCODMAT = '$magazzino' AND DOC_MAST.MVDATREG >= {d '$data_partenza'} AND SALDIART.SLCODMAG = '00')     order by  2, 1 ";
								if($da_data == "") {
									$data_partenza = $row['data_inizio'];
									$query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} ) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
								} else {
									$data_partenza = $da_data;
									$data_fine = $a_data;

									$query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'}) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'} AND MVM_MAST.MMDATREG <= {d '$data_fine'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
								}
								$params = array();
								$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
								$result_somma1 = sqlsrv_query($conn,$query_somma1, $params, $options);
								$somma = 0;
								while($row_somma1 = sqlsrv_fetch_array( $result_somma1, SQLSRV_FETCH_ASSOC)) {

									$somma += $row_somma1['TOTALE'];
								}
							?>
								<tr>
									<td><?=$row['campo3']?></td>
									<td>Tot:  <?=number_format($somma, 3, ',', '.');?> &euro;</td>
									<td><i titolo="Magazzino 3" magazzino="<?=$row['campo3']?>" class="fa fa-search btn mag"></i></td>
								</tr>
							<? } ?>
							<? if($row['campo4'] != ""){
//								$data_partenza = $row['data_inizio'];
								$magazzino = $row['campo4'];
//								$query_somma1 = "select DOC_MAST.MVDATREG,DOC_DETT.MVCODART,DOC_DETT.MVDESART,DOC_DETT.MVUNIMIS,DOC_DETT.MVCAUMAG,DOC_DETT.MVCODMAT,DOC_DETT.MVQTAMOV,SALDIART.SLVALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART=SALDIART.SLCODICE) where (DOC_DETT.MVCODMAT = '$magazzino' AND DOC_MAST.MVDATREG >= {d '$data_partenza'} AND SALDIART.SLCODMAG = '00')     order by  2, 1 ";
								if($da_data == "") {
									$data_partenza = $row['data_inizio'];
									$query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} ) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
								} else {
									$data_partenza = $da_data;
									$data_fine = $a_data;

									$query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'}) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'} AND MVM_MAST.MMDATREG <= {d '$data_fine'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
								}
								$params = array();
								$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
								$result_somma1 = sqlsrv_query($conn,$query_somma1, $params, $options);
								$somma = 0;
								while($row_somma1 = sqlsrv_fetch_array( $result_somma1, SQLSRV_FETCH_ASSOC)) {

									$somma += $row_somma1['TOTALE'];
								}
							?>
								<tr>
									<td><?=$row['campo4']?></td>
									<td>Tot:  <?=number_format($somma, 3, ',', '.');?> &euro;</td>
									<td><i titolo="Magazzino 4"  magazzino="<?=$row['campo4']?>" class="fa fa-search btn mag"></i></td>
								</tr>
							<? } ?>
							<? if($row['campo5'] != ""){
//								$data_partenza = $row['data_inizio'];
								$magazzino = $row['campo5'];
//								$query_somma1 = "select DOC_MAST.MVDATREG,DOC_DETT.MVCODART,DOC_DETT.MVDESART,DOC_DETT.MVUNIMIS,DOC_DETT.MVCAUMAG,DOC_DETT.MVCODMAT,DOC_DETT.MVQTAMOV,SALDIART.SLVALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART=SALDIART.SLCODICE) where (DOC_DETT.MVCODMAT = '$magazzino' AND DOC_MAST.MVDATREG >= {d '$data_partenza'} AND SALDIART.SLCODMAG = '00')     order by  2, 1 ";
								if($da_data == "") {
									$data_partenza = $row['data_inizio'];
									$query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} ) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
								} else {
									$data_partenza = $da_data;
									$data_fine = $a_data;

									$query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'}) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'} AND MVM_MAST.MMDATREG <= {d '$data_fine'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
								}
								$params = array();
								$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
								$result_somma1 = sqlsrv_query($conn,$query_somma1, $params, $options);
								$somma = 0;
								while($row_somma1 = sqlsrv_fetch_array( $result_somma1, SQLSRV_FETCH_ASSOC)) {

									$somma += $row_somma1['TOTALE'];
								}
							?>
								<tr>
									<td><?=$row['campo5']?></td>
									<td>Tot:  <?=number_format($somma, 3, ',', '.');?> &euro;</td>
									<td><i titolo="Magazzino 5"  magazzino="<?=$row['campo5']?>" class="fa fa-search btn mag"></i></td>
								</tr>
							<? } ?>
							<? if($row['campo6'] != ""){
//								$data_partenza = $row['data_inizio'];
								$magazzino = $row['campo6'];
//								$query_somma1 = "select DOC_MAST.MVDATREG,DOC_DETT.MVCODART,DOC_DETT.MVDESART,DOC_DETT.MVUNIMIS,DOC_DETT.MVCAUMAG,DOC_DETT.MVCODMAT,DOC_DETT.MVQTAMOV,SALDIART.SLVALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART=SALDIART.SLCODICE) where (DOC_DETT.MVCODMAT = '$magazzino' AND DOC_MAST.MVDATREG >= {d '$data_partenza'} AND SALDIART.SLCODMAG = '00')     order by  2, 1 ";
								if($da_data == "") {
									$data_partenza = $row['data_inizio'];
									$query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} ) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
								} else {
									$data_partenza = $da_data;
									$data_fine = $a_data;

									$query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'}) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'} AND MVM_MAST.MMDATREG <= {d '$data_fine'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
								}
								$params = array();
								$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
								$result_somma1 = sqlsrv_query($conn,$query_somma1, $params, $options);
								$somma = 0;
								while($row_somma1 = sqlsrv_fetch_array( $result_somma1, SQLSRV_FETCH_ASSOC)) {

									$somma += $row_somma1['TOTALE'];
								}
								?>
								<tr>
									<td><?=$row['campo6']?></td>
									<td>Tot:  <?=number_format($somma, 3, ',', '.');?> &euro;</td>
									<td><i titolo="Magazzino 6"  magazzino="<?=$row['campo6']?>" class="fa fa-search btn mag"></i></td>
								</tr>
							<? } ?>
						</table>
					</div>
				</div>
			</div>
			<br><br>
			<div class="col-lg-12">
				<div class="row">
					<!-- TITOLO -->
					<div class="col-lg-12">
						<div id="tabella_costo_materiale"></div>
					</div>
				</div>
			</div>

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->


</div>
<!-- /#wrapper -->



<!-- footer -->
<?php
include("footer.php");
?>

</body>

</html>
