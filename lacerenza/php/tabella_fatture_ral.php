<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.FattureRal.php");
require_once("../classi/class.Ral.php");

$filtro = isset($_GET['filtro_ral']) ? $_GET['filtro_ral'] : "";

$id_commessa = $_GET['id_commessa'];
$id_ral = $_GET['id_ral'];

//estraggo elenco ral
$fatture_ral = new FattureRal();

if($filtro == ""){
    $e_query_ral = $fatture_ral->caricaFattureRal($id_ral);
} else {
    $e_query_ral = $fatture_ral->filtraFattureRal($filtro, $id_ral);
}
$numeroFattureRal = $fatture_ral->numeroFattureRal();

//Resta da fatturare
$ral_importo = new Ral();
$query_ral = $ral_importo->caricaRalById($id_ral);
$row_importo = $query_ral->fetch_array();
$importo_ral = $row_importo['totale_ral'];
$totale_fatture_ral = $ral_importo->totFatture($id_ral);
$resta_da_fatturare = $importo_ral - $totale_fatture_ral;
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_fatture_ral.js" type="text/javascript"></script>

<div style="text-align:center">
                              <? if($resta_da_fatturare >= 0) { ?>
                              <label class="label label-info">Restano da fatturare: &euro; <?=number_format($resta_da_fatturare, 2, ',', '.');?></label>
                                  <? } else { ?>
                              <label class="label label-danger">Il fatturato risulata maggiore dell'importo del SAL:  &euro; <?=number_format($resta_da_fatturare, 2, ',', '.');?></label>
                                  <? } ?>
                                  </div>
                            <br />

<? if($numeroFattureRal > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">Data</th>
            	<th style="text-align:center">Utente</th>
            	<th style="text-align:center">Descrizione</th>
                <th style="text-align:center">Importo</th>
                <th style="text-align:center">Note</th>
                <th style="text-align:center">Allegato</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
				while($row = $e_query_ral->fetch_array()){
			?>
			<tr>
				<td style="text-align:center" data-title="Data"><?=CapovolgiData($row['data'])?></td>
				<td style="text-align:center" data-title="Utente"><?=$row['utente']?></td>
				<td style="text-align:center" data-title="Descrizione"><?=$row['descrizione']?></td>
				<td style="text-align:center" data-title="Importo">&euro; <?=number_format($row['importo'], 2, ',', '.');?></td>
				<td style="text-align:center" data-title="Importo">
                    <? if($row['note'] != "") { ?>
                    <?=$row['note']?>
                    <? } else { ?>
                    Nessuna
                    <? } ?>  
				</td>
				<td style="text-align:center" data-title="Allegato">
                	<? if($row['nome_allegato'] != "") { ?>
                        <!-- <a href="<?=$row['link_allegato'].$row['nome_allegato']?>" target="_blank"> -->
                        <a href="uploads/commesse/<?=$id_commessa?>/ral/<?=$id_ral?>/<?=$row['nome_allegato']?>" target="_blank">
                            Apri allegato
                        </a>
                    <? } else { ?>
                    	Nessun allegato
                    <? } ?>
                </td>
               				
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuova_fattura_ral.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>&id_ral=<?=$id_ral?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_fattura_ral" nome="<?=$row['nome_allegato']?>" id_commessa="<?=$id_commessa?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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

<input type="hidden" value="<?=$id_commessa?>" id="id_commessa"/>
<input type="hidden" value="<?=$id_ral?>" id="id_ral"/>