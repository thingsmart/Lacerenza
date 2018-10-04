<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Presenze.php");
require_once("../classi/class.Commesse.php");
require_once("../classi/class.Costi.php");


$id_commessa = $_GET['id_commessa'];
$id_dipendente = $_GET['id_dipendente'];
$data = isset($_GET['data']) ? $_GET['data'] : date("d-m-Y");
$data = ($data != "") ? CapovolgiData($data) : "";

//estraggo elenco commesse
$presenze = new Presenze();

$e_query_presenza = $presenze->caricaPresenza($id_dipendente, CapovolgiData($data));

$numeroPresenze = $presenze->numeroPresenze();

?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_presenze.js" type="text/javascript"></script>


<? if($numeroPresenze > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
            	<th style="text-align:center">Commessa</th>
            	<th style="text-align:center">Data</th>
            	<th style="text-align:center">Costo * ore</th>
                <th style="text-align:center">Dettagli</th>
                <th style="text-align:center">N. Ore</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
				while($row = $e_query_presenza->fetch_array()){
                    $i++;
					$commessa = new Commesse();
					$e_query_commessa = $commessa->caricaCommesseById($row['id_commessa']);
					$row_c = $e_query_commessa->fetch_array();
					$costo = new Costi();
					$costo_h = $costo->costoAttuale($row['id_dipendente'], $row['data']);
					$costo_h = ($costo_h == 0) ? $row['costo'] : $costo_h;
					$costo_h = ($row['dettagli'] == "Ferie" || $row['dettagli'] == "malattia") ? $row['costo'] : $costo_h;
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Commessa"><?=$row_c['cantiere']?></td>
				<td style="text-align:center" data-title="Data"><?=CapovolgiData($row['data'])?></td>
				<td style="text-align:center" data-title="Costo * ore"><?=$costo_h * $row['n_ore']?> &euro;</td>
				<td style="text-align:center" data-title="Dettagli">
                    <? if($row['dettagli'] != ""){?>
                        <?=$row['dettagli']?>
                    <? } else { ?>
                        Nessuna
                    <? } ?>
				</td>
				<td style="text-align:center" data-title="N. Ore"><?=$row['n_ore']?></td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_presenza" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i> </a>
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