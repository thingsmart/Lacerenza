<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Tagliandi.php");

$filtro = isset($_GET['filtro_tagliando']) ? $_GET['filtro_tagliando'] : "";
$data_inizio = isset($_GET['data_inizio']) ? $_GET['data_inizio'] : "";
$data_fine = isset($_GET['data_fine']) ? $_GET['data_fine'] : "";
$targa = isset($_GET['targa']) ? $_GET['targa'] : "";

$data_inizio = ($data_inizio != "") ? capovolgiData($data_inizio) : date("Y-01-01");
$data_fine = ($data_fine != "") ? capovolgiData($data_fine) : date("Y-12-31");

$id_mezzo = $_GET['id'];

//estraggo elenco commesse
$tagliandi = new Tagliandi();

if($filtro == ""){
$e_query_mezzo = $tagliandi->caricaTagliandiByData($id_mezzo, $data_inizio , $data_fine);
} else {
$e_query_mezzo = $tagliandi->filtraTagliandiByData($id_mezzo, $filtro, $data_inizio , $data_fine);
}
$numeroTagliandi = $tagliandi->numeroTagliandi();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_tagliandi.js" type="text/javascript"></script>

<? if($numeroTagliandi > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">Tipo</th>
                <th style="text-align:center">Data tagliando</th>
                <th style="text-align:center">Costo</th>
                <th style="text-align:center">Km tagliando</th>
                <th style="text-align:center">Fattura di riferimento</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           		$totale = 0;
				while($row = $e_query_mezzo->fetch_array()){
					$totale += $row['costo'];
			?>
			<tr>
				<td style="text-align:center" data-title="Tipo"><?=$row['tipo_tagliando']?></td>
				<td style="text-align:center" data-title="Data"><?=CapovolgiData($row['data_tagliando'])?></td>
				<td style="text-align:center" data-title="Costo"><?=$row['costo']?> &euro;</td>
				<td style="text-align:center" data-title="Km tagliando"><?=$row['tagliando_ogni']?></td>
				<td style="text-align:center" data-title="Fattura di riferimento">
                	<? if($row['riferimento_fattura'] != "") { ?>
                        <a href="uploads/mezzi/<?=$id_mezzo?>/tagliandi/<?=$row['riferimento_fattura']?>" target="_blank">
                            Apri allegato
                        </a>
                    <? } else { ?>
                    	Nessun allegato
                    <? } ?>
                </td>
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuovo_tagliando.php?id=<?=$row['id']?>&id_mezzo=<?=$id_mezzo?>&data_fine=<?=$data_fine?>&data_inizio=<?=$data_inizio?>&targa=<?=$targa?>"><i class="fa fa-edit"></i> </a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_mezzo" nome="<?=$row['riferimento_fattura']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash"></i> </a>
				</td>
			</tr>
			<?php
				} //END WHILE
			?>
			<tr>
				<td colspan="2" style="text-align:center"> <b>Totale:</b> </td>
				<td style="text-align:center"><b><?=$totale?> &euro;</b></td>
			</tr>
          </tbody>
       </table>
</section>
<? } else {?>
	Nessun dato trovato
<? } ?>

<input type="hidden" value="<?=$id_mezzo?>" id="id_mezzo"/>