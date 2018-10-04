<?php


require_once("../lib/funzioni_sito.php");
require_once("../lib/verificaConvertiData.php");
include("../databases/db_function.php");
$conn = connectIIS();

$da_data = isset($_GET['da_data']) ? $_GET['da_data'] : "";
$a_data = isset($_GET['a_data']) ? $_GET['a_data'] : "";

$data_partenza = $_GET['data_partenza'];
$data_fine_controllo = isset($_GET['data_fine']) ? $_GET['data_fine'] : "";
$data_fine = isset($_GET['data_fine']) ? $_GET['data_fine'] : date("Y-12-31");
$testo_cerca = $_GET['testo_cerca'];

$data_partenza = ($da_data != "") ? CapovolgiData($da_data) : $data_partenza;
$data_fine = ($a_data != "") ? CapovolgiData($a_data) : $data_fine;
$data_fine_controllo = ($a_data != "") ? CapovolgiData($a_data) : $data_fine_controllo;

$id_commessa = $_GET['id'];
$magazzino =  $_GET['magazzino'];




if($data_fine == "") {
  $query = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} ) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
} else {
  if($data_fine_controllo != "") {
    $data_partenza = CapovolgiData($data_partenza);
    $data_fine = CapovolgiData($data_fine);
  }
//  $query = "select DOC_MAST.MVDATREG,DOC_DETT.MVCODART,DOC_DETT.MVDESART,DOC_DETT.MVUNIMIS,DOC_DETT.MVCAUMAG,DOC_DETT.MVCODMAT,DOC_DETT.MVQTAMOV,SALDIART.SLVALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as SLTOTALE from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART=SALDIART.SLCODICE) where (DOC_DETT.MVCODMAT = '$magazzino' AND DOC_MAST.MVDATREG >= {d '$data_partenza'} AND SALDIART.SLCODMAG = '00')     order by  2, 1 ";

  $query = "select DOC_MAST.MVDATREG as DATREG,DOC_DETT.MVCODART as CODART,DOC_DETT.MVDESART as DESART,DOC_DETT.MVUNIMIS as UNIMIS,DOC_DETT.MVCAUMAG as CAUMAG,DOC_DETT.MVCODMAT as CODMAT,DOC_DETT.MVQTAMOV as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * DOC_DETT.MVQTAMOV) as TOTALE, DOC_DETT.CPROWORD AS ID from ((SRLDOC_MAST DOC_MAST Left outer Join SRLDOC_DETT DOC_DETT on DOC_MAST.MVSERIAL=DOC_DETT.MVSERIAL) Left outer Join SRLSALDIART SALDIART on DOC_DETT.MVCODART = SALDIART.SLCODICE) where ((DOC_MAST.MVDATREG >= {d '$data_partenza'} AND DOC_MAST.MVDATREG <= {d '$data_fine'}) AND DOC_DETT.MVCODMAT = '$magazzino' AND SALDIART.SLCODMAG = '00')    union select MVM_MAST.MMDATREG as DATREG,MVM_DETT.MMCODART as CODART,ART_ICOL.ARDESART as DESART,MVM_DETT.MMUNIMIS as UNIMIS,MVM_DETT.MMCAUMAG as CAUMAG,MVM_DETT.MMCODMAG as CODMAT,-(MVM_DETT.MMQTAMOV) as QTAMOV,SALDIART.SLVALUCA as VALUCA,(SALDIART.SLVALUCA * -(MVM_DETT.MMQTAMOV)) as TOTALE, MVM_DETT.CPROWORD AS ID  from (((SRLMVM_MAST MVM_MAST Left outer Join SRLMVM_DETT MVM_DETT on MVM_MAST.MMSERIAL=MVM_DETT.MMSERIAL) Left outer Join SRLART_ICOL ART_ICOL on MVM_DETT.MMCODART=ART_ICOL.ARCODART) Left outer Join SRLSALDIART SALDIART on MVM_DETT.MMCODART = SALDIART.SLCODICE) where ((MVM_MAST.MMDATREG >= {d '$data_partenza'} AND MVM_MAST.MMDATREG <= {d '$data_fine'}) AND MVM_MAST.MMTCAMAG = 'RES' AND MVM_DETT.MMCODMAG = '$magazzino' AND SALDIART.SLCODMAG = '00')     order by  2 , 1";
}
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query($conn,$query, $params, $options);

$row_count = sqlsrv_num_rows( $result );


?>
<script>
  $(document).ready(function() {

    //inizializzo datepicker
    $('.data_picker').datepicker({
      language: 'it',
      autoclose: true
    });

    $("#cerca").click(function(){
      var da_data = $("#da_data").val();
      var a_data = $("#a_data").val();
      var testo_cerca = $("#testo_cerca").val();
      if(da_data == "" || a_data == ""){
        alert("Selezionare entrambe le date");
      }
      $("#tabella_costo_materiale").html('<div style="text-align:center"><img src="img/load.gif"/></div>');
      $("#tabella_costo_materiale").load("php/tabella_costo_materiale.php?id=<?=$id_commessa?>&magazzino=<?=$magazzino?>&data_partenza="+da_data+"&data_fine="+a_data+"&testo_cerca="+testo_cerca);
    });


  });
</script>
<div class="row" style="margin-bottom:10px;">
  <div class="col-lg-12">
    <div class="col-lg-3">
      <input class="form-control data_picker" type="text" id="da_data" value="<?=CapovolgiData($data_partenza)?>" readonly/>
    </div>
    <div class="col-lg-3">
      <input class="form-control data_picker" type="text" id="a_data" value="<?=CapovolgiData($data_fine)?>" readonly/>
    </div>
    <div class="col-lg-3">
      <input class="form-control " type="text" id="testo_cerca" value="<?=$testo_cerca?>"/>
    </div>
    <div class="col-lg-3">
      <div class="btn btn-info btn-block" id="cerca">Cerca</div>
    </div>
  </div>
</div>

<section id="no-more-tables">
  <?if ($row_count == 0){ ?>
    Nessun dato trovato
  <? } else { ?>
    <table class="table-striped table-condensed cf" style="width:100%">
      <thead class="cf">
      <tr>
        <th style="text-align:center">DATA</th>
        <th style="text-align:center">CODICE</th>
        <th style="text-align:center">DESCRIZIONE</th>
        <th style="text-align:center">U.M.</th>
        <th style="text-align:center">CAUSALE</th>
        <th style="text-align:center">MAGAZZINO</th>
        <th style="text-align:center">QTA'</th>
        <th style="text-align:center">COSTO</th>
        <th style="text-align:center">TOTALE</th>
      </tr>
      </thead>
      <tbody>
      <?php
      $totale = 0;
      while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ){
        $totale += $row['TOTALE'];
        ?>
        <tr>
          <td class="centra" style="text-align:center" data-title="DATA">
            <? 	$newDate = date_format($row['DATREG'], 'd-m-Y');

            ?>
            <?=$newDate?></td>
          <td class="centra" style="text-align:center" data-title="CODICE"><?=$row['CODART']?></td>
          <td class="centra" style="text-align:center" data-title="DESCRIZIONE"><?=$row['DESART']?></td>
          <td class="centra" style="text-align:center" data-title="U.M."><?=$row['UNIMIS']?></td>
          <td class="centra" style="text-align:center" data-title="CAUSALE"><?=$row['CAUMAG']?></td>
          <td class="centra" style="text-align:center" data-title="MAGAZZINO"><?=$row['CODMAT']?></td>
          <td class="centra" style="text-align:center" data-title="QTA'"><?=$row['QTAMOV']?></td>
          <td class="centra" style="text-align:center" data-title="COSTO"><?=$row['VALUCA']?></td>
          <td class="centra" style="text-align:center" data-title="TOTALE"><?=number_format($row['TOTALE'], 3, ',', '.');?></td>
        </tr>
      <?php
      } //END WHILE
      ?>
      <tr>
        <td colspan="8">&nbsp;</td>
        <td style="background:lightgreen"><?=number_format($totale, 3, ',', '.');?> &euro;</td>
      </tr>
      </tbody>
    </table>
  <? } ?>
</section>	
        