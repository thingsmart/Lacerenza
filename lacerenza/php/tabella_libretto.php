<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Libretto.php");

$filtro = isset($_GET['filtro_spesa']) ? $_GET['filtro_spesa'] : "";
$data_inizio = isset($_GET['data_inizio']) ? $_GET['data_inizio'] : "";
$data_fine = isset($_GET['data_fine']) ? $_GET['data_fine'] : "";
$targa = $_GET['targa'];
$data_inizio = ($data_inizio != "") ? capovolgiData($data_inizio) : date("Y-01-01");
$data_fine = ($data_fine != "") ? capovolgiData($data_fine) : date("Y-12-31");

$id_mezzo = $_GET['id'];

//estraggo elenco commesse
$libretto = new Libretto();
if($filtro == ""){
    $e_query_spese = $libretto->carica($id_mezzo);
} else {
    $e_query_spese = $libretto->filtra($id_mezzo, $filtro);
}
$numeroSpese = $libretto->numero();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_libretto.js" type="text/javascript"></script>

<? if($numeroSpese > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">Descrizione</th>
                <th style="text-align:center">Data</th>
                <th style="text-align:center">Fattura di riferimento</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           		$totale = 0;
                while($row = $e_query_spese->fetch_array()){
                	$totale += $row['costo'];
			?>
			<tr>
				<td style="text-align:center" data-title="Descrizione"><?=$row['descrizione']?></td>
				<td style="text-align:center" data-title="Data"><?=CapovolgiData($row['data'])?></td>

				<td style="text-align:center" data-title="Allegato">
                	<? if($row['allegato'] != "") { ?>
                        <a href="uploads/mezzi/<?=$id_mezzo?>/libretto/<?=$row['allegato']?>" target="_blank">
                            Apri allegato
                        </a>
                    <? } else { ?>
                    	Nessun allegato
                    <? } ?>
                </td>
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuovo_libretto.php?id=<?=$row['id']?>&id_mezzo=<?=$id_mezzo?>&data_inizio=<?=$data_inizio?>&data_fine=<?=$data_fine?>&targa=<?=$targa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_spesa" nome="<?=$row['allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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

<input type="hidden" value="<?=$id_mezzo?>" id="id_mezzo"/>