<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Tecnica.php");

$mese = isset($_GET['mese']) ? $_GET['mese'] : "";
$anno = isset($_GET['anno']) ? $_GET['anno'] : "";


//estraggo elenco commesse
$tecnica = new Tecnica();

if($mese == ""){
$e_query = $tecnica->carica();
} else {
    $e_query = $tecnica->filtra($mese, $anno);
}
$numero = $tecnica->numero();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_tecnica.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
       $('.ricontatti_tooltip').tooltip();
    });
</script>
<? if($numero > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">N. Prev.</th>
                <th style="text-align:center">Cliente</th>
                <th style="text-align:center">Sopraluogo</th>
                <th style="text-align:center">Data emissione offerta</th>
                <th style="text-align:center">Oggetto offerta</th>
                <th style="text-align:center">Operatore</th>
                <th style="text-align:center">Rcontatti</th>
                <th style="text-align:center">Esito preventivo</th>
                <th style="text-align:center">Nuovo/Vecchio cliente</th>
                <th style="text-align:center">Sede/Fuori sede</th>
                <th style="text-align:center">Motivazione esito negativo</th>
                <th style="text-align:center">Data acquisizione commessa</th>
                <th style="text-align:center">Modalit&agrave; contrattuale</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
            $i=0;
				while($row = $e_query->fetch_array()){
                    $i++;
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="N. Prev."><?=$row['num_preventivo']?></td>
				<td style="text-align:center" data-title="Cliente">
					<? if($row['link_file'] != "") { ?>
                        <a href="<?=$row['link_file']?>" target="_blank">
                            <?=$row['cliente']?>
                        </a>
                    <? } else { ?>
                    	<?=$row['cliente']?>
                    <? } ?>
				</td>
				<td style="text-align:center" data-title="Sopraluogo"><?=$row['sopraluogo']?></td>
				<td style="text-align:center" data-title="Data emissione offerta"><?=CapovolgiData($row['data'])?></td>
				<td style="text-align:center" data-title="Oggetto offerta">
					<? if($row['link_file'] != "") { ?>
                        <a href="<?=$row['link_file']?>" target="_blank">
                            <?=$row['offerta']?>
                        </a>
                    <? } else { ?>
                    	<?=$row['offerta']?>
                    <? } ?>
				</td>
				<td style="text-align:center" data-title="Operatore"><?=$row['operatore']?></td>
				<td style="text-align:center" data-title="Rcontatti">
					<? if($row['ricontatti'] != ""){ ?>
                        <div  class="ricontatti_tooltip" data-toggle="tooltip" data-original-title="<?=$row['ricontatti']?>">Leggi</div>
                    <? } else { ?>
                        Nessuna
                    <? } ?>
				<td style="text-align:center" data-title="Esito preventivo"><?=$row['esito']?></td>
				<td style="text-align:center" data-title="Nuovo/Vecchio cliente"><?=$row['tipo_cliente']?></td>
				<td style="text-align:center" data-title="Sede/Fuori sede"><?=$row['tipo_sede']?></td>
				<td style="text-align:center" data-title="Motivazione esito negativo"><?=$row['motivazione']?></td>
				<td style="text-align:center" data-title="Data acquisizione commessa"><?=CapovolgiData($row['data_acquisizione'])?></td>
				<td style="text-align:center" data-title="Modalit&agrave; contrattuale"><?=$row['modalita']?></td>
				
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuova_tecnica.php?id=<?=$row['id']?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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

