<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.ProgrammazioneCantiere.php");
require_once("../classi/class.Dipendenti.php");

$filtro = isset($_GET['filtro_mezzo']) ? $_GET['filtro_mezzo'] : "";
$data = isset($_GET['data']) ? $_GET['data'] : "";
$data_select = CapovolgiData($data);

//estraggo elenco commesse
$cantiere = new ProgrammazioneCantiere();

$e_query = $cantiere->carica($data_select);

$numero = $cantiere->numero();

if($numero > 0){
	$data_query = CapovolgiData($data);
	$query_operatore = "SELECT utente FROM tb_programmazione_cantiere WHERE data = '$data_query' GROUP BY data;";
	$e_query_operatore = EseguiQuery($query_operatore, 'selezione');
	$row_operatore = $e_query_operatore->fetch_array();
	$operatore = $row_operatore['utente'];
	
	
}
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_programmazione_cantiere.js" type="text/javascript"></script>
<? if($numero == 0){ ?>
	<script>
	$(document).ready(function() {
		$( "#nuova_prog" ).removeClass( "col-lg-4" ).addClass( "col-lg-2" );
		$( "#data_prog" ).removeClass( "col-lg-4" ).addClass( "col-lg-2" );
		$(".clona_ieri").show();
		});
	</script>
<? } else { ?>
            <script>
	$(document).ready(function() {

		$(".clona_ieri").hide();
		$( "#nuova_prog" ).removeClass( "col-lg-2" ).addClass( "col-lg-4" );
		$( "#data_prog" ).removeClass( "col-lg-2" ).addClass( "col-lg-4" );
		});
	</script>
<? } ?>            
                       <br>
<? if($numero > 0){ ?>

<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
				<th style="text-align:center">Cantiere di destinazione</th>
				<th style="text-align:center">Tipologia</th>
                <!-- <th style="text-align:center">Cod. Lavoro</th>
                <th style="text-align:center">Descrizione Lavoro</th> -->
                <th style="text-align:center">Personale</th>
                <th style="text-align:center">Mezzo di trasporto</th>
                <th style="text-align:center">N. addetti</th>
                <th style="text-align:center">Note</th>
                 <? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN"){?>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
                <? } ?>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
           $tot_addetti = 0;
		   $num_ripetuti = 0;
		  $lista_id = array();



				while($row = $e_query->fetch_array()){
					$i++;
					// echo $row['id_dipendenti'];
					// $dipendenti = new Dipendenti();
					// $e_query_dipendenti_terzi = $dipendenti->caricaDipendenteById($id);
					$dati_addetti = $row['addetti'];
					$dati_esplosi = explode(",", $dati_addetti);
					$num_addetti = count($dati_esplosi);
					//$tot_addetti += $num_addetti;
			?>
			<tr>
				<td class="centra" style="text-align:center" data-title="N."><?=$i?></td>
				<td class="centra" style="text-align:center" data-title="Cantiere di destinazione"><?=$row['cod_commessa']?> - <?=$row['descrizione_commessa']?></td>
				<td class="centra" style="text-align:center" data-title="Tiplogia"><?=$row['tipologia_lavoro']?></td>
				<!-- <td class="centra" style="text-align:center" data-title="Cod. Lavoro"><?=$row['cod_lavoro']?></td>
				<td class="centra" style="text-align:center" data-title="Descrizione Lavoro"><?=$row['descrizione_lavoro']?></td> -->
                <td class="centra" style="text-align:center" data-title="Personale">
                	<?
	                	$dati_addetti_terzi = $row['addetti'];
						$dati_esplosi_terzi = explode(",", $dati_addetti_terzi);
						$id_addetti_terzi = $row['id_dipendenti'];
						
						
						$id_esplosi_terzi = explode(",", $id_addetti_terzi);
						
						for($l = 0; $l < count($dati_esplosi_terzi); $l++){
							$ripetuto = 0;
							 $dipendenti = new Dipendenti();
							if (in_array($id_esplosi_terzi[$l], $lista_id)) {
					   $num_ripetuti += 1;
					   $ripetuto = 1;
					} else {
						$tot_addetti += 1;
						 $lista_id[] = $id_esplosi_terzi[$l];
//								echo $id_esplosi_terzi[$l];
					}

							 $e_query_dipendenti_terzi = $dipendenti->caricaDipendenteById($id_esplosi_terzi[$l]);
							 $row_terzi = $e_query_dipendenti_terzi->fetch_array();
                	?>
	                	<? if($row_terzi['attivo'] == "TERZI"){?>
	                		<b style="color:red"><?=$dati_esplosi_terzi[$l]?></b>,
	                	<?} else if($ripetuto == 1){?>	
	                		<b style="color:#5287D1"><?=$dati_esplosi_terzi[$l]?></b>,
	                	<? } else { ?>
	                	<?=$dati_esplosi_terzi[$l]?>,
	                	<? } ?>
                	<? } ?>
                </td>
				<td class="centra" style="text-align:center" data-title="Mezzo di trasporto"><?=$row['mezzo']?></td>
				<td class="centra" style="text-align:center" data-title="N. Addetti"><?=$num_addetti?></td>
				<td class="centra" style="text-align:center" data-title="Note"><?=$row['note']?></td>
				 <? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN"){?>
                <td class="centra" data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuova_programmazione_cantiere.php?id=<?=$row['id']?>&data=<?=$data?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td class="centra" data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
				</td>
				<? } ?>
			</tr>
			<?php
				} //END WHILE
				$dipendenti = new Dipendenti();
				$e_query_dipendenti = $dipendenti->caricaDipendentiRuolino();
			?>
			<tr>
				<td colspan="4"><b>Totale addetti:</b> </td>
				<td class="centra"><?=$tot_addetti?> su <?=$e_query_dipendenti->num_rows?></td>
				<? if($num_ripetuti > 0){?>
				<td colspan="3" class="centra">(Utenti ripetuti e non contati: <?=$num_ripetuti?> )</td>
				<? } ?>
				<!--Controllo utenti rimasti-->
				<? while($row_manca = $e_query_dipendenti->fetch_array()){
					$lista_finale[] = $row_manca['id'];
				}?>
			</tr>
		<tr>
			<td colspan="4"><b>Utenti non inseriti :</b> </td>
			<td colspan="5">
				<?
				for($o=0; $o<count($lista_finale); $o++) {
					if (!in_array($lista_finale[$o], $lista_id)) {
						$query_dip = $dipendenti->caricaDipendenteById($lista_finale[$o]);
						$dipendenti_mancanti = $query_dip->fetch_array();
						?>
						<?=$dipendenti_mancanti['nome']." ".$dipendenti_mancanti['cognome'].", "?>
					<?}
				}
				?>
			</td>
		</tr>
          </tbody>
       </table>
</section>
<? } else {?>
	Nessun dato trovato
<? } ?>