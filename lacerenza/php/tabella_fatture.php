<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Fatture.php");

$filtro = isset($_GET['filtro_fattura']) ? $_GET['filtro_fattura'] : "";

$id_commessa = $_GET['id'];

//estraggo elenco commesse
$fatture = new Fatture();

if($filtro == ""){
$e_query_fattura = $fatture->CaricaFatture($id_commessa);
} else {
    $e_query_fattura = $fatture->filtraFatture($filtro, $id_commessa);
}
$numeroTagliandi = $fatture->numeroFatture();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_fatture.js" type="text/javascript"></script>

<? if($numeroTagliandi > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
            	<th style="text-align:center">Tipo Documento</th>
                <th style="text-align:center">Descrizione</th>
                <th style="text-align:center">Importo totale</th>
                <th style="text-align:center">Data Pagamento</th>
                <th style="text-align:center">Data Incasso</th>
                <th style="text-align:center">Allegato</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
				while($row = $e_query_fattura->fetch_array()){
                    $i++;
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Tipo documento"><?=$row['tipo_documento']?></td>
				<td style="text-align:center" data-title="Descrizione">
                    <? if($row['descrizione'] != ""){?>
                        <?=$row['descrizione']?>
                    <? } else { ?>
                        Nessuna
                    <? } ?>
				</td>
				<td style="text-align:center" data-title="Importo tot.">&euro; <?=number_format($row['importo_totale'], 2, ',', '.');?></td>
				<td style="text-align:center" data-title="Data pagamento"><?=CapovolgiData($row['data_pagamento'])?></td>
				<td style="text-align:center" data-title="Data incasso">
                    <? if($row['data_incasso'] != "0000-00-00"){ ?>
                        <?=CapovolgiData($row['data_incasso'])?>
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
                 	<a style="width:100%" class="btn" href="nuova_fattura.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_fattura" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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