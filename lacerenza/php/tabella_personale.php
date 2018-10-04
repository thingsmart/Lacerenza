<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Personale.php");

$filtro = isset($_GET['filtro_personale']) ? $_GET['filtro_personale'] : "";

$id_commessa = $_GET['id_commessa'];

//estraggo elenco commesse
$personale = new Personale();

if($filtro == ""){
    $e_query_personale = $personale->caricaPersonale($id_commessa);
} else {
    $e_query_personale = $personale->filtraPersonale($filtro, $id_commessa);
}
$numeroPersonale = $personale->numeroPersonale();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_personale.js" type="text/javascript"></script>

<? if($numeroPersonale > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Nome</th>
                <th style="text-align:center">Cognome</th>
                <th style="text-align:center">Costo ora</th>
                <th style="text-align:center">Presenze</th>
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
				while($row = $e_query_personale->fetch_array()){
                    $i++;
                    $totale_ore = $personale->totale_ore($row['id_dipendente'], $id_commessa);
                    $totale_giorni = $personale->totale_giorni($row['id_dipendente'], $id_commessa);
                    $costo = $totale_ore * $row['costo_h'];
                    $nome_personale = $row['nome']." ".$row['cognome'];
           ?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Nome"><?=$row['nome']?></td>
				<td style="text-align:center" data-title="Cognome"><?=$row['cognome']?></td>
				<td style="text-align:center" data-title="Costo ora"><?=$row['costo_h']?> &euro;</td>
				<td style="text-align:center" data-title="Presenze">
                 	<a style="width:100%" class="btn btn-warning" href="pagina_presenze.php?id_dipendente=<?=$row['id_dipendente']?>&id_commessa=<?=$id_commessa?>&nome_personale=<?=$nome_personale?>"><i class="fa fa-check-square fa-lg"></i></a>
				</td>
				<td style="text-align:center" data-title="Tot. ore"><?=$totale_ore?></td>
				<td style="text-align:center" data-title="Tot. giorni"><?=$totale_giorni?></td>
				<td style="text-align:center" data-title="Tot. Importo"><?=$costo?> &euro;</td>
				
				
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuovo_personale.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_personale" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash fa-lg"></i></a>
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
