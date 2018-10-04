<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.OrdiniCommessa.php");

$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : "";

$id_commessa = $_GET['id_commessa'];
$id_ordine = $_GET['id_ordine'];

//estraggo elenco commesse
$ordini = new OrdiniCommessa();

if($filtro == ""){
$e_query_ordine = $ordini->caricaAllegati($id_ordine);
} else {
    $e_query_ordine = $ordini->filtra_allegati($filtro, $id_ordine);
}
$numero = $ordini->numero();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_allegati_ordini_commessa.js" type="text/javascript"></script>

<? if($numero > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Tipo Documento</th>
                <th style="text-align:center">Descrizione</th>
                <th style="text-align:center">Data</th>
                <th style="text-align:center">Apri</th>
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
				<td style="text-align:center" data-title="Tipo Documento">
                    <?=$row['tipologia']?>
				</td>
				<td style="text-align:center" data-title="Descrizione">
                    <?=$row['descrizione']?>
				</td>
				<td style="text-align:center" data-title="Data">
                	<?=CapovolgiData($row['data'])?>
                </td>
                <td style="text-align:center" data-title="Apri">
                	<a href="uploads/commesse/<?=$id_commessa?>/ordini_commessa/<?=$id_ordine?>/<?=$row['filename']?>" target="_blank"><i class="fa fa-external-link fa-lg"></i></a>
                </td>
                
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn elimina_allegato" nome="<?=$row['filename']?>" id_commessa="<?=$id_commessa?>" id_allegato="<?=$row['id']?>" id_ordine="<?=$row['id_ordine_commessa']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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