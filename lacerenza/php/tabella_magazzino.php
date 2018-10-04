<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.TestataMagazzino.php");

$filtro = isset($_GET['filtro_mezzo']) ? $_GET['filtro_mezzo'] : "";
$data = isset($_GET['data']) ? $_GET['data'] : "";
$a_data = isset($_GET['a_data']) ? $_GET['a_data'] : "";
$data_select = CapovolgiData($data);
$a_data_select = CapovolgiData($a_data);

//estraggo elenco commesse
$magazzino = new TestataMagazzino();

$e_query = $magazzino->carica($data_select, $a_data_select);

$numero = $magazzino->numero();


?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_magazzino.js" type="text/javascript"></script>
<!-- <div class="row">
 <div class="col-lg-2">
                          	<div class="btn btn-success btn-block" id="btn_nuovo_magazzino"><i class="fa fa-plus-circle fa-lg"></i> Nuovo</div>
                          	<br>
                          </div>
                          <div class="col-lg-2">
                            <input id="data" class="data_picker form-control" value="<?=$data?>" readonly>
                            <br>
                          </div>
                       </div> -->
                       <br>
<? if($numero > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
                <th style="text-align:center">N.</th>
                <th style="text-align:center">Data</th>
                <th style="text-align:center">Responsabile</th>
                <th style="text-align:center">Automezzo</th>
                <th style="text-align:center">Cantiere</th>
                <th style="text-align:center">Stampa</th>
                <th style="text-align:center">Carico</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
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
                <td class="centra" style="text-align:center" data-title="Responsabile"><?=$row['utente']?></td>
				<td class="centra" style="text-align:center" data-title="Automezzo"><?=$row['mezzo']?></td>
                <td class="centra" style="text-align:center" data-title="Cantiere"><?=$row['descrizione_commessa']?></td>
                <td class="centra" data-title="Stampa" style="text-align:center">
                 	<a target="_blank" style="width:100%" class="btn" href="stampa_magazzino.php?id=<?=$row['id']?>"><i class="fa fa-print fa-lg"></i></a>
				</td>
                <td class="centra" data-title="Carico" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuova_merce.php?mezzo=<?=$row['mezzo']?>&id_commessa=<?=$row['id_commessa']?>&id=<?=$row['id']?>&data=<?=$data?>"><i class="fa fa-plus fa-lg"></i></a>
				</td>
                <td class="centra" data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuovo_magazzino.php?id=<?=$row['id']?>&data=<?=$data?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td class="centra" data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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