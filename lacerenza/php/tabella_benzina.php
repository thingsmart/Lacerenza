<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Benzine.php");

$filtro = isset($_GET['filtro_benzina']) ? $_GET['filtro_benzina'] : "";
$data_inizio = isset($_GET['data_inizio']) ? $_GET['data_inizio'] : "";
$data_fine = isset($_GET['data_fine']) ? $_GET['data_fine'] : "";

$data_inizio = ($data_inizio != "") ? capovolgiData($data_inizio) : date("Y-01-01");
$data_fine = ($data_fine != "") ? capovolgiData($data_fine) : date("Y-12-31");

$id_mezzo = $_GET['id'];

//estraggo elenco esso card
$benzine = new Benzine();

if($filtro == ""){
    $e_query_benzina = $benzine->caricaBenzinaByData($id_mezzo, $data_inizio , $data_fine);
} else {
	$e_query_benzina = $benzine->filtraBenzinaByData($id_mezzo, $filtro, $data_inizio , $data_fine);
}
$numeroBenzina = $benzine->numeroBenzina();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_benzina.js" type="text/javascript"></script>

<? if($numeroBenzina > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
                <th style="text-align:center">Data</th>
                <th style="text-align:center">Totale IVA esclusa</th>
                <th style="text-align:center">Dettagli</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           		$totale = 0;
				while($row = $e_query_benzina->fetch_array()){
					$totale += $row['totale_iva_inclusa'];	
			?>
			<tr>
				<td style="text-align:center" data-title="Data"><?=CapovolgiData($row['data'])?></td>
				<td style="text-align:center" data-title="Totale"><?=$row['totale_iva_inclusa']?> &euro;</td>
				<td data-title="Dettagli" style="text-align:center">
                 	<div style="width:100%" class="btn btn-dettagli" importo_iva="<?=$row['importo_iva']?>" aliq_iva="<?=$row['aliq_iva']?>" prezzo_escluso_iva="<?=$row['prezzo_escluso_iva']?>" sconto = "<?=$row['sconto']?>" servizio="<?=$row['prodotto_servizio']?>" km_veicolo="<?=$row['km_veicolo']?>" codice_autista="<?=$row['codice_autista']?>" targa="<?=$row['targa']?>" localita="<?=$row['localita']?>" titolare_carta="<?=$row['titolare_carta']?>" numero_carta="<?=$row['numero_carta']?>" data-toggle="modal" data-target=".bs-dettagli"><i class="fa fa-file-text fa-lg"></i></div>
				</td>
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuova_benzina.php?id=<?=$row['id']?>&id_mezzo=<?=$id_mezzo?>&data_inizio=<?=$data_inizio?>&data_fine=<?=$data_fine?>" ><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_benzina" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
				</td>
			</tr>
			<?php
				} //END WHILE
			?>
			<tr>
				<td colspan="4" style="text-align:center"> <b>Totale:</b> </td>
				<td style="text-align:center"><b><?=$totale?> &euro;</b></td>
			</tr>
          </tbody>
       </table>
</section>
<? } else {?>
	Nessun dato trovato
<? } ?>

<input type="hidden" value="<?=$id_mezzo?>" id="id_mezzo"/>