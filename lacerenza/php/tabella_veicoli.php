<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Veicoli.php");

$filtro = isset($_GET['filtro_veicolo']) ? $_GET['filtro_veicolo'] : "";

$id_commessa = $_GET['id_commessa'];

//estraggo elenco commesse
$veicolo = new Veicoli();

if($filtro == ""){
    $e_query_veicolo = $veicolo->caricaVeicoli($id_commessa);
} else {
    $e_query_veicolo = $veicolo->filtraVeicolo($filtro, $id_commessa);
}
$numeroVeicoli = $veicolo->numeroVeicoli();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_veicoli.js" type="text/javascript"></script>

<? if($numeroVeicoli > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Mezzo</th>
                <th style="text-align:center">Targa</th>
                <th style="text-align:center">Costo ora</th>
                <th style="text-align:center">Utilizzo</th>
                <th style="text-align:center">Tot. ore</th>
                <th style="text-align:center">Tot. giorni</th>
                <th style="text-align:center">Tot. Importo</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
				while($row = $e_query_veicolo->fetch_array()){
                    $i++;
                    $totale_ore = $veicolo->totale_ore($row['id_mezzo'], $id_commessa);
                    $totale_giorni = $veicolo->totale_giorni($row['id_mezzo'], $id_commessa);
                    $costo = $totale_ore * $row['costo_h'];
                    $nome_veicolo = $row['mezzo']." ".$row['targa'];
           ?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Mezzo"><?=$row['mezzo']?></td>
				<td style="text-align:center" data-title="Targa"><?=$row['targa']?></td>
				<td style="text-align:center" data-title="Costo ora"><?=$row['costo_h']?> &euro;</td>
				<td style="text-align:center" data-title="Presenze">
                 	<a style="width:100%" class="btn btn-warning" href="pagina_utilizzo.php?id_mezzo=<?=$row['id_mezzo']?>&id_commessa=<?=$id_commessa?>&nome_veicolo=<?=$nome_veicolo?>"><i class="fa fa-hand-o-right"></i> Utilizzo</a>
				</td>
				<td style="text-align:center" data-title="Tot. ore"><?=$totale_ore?></td>
				<td style="text-align:center" data-title="Tot. giorni"><?=$totale_giorni?></td>
				<td style="text-align:center" data-title="Tot. Importo"><?=$costo?> &euro;</td>
				
				
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuovo_veicolo.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_veicolo"  id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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
