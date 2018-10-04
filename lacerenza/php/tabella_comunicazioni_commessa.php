<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Comunicazioni.php");

$filtro = isset($_GET['filtro_mezzo']) ? $_GET['filtro_mezzo'] : "";
$data = isset($_GET['data']) ? $_GET['data'] : "";
$a_data = isset($_GET['a_data']) ? $_GET['a_data'] : "";
$data_select = CapovolgiData($data);
$a_data_select = CapovolgiData($a_data);
$id=$_GET['id'];
//estraggo elenco commesse
$magazzino = new Comunicazioni();

$e_query = $magazzino->caricaByCommessa($data_select, $a_data_select, $id);

$numero = $magazzino->numero();

?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_comunicazioni_commessa.js" type="text/javascript"></script>

                       <br>
<? if($numero > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Data</th>
                <th style="text-align:center">Descrizion Commessa</th>
                <th style="text-align:center">Comunicazione</th>
                <th style="text-align:center">Tipo Comunicazione</th>
                <th style="text-align:center">Destinatatrio</th>
                <th style="text-align:center">Note</th>
                <th style="text-align:center">Allegati</th>
                <!-- <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th> -->
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
				while($row = $e_query->fetch_array()){
					$i++;
			?>
			<tr>
				<td class="centra" style="text-align:center" data-title="N."><?=$i?></td>
				<td class="centra" style="text-align:center" data-title="Data"><?=CapovolgiData($row['data'])?></td>
                <td class="centra" style="text-align:center" data-title="Descrizion Commessa"><?=$row['descrizione_commessa']?></td>
                <td class="centra" style="text-align:center" data-title="Comunicazione"><?=$row['testo']?></td>
				<td class="centra" style="text-align:center" data-title="Tipo Comunicazione"><?=$row['tipo_comunicazione']?></td>
				<td class="centra" style="text-align:center" data-title="Destinatatrio"><?=$row['destinatario']?></td>
				<td class="centra" style="text-align:center" data-title="Note"><?=$row['note']?></td>
				<td class="centra" data-title="Allegati" style="text-align:center">
                 	<a style="width:100%" class="btn" href="allegati_comunicazione.php?id=<?=$row['id']?>&data=<?=$data?>&a_data=<?=$a_data?>&id_commessa=<?=$id?>"><i class="fa fa-paperclip fa-lg"></i></a>
				</td>
                <!-- <td class="centra" data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuova_comunicazione.php?id=<?=$row['id']?>&data=<?=$data?>&a_data=<?=$a_data?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td class="centra" data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
				</td> -->
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

<input type="hidden" value="<?=$id?>" id="id_commessa_cerca" />