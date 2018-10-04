<?php
session_start();

ini_set('max_execution_time', 0);
$fade = ($browser == 0) ? "fade" : "";
$id_commessa = $_GET['id'];
$data_fine = ($_GET['data_fine'] == "0000-00-00") ? "" : $_GET['data_fine'];

$_SESSION['id_commessa'] = $id_commessa;

include("header.php");
require_once ("classi/class.Dipendenti.php");
require_once ("classi/class.Presenze.php");
require_once ("classi/class.MaterialiEsterni.php");
require_once ("classi/class.Commesse.php");
require_once ("classi/class.Costi.php");
require_once ("classi/class.Ral.php");
include ("databases/db_function.php");
require_once("lib/verificaConvertiData.php");

if($id_commessa == ""){
    echo "<br><br>";
    echo "Errore: Esci e rientra dalla commessa.";
    exit;
}

$conn = connectIIS();

$c = new Commesse();
$e_query_c = $c->caricaCommesseById($id_commessa);
$row_c = $e_query_c->fetch_array();

$ruolino = new Dipendenti();
$e_query_ruolino = $ruolino -> caricaDipendentiRuolinoAllCosti();

$da_data = isset($_GET['da_data']) ? CapovolgiData($_GET['da_data']) : $row_c['data_inizio'];
if($_GET['data_fine'] == ""){
    $a_data = isset($_GET['a_data']) ? CapovolgiData($_GET['a_data']) : date("Y-m-d");

} else {
    if(isset($_GET['a_data'])) {
        $a_data = isset($_GET['a_data']) ? CapovolgiData($_GET['a_data']) : date("Y-m-d");
    } else {
        $a_data = $data_fine;
    }
}
?>
<script>
$(document).ready(function() {
	$("#nome_commessa").html("<?=$row_c['descrizione']?>");

    $('.data_picker').datepicker({
        language: 'it',
        autoclose: true
    });

    $("#cerca").click(function(){
        var da_data = $("#da_data").val();
        var a_data = $("#a_data").val();
        if(da_data == "" || a_data == ""){
            alert("seleziona entrambe le date");
            return;
        }
        window.location = "riepilogo_commessa.php?id=<?=$id_commessa?>&da_data="+da_data+"&a_data="+a_data;

    });


});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Riepilogo");
});
</script>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	<div class="col-lg-12">
                	<div class="page-title">
					<h1>Monitoraggio Costi Commessa <small> <?=$row_c['descrizione']?></small>  <a class="close pull-right" href="commesse.php"><i class="fa fa-backward"></i> Indietro</a></h1>
					<div class="clearfix"></div>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-desktop fa-lg"></i> riepilogo
						</li>
						<li class="pull-right">

						</li>
					</ol>
					</div>
					</div>                               
                </div>

                <div class="row" style="margin-bottom:10px;">
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <? if($da_data != ""){ ?>
                                <input class="form-control data_picker" type="text" id="da_data" value="<?=CapovolgiData($da_data)?>" readonly/>
                            <? } else { ?>
                                <input class="form-control data_picker" type="text" id="da_data" value="<?=CapovolgiData($row_c['data_inizio'])?>"  readonly/>
                            <? } ?>
                        </div>
                        <div class="col-lg-3">
                            <? if($a_data != ""){ ?>
                                <input class="form-control data_picker" type="text" id="a_data" value="<?=CapovolgiData($a_data)?>" readonly/>
                            <? } else { ?>
                                <input class="form-control data_picker" type="text" id="a_data" value="<?=date("d-m-Y")?>" readonly/>
                            <? } ?>
                        </div>
                        <div class="col-lg-3">
                            <div class="btn btn-info btn-block" id="cerca">Cerca</div>
                        </div>
                    </div>
                </div>

                <section id="no-more-tables">
                    <table class="table-striped table-condensed cf" style="width:100%">
                        <thead class="cf">
                        <tr>
                            <th style="text-align:center; width:30%; border-right: thin solid white">Monitoraggio costi commessa</th>
                            <th style="text-align:center">Codice commessa: <?=$row_c['codice']?> </th>

                        </tr>
                        </thead>
                        <tbody>

                                    <?
                                    $tot_complessivo_magazzino = 0;
                                    if($row_c['campo1'] != ""){
                                        $magazzino = $row_c['campo1'];
                                        if($da_data == "") {
                                            $data_partenza = $row_c['data_inizio'];
                                            $query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID  from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} ) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
                                        } else {
                                            $data_partenza = $da_data;
                                            $data_fine = $a_data;

                                            //$query_somma1 = "select DOC_MAST.MVDATREG,DOC_DETT.MVCODART,DOC_DETT.MVDESART,DOC_DETT.MVUNIMIS,DOC_DETT.MVCAUMAG,DOC_DETT.MVCODMAT,DOC_DETT.MVQTAMOV,SALDIART.SLVALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART=SALDIART.SLCODICE) where (DOC_DETT.MVCODMAT = '$magazzino' AND DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'} AND SALDIART.SLCODMAG = '00')     order by  2 ";
                                            $query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'}) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'} AND MVM_MAST.MMDATREG <= {d '$data_fine'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";

                                        }

                                        $params = array();
                                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                                        $result_somma1 = sqlsrv_query($conn,$query_somma1, $params, $options);
                                        $somma = 0;
                                        while($row_somma1 = sqlsrv_fetch_array( $result_somma1, SQLSRV_FETCH_ASSOC)) {

                                            $somma += $row_somma1['TOTALE'];
                                        }
                                        $tot_complessivo_magazzino += $somma;
                                        ?>

                                    <? } ?>
                                    <? if($row_c['campo2'] != ""){
//                                        $data_partenza = $row_c['data_inizio'];
                                        $magazzino = $row_c['campo2'];
//                                        $query_somma1 = "select DOC_MAST.MVDATREG,DOC_DETT.MVCODART,DOC_DETT.MVDESART,DOC_DETT.MVUNIMIS,DOC_DETT.MVCAUMAG,DOC_DETT.MVCODMAT,DOC_DETT.MVQTAMOV,SALDIART.SLVALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART=SALDIART.SLCODICE) where (DOC_DETT.MVCODMAT = '$magazzino' AND DOC_MAST.MVDATREG >= {d '$data_partenza'} AND SALDIART.SLCODMAG = '00')     order by  2 ";
                                        if($da_data == "") {
                                            $data_partenza = $row_c['data_inizio'];
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
                                        $tot_complessivo_magazzino += $somma;
                                        ?>

                                    <? } ?>
                                    <? if($row_c['campo3'] != ""){
//                                        $data_partenza = $row_c['data_inizio'];
                                        $magazzino = $row_c['campo3'];
//                                        $query_somma1 = "select DOC_MAST.MVDATREG,DOC_DETT.MVCODART,DOC_DETT.MVDESART,DOC_DETT.MVUNIMIS,DOC_DETT.MVCAUMAG,DOC_DETT.MVCODMAT,DOC_DETT.MVQTAMOV,SALDIART.SLVALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART=SALDIART.SLCODICE) where (DOC_DETT.MVCODMAT = '$magazzino' AND DOC_MAST.MVDATREG >= {d '$data_partenza'} AND SALDIART.SLCODMAG = '00')     order by  2 ";
                                        if($da_data == "") {
                                            $data_partenza = $row_c['data_inizio'];
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
                                        $tot_complessivo_magazzino += $somma;
                                        ?>

                                    <? } ?>
                                    <? if($row_c['campo4'] != ""){
//                                        $data_partenza = $row_c['data_inizio'];
                                        $magazzino = $row_c['campo4'];
//                                        $query_somma1 = "select DOC_MAST.MVDATREG,DOC_DETT.MVCODART,DOC_DETT.MVDESART,DOC_DETT.MVUNIMIS,DOC_DETT.MVCAUMAG,DOC_DETT.MVCODMAT,DOC_DETT.MVQTAMOV,SALDIART.SLVALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART=SALDIART.SLCODICE) where (DOC_DETT.MVCODMAT = '$magazzino' AND DOC_MAST.MVDATREG >= {d '$data_partenza'} AND SALDIART.SLCODMAG = '00')     order by  2 ";
                                        if($da_data == "") {
                                            $data_partenza = $row_c['data_inizio'];
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
                                        $tot_complessivo_magazzino += $somma;
                                        ?>

                                    <? } ?>
                                    <? if($row_c['campo5'] != ""){
//                                        $data_partenza = $row_c['data_inizio'];
                                        $magazzino = $row_c['campo5'];
//                                        $query_somma1 = "select DOC_MAST.MVDATREG,DOC_DETT.MVCODART,DOC_DETT.MVDESART,DOC_DETT.MVUNIMIS,DOC_DETT.MVCAUMAG,DOC_DETT.MVCODMAT,DOC_DETT.MVQTAMOV,SALDIART.SLVALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART=SALDIART.SLCODICE) where (DOC_DETT.MVCODMAT = '$magazzino' AND DOC_MAST.MVDATREG >= {d '$data_partenza'} AND SALDIART.SLCODMAG = '00')     order by  2 ";
                                        if($da_data == "") {
                                            $data_partenza = $row_c['data_inizio'];
                                            $query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} ) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
                                        } else {
                                            $data_partenza = $da_data;
                                            $data_fine = $a_data;

                                            $query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'}) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'} AND MVM_MAST.MMDATREG <= {d '$data_fine'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
                                        }
                                        $params = array();
                                        $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
                                        $result_somma1 = sqlsrv_query($conn,$query_somma1, $params, $options);
                                        $somma = 0;
                                        while($row_somma1 = sqlsrv_fetch_array( $result_somma1, SQLSRV_FETCH_ASSOC)) {

                                            $somma += $row_somma1['TOTALE'];
                                        }
                                        $tot_complessivo_magazzino += $somma;
                                        ?>

                                    <? } ?>

                                    <? if($row_c['campo6'] != ""){
//                                        $data_partenza = $row_c['data_inizio'];
                                        $magazzino = $row_c['campo6'];
//                                        $query_somma1 = "select DOC_MAST.MVDATREG,DOC_DETT.MVCODART,DOC_DETT.MVDESART,DOC_DETT.MVUNIMIS,DOC_DETT.MVCAUMAG,DOC_DETT.MVCODMAT,DOC_DETT.MVQTAMOV,SALDIART.SLVALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART=SALDIART.SLCODICE) where (DOC_DETT.MVCODMAT = '$magazzino' AND DOC_MAST.MVDATREG >= {d '$data_partenza'} AND SALDIART.SLCODMAG = '00')     order by  2 ";
                                        if($da_data == "") {
                                            $data_partenza = $row_c['data_inizio'];
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
                                        $tot_complessivo_magazzino += $somma;
                                        ?>

                                    <? } ?>



                        <!--Costi operati-->

                                    <?
                                    $totale_operai_finale = 0;
                                    while($row = $e_query_ruolino->fetch_array()){
                                        $presenza = new Presenze();
                                        if($da_data == ""){
                                            $e_totale = $presenza->oreLavoroCommessa($id_commessa);
                                        } else {
                                            $e_totale = $presenza->oreLavoroCommessaData($id_commessa, $da_data, $a_data);
                                        }

                                        $tot_per_mese = 0;
                                        $tot_costo = 0;

                                        $costo = new Costi();
                                        $costo_orario_medio_totale = 0;
                                        $numero_giorni = 0;
                                        //Calcolo ore totali per la commessa
                                        while($row_totale = $e_totale->fetch_array()){
                                            $dipendenti_oggi = explode(",", $row_totale['id_dipendenti']);
                                            for($l=0; $l<count($dipendenti_oggi); $l++){
                                                if($row['id'] == intval($dipendenti_oggi[$l])){
                                                    $tot_per_mese += $row_totale['ore'];
                                                    $costo_esploso = explode("-", $row_totale['data']);

                                                    $costo_paretnza = $costo_esploso[0]."-".$costo_esploso[1]."-1";
                                                    $costo_h = $costo->costoAttualeCommessa($row['id'], $costo_paretnza, $id_commessa);
                                                    if($costo_h == 0){
                                                        $costo_h = $costo->costoAttualeNuovo($row['id'], $costo_paretnza);
                                                    }
                                                    $costo_tmp = $costo_h * $row_totale['ore'];
                                                    $tot_costo += $costo_tmp;
                                                    $costo_orario_medio_totale += $costo_h;
                                                    $numero_giorni += 1;
                                                }
                                            }
                                        }

                                        $totale_operai_finale += $tot_costo;
                                    ?>
                                        <? if($tot_per_mese > 0){ ?>

                                        <? } ?>
                                    <? } ?>
                                   <!--//END: Costi operati-->
                        <tr><!--Riepilogo costi-->
                            <td style="text-align:center" data-title="Riepilogo costi">Riepilogo costi</td>
                            <td>
                                <table style="width:100%">
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Costi Materiale: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_complessivo_magazzino, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="costo.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Materiale esterno-->
                                        <td style="padding:5px; font-size:13px;"> Costi Forniture Esterne Materiale: </td>
                                        <?
                                            $tot_esterno = 0;
                                            $esterno = new MaterialiEsterni();
                                        if($da_data == ""){
                                            $e_query_esterno = $esterno->caricaFatture($id_commessa, "MATERIALE");
                                        } else {
                                            $e_query_esterno = $esterno->caricaFattureData($id_commessa, $da_data, $a_data, "MATERIALE");
                                        }
                                        if($e_query_esterno->num_rows > 0){
                                            while($row_esterno = $e_query_esterno->fetch_array()){
                                                $tot_esterno += $row_esterno['importo_totale'];
                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_esterno, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_materiali_esterni.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=MATERIALE"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Materiale esterno-->
                                        <td style="padding:5px; font-size:13px;"> Costi Forniture Esterne Manodopera: </td>
                                        <?
                                        $tot_esterno_manodopera = 0;
                                        $esterno = new MaterialiEsterni();
                                        if($da_data == ""){
                                            $e_query_esterno = $esterno->caricaFatture($id_commessa, "MANODOPERA");
                                        } else {
                                            $e_query_esterno = $esterno->caricaFattureData($id_commessa, $da_data, $a_data, "MANODOPERA");
                                        }
                                        if($e_query_esterno->num_rows > 0){
                                            while($row_esterno = $e_query_esterno->fetch_array()){
                                                $tot_esterno_manodopera += $row_esterno['importo_totale'];
                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_esterno_manodopera, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_materiali_esterni.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=MANODOPERA"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>

                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Costi Manodopera: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_operai_finale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="costo_operai.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Totale materiale-->
                                        <? $totale_materiale = $tot_complessivo_magazzino+$tot_esterno?>
                                        <td style="padding:5px; font-size:13px;">  Totale Materiale: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_materiale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Totale Costi: </td>
                                        <?
                                        $totale_finale = $tot_complessivo_magazzino + $totale_operai_finale + $tot_esterno_manodopera + $tot_esterno;
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_finale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>

                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Totale Contabilit&agrave;: </td>
                                        <?
                                        $totale_sal = 0;
                                        $ral = new Ral();
                                        if($da_data == ""){
                                            $e_query_ral = $ral->caricaRal($id_commessa);
                                        } else {
                                            $e_query_ral = $ral->caricaRalData($id_commessa, $da_data, $a_data);
                                        }

                                        if($e_query_ral->num_rows > 0){
                                            while($row_ral = $e_query_ral->fetch_array()){

                                                $totale_sal += $row_ral['totale_ral'];

                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_sal, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_contabilita.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>"><i class=" btn fa fa-search"></i></a></td>

                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Differenza: </td>
                                        <?
                                        $diff = $totale_sal - $totale_finale;
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($diff, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;"> Differenza %: </td>
                                        <td style="padding:5px; font-size:13px;"><b>
                                                <? if($totale_finale != 0){ ?>
                                                <? $percent = ($diff * 100)/$totale_finale?>
                                                    <?=number_format($percent, 4, ',', '.');?>  %
                                                <? } else { ?>
                                                    0 %
                                                <? } ?>
                                            </b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                </table>
                            </td>
                        </tr><!--//END: Riepilogo costi-->
                        </tbody>
                    </table>
                </section>


                <!--CAP-->
                <br>
                <h1>CAP</h1>
                <section id="no-more-tables">
                    <table class="table-striped table-condensed cf" style="width:100%">
                        <thead class="cf">
                        <tr>
                            <th style="text-align:center; width:30%; border-right: thin solid white">Monitoraggio costi commessa</th>
                            <th style="text-align:center">Codice commessa: <?=$row_c['codice']?> </th>

                        </tr>
                        </thead>
                        <tbody>

                        <?
                        $tot_complessivo_magazzino = 0;
                        if($row_c['campo2'] != ""){
                            $magazzino = $row_c['campo2'];


                                if ($da_data == "") {
                                    $data_partenza = $row_c['data_inizio'];
                                    $query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} ) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
                                } else {
                                    $data_partenza = $da_data;
                                    $data_fine = $a_data;

                                    $query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'}) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'} AND MVM_MAST.MMDATREG <= {d '$data_fine'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
                                }

                                $params = array();
                                $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                                $result_somma1 = sqlsrv_query($conn, $query_somma1, $params, $options);
                                $somma = 0;
                                while ($row_somma1 = sqlsrv_fetch_array($result_somma1, SQLSRV_FETCH_ASSOC)) {

                                    $somma += $row_somma1['TOTALE'];

                                }
                            $tot_complessivo_magazzino += $somma;
                            ?>

                        <? } ?>



                        <!--Costi operati-->

                        <?
                        $totale_operai_finale = 0;
                        $e_query_ruolino = $ruolino -> caricaDipendentiRuolinoAll();
                        while($row = $e_query_ruolino->fetch_array()){
                            $presenza = new Presenze();
                            if($da_data == ""){
                                $e_totale = $presenza->oreLavoroCommessaTl($id_commessa, "cap");
                            } else {
                                $e_totale = $presenza->oreLavoroCommessaDataTl($id_commessa, $da_data, $a_data, "cap");
                            }

                            $tot_per_mese = 0;
                            $tot_costo = 0;

                            $costo = new Costi();
                            $costo_orario_medio_totale = 0;
                            $numero_giorni = 0;
                            //Calcolo ore totali per la commessa
                            while($row_totale = $e_totale->fetch_array()){
                                $dipendenti_oggi = explode(",", $row_totale['id_dipendenti']);
                                for($l=0; $l<count($dipendenti_oggi); $l++){
                                    if($row['id'] == intval($dipendenti_oggi[$l])){
                                        $tot_per_mese += $row_totale['ore'];
                                        $costo_esploso = explode("-", $row_totale['data']);

                                        $costo_paretnza = $costo_esploso[0]."-".$costo_esploso[1]."-1";
                                        $costo_h = $costo->costoAttualeCommessa($row['id'], $costo_paretnza, $id_commessa);
                                        if($costo_h == 0){
                                            $costo_h = $costo->costoAttualeNuovo($row['id'], $costo_paretnza);
                                        }
                                        $costo_tmp = $costo_h * $row_totale['ore'];
                                        $tot_costo += $costo_tmp;
                                        $costo_orario_medio_totale += $costo_h;
                                        $numero_giorni += 1;
                                    }
                                }
                            }

                            $totale_operai_finale += $tot_costo;
                            ?>
                            <? if($tot_per_mese > 0){ ?>

                            <? } ?>
                        <? } ?>
                        <!--//END: Costi operati-->
                        <tr><!--Riepilogo costi-->
                            <td style="text-align:center" data-title="Riepilogo costi">Riepilogo costi</td>
                            <td>
                                <table style="width:100%">
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Costi Materiale: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_complessivo_magazzino, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="costo.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Materiale esterno-->
                                        <td style="padding:5px; font-size:13px;"> Costi Forniture Esterne Materiale: </td>
                                        <?
                                        $tot_esterno = 0;
                                        $esterno = new MaterialiEsterni();
                                        if($da_data == ""){
                                            $e_query_esterno = $esterno->caricaFattureTl($id_commessa, "MATERIALE", "cap");
                                        } else {
                                            $e_query_esterno = $esterno->caricaFattureDataTl($id_commessa, $da_data, $a_data, "MATERIALE", "cap");
                                        }
                                        if($e_query_esterno->num_rows > 0){
                                            while($row_esterno = $e_query_esterno->fetch_array()){
                                                $tot_esterno += $row_esterno['importo_totale'];
                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_esterno, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_materiali_esterni.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=MATERIALE&tipo=cap"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Materiale esterno-->
                                        <td style="padding:5px; font-size:13px;"> Costi Forniture Esterne Manodopera: </td>
                                        <?
                                        $tot_esterno_manodopera = 0;
                                        $esterno = new MaterialiEsterni();
                                        if($da_data == ""){
                                            $e_query_esterno = $esterno->caricaFattureTl($id_commessa, "MANODOPERA", "cap");
                                        } else {
                                            $e_query_esterno = $esterno->caricaFattureDataTl($id_commessa, $da_data, $a_data, "MANODOPERA", "cap");
                                        }
                                        if($e_query_esterno->num_rows > 0){
                                            while($row_esterno = $e_query_esterno->fetch_array()){
                                                $tot_esterno_manodopera += $row_esterno['importo_totale'];
                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_esterno_manodopera, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_materiali_esterni.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=MANODOPERA&tipo=cap"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Costi Manodopera: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_operai_finale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="costo_operai.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tl=cap"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Totale materiale-->
                                        <? $totale_materiale = $tot_complessivo_magazzino+$tot_esterno?>
                                        <td style="padding:5px; font-size:13px;">  Totale Materiale: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_materiale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Totale Costi: </td>
                                        <?
                                        $totale_finale = $tot_complessivo_magazzino + $totale_operai_finale + $tot_esterno_manodopera + $tot_esterno;
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_finale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>

                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Totale Contabilit&agrave;: </td>
                                        <?
                                        $totale_sal = 0;
                                        $ral = new Ral();
                                        if($da_data == ""){
                                            $e_query_ral = $ral->caricaRalTl($id_commessa, "cap");
                                        } else {
                                            $e_query_ral = $ral->caricaRalDataTl($id_commessa, $da_data, $a_data, "cap");
                                        }

                                        if($e_query_ral->num_rows > 0){
                                            while($row_ral = $e_query_ral->fetch_array()){

                                                $totale_sal += $row_ral['totale_ral'];

                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_sal, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_contabilita.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=cap"><i class=" btn fa fa-search"></i></a></td>

                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Differenza: </td>
                                        <?
                                        $diff = $totale_sal - $totale_finale;
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($diff, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;"> Differenza %: </td>
                                        <td style="padding:5px; font-size:13px;"><b>
                                                <? if($totale_finale != 0){ ?>
                                                    <? $percent = ($diff * 100)/$totale_finale?>
                                                    <?=number_format($percent, 4, ',', '.');?>  %
                                                <? } else { ?>
                                                    0 %
                                                <? } ?>
                                            </b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                </table>
                            </td>
                        </tr><!--//END: Riepilogo costi-->
                        </tbody>
                    </table>
                </section>
                <!--FINE CAP-->


                <!--IMP-->
                <br>
                <h1>IMP</h1>
                <section id="no-more-tables">
                    <table class="table-striped table-condensed cf" style="width:100%">
                        <thead class="cf">
                        <tr>
                            <th style="text-align:center; width:30%; border-right: thin solid white">Monitoraggio costi commessa</th>
                            <th style="text-align:center">Codice commessa: <?=$row_c['codice']?> </th>

                        </tr>
                        </thead>
                        <tbody>

                        <?
                        $tot_complessivo_magazzino = 0;
                        if($row_c['campo3'] != ""){
                            $magazzino = $row_c['campo3'];


                            if ($da_data == "") {
                                $data_partenza = $row_c['data_inizio'];
                                $query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} ) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
                            } else {
                                $data_partenza = $da_data;
                                $data_fine = $a_data;

                                $query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'}) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'} AND MVM_MAST.MMDATREG <= {d '$data_fine'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
                            }

                            $params = array();
                            $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                            $result_somma1 = sqlsrv_query($conn, $query_somma1, $params, $options);
                            $somma = 0;
                            while ($row_somma1 = sqlsrv_fetch_array($result_somma1, SQLSRV_FETCH_ASSOC)) {

                                $somma += $row_somma1['TOTALE'];
                            }
                            $tot_complessivo_magazzino += $somma;
                            ?>

                        <? } ?>



                        <!--Costi operati-->

                        <?
                        $totale_operai_finale = 0;
                        $e_query_ruolino = $ruolino -> caricaDipendentiRuolinoAll();
                        while($row = $e_query_ruolino->fetch_array()){
                            $presenza = new Presenze();
                            if($da_data == ""){
                                $e_totale = $presenza->oreLavoroCommessaTl($id_commessa, "imp");
                            } else {
                                $e_totale = $presenza->oreLavoroCommessaDataTl($id_commessa, $da_data, $a_data, "imp");
                            }

                            $tot_per_mese = 0;
                            $tot_costo = 0;

                            $costo = new Costi();
                            $costo_orario_medio_totale = 0;
                            $numero_giorni = 0;
                            //Calcolo ore totali per la commessa
                            while($row_totale = $e_totale->fetch_array()){
                                $dipendenti_oggi = explode(",", $row_totale['id_dipendenti']);
                                for($l=0; $l<count($dipendenti_oggi); $l++){
                                    if($row['id'] == intval($dipendenti_oggi[$l])){
                                        $tot_per_mese += $row_totale['ore'];
                                        $costo_esploso = explode("-", $row_totale['data']);

                                        $costo_paretnza = $costo_esploso[0]."-".$costo_esploso[1]."-1";
                                        $costo_h = $costo->costoAttualeCommessa($row['id'], $costo_paretnza, $id_commessa);
                                        if($costo_h == 0){
                                            $costo_h = $costo->costoAttualeNuovo($row['id'], $costo_paretnza);
                                        }
                                        $costo_tmp = $costo_h * $row_totale['ore'];
                                        $tot_costo += $costo_tmp;
                                        $costo_orario_medio_totale += $costo_h;
                                        $numero_giorni += 1;
                                    }
                                }
                            }

                            $totale_operai_finale += $tot_costo;
                            ?>
                            <? if($tot_per_mese > 0){ ?>

                            <? } ?>
                        <? } ?>
                        <!--//END: Costi operati-->
                        <tr><!--Riepilogo costi-->
                            <td style="text-align:center" data-title="Riepilogo costi">Riepilogo costi</td>
                            <td>
                                <table style="width:100%">
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Costi Materiale: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_complessivo_magazzino, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="costo.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Materiale esterno-->
                                        <td style="padding:5px; font-size:13px;"> Costi Forniture Esterne Materiale: </td>
                                        <?
                                        $tot_esterno = 0;
                                        $esterno = new MaterialiEsterni();
                                        if($da_data == ""){
                                            $e_query_esterno = $esterno->caricaFattureTl($id_commessa, "MATERIALE", "imp");
                                        } else {
                                            $e_query_esterno = $esterno->caricaFattureDataTl($id_commessa, $da_data, $a_data, "MATERIALE", "imp");
                                        }
                                        if($e_query_esterno->num_rows > 0){
                                            while($row_esterno = $e_query_esterno->fetch_array()){
                                                $tot_esterno += $row_esterno['importo_totale'];
                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_esterno, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_materiali_esterni.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=MATERIALE&tipo=imp"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Materiale esterno-->
                                        <td style="padding:5px; font-size:13px;"> Costi Forniture Esterne Manodopera: </td>
                                        <?
                                        $tot_esterno_manodopera = 0;
                                        $esterno = new MaterialiEsterni();
                                        if($da_data == ""){
                                            $e_query_esterno = $esterno->caricaFattureTl($id_commessa, "MANODOPERA", "imp");
                                        } else {
                                            $e_query_esterno = $esterno->caricaFattureDataTl($id_commessa, $da_data, $a_data, "MANODOPERA", "imp");
                                        }
                                        if($e_query_esterno->num_rows > 0){
                                            while($row_esterno = $e_query_esterno->fetch_array()){
                                                $tot_esterno_manodopera += $row_esterno['importo_totale'];
                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_esterno_manodopera, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_materiali_esterni.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=MANODOPERA&tipo=imp"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Costi Manodopera: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_operai_finale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="costo_operai.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tl=imp"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Totale materiale-->
                                        <? $totale_materiale = $tot_complessivo_magazzino+$tot_esterno?>
                                        <td style="padding:5px; font-size:13px;">  Totale Materiale: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_materiale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Totale Costi: </td>
                                        <?
                                        $totale_finale = $tot_complessivo_magazzino + $totale_operai_finale + $tot_esterno_manodopera + $tot_esterno;
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_finale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>

                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Totale Contabilit&agrave;: </td>
                                        <?
                                        $totale_sal = 0;
                                        $ral = new Ral();
                                        if($da_data == ""){
                                            $e_query_ral = $ral->caricaRalTl($id_commessa, "imp");
                                        } else {
                                            $e_query_ral = $ral->caricaRalDataTl($id_commessa, $da_data, $a_data, "imp");
                                        }

                                        if($e_query_ral->num_rows > 0){
                                            while($row_ral = $e_query_ral->fetch_array()){

                                                $totale_sal += $row_ral['totale_ral'];

                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_sal, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_contabilita.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=imp"><i class=" btn fa fa-search"></i></a></td>

                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Differenza: </td>
                                        <?
                                        $diff = $totale_sal - $totale_finale;
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($diff, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;"> Differenza %: </td>
                                        <td style="padding:5px; font-size:13px;"><b>
                                                <? if($totale_finale != 0){ ?>
                                                    <? $percent = ($diff * 100)/$totale_finale?>
                                                    <?=number_format($percent, 4, ',', '.');?>  %
                                                <? } else { ?>
                                                    0 %
                                                <? } ?>
                                            </b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                </table>
                            </td>
                        </tr><!--//END: Riepilogo costi-->
                        </tbody>
                    </table>
                </section>
                <!--FINE IMP-->

                <!--CG-->
                <br>
                <h1>CG</h1>
                <section id="no-more-tables">
                    <table class="table-striped table-condensed cf" style="width:100%">
                        <thead class="cf">
                        <tr>
                            <th style="text-align:center; width:30%; border-right: thin solid white">Monitoraggio costi commessa</th>
                            <th style="text-align:center">Codice commessa: <?=$row_c['codice']?> </th>

                        </tr>
                        </thead>
                        <tbody>

                        <?
                        $tot_complessivo_magazzino = 0;
                        if($row_c['campo4'] != ""){
                            $magazzino = $row_c['campo4'];


                            if ($da_data == "") {
                                $data_partenza = $row_c['data_inizio'];
                                $query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} ) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
                            } else {
                                $data_partenza = $da_data;
                                $data_fine = $a_data;

                                $query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'}) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'} AND MVM_MAST.MMDATREG <= {d '$data_fine'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
                            }

                            $params = array();
                            $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                            $result_somma1 = sqlsrv_query($conn, $query_somma1, $params, $options);
                            $somma = 0;
                            while ($row_somma1 = sqlsrv_fetch_array($result_somma1, SQLSRV_FETCH_ASSOC)) {

                                $somma += $row_somma1['TOTALE'];
                            }
                            $tot_complessivo_magazzino += $somma;
                            ?>

                        <? } ?>



                        <!--Costi operati-->

                        <?
                        $totale_operai_finale = 0;
                        $e_query_ruolino = $ruolino -> caricaDipendentiRuolinoAll();
                        while($row = $e_query_ruolino->fetch_array()){
                            $presenza = new Presenze();
                            if($da_data == ""){
                                $e_totale = $presenza->oreLavoroCommessaTl($id_commessa, "cg");
                            } else {
                                $e_totale = $presenza->oreLavoroCommessaDataTl($id_commessa, $da_data, $a_data, "cg");
                            }

                            $tot_per_mese = 0;
                            $tot_costo = 0;

                            $costo = new Costi();
                            $costo_orario_medio_totale = 0;
                            $numero_giorni = 0;
                            //Calcolo ore totali per la commessa
                            while($row_totale = $e_totale->fetch_array()){
                                $dipendenti_oggi = explode(",", $row_totale['id_dipendenti']);
                                for($l=0; $l<count($dipendenti_oggi); $l++){
                                    if($row['id'] == intval($dipendenti_oggi[$l])){
                                        $tot_per_mese += $row_totale['ore'];
                                        $costo_esploso = explode("-", $row_totale['data']);

                                        $costo_paretnza = $costo_esploso[0]."-".$costo_esploso[1]."-1";
                                        $costo_h = $costo->costoAttualeCommessa($row['id'], $costo_paretnza, $id_commessa);
                                        if($costo_h == 0){
                                            $costo_h = $costo->costoAttualeNuovo($row['id'], $costo_paretnza);
                                        }
                                        $costo_tmp = $costo_h * $row_totale['ore'];
                                        $tot_costo += $costo_tmp;
                                        $costo_orario_medio_totale += $costo_h;
                                        $numero_giorni += 1;
                                    }
                                }
                            }

                            $totale_operai_finale += $tot_costo;
                            ?>
                            <? if($tot_per_mese > 0){ ?>

                            <? } ?>
                        <? } ?>
                        <!--//END: Costi operati-->
                        <tr><!--Riepilogo costi-->
                            <td style="text-align:center" data-title="Riepilogo costi">Riepilogo costi</td>
                            <td>
                                <table style="width:100%">
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Costi Materiale: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_complessivo_magazzino, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="costo.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Materiale esterno-->
                                        <td style="padding:5px; font-size:13px;"> Costi Forniture Esterne Materiale: </td>
                                        <?
                                        $tot_esterno = 0;
                                        $esterno = new MaterialiEsterni();
                                        if($da_data == ""){
                                            $e_query_esterno = $esterno->caricaFattureTl($id_commessa, "MATERIALE", "cg");
                                        } else {
                                            $e_query_esterno = $esterno->caricaFattureDataTl($id_commessa, $da_data, $a_data, "MATERIALE", "cg");
                                        }
                                        if($e_query_esterno->num_rows > 0){
                                            while($row_esterno = $e_query_esterno->fetch_array()){
                                                $tot_esterno += $row_esterno['importo_totale'];
                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_esterno, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_materiali_esterni.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=MATERIALE&tipo=cg"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Materiale esterno-->
                                        <td style="padding:5px; font-size:13px;"> Costi Forniture Esterne Manodopera: </td>
                                        <?
                                        $tot_esterno_manodopera = 0;
                                        $esterno = new MaterialiEsterni();
                                        if($da_data == ""){
                                            $e_query_esterno = $esterno->caricaFattureTl($id_commessa, "MANODOPERA", "cg");
                                        } else {
                                            $e_query_esterno = $esterno->caricaFattureDataTl($id_commessa, $da_data, $a_data, "MANODOPERA", "cg");
                                        }
                                        if($e_query_esterno->num_rows > 0){
                                            while($row_esterno = $e_query_esterno->fetch_array()){
                                                $tot_esterno_manodopera += $row_esterno['importo_totale'];
                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_esterno_manodopera, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_materiali_esterni.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=MANODOPERA&tipo=cg"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Costi Manodopera: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_operai_finale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="costo_operai.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tl=cg"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Totale materiale-->
                                        <? $totale_materiale = $tot_complessivo_magazzino+$tot_esterno?>
                                        <td style="padding:5px; font-size:13px;">  Totale Materiale: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_materiale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Totale Costi: </td>
                                        <?
                                        $totale_finale = $tot_complessivo_magazzino + $totale_operai_finale + $tot_esterno_manodopera + $tot_esterno;
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_finale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>

                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Totale Contabilit&agrave;: </td>
                                        <?
                                        $totale_sal = 0;
                                        $ral = new Ral();
                                        if($da_data == ""){
                                            $e_query_ral = $ral->caricaRalTl($id_commessa, "cg");
                                        } else {
                                            $e_query_ral = $ral->caricaRalDataTl($id_commessa, $da_data, $a_data, "cg");
                                        }

                                        if($e_query_ral->num_rows > 0){
                                            while($row_ral = $e_query_ral->fetch_array()){

                                                $totale_sal += $row_ral['totale_ral'];

                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_sal, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_contabilita.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=cg"><i class=" btn fa fa-search"></i></a></td>

                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Differenza: </td>
                                        <?
                                        $diff = $totale_sal - $totale_finale;
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($diff, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;"> Differenza %: </td>
                                        <td style="padding:5px; font-size:13px;"><b>
                                                <? if($totale_finale != 0){ ?>
                                                    <? $percent = ($diff * 100)/$totale_finale?>
                                                    <?=number_format($percent, 4, ',', '.');?>  %
                                                <? } else { ?>
                                                    0 %
                                                <? } ?>
                                            </b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                </table>
                            </td>
                        </tr><!--//END: Riepilogo costi-->
                        </tbody>
                    </table>
                </section>
                <!--FINE CG-->

                <!--FV-->
                <br>
                <h1>FV</h1>
                <section id="no-more-tables">
                    <table class="table-striped table-condensed cf" style="width:100%">
                        <thead class="cf">
                        <tr>
                            <th style="text-align:center; width:30%; border-right: thin solid white">Monitoraggio costi commessa</th>
                            <th style="text-align:center">Codice commessa: <?=$row_c['codice']?> </th>

                        </tr>
                        </thead>
                        <tbody>

                        <?
                        $tot_complessivo_magazzino = 0;
                        if($row_c['campo5'] != ""){
                            $magazzino = $row_c['campo5'];


                            if ($da_data == "") {
                                $data_partenza = $row_c['data_inizio'];
                                $query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} ) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
                            } else {
                                $data_partenza = $da_data;
                                $data_fine = $a_data;

                                $query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'}) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'} AND MVM_MAST.MMDATREG <= {d '$data_fine'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
                            }

                            $params = array();
                            $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                            $result_somma1 = sqlsrv_query($conn, $query_somma1, $params, $options);
                            $somma = 0;
                            while ($row_somma1 = sqlsrv_fetch_array($result_somma1, SQLSRV_FETCH_ASSOC)) {

                                $somma += $row_somma1['TOTALE'];
                            }
                            $tot_complessivo_magazzino += $somma;
                            ?>

                        <? } ?>



                        <!--Costi operati-->

                        <?
                        $totale_operai_finale = 0;
                        $e_query_ruolino = $ruolino -> caricaDipendentiRuolinoAll();
                        while($row = $e_query_ruolino->fetch_array()){
                            $presenza = new Presenze();
                            if($da_data == ""){
                                $e_totale = $presenza->oreLavoroCommessaTl($id_commessa, "fv");
                            } else {
                                $e_totale = $presenza->oreLavoroCommessaDataTl($id_commessa, $da_data, $a_data, "fv");
                            }

                            $tot_per_mese = 0;
                            $tot_costo = 0;

                            $costo = new Costi();
                            $costo_orario_medio_totale = 0;
                            $numero_giorni = 0;
                            //Calcolo ore totali per la commessa
                            while($row_totale = $e_totale->fetch_array()){
                                $dipendenti_oggi = explode(",", $row_totale['id_dipendenti']);
                                for($l=0; $l<count($dipendenti_oggi); $l++){
                                    if($row['id'] == intval($dipendenti_oggi[$l])){
                                        $tot_per_mese += $row_totale['ore'];
                                        $costo_esploso = explode("-", $row_totale['data']);

                                        $costo_paretnza = $costo_esploso[0]."-".$costo_esploso[1]."-1";
                                        $costo_h = $costo->costoAttualeCommessa($row['id'], $costo_paretnza, $id_commessa);
                                        if($costo_h == 0){
                                            $costo_h = $costo->costoAttualeNuovo($row['id'], $costo_paretnza);
                                        }
                                        $costo_tmp = $costo_h * $row_totale['ore'];
                                        $tot_costo += $costo_tmp;
                                        $costo_orario_medio_totale += $costo_h;
                                        $numero_giorni += 1;
                                    }
                                }
                            }

                            $totale_operai_finale += $tot_costo;
                            ?>
                            <? if($tot_per_mese > 0){ ?>

                            <? } ?>
                        <? } ?>
                        <!--//END: Costi operati-->
                        <tr><!--Riepilogo costi-->
                            <td style="text-align:center" data-title="Riepilogo costi">Riepilogo costi</td>
                            <td>
                                <table style="width:100%">
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Costi Materiale: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_complessivo_magazzino, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="costo.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Materiale esterno-->
                                        <td style="padding:5px; font-size:13px;"> Costi Forniture Esterne Materiale: </td>
                                        <?
                                        $tot_esterno = 0;
                                        $esterno = new MaterialiEsterni();
                                        if($da_data == ""){
                                            $e_query_esterno = $esterno->caricaFattureTl($id_commessa, "MATERIALE", "fv");
                                        } else {
                                            $e_query_esterno = $esterno->caricaFattureDataTl($id_commessa, $da_data, $a_data, "MATERIALE", "fv");
                                        }
                                        if($e_query_esterno->num_rows > 0){
                                            while($row_esterno = $e_query_esterno->fetch_array()){
                                                $tot_esterno += $row_esterno['importo_totale'];
                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_esterno, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_materiali_esterni.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=MATERIALE&tipo=fv"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Materiale esterno-->
                                        <td style="padding:5px; font-size:13px;"> Costi Forniture Esterne Manodopera: </td>
                                        <?
                                        $tot_esterno_manodopera = 0;
                                        $esterno = new MaterialiEsterni();
                                        if($da_data == ""){
                                            $e_query_esterno = $esterno->caricaFattureTl($id_commessa, "MANODOPERA", "fv");
                                        } else {
                                            $e_query_esterno = $esterno->caricaFattureDataTl($id_commessa, $da_data, $a_data, "MANODOPERA", "fv");
                                        }
                                        if($e_query_esterno->num_rows > 0){
                                            while($row_esterno = $e_query_esterno->fetch_array()){
                                                $tot_esterno_manodopera += $row_esterno['importo_totale'];
                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_esterno_manodopera, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_materiali_esterni.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=MANODOPERA&tipo=fv"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Costi Manodopera: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_operai_finale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="costo_operai.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tl=fv"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Totale materiale-->
                                        <? $totale_materiale = $tot_complessivo_magazzino+$tot_esterno?>
                                        <td style="padding:5px; font-size:13px;">  Totale Materiale: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_materiale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Totale Costi: </td>
                                        <?
                                        $totale_finale = $tot_complessivo_magazzino + $totale_operai_finale + $tot_esterno_manodopera + $tot_esterno;
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_finale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>

                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Totale Contabilit&agrave;: </td>
                                        <?
                                        $totale_sal = 0;
                                        $ral = new Ral();
                                        if($da_data == ""){
                                            $e_query_ral = $ral->caricaRalTl($id_commessa, "fv");
                                        } else {
                                            $e_query_ral = $ral->caricaRalDataTl($id_commessa, $da_data, $a_data, "fv");
                                        }

                                        if($e_query_ral->num_rows > 0){
                                            while($row_ral = $e_query_ral->fetch_array()){

                                                $totale_sal += $row_ral['totale_ral'];

                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_sal, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_contabilita.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=fv"><i class=" btn fa fa-search"></i></a></td>

                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Differenza: </td>
                                        <?
                                        $diff = $totale_sal - $totale_finale;
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($diff, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;"> Differenza %: </td>
                                        <td style="padding:5px; font-size:13px;"><b>
                                                <? if($totale_finale != 0){ ?>
                                                    <? $percent = ($diff * 100)/$totale_finale?>
                                                    <?=number_format($percent, 4, ',', '.');?>  %
                                                <? } else { ?>
                                                    0 %
                                                <? } ?>
                                            </b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                </table>
                            </td>
                        </tr><!--//END: Riepilogo costi-->
                        </tbody>
                    </table>
                </section>
                <!--FINE FV-->


                <!--OM-->
                <br>
                <h1>OM</h1>
                <section id="no-more-tables">
                    <table class="table-striped table-condensed cf" style="width:100%">
                        <thead class="cf">
                        <tr>
                            <th style="text-align:center; width:30%; border-right: thin solid white">Monitoraggio costi commessa</th>
                            <th style="text-align:center">Codice commessa: <?=$row_c['codice']?> </th>

                        </tr>
                        </thead>
                        <tbody>

                        <?
                        $tot_complessivo_magazzino = 0;
                        if($row_c['campo6'] != ""){
                            $magazzino = $row_c['campo6'];


                            if ($da_data == "") {
                                $data_partenza = $row_c['data_inizio'];
                                $query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} ) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
                            } else {
                                $data_partenza = $da_data;
                                $data_fine = $a_data;

                                $query_somma1 = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'}) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'} AND MVM_MAST.MMDATREG <= {d '$data_fine'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
                            }

                            $params = array();
                            $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                            $result_somma1 = sqlsrv_query($conn, $query_somma1, $params, $options);
                            $somma = 0;
                            while ($row_somma1 = sqlsrv_fetch_array($result_somma1, SQLSRV_FETCH_ASSOC)) {

                                $somma += $row_somma1['TOTALE'];
                            }
                            $tot_complessivo_magazzino += $somma;
                            ?>

                        <? } ?>



                        <!--Costi operati-->

                        <?
                        $totale_operai_finale = 0;
                        $e_query_ruolino = $ruolino -> caricaDipendentiRuolinoAll();
                        while($row = $e_query_ruolino->fetch_array()){
                            $presenza = new Presenze();
                            if($da_data == ""){
                                $e_totale = $presenza->oreLavoroCommessaTl($id_commessa, "om");
                            } else {
                                $e_totale = $presenza->oreLavoroCommessaDataTl($id_commessa, $da_data, $a_data, "om");
                            }

                            $tot_per_mese = 0;
                            $tot_costo = 0;

                            $costo = new Costi();
                            $costo_orario_medio_totale = 0;
                            $numero_giorni = 0;
                            //Calcolo ore totali per la commessa
                            while($row_totale = $e_totale->fetch_array()){
                                $dipendenti_oggi = explode(",", $row_totale['id_dipendenti']);
                                for($l=0; $l<count($dipendenti_oggi); $l++){
                                    if($row['id'] == intval($dipendenti_oggi[$l])){
                                        $tot_per_mese += $row_totale['ore'];
                                        $costo_esploso = explode("-", $row_totale['data']);

                                        $costo_paretnza = $costo_esploso[0]."-".$costo_esploso[1]."-1";
                                        $costo_h = $costo->costoAttualeCommessa($row['id'], $costo_paretnza, $id_commessa);
                                        if($costo_h == 0){
                                            $costo_h = $costo->costoAttualeNuovo($row['id'], $costo_paretnza);
                                        }
                                        $costo_tmp = $costo_h * $row_totale['ore'];
                                        $tot_costo += $costo_tmp;
                                        $costo_orario_medio_totale += $costo_h;
                                        $numero_giorni += 1;
                                    }
                                }
                            }

                            $totale_operai_finale += $tot_costo;
                            ?>
                            <? if($tot_per_mese > 0){ ?>

                            <? } ?>
                        <? } ?>
                        <!--//END: Costi operati-->
                        <tr><!--Riepilogo costi-->
                            <td style="text-align:center" data-title="Riepilogo costi">Riepilogo costi</td>
                            <td>
                                <table style="width:100%">
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Costi Materiale: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_complessivo_magazzino, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="costo.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Materiale esterno-->
                                        <td style="padding:5px; font-size:13px;"> Costi Forniture Esterne Materiale: </td>
                                        <?
                                        $tot_esterno = 0;
                                        $esterno = new MaterialiEsterni();
                                        if($da_data == ""){
                                            $e_query_esterno = $esterno->caricaFattureTl($id_commessa, "MATERIALE", "om");
                                        } else {
                                            $e_query_esterno = $esterno->caricaFattureDataTl($id_commessa, $da_data, $a_data, "MATERIALE", "om");
                                        }
                                        if($e_query_esterno->num_rows > 0){
                                            while($row_esterno = $e_query_esterno->fetch_array()){
                                                $tot_esterno += $row_esterno['importo_totale'];
                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_esterno, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_materiali_esterni.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=MATERIALE&tipo=om"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Materiale esterno-->
                                        <td style="padding:5px; font-size:13px;"> Costi Forniture Esterne Manodopera: </td>
                                        <?
                                        $tot_esterno_manodopera = 0;
                                        $esterno = new MaterialiEsterni();
                                        if($da_data == ""){
                                            $e_query_esterno = $esterno->caricaFattureTl($id_commessa, "MANODOPERA", "om");
                                        } else {
                                            $e_query_esterno = $esterno->caricaFattureDataTl($id_commessa, $da_data, $a_data, "MANODOPERA", "om");
                                        }
                                        if($e_query_esterno->num_rows > 0){
                                            while($row_esterno = $e_query_esterno->fetch_array()){
                                                $tot_esterno_manodopera += $row_esterno['importo_totale'];
                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($tot_esterno_manodopera, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_materiali_esterni.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=MANODOPERA&tipo=om"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Costi Manodopera: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_operai_finale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="costo_operai.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tl=om"><i class=" btn fa fa-search"></i></a></td>
                                    </tr>
                                    <tr><!--Totale materiale-->
                                        <? $totale_materiale = $tot_complessivo_magazzino+$tot_esterno?>
                                        <td style="padding:5px; font-size:13px;">  Totale Materiale: </td>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_materiale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Totale Costi: </td>
                                        <?
                                        $totale_finale = $tot_complessivo_magazzino + $totale_operai_finale + $tot_esterno_manodopera + $tot_esterno;
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_finale, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>

                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Totale Contabilit&agrave;: </td>
                                        <?
                                        $totale_sal = 0;
                                        $ral = new Ral();
                                        if($da_data == ""){
                                            $e_query_ral = $ral->caricaRalTl($id_commessa, "om");
                                        } else {
                                            $e_query_ral = $ral->caricaRalDataTl($id_commessa, $da_data, $a_data, "om");
                                        }

                                        if($e_query_ral->num_rows > 0){
                                            while($row_ral = $e_query_ral->fetch_array()){

                                                $totale_sal += $row_ral['totale_ral'];

                                            }
                                        }
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($totale_sal, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" href="pagina_contabilita.php?id=<?=$id_commessa?>&da_data=<?=$da_data?>&a_data=<?=$a_data?>&tipologia=om"><i class=" btn fa fa-search"></i></a></td>

                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;">  Differenza: </td>
                                        <?
                                        $diff = $totale_sal - $totale_finale;
                                        ?>
                                        <td style="padding:5px; font-size:13px;"><b><?=number_format($diff, 2, ',', '.');?> &euro;</b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px; font-size:13px;"> Differenza %: </td>
                                        <td style="padding:5px; font-size:13px;"><b>
                                                <? if($totale_finale != 0){ ?>
                                                    <? $percent = ($diff * 100)/$totale_finale?>
                                                    <?=number_format($percent, 4, ',', '.');?>  %
                                                <? } else { ?>
                                                    0 %
                                                <? } ?>
                                            </b></td>
                                        <td><a target="_blank" ></td>
                                    </tr>
                                </table>
                            </td>
                        </tr><!--//END: Riepilogo costi-->
                        </tbody>
                    </table>
                </section>
                <!--FINE OM-->

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
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare l'ordine? </div>
      <div class="modal-footer">
        <input id="id_da_eliminare" type="hidden" />
        <input id="nome_da_eliminare" type="hidden" />
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
