<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Commesse.php");
require_once("../classi/class.Utenti.php");

$filtro = isset($_GET['filtro_commessa']) ? $_GET['filtro_commessa'] : "";
$filtro = str_replace("'", "&#39;", $filtro);
$da_data = isset($_GET['da_data']) ? $_GET['da_data'] : "";
$a_data = isset($_GET['a_data']) ? $_GET['a_data'] : "";
$mostra = isset($_GET['mostra']) ? $_GET['mostra'] : "";
$operazione = $_GET['op'];

if($operazione == 'anno') {
	$operazione = 1;
} else {
	$operazione = 0;
}

//estraggo elenco commesse
$commesse = new Commesse();

//echo $da_data. " - ".$a_data. " - ".$mostra; exit;

if($filtro == "" && $da_data == "" && $a_data == "" && $mostra == ""){
	$e_query_commessa = $commesse->CaricaCommesse();
} else {
	if($da_data != "" && $a_data != ""){
		$da_data = CapovolgiData($da_data);
		$a_data = CapovolgiData($a_data);
		$e_query_commessa = $commesse->filtraCommesseDate($filtro, $da_data, $a_data, $mostra, $operazione);
	} else if($da_data != "" && $a_data == ""){
		$da_data = CapovolgiData($da_data);
		$e_query_commessa = $commesse->filtraCommesseDaData($filtro, $da_data, $mostra, $operazione);
	} else if($da_data == "" && $a_data != ""){
		$a_data = CapovolgiData($a_data);
		$e_query_commessa = $commesse->filtraCommesseAData($filtro, $a_data, $mostra, $operazione);
	} else if($da_data == "" && $a_data == ""){
		if($mostra == "chiuse"){
			$e_query_commessa = $commesse->filtraCommesseChiuse($filtro, $mostra, $operazione);
		} else {
			$e_query_commessa = $commesse->filtraCommesse($filtro, $mostra, $operazione);
		}
	}

}
$numeroCommesse = $commesse->numeroCommesse();
?>

<style>
	.highlight {
		background-color:yellow !important;
	}
</style>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_commesse.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
       $('.annotazioni_tooltip').tooltip();
    });
</script>
<? if($numeroCommesse > 0){ ?>
<section id="no-more-tables">

	<input type="hidden" id="goto_first" value="first">
	<input type="hidden" id="goto_prev" value="prev">
	<input type="hidden" id="goto_next" value="next">
	<input type="hidden" id="goto_last" value="last">
	<input type="hidden" id="goto_row" value="goto row">
	<input type="hidden" id="remove_row" value="remove row">
	<table id="data" class="table-condensed cf" style="width:100%;">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">Codice Commessa</th>
                <th style="text-align:center">Utente</th>
                <th style="text-align:center">Descrizione</th>
                <th style="text-align:center">Localit&agrave;</th>
                <th style="text-align:center">Data Inizio</th>
                <th style="text-align:center">Data Fine</th>
                <th style="text-align:center">Archivia</th>
                <th style="text-align:center">Ap.Cant</th>
                <th style="text-align:center">Annotazioni</th>
				<th style="text-align:center">Riepilogo</th>
				<th style="text-align:center">Dettagli</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
		   $i=0;
				while($row = $e_query_commessa->fetch_array()){
					$i++;
			?>
			<tr row_number="<?=$i?>" class="tr_all" id="tr_<?=$row['id']?>" style='cursor: pointer; <? if($_SESSION["id_commessa"] == $row["id"]){ echo "background:#C1C5C7;";}?>'>
				<td style="text-align:center" data-title="Codice commessa"><?=$row['codice']?></td>
				<td style="text-align:center" data-title="Utente">
					<?
						$user = new Utenti();
						$e_query_user = $user->caricaUtenteByUser($row['utente']);
						$row_user = $e_query_user->fetch_array();
					?>
					<?=substr($row_user['nome'],0,1)?>. <?=substr($row_user['cognome'],0,1)?>.
				</td>
				<td style="text-align:center" data-title="Descrizione">
                    <? if($row['descrizione'] != ""){ ?>
                        <?=$row['descrizione']?>
                    <? } else { ?>
                        Nessuna
                    <? } ?>
				</td>
				<td style="text-align:center" data-title="Localita'"><?=$row['localita']?></td>
				<td style="text-align:center" data-title="Data Inizio"><?=CapovolgiData($row['data_inizio'])?></td>
				<td style="text-align:center" data-title="Data Fine">
				<?
					if($row['data_fine'] == "0000-00-00"){
				?>
						Aperto
				<?
					} else {
						echo CapovolgiData($row['data_fine']);
					}
				?>
				</td>

                <td data-title="Status" style="text-align:center">
                    <? if($row['archiviato'] == 0){ ?>
                        <a style="width:100%" class="btn btn_archiviazione" id="<?=$row['id']?>" title="Archivia Commessa al <?=date("d-m-Y");?>" datafine="<?=CapovolgiData($row["data_fine"]);?>" operazione="archivia" da_data="<?=CapovolgiData($da_data);?>" a_data="<?=CapovolgiData($a_data);?>" filtro="<?=$filtro;?>"><i class="fa fa-square-o fa-lg"></i></a>
                    <? } else { ?>
                        <a style="width:100%" class="btn btn_archiviazione" id="<?=$row['id']?>" title="Cancella Archiviazione Commessa" operazione="rimuovi" da_data="<?=CapovolgiData($da_data);?>" a_data="<?=CapovolgiData($a_data);?>" filtro="<?=$filtro;?>"><i class="fa fa-check-square-o fa-lg"></i></a>
                    <? } ?>
                </td>

                <td data-title="Status" style="text-align:center">
                    <? if($row['apertura_cantiere'] == 0){ ?>
                        <a style="width:100%" class="btn" id="<?=$row['id']?>" title="Apertura Cantiere non effettuata" ><i class="fa fa-square-o fa-lg"></i></a>
                    <? } else { ?>
                        <a style="width:100%" class="btn" id="<?=$row['id']?>" title="Apertura Cantiere effettuata" ><i class="fa fa-check-square-o fa-lg"></i></a>
                    <? } ?>
                </td>

				 <td style="text-align:center" data-title="Annotazione">
                      <? if($row['annotazioni'] != ""){ ?>
                        <a  href="#" class="annotazioni_tooltip" data-toggle="tooltip" data-original-title="<?=$row['annotazioni']?>">Leggi</a>
                    <? } else { ?>
                        Nessuna
                    <? } ?>
				 </td>
				<td style="text-align:center" data-title="Riepilogo" style="text-align:center">
					<a target="_blank" id="<?=$row['id']?>" class="riepilogo_icona" style="width:100%" class="btn" href="riepilogo_commessa.php?id=<?=$row['id']?>&data_fine=<?=$row['data_fine']?>"><i class="fa fa-desktop fa-lg"></i></a>
				</td>
				 <td style="text-align:center" data-title="Dettagli" style="text-align:center">
                 	<a style="width:100%" target="_blank" id="<?=$row['id']?>" class="btn riepilogo_icona" href="dettaglio_commessa.php?id=<?=$row['id']?>"><i class="fa fa-plus-square fa-lg"></i></a>
                 </td>
                 <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn riepilogo_icona" id="<?=$row['id']?>"  href="nuova_commessa.php?id=<?=$row['id']?>"><i class="fa fa-edit fa-lg"></i></a>
                 </td>
                 <td data-title="Elimina" style="text-align:center">
                 	<div style="width:100%" class="btn btn_elimina_commessa" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></div>
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