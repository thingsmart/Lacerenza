<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Attivita.php");

$filtro = isset($_GET['filtro_attivita']) ? $_GET['filtro_attivita'] : "";

$id_commessa = $_GET['id'];

//estraggo elenco commesse
$attivita = new Attivita();

if($filtro == ""){
$e_query_attivita = $attivita->caricaAttivita($id_commessa);
} else {
    $e_query_attivita = $attivita->filtraAttivita($filtro, $id_commessa);
}
$numeroAttivita = $attivita->numeroAttivita();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_attivita.js" type="text/javascript"></script>

<? if($numeroAttivita > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Impresa fornitrice</th>
            	<th style="text-align:center">Lavoro</th>
                <th style="text-align:center">Importo</th>
                <th style="text-align:center">Contratto del</th>
                <th style="text-align:center">Registrato a</th>
                <th style="text-align:center">Il</th>
                <th style="text-align:center">Numero</th>
                <th style="text-align:center">Allegati</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
           $totale = 0;
				while($row = $e_query_attivita->fetch_array()){
                    $i++;
                    $totale += $row['importo'];
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Impresa fornitrice"><?=$row['impresa_fornitrice']?></td>
				<td style="text-align:center" data-title="Lavoro"><?=$row['lavoro']?></td>
				<td style="text-align:center" data-title="Importo">&euro; <?=number_format($row['importo'], 2, ',', '.');?></td>
                <td style="text-align:center" data-title="Contratto del"><?=CapovolgiData($row['data_del'])?></td>
				<td style="text-align:center" data-title="Registrato a"><?=$row['registrato_a']?></td>
                <td style="text-align:center" data-title="Il"><?=CapovolgiData($row['data_il'])?></td>
				<td style="text-align:center" data-title="Numero"><?=$row['numero']?></td>
				
                <td data-title="Allegati" style="text-align:center">
                 	<a style="width:100%" class="btn" href="pagina_allegati_attivita.php?id_attivita=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-paperclip fa-lg"></i></a>
				</td>
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuova_attivita.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_attivita" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
				</td>
			</tr>
			<?php
				} //END WHILE
			?>
			<tr>
				<td colspan="3" style="text-align:center; color: #185A7A; font-weight: bold;"> <b>Totale:</b> </td>
				<td style="text-align:center; background-color: #185A7A; color: #fff; font-weight: bold;"><b>&euro; <?=number_format($totale, 2, ',', '.');?></b></td>
			</tr>
          </tbody>
       </table>
</section>
<? } else {?>
	Nessun dato trovato
<? } ?>

<input type="hidden" value="<?=$id_commessa?>" id="id_commessa"/>