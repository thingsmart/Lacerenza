<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Ral.php");

$filtro = isset($_GET['filtro_ral']) ? $_GET['filtro_ral'] : "";
$da_data = isset($_GET['da_data']) ? $_GET['da_data'] : "";
$a_data = isset($_GET['a_data']) ? $_GET['a_data'] : "";
$id_commessa = $_GET['id'];
$tipologia = isset($_GET['tipologia']) ? $_GET['tipologia'] : "";

//estraggo elenco ral
$ral = new Ral();

if($filtro == ""){
    if($da_data != ""){
        $da_data = CapovolgiData($da_data);
        $a_data = CapovolgiData($a_data);
        if($tipologia != ""){
            $e_query_ral = $ral->caricaRalDataTl($id_commessa, $da_data, $a_data, $tipologia);
        } else {
            $e_query_ral = $ral->caricaRalData($id_commessa, $da_data, $a_data);
        }
    } else {
        if($tipologia != ""){
            $e_query_ral = $ral->caricaRalTl($id_commessa, $tipologia);
        } else {
            $e_query_ral = $ral->caricaRal($id_commessa);
        }
    }

} else {

    if($da_data != ""){
        $da_data = CapovolgiData($da_data);
        $a_data = CapovolgiData($a_data);
        $e_query_ral = $ral->filtraRalData($filtro, $id_commessa, $da_data, $a_data);
    } else {

        $e_query_ral = $ral->filtraRal($filtro, $id_commessa);
    }

}
$numeroRal = $ral->numeroRal();
//$totale_ral = $ral->totRAL($id_commessa);
$totale_ral = 0;
$totale_fatture_ral = 0;
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_ral.js" type="text/javascript"></script>


<input type="hidden" value="<?=$id_commessa?>" id="id_commessa"/>
<? if($numeroRal > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">Data</th>
            	<th style="text-align:center">Utente</th>
            	<th style="text-align:center">Descrizione</th>
            	<th style="text-align:center">Note</th>
                <th style="text-align:center">Importo</th>
                <th style="text-align:center">Allegato</th>
                <th style="text-align:center">Fatture</th>
                <th style="text-align:center">Tot. Fatture</th>
                <th style="text-align:center">Resta da Fatturare</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
				while($row = $e_query_ral->fetch_array()){
                    $totFatture = $ral->totFatture($row['id']);
                    $resta_da_fatturare =$row['totale_ral'] - $totFatture;
                    $totale_fatture_ral = $totale_fatture_ral + $totFatture;
                    $totale_ral += $row['totale_ral'];
			?>
			<tr>
				<td style="text-align:center" data-title="Data"><?=CapovolgiData($row['data'])?></td>
				<td style="text-align:center" data-title="Utente"><?=$row['utente']?></td>
				<td style="text-align:center" data-title="Descrizione"><?=$row['ral']?></td>
				<td style="text-align:center" data-title="Note">
                    <? if($row['note'] != "") { ?>
                    <?=$row['note']?>
                    <? } else { ?>
                    Nessuna
                    <? } ?>  
				</td>
				<td style="text-align:center" data-title="Importo">&euro; <?=number_format($row['totale_ral'], 2, ',', '.');?></td>
				<td style="text-align:center" data-title="Allegato">
                	<? if($row['nome_allegato'] != "") { ?>
                        <!-- <a href="<?=$row['link_allegato'].$row['nome_allegato']?>" target="_blank"> -->
                        <a href="uploads/commesse/<?=$id_commessa?>/ral/<?=$row['nome_allegato']?>" target="_blank">
                            Apri allegato
                        </a>
                    <? } else { ?>
                    	Nessun allegato
                    <? } ?>
                </td>
                <td data-title="Fatture" style="text-align:center">
                 	<a style="width:100%" class="btn" href="pagina_fatture_ral.php?id_commessa=<?=$id_commessa?>&id_ral=<?=$row['id']?>"><i class="fa fa-file-text fa-lg"></i></a>
				</td>
				<td style="text-align:center" data-title="Tot. Fatture">&euro; <?=number_format($totFatture, 2, ',', '.');?></td>
				<td style="text-align:center" data-title="Resta da Fatturare">
                    <? if($resta_da_fatturare >= 0){ ?>
                    <div class="label label-info">&euro; <?=number_format($resta_da_fatturare, 2, ',', '.');?></div>
                    <? } else { ?>
                    <div class="label label-danger">&euro; <?=number_format($resta_da_fatturare, 2, ',', '.');?></div>
                    <? } ?>
				</td>
				
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuova_ral.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_ral" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
				</td>
			</tr>
			<?php
				} //END WHILE
			?>
            <tr>
                <td data-title="Totale SAL" style="text-align:center; color: #185A7A; font-weight: bold;" colspan="4">
                    <strong>Totale SAL:</strong>
                </td>
                <td data-title="Importo" style="text-align:center; background-color: #185A7A; color: #fff; font-weight: bold;">
                     &euro; <?=number_format($totale_ral, 2, ',', '.');?>
                </td>
                <td data-title="Totale Fatture" style="text-align:center; color: #185A7A; font-weight: bold;" colspan="2">
                    <strong>Totale Fatture:</strong>
                </td>
                <td data-title="Importo" style="text-align:center; background-color: #185A7A; color: #fff; font-weight: bold;">
                     &euro; <?=number_format($totale_fatture_ral, 2, ',', '.');?>
                </td>
                <td data-title="Resta da fatturare" style="text-align:center; color: #185A7A; font-weight: bold;" colspan="1">
                    <strong>Resta da Fatturare:</strong>
                </td>
                <td data-title="Importo" style="text-align:center; background-color: #185A7A; color: #fff; font-weight: bold;">
                    <? if($totale_ral-$totale_fatture_ral > 0) { ?>
                   &euro; <?=number_format($totale_ral-$totale_fatture_ral, 2, ',', '.');?>
                     <? } else if($totale_ral-$totale_fatture_ral == 0){ ?>
                   &euro; <?=number_format($totale_ral-$totale_fatture_ral, 2, ',', '.');?>
                    <? } else { ?>
                   &euro; <?=number_format($totale_ral-$totale_fatture_ral, 2, ',', '.');?>
                    <? } ?>
                </td>
            </tr>
          </tbody>
       </table>
</section>

<? } else {?>
	Nessun dato trovato
<? } ?>

