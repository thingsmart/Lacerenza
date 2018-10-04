<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Mezzi.php");
require_once("../classi/class.Manutenzione.php");

$filtro = isset($_GET['filtro_mezzo']) ? $_GET['filtro_mezzo'] : "";
$data_inizio = isset($_GET['data_inizio']) ? $_GET['data_inizio'] : "";
$data_fine = isset($_GET['data_fine']) ? $_GET['data_fine'] : "";

$anno_prima = date("Y")-1;
$data_inizio = ($data_inizio != "") ? capovolgiData($data_inizio) : date($anno_prima."-01-01");
$data_fine = ($data_fine != "") ? capovolgiData($data_fine) : date("Y-12-31");;

//estraggo elenco commesse
$mezzi = new Mezzi();

if($filtro == ""){
$e_query_mezzo = $mezzi->CaricaMezzi();
} else {
$e_query_mezzo = $mezzi->filtraMezzi($filtro);
}
$numeroMezzi = $mezzi->numeroMezzi();
?>

<? if($numeroMezzi > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">Mezzo</th>
                <th style="text-align:center">Targa</th>
                <th style="text-align:center">Ultima Manutenzione</th>
                <th style="text-align:center">Manutenzione</th>
           </tr>
        </thead>
        <tbody>
           <?php
				while($row = $e_query_mezzo->fetch_array()){
					$mezzi = new Mezzi();
					$costo_totale = $mezzi->costoTotale($row['id'], $data_inizio, $data_fine);
			?>
			<tr class="<?=$row['venduto']?>" <? if($row['venduto'] == "VENDUTO"){ echo "style='display:none'"; } ?>>
				<td class="centra" style="text-align:center" data-title="Mezzo"><?=$row['mezzo']?></td>
				<td class="centra" style="text-align:center" data-title="Targa"><?=$row['targa']?></td>
				<td class="centra" style="text-align:center" data-title="Ultima manutenzione">
					<?
					$manutenzione = new Manutenzione();
					$e_query_manutenzione = $manutenzione->caricaUltima($row['id']);
					if($e_query_manutenzione->num_rows > 0){
						$row_manutenzione = $e_query_manutenzione->fetch_array();
					?>
						<?=CapovolgiData($row_manutenzione['data'])?>
					<? } else { ?>
						Nessuna
					<? } ?>
				</td>
                <td class="centra" style="text-align:center" data-title="Manutenzione">
                 	<a style="width:100%" class="btn" href="manutenzione.php?id=<?=$row['id']?>&targa=<?=$row['targa']?>"><i class="fa fa-tint fa-lg"></i></a>
				</td>
				
			</tr>
			<?php
				} //END WHILE
			?>
          </tbody>
       </table>
</section>
<? } else {?>
	Nessun dato trovato
<? } ?>