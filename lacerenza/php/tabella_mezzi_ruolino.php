<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Veicoli.php");

$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";
$data = isset($_GET['data']) ? $_GET['data'] : "";
$data = CapovolgiData($data);

//estraggo elenco commesse
$veicolo = new Veicoli();
$e_query_veicolo = $veicolo->caricaVeicoli($id_commessa, $data);

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
                <th style="text-align:center">Costo</th>
                <th style="text-align:center">KM</th>
                <!-- <th style="text-align:center">Modifica</th>-->
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
				while($row = $e_query_veicolo->fetch_array()){
                    $i++;
                    $nome_veicolo = $row['mezzo']." ".$row['targa'];
           ?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Mezzo"><?=$row['mezzo']?></td>
				<td style="text-align:center" data-title="Costo"><?=$row['costo_h']?> &euro;</td>
				<td style="text-align:center" data-title="KM"><?=$row['km']?></td>
				
                <!-- <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn btn-info" href="nuovo_veicolo.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-edit"></i> Modifica</a>
				</td>-->
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
