<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.OrdiniCommessa.php");

$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : "";

$id_commessa = $_GET['id'];

//estraggo elenco commesse
$ordini = new OrdiniCommessa();

if($filtro == ""){
$e_query_ordine = $ordini->carica($id_commessa);
} else {
    $e_query_ordine = $ordini->filtra($filtro, $id_commessa);
}
$numero = $ordini->numero();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_ordini_commessa.js" type="text/javascript"></script>

<? if($numero > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Operatore</th>
                <th style="text-align:center">Cod. Commessa</th>
                <th style="text-align:center">Commessa</th>
                <th style="text-align:center">Fornitore</th>
                <th style="text-align:center">Allegati</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
				while($row = $e_query_ordine->fetch_array()){
                    $i++;
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Operatore">
                    <?=$row['utente']?>
				</td>
				<td style="text-align:center" data-title="Cod. Commessa">
                    <?=$row['cod_commessa']?>
				</td>
				<td style="text-align:center" data-title="Commessa">
                	<?=$row['descrizione_commessa']?>
                </td>
                <td style="text-align:center" data-title="Fornitore">
                	<b><?=$row['fornitore']?></b>
                </td>
                <td data-title="Allegati" style="text-align:center">
                 	<a style="width:100%" class="btn" href="pagina_allegati_ordini_commessa.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>&fornitore=<?=$row['fornitore']?>"><i class="fa fa-plus fa-lg"></i></a>
				</td>
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuovo_ordine_commessa.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_ordine" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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