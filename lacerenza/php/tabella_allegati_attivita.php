<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.AllegatiAttivita.php");

$filtro = isset($_GET['filtro_allegato']) ? $_GET['filtro_allegato'] : "";

$id_commessa = $_GET['id_commessa'];
$id_attivita = $_GET['id_attivita'];

//estraggo elenco commesse
$allegati = new AllegatiAttivita();

if($filtro == ""){
    $e_query_allegati = $allegati->CaricaAllegati($id_attivita);
} else {
    $e_query_allegati = $allegati->filtraAllegati($filtro, $id_attivita);
}
$numeroAllegati = $allegati->numeroAllegati();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_allegati_attivita.js" type="text/javascript"></script>

<? if($numeroAllegati > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
            	<th style="text-align:center">Descrizione</th>
            	<th style="text-align:center">Ricevuto in data</th>
            	<th style="text-align:center">Inviato in data</th>
            	<th style="text-align:center">A</th>
                <th style="text-align:center">Link</th>
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
                <td style="text-align:center" data-title="Ricevuto in data"><?=CapovolgiData($row['data_ricevuto'])?></td>
				<td style="text-align:center" data-title="Inviato in data"><?=CapovolgiData($row['data_inviato'])?></td>
				<td style="text-align:center" data-title="A"><?=$row['inviato_a']?></td>

				<td style="text-align:center" data-title="Link"><a class="btn" style="width:100%" href="<?=$row['link_allegato'].$row['nome_allegato']?>" target="_blank"><i class="fa fa-external-link fa-lg"></i></a></td>
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
<input type="hidden" value="<?=$id_attivita?>" id="id_attivita"/>