<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Gare.php");

$mese = isset($_GET['mese']) ? $_GET['mese'] : "";
$anno = isset($_GET['anno']) ? $_GET['anno'] : "";


//estraggo elenco commesse
$gare = new Gare();

if($mese == ""){
$e_query = $gare->carica();
} else {
    $e_query = $gare->filtra($mese, $anno);
}
$numero = $gare->numero();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_gara.js" type="text/javascript"></script>

<? if($numero > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Descrizione</th>
                <th style="text-align:center">Data emissione</th>
                <th style="text-align:center">Data scadenza</th>
                <th style="text-align:center">Polizze</th>
                <th style="text-align:center">AVCP</th>
                <th style="text-align:center">PASSOE</th>
                <th style="text-align:center">Operatore</th>
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
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Descrizione"><?=$row['descrizione']?></td>
				<td style="text-align:center" data-title="Data emissione"><?=CapovolgiData($row['data_emissione'])?></td>
				<td style="text-align:center" data-title="Data scadenza"><?=CapovolgiData($row['data_scadenza'])?></td>
				<td style="text-align:center" data-title="Polizze"><?=$row['polizze']?></td>
				<td style="text-align:center" data-title="AVCP"><?=$row['avcp']?></td>
				<td style="text-align:center" data-title="PASSOE"><?=$row['passoe']?></td>
				<td style="text-align:center" data-title="Operatore"><?=$row['utente']?></td>
				
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuova_gara.php?id=<?=$row['id']?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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

