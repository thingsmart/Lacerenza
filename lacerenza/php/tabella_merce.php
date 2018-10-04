<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Magazzino.php");

$filtro = isset($_GET['filtro_mezzo']) ? $_GET['filtro_mezzo'] : "";
$id_magazzino = isset($_GET['id_magazzino']) ? $_GET['id_magazzino'] : "";
$data = isset($_GET['data']) ? $_GET['data'] : "";
$data_select = CapovolgiData($data);

//estraggo elenco commesse
$magazzino = new Magazzino();

$e_query = $magazzino->carica($id_magazzino);

$numero = $magazzino->numero();


?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_merce.js" type="text/javascript"></script>

                       <br>
<? if($numero > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Quantit&agrave;</th>
                <th style="text-align:center">Descrizione del materiale</th>
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
				<td class="centra" style="text-align:center" data-title="Quantit&agrave;"><?=$row['quantita']?></td>
                <td class="centra" style="text-align:center" data-title="Descrizione del materiale"><?=$row['materiale']?></td>
                <td class="centra" data-title="Modifica" style="text-align:center">
                 	<div style="width:100%" class="btn btn_modifica" data-toggle="modal" data-target=".bs-modifica" id_testata_magazzino="<?=$row['id_testata_magazzino']?>" id="<?=$row['id']?>" quantita="<?=$row['quantita']?>" materiale="<?=$row['materiale']?>"><i class="fa fa-edit fa-lg"></i></div>
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

<input type="hidden" id="id_magazzino_testata" value="<?=$id_magazzino?>" />
<input type="hidden" id="data" value="<?=$data?>" />


<!--Modal elimina-->
<div class="modal <?=$fade?> bs-modifica" tabindex="-1" role="dialog" id="dialog_modifica" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modifica</h4>
      </div>
      <div class="modal-body" id="modal_body" >
      	<input id="id_da_modificare" type="hidden" />
      	<input id="id_testata_da_modificare" type="hidden" />
      	Quantit&agrave;:<br>
        <input class="form-control" id="quantita_da_modificare" type="text" />
        <br>
        Descrizione:<br>
        <input class="form-control" id="descrizione_da_modificare" type="text" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn_modifica_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_modifica_conferma" class="btn btn-danger">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->
