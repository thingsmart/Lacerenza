<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Spese.php");

$filtro = isset($_GET['filtro_spesa']) ? $_GET['filtro_spesa'] : "";
$data_inizio = isset($_GET['data_inizio']) ? $_GET['data_inizio'] : "";
$data_fine = isset($_GET['data_fine']) ? $_GET['data_fine'] : "";
$targa = $_GET['targa'];
$data_inizio = ($data_inizio != "") ? capovolgiData($data_inizio) : date("Y-01-01");
$data_fine = ($data_fine != "") ? capovolgiData($data_fine) : date("Y-12-31");

$id_mezzo = $_GET['id'];

//estraggo elenco commesse
$spese = new Spese();
if($filtro == ""){
    $e_query_spese = $spese->CaricaSpeseByData($id_mezzo, $data_inizio , $data_fine);
} else {
    $e_query_spese = $spese->filtraSpeseByData($id_mezzo, $filtro, $data_inizio , $data_fine);
}
$numeroSpese = $spese->numeroSpese();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_spese.js" type="text/javascript"></script>

<? if($numeroSpese > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">Tipo</th>
                <th style="text-align:center">Data Pagamento</th>
                <th style="text-align:center">Costo</th>
                <th style="text-align:center">Scadenza</th>
                <th style="text-align:center">Fattura di riferimento</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           		$totale = 0; $totaleFissi = 0; $totaleManutenzione = 0;
                while($row = $e_query_spese->fetch_array()){
                	$totale += $row['costo'];
					if($row['tipo'] == 'ASSICURAZIONE' || $row['tipo'] == 'BOLLO' || $row['tipo'] == 'REVISIONE' ) {
						$totaleFissi += $row['costo'];
					} else {
						$totaleManutenzione += $row['costo'];
					}
			?>
			<tr>
				<td style="text-align:center" data-title="Tipo"><?=$row['tipo']?></td>
				<td style="text-align:center" data-title="Data"><?=CapovolgiData($row['data_ultimo_pagamento'])?></td>
				<td style="text-align:center" data-title="Costo">&euro; <?=number_format($row['costo'], 2, ',', '.');?></td>
				<td style="text-align:center" data-title="Scadenza">
                    <? if($row['data_scadenza'] != "0000-00-00"){ ?>    
                        <?=CapovolgiData($row['data_scadenza'])?>
                    <? } else { ?>
                        Data Assente
                    <? } ?>
				</td>
				<td style="text-align:center" data-title="Fattura di riferimento">
                	<? if($row['riferimento_fattura'] != "") { ?>
                        <a href="uploads/mezzi/<?=$id_mezzo?>/spese/<?=$row['riferimento_fattura']?>" target="_blank">
                            Apri allegato
                        </a>
                    <? } else { ?>
                    	Nessun allegato
                    <? } ?>
                </td>
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuova_spesa.php?id=<?=$row['id']?>&id_mezzo=<?=$id_mezzo?>&data_inizio=<?=$data_inizio?>&data_fine=<?=$data_fine?>&targa=<?=$targa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_spesa" nome="<?=$row['riferimento_fattura']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
				</td>
			</tr>
			<?php
				} //END WHILE
			?>
			<tr>
				<td colspan="2" style="text-align:center"> <b>Totale:</b> </td>
				<td style="text-align:center"><b><?=$totale?> &euro;</b></td>
			</tr>
		   <tr>
			   <td colspan="2" style="text-align:center"> <b>Totale Costi Fissi:</b> </td>
			   <td style="text-align:center"><b><?=$totaleFissi?> &euro;</b></td>
		   </tr>
		   <tr>
			   <td colspan="2" style="text-align:center"> <b>Totale Costi Manutenzione:</b> </td>
			   <td style="text-align:center"><b><?=$totaleManutenzione?> &euro;</b></td>
		   </tr>
          </tbody>
       </table>
</section>
<? } else {?>
	Nessun dato trovato
<? } ?>

<input type="hidden" value="<?=$id_mezzo?>" id="id_mezzo"/>