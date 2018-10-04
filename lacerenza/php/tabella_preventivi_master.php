<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.PreventivoMaster.php");
require_once("../classi/class.ModelloMaster.php");
require_once("../classi/class.Modello.php");
require_once("../classi/class.Sezione.php");

$filtro = $_GET['q'];

$preventivo_master = new PreventivoMaster();

$data = isset($_GET['data']) ? $_GET['data'] : "";
$a_data = isset($_GET['a_data']) ? $_GET['a_data'] : "";
$data_select = CapovolgiData($data);
$a_data_select = CapovolgiData($a_data);

$lista_preventivi_master = $preventivo_master->getAllData($data_select, $a_data_select);
// if($filtro == ""){
	// $lista_preventivi_master = $preventivo_master->getAllData($data_select, $a_data_select);
// } else {
    // $lista_preventivi_master = $preventivo_master->getFilter($filtro);
// }
$numero = count($lista_preventivi_master);

?>

<!--SCRIPT SITO-->
<script src="js/sito/preventivi/tabella_preventivi_master.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
       $('.ricontatti_tooltip').tooltip();
    });
</script>
<? if($numero > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N°</th>
                <th style="text-align:center">Data</th>
                <th style="text-align:center">Cliente</th>
                <th style="text-align:center">Mod. Preventivo</th>
                <th style="text-align:center">PDF Allegato</th>
                <th style="text-align:center">Dettagli</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php foreach ($lista_preventivi_master as $new_preventivo_master) {
               
			?>
			<tr>
				<td style="text-align:center" data-title="N°">
					<?=$new_preventivo_master->num_preventivo?>
				</td>
				<td style="text-align:center" data-title="Data">
					<?=CapovolgiData($new_preventivo_master->data_preventivo)?>
				</td>
				<td style="text-align:center" data-title="Cliente">
					<?=$new_preventivo_master->cliente?>
				</td>
				<td style="text-align:center" data-title="Mod. Preventivo">
					<? $dati_preventivo = ModelloMaster::getById($new_preventivo_master->id_modello_master); ?>
					<?=$dati_preventivo->titolo?>
				</td>
                <td data-title="Dettagli" style="text-align:center">
                	<? if($new_preventivo_master->link_file != '') { ?>
                 		<a style="width:100%" class="btn" href="<?=$new_preventivo_master->link_file?><?=$new_preventivo_master->filename?>" target="_blank"><i class="fa fa-file-pdf-o fa-lg"></i></a>
                 	<? } else { ?>
                 		<a style="width:100%" class="btn" title="Nessun PDF Allegato"><i class="fa fa-warning fa-lg"></i></a>
                 	<? } ?>
				</td>
                <td data-title="Dettagli" style="text-align:center">
                 	<a style="width:100%" class="btn" href="dettagli_preventivo.php?id=<?=$new_preventivo_master->id?>"><i class="fa fa-search fa-lg"></i></a>
				</td>
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuovo_preventivo.php?id=<?=$new_preventivo_master->id?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina" nome="<?=$row['nome_allegato']?>" id="<?=$new_preventivo_master->id?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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

