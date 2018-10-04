<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.AllegatiDipendente.php");

$filtro = isset($_GET['filtro_allegato']) ? $_GET['filtro_allegato'] : "";

$id_commessa = $_GET['id_commessa'];
$id_dipendente = $_GET['id_dipendente'];

//estraggo elenco commesse
$allegati = new AllegatiDipendente();

if($filtro == ""){
    $e_query_allegati = $allegati->CaricaAllegati($id_dipendente);
} else {
    $e_query_allegati = $allegati->filtraAllegati($filtro, $id_dipendente);
}
$numeroAllegati = $allegati->numeroAllegati();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_allegati_dipendenti.js" type="text/javascript"></script>

<? if($numeroAllegati > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
            	<th style="text-align:center">Descrizione</th>
            	<th style="text-align:center">Data</th>
				<th style="text-align:center">Scadenza</th>
				<th style="text-align:center">Controllo Scadenza</th>
				<th style="text-align:center">Link</th>
				<th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
				while($row = $e_query_allegati->fetch_array()){
                    $i++;
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Descrizione">
                    <? if($row['descrizione'] != ""){?>
                        <?=$row['descrizione']?>
                    <? } else { ?>
                        Nessuna
                    <? } ?>
				</td>
                <td style="text-align:center" data-title="Data"><?=CapovolgiData($row['data'])?></td>
				<td style="text-align:center" data-title="Scadenza"><?=CapovolgiData($row['scadenza'])?></td>
				<td style="text-align:center" data-title="Scadenza"><? if($row['controlla_scadenza'] == 1) { echo "SI"; } else { echo "NO"; }?></td>
				<td style="text-align:center" data-title="Link"><a class="btn" style="width:100%" href="<?=$row['link_allegato'].$row['nome_allegato']?>" target="_blank"><i class="fa fa-external-link fa-lg"></i></a></td>
				<td data-title="Modifica" style="text-align:center">
					<a style="width:100%" class="btn btn_modifica" nome="<?=$row['nome_allegato']?>" descrizione="<?=$row['descrizione']?>" controllascadenza="<?=$row['controlla_scadenza']?>" inizio="<?=CapovolgiData($row['data'])?>" fine="<?=CapovolgiData($row['scadenza']);?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-dettaglio"><i class="fa fa-pencil"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_allegato" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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
<input type="hidden" value="<?=$id_dipendente?>" id="id_dipendente"/>




<!--Modal Dettagli-->
<div class="modal <?=$fade?> bs-dettaglio" tabindex="-1" role="dialog" id="dialog_dettaglio" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="titoloDettaglio" style="color: #185a7a">Dettaglio Allegato</h4>
			</div>
			<div class="modal-body" id="bodyDettaglio" >
				<div class="form-group">
					<label>Descrizione</label>
					<input type="hidden" id="idmodale" name="idmodale" class="form-control">
					<input type="text" id="descrizionemodale" name="descrizionemodale" class="form-control">
				</div>
				<div class="form-group">
					<label>Data Inizio</label>
					<input type="text" id="iniziomodale" name="iniziomodale" class="form-control">
				</div>
				<div class="form-group">
					<label>Data Fine</label>
					<input type="text" id="finemodale" name="finemodale" class="form-control">
				</div>
				<div class="form-group">
					<label>Controlla</label>
					<select class="form-control" id="controllamodale" name="controllamodale">
						<option value="1">SI, CONTROLLA</option>
						<option value="0">NO, NON CONTROLLARE</option>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
				<button type="button" class="btn btn-default btn_salva_modifiche">Modifica</button>
			</div>
		</div>
	</div>
</div>
<!--FINE modal elimina-->