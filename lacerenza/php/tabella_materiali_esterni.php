<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.MaterialiEsterni.php");

$filtro = isset($_GET['filtro_fattura']) ? $_GET['filtro_fattura'] : "";
$da_data = isset($_GET['da_data']) ? $_GET['da_data'] : "";
$a_data = isset($_GET['a_data']) ? $_GET['a_data'] : "";
$id_commessa = $_GET['id'];
$tipologia = isset($_GET['tipologia']) ? $_GET['tipologia'] : "";
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : "";
//estraggo elenco commesse
$fatture = new MaterialiEsterni();

if($filtro == ""){
    if($da_data != ""){
       $da_data = CapovolgiData($da_data);
        $a_data = CapovolgiData($a_data);
        $e_query_fattura = $fatture->CaricaFattureDataTl($id_commessa, $da_data, $a_data, $tipologia, $tipo);
    } else {
        $e_query_fattura = $fatture->CaricaFatture($id_commessa, $tipologia);
    }
} else {
    if($da_data != ""){
        $da_data = CapovolgiData($da_data);
        $a_data = CapovolgiData($a_data);

        $e_query_fattura = $fatture->filtraFattureDataTl($filtro, $id_commessa, $da_data, $a_data, $tipo);
    } else {

        $e_query_fattura = $fatture->filtraFatture($filtro, $id_commessa);
    }

}
$numeroTagliandi = $fatture->numeroFatture();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_materiali_esterni.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        $('.annotazioni_tooltip').tooltip();
    });
</script>
<? if($numeroTagliandi > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
            	<th style="text-align:center">Tipo Documento</th>
                <th style="text-align:center">Fornitore</th>
                <th style="text-align:center">Importo totale</th>
                <th style="text-align:center">Data Pagamento</th>
                <th style="text-align:center">Note</th>
                <th style="text-align:center">Allegato</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
           $tot = 0;
				while($row = $e_query_fattura->fetch_array()){
                    $i++;
                    $tot+= $row['importo_totale'];
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Tipo documento"><?=$row['tipo_documento']?></td>
				<td style="text-align:center" data-title="Fornitore">
                    <? if($row['descrizione'] != ""){?>
                        <?=$row['descrizione']?>
                    <? } else { ?>
                        Nessuna
                    <? } ?>
				</td>
				<td style="text-align:center" data-title="Importo tot.">&euro; <?=number_format($row['importo_totale'], 2, ',', '.');?></td>
				<td style="text-align:center" data-title="Data pagamento"><?=CapovolgiData($row['data_pagamento'])?></td>
				<td style="text-align:center" data-title="Note">
                    <? if($row['note'] != ""){ ?>
                    <a  class="annotazioni_tooltip" data-toggle="tooltip" data-original-title="<?=$row['note']?>">Leggi</a>
                    <? } else { ?>
                        Nessuna
                    <? } ?>
				</td>
				<td style="text-align:center" data-title="Allegato">
                	<? if($row['nome_allegato'] != "") { ?>
                        <a href="<?=$row['link_allegato'].$row['nome_allegato']?>" target="_blank">
                            Apri allegato
                        </a>
                    <? } else { ?>
                    	Nessun allegato
                    <? } ?>
                </td>
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuova_fattura_materiali_esterni.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>&tipologia=<?=$tipologia?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_fattura" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
				</td>
			</tr>
			<?php
				} //END WHILE
			?>
        <tr>
            <td colspan="3" style="text-align:center">Totale:</td>
            <td style="text-align:center; background:lightgreen">&euro;  <?=number_format($tot, 2, ',', '.');?></td>
        </tr>
          </tbody>
       </table>
</section>
<? } else {?>
	Nessun dato trovato
<? } ?>

<input type="hidden" value="<?=$id_commessa?>" id="id_commessa"/>