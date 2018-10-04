<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Costi.php");
require_once("../classi/class.Commesse.php");


$id_dipendente = $_GET['id_dipendente'];
$id_commessa = $_GET['id_commessa'];

//estraggo elenco commesse
$costi = new Costi();
if($id_commessa != "") {
	$e_query_costo = $costi->caricaCostiCommessa($id_dipendente, $id_commessa);
} else {
	$e_query_costo = $costi->caricaCostiTutti($id_dipendente);
}

$numeroCosti = $e_query_costo->num_rows;

?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_costi.js" type="text/javascript"></script>


<? if($numeroCosti > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">Mese</th>
            	<th style="text-align:center">Anno</th>
            	<th style="text-align:center">Costo</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
				while($row = $e_query_costo->fetch_array()){					
			?>
			<tr>
				<td style="text-align:center" data-title="Mese"><?=$row['mese']?></td>
				<td style="text-align:center" data-title="Anno"><?=$row['anno']?></td>
				<td style="text-align:center" data-title="Costo"><?=$row['costo']?> &euro;</td>
				<td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn btn_modifica_costo" id="<?=$row['id']?>" costo="<?=$row['costo']?>" data-toggle="modal" data-target=".bs-modifica"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_costo" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash fa-lg"></i></a>
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

<input type="hidden" value="<?=$id_dipendente?>" id="id_dipendente"/>