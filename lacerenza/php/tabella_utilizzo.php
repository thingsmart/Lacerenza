<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Utilizzo.php");


$id_commessa = $_GET['id_commessa'];
$id_mezzo = $_GET['id_mezzo'];

//estraggo elenco commesse
$utilizzo = new Utilizzo();

$e_query_utilizzo = $utilizzo->caricaUtilizzo($id_mezzo, $id_commessa);

$numeroUtilizzo = $utilizzo->numeroUtilizzo();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_utilizzo.js" type="text/javascript"></script>

<? if($numeroUtilizzo > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
            	<th style="text-align:center">Data</th>
                <th style="text-align:center">Dettagli</th>
                <th style="text-align:center">N. Ore</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
				while($row = $e_query_utilizzo->fetch_array()){
                    $i++;
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Data"><?=CapovolgiData($row['data'])?></td>
				<td style="text-align:center" data-title="Dettagli">
                    <? if($row['dettagli'] != ""){?>
                        <?=$row['dettagli']?>
                    <? } else { ?>
                        Nessuna
                    <? } ?>
				</td>
				<td style="text-align:center" data-title="N. Ore"><?=$row['n_ore']?></td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_utilizzo" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash fa-lg"></i></a>
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
<input type="hidden" value="<?=$id_mezzo?>" id="id_mezzo"/>