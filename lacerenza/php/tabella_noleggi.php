<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Noleggi.php");

$filtro = isset($_GET['filtro_noleggio']) ? $_GET['filtro_noleggio'] : "";

$id_commessa = $_GET['id'];

//estraggo elenco commesse
$noleggi = new Noleggi();

if($filtro == ""){
$e_query_noleggio = $noleggi->caricaNoleggi($id_commessa);
} else {
    $e_query_noleggio = $noleggi->filtraNoleggio($filtro, $id_commessa);
}
$numeroNoleggi = $noleggi->numeroNoleggi();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_noleggi.js" type="text/javascript"></script>

<? if($numeroNoleggi > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Data</th>
            	<th style="text-align:center">Numero</th>
                <th style="text-align:center">Descrizione contratto</th>
                <th style="text-align:center">Importo contratto</th>
                <th style="text-align:center">Fornitore</th>
                <th style="text-align:center">Allegati</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
		   $totale = 0;
				while($row = $e_query_noleggio->fetch_array()){
                    $i++;
					$totale += $row['importo'];
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
                <td style="text-align:center" data-title="Data"><?=CapovolgiData($row['data'])?></td>
				<td style="text-align:center" data-title="Numero"><?=$row['numero']?></td>
				<td style="text-align:center" data-title="Descrizione contratto">
                    <? if($row['descrizione'] != ""){?>
                        <?=$row['descrizione']?>
                    <? } else { ?>
                        Nessuna
                    <? } ?>
				</td>
				<td style="text-align:center" data-title="Importo contratto">&euro; <?=number_format($row['importo'], 2, ',', '.');?></td>
				<td style="text-align:center" data-title="Fornitore"><?=$row['fornitore']?></td>
				
                <td data-title="Allegati" style="text-align:center">
                 	<a style="width:100%" class="btn" href="pagina_allegati_noleggi.php?id_noleggio=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-paperclip fa-lg"></i></a>
				</td>
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuovo_noleggio.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_noleggio" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
				</td>
			</tr>
			<?php
				} //END WHILE
			?>
			<tr>
				<td colspan="4"  style="text-align:center; color:#185A7A; font-weight:bold;"> <b>Totale:</b> </td>
				<td style="text-align:center; background-color:#185A7A; color: #fff;"><b><?=$totale?> &euro;</b></td>
			</tr>
          </tbody>
       </table>
</section>
<? } else {?>
	Nessun dato trovato
<? } ?>

<input type="hidden" value="<?=$id_commessa?>" id="id_commessa"/>