<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Polizze.php");

$filtro = isset($_GET['filtro_polizza']) ? $_GET['filtro_polizza'] : "";

$id_commessa = $_GET['id'];

//estraggo elenco commesse
$polizze = new Polizze();

if($filtro == ""){
$e_query_polizza = $polizze->CaricaPolizze($id_commessa);
} else {
    $e_query_polizza = $polizze->filtraPolizza($filtro, $id_commessa);
}
$numeroPolizze = $polizze->numeroPolizze();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_polizze.js" type="text/javascript"></script>

<? if($numeroPolizze > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
            	<th style="text-align:center">Descrizione Documnto</th>
                <th style="text-align:center">Data stipula</th>
                <th style="text-align:center">Scadenza</th>
                <th style="text-align:center">Importo</th>
                <th style="text-align:center">Polizza svincolata</th>
                <th style="text-align:center">Allegato</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
				while($row = $e_query_polizza->fetch_array()){
                    $i++;
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Descrizione Documento"><?=$row['descrizione']?></td>
				<td style="text-align:center" data-title="Data stipula"><?=CapovolgiData($row['data_stipula'])?></td>
				<td style="text-align:center" data-title="Scadenza"><?=CapovolgiData($row['scadenza'])?></td>
				<td style="text-align:center" data-title="Importo">&euro; <?=number_format($row['importo'], 2, ',', '.');?></td>
				<td style="text-align:center" data-title="Polizza svincolata">
                    <? if($row['polizza_svincolata'] != ""){?>
                        <?=$row['polizza_svincolata']?>
                    <? } else { ?>
                        ___
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
                 	<a style="width:100%" class="btn" href="nuova_polizza.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_polizza" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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