<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Terzi.php");

$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
$data = isset($_GET['data']) ? $_GET['data'] : "";
$data = CapovolgiData($data);

//estraggo elenco commesse
$terzi = new Terzi();
$e_query_veicolo = $terzi->carica($id_commessa, $data);

$numero = $terzi->numero();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_terzi.js" type="text/javascript"></script>

<? if($numero > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Lavorazione terzi</th>
                <th style="text-align:center">Ore</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
				while($row = $e_query_veicolo->fetch_array()){
                    $i++;
           ?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Lavorazione terzi"><?=$row['descrizione']?></td>
				<td style="text-align:center" data-title="Ore"><?=$row['ore']?></td>

                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_terzi"  id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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
