<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Materiali.php");

$filtro = isset($_GET['filtro_materiale']) ? $_GET['filtro_materiale'] : "";

$id_commessa = $_GET['id'];

//estraggo elenco commesse
$materiali = new Materiali();

if($filtro == ""){
$e_query_materiale = $materiali->caricaMateriale($id_commessa);
} else {
    $e_query_materiale = $materiali->filtraMateriale($filtro, $id_commessa);
}
$numeroMateriali = $materiali->numeroMateriali();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_materiali.js" type="text/javascript"></script>

<? if($numeroMateriali > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Tipo Materiale</th>
                <th style="text-align:center">Fornitore</th>
                <th style="text-align:center">Costo</th>
                <th style="text-align:center">Quantit&agrave;</th>
                <th style="text-align:center">Importo totale</th>
                <th style="text-align:center">Data</th>
                <th style="text-align:center">Allegato</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
		   $totale = 0;
				while($row = $e_query_materiale->fetch_array()){
                    $i++;
					$totale += $row['importo'];
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Tipo Materiale"><?=$row['tipo_materiale']?></td>
				<td style="text-align:center" data-title="Fornitore"><?=$row['fornitore']?></td>
				<td style="text-align:center" data-title="Costo">&euro; <?=number_format($row['costo'], 2, ',', '.');?></td>
				<td style="text-align:center" data-title="Quantit&agrave;"><?=$row['quantita']?></td>
				<td style="text-align:center" data-title="Importo totale">&euro; <?=number_format($row['importo'], 2, ',', '.');?></td>
				<td style="text-align:center" data-title="Data"><?=CapovolgiData($row['data'])?></td>
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
                 	<a style="width:100%" class="btn" href="nuovo_materiale.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_materiale" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
				</td>
			</tr>
			<?php
				} //END WHILE
			?>
			<tr>
				<td colspan="5" style="text-align:center; color:#185A7A; font-weight:bold;"> <b>Totale:</b> </td>
				<td style="text-align:center; background-color:#185A7A; color: #fff;"><b><?=$totale?> &euro;</b></td>
			</tr>
          </tbody>
       </table>
</section>
<? } else {?>
	Nessun dato trovato
<? } ?>

<input type="hidden" value="<?=$id_commessa?>" id="id_commessa"/>