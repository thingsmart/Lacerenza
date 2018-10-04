<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Mezzi.php");
require_once("../classi/class.Benzine.php");

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

<!--SCRIPT SITO-->
<script src="js/sito/tabella_mezzi.js" type="text/javascript"></script>

<? if($numeroMezzi > 0){ ?>
	<strong id="testo_mostra">Mostra mezzi venduti</strong> <input type="checkbox" id="venduti" />
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">Mezzo</th>
                <th style="text-align:center">Possesso</th>
                <th style="text-align:center">Targa</th>
                <th style="text-align:center">Km Percorsi</th>
                <th style="text-align:center">Ultimo agg. km</th>
                <th style="text-align:center">Esso Card</th>
                <th style="text-align:center">Tagliandi</th>
				<th style="text-align:center">(Bolli | Assic...)</th>
				<th style="text-align:center">Libretto</th>
				<th style="text-align:center">Ultime Op.</th>
				<th style="text-align:center">Statistiche</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
                <th style="text-align:center">Costo Totale</th>
           </tr>
        </thead>
        <tbody>
           <?php
				while($row = $e_query_mezzo->fetch_array()){
					$mezzi = new Mezzi();
					$costo_totale = $mezzi->costoTotale($row['id'], $data_inizio, $data_fine);
					$benzina_obj = new Benzine();
					$e_query_aggiornamento = $benzina_obj->caricaBenzinaAggiornamento($row['id']);
					$dati_aggionramento = $e_query_aggiornamento->fetch_array();


			?>
			<tr class="<?=$row['venduto']?>" <? if($row['venduto'] == "VENDUTO"){ echo "style='display:none'"; } ?>>
				<td class="centra" style="text-align:center" data-title="Mezzo"><?=$row['mezzo']?></td>
				<td class="centra" style="text-align:center" data-title="Possesso"><?=str_replace("_", " ", $row['venduto'])?></td>
				<td class="centra" style="text-align:center" data-title="Targa"><?=$row['targa']?></td>
				<td class="centra" style="text-align:center" data-title="Km Percorsi">
					<? if($dati_aggionramento['km_veicolo'] != ""){ ?>
						<?=$dati_aggionramento['km_veicolo']?>
					<? } else { ?>
						<?=$row['km_percorsi']?>
					<? } ?>
				</td>
				<td class="centra" style="text-align:center" data-title="Ultimo aggiornamento">
					<? if($dati_aggionramento['data'] != ""){ ?>
						<?=CapovolgiData($dati_aggionramento['data'])?>
					<? } else { ?>
						<?=CapovolgiData($row['data_ultimo_aggiornamento_km'])?>
					<? } ?>
				</td>
                <td class="centra" style="text-align:center" data-title="Esso Card">
                 	<a style="width:100%" class="btn" href="pagina_benzina.php?id=<?=$row['id']?>&targa=<?=$row['targa']?>&data_fine=<?=$data_fine?>&data_inizio=<?=$data_inizio?>"><i class="fa fa-tint fa-lg"></i></a>
				</td>
				<td class="centra" style="text-align:center" data-title="Tagliandi">
                 	<a style="width:100%" class="btn" href="pagina_tagliandi.php?id=<?=$row['id']?>&data_fine=<?=$data_fine?>&data_inizio=<?=$data_inizio?>&targa=<?=$row['targa']?>"><i class="fa fa-file-text fa-lg"></i></a>
				</td>
				<td class="centra" data-title="(Bolli|Assic...)" style="text-align:center">
                 	<a style="width:100%" class="btn" href="pagina_spese.php?id=<?=$row['id']?>&data_fine=<?=$data_fine?>&data_inizio=<?=$data_inizio?>&targa=<?=$row['targa']?>"><i class="fa fa-files-o fa-lg"></i></a>
				</td>
				<td class="centra" data-title="Libretto" style="text-align:center">
					<a style="width:100%" class="btn" href="pagina_libretto.php?id=<?=$row['id']?>&data_fine=<?=$data_fine?>&data_inizio=<?=$data_inizio?>&targa=<?=$row['targa']?>"><i class="fa fa-book fa-lg"></i></a>
				</td>
				<td class="centra" data-title="Ultimi Tagliandi" style="text-align:center">
					<a style="width:100%" class="btn btn_tagliandi_mezzo" id="<?=$row['id']?>" targa="<?=$row['targa']?>" data-toggle="modal" data-target=".bs-dettaglio"><i class="fa fa-list fa-lg"></i></a>
				</td>
				<td class="centra" data-title="Statistiche" style="text-align:center">
					<a style="width:100%" class="btn" href="statistiche_mezzo.php?id=<?=$row['id']?>" id="<?=$row['id']?>"><i class="fa fa-bar-chart-o fa-lg"></i></a>
				</td>
                <td class="centra" data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuovo_mezzo.php?id=<?=$row['id']?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td class="centra" data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_mezzo" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
				</td>
				<td class="centra" style="text-align:center" data-title="Costo Totale">&euro; <?=number_format($costo_totale, 2, ',', '.');?></td>
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


<!--Modal Dettagli-->
<div class="modal <?=$fade?> bs-dettaglio" tabindex="-1" role="dialog" id="dialog_dettaglio" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="titoloDettaglio" style="color: #185a7a">Dettaglio Mezzo</h4>
			</div>
			<div class="modal-body" id="bodyDettaglio" > Sei sicuro di voler eliminare il mezzo e tutti i dati relativi ad esso? </div>
			<div class="modal-footer">
				<a class="btn btn-danger text-left">Non Eseguito</a>
				<a class="btn btn-success text-left">Eseguito</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Ho letto</button>
			</div>
		</div>
	</div>
</div>
<!--FINE modal elimina-->
