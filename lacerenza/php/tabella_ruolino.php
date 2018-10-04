<?php
/****
  *** Tabella contenente la lista degli utenti mostrata nella pagina home
****/
include("controllaSessione.php");

include("../databases/db_function.php");
require_once("../classi/class.Dipendenti.php");
require_once("../classi/class.Presenze.php");
require_once("../classi/class.Commesse.php");
require_once("../classi/class.Costi.php");
require_once("../lib/verificaConvertiData.php");

$filtro_ruolino = isset($_GET['filtro_ruolino']) ? $_GET['filtro_ruolino'] : "";
$filtro_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "-1";
$data = isset($_GET['data']) ? CapovolgiData($_GET['data']) : date("Y-m-d");
$a_data = isset($_GET['a_data']) ? CapovolgiData($_GET['a_data']) : date("Y-m-d");

//estraggo elenco utenti
$ruolino = new Dipendenti();

if($filtro_ruolino == ""){
	
		$e_query_ruolino = $ruolino->caricaDipendentiRuolinoNew();
	
} else {
	if($filtro_commessa == "" || $filtro_commessa == -1){
		$e_query_ruolino = $ruolino->filtraDipendentiRuolinoNew($filtro_ruolino);
	} else {
		$e_query_ruolino = $ruolino->filtraDipendentiRuolinoCommessaDaDataNew($filtro_ruolino, $filtro_commessa, $data, $a_data);
	}

}
$numeroDipendenti = $ruolino->numeroDipendenti();
?>

<style>
	.error {
		background: #FFEDF0;
		
	}
</style>
<!--SCRIPT SITO-->
<script src="js/sito/tabella_ruolino.js" type="text/javascript"></script>

<?php
	if($numeroDipendenti <= 0){
?>
	<div><strong>Nessun dipendente presente</strong></div>
<?php	
	} else {
?>

<section id="no-more-tables">
	<table class="table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
              <th class="text-center">N.</th>
              <th class="text-center">Cognome</th>
              <th class="text-center">Nome</th>    
              <th class="text-center">Cantieri</th>    
              <!-- <th class="text-center">Dettagli</th> -->    
              <th class="text-center">Costo h.</th>
				<th class="text-center">Tot. Ore</th>
				<th class="text-center">Tot.</th>
				<!-- <th class="text-center">Presenze</th>     -->
              </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
		   $verifica_correttezza = 0;
		   $totale_complessivo = 0;
		   $totale_ore = 0;
				while($row = $e_query_ruolino->fetch_array()){
                    $i++;
					$presenza = new Presenze();
					$e_query_presenze = $presenza->caricaPresenza($row['id'], $data);
					$e_query_presenze2 = $presenza->caricaPresenza($row['id'], $data);
					$n_ferie_malattie = $presenza->ferieMalattieGiornaliero($row['id'], $data);
					$e_query_presenze_oggi = $presenza->oreLavoroGiornalieroDate($data, $a_data);
					$ore = 0;
					$commesse_oggi = "";
					while($row_presenze_oggi = $e_query_presenze_oggi->fetch_array()){
						
						$dipendenti_oggi = explode(",", $row_presenze_oggi['id_dipendenti']);
						for($l=0; $l<count($dipendenti_oggi); $l++){
							if($row['id'] == intval($dipendenti_oggi[$l])){
								$ore += $row_presenze_oggi['ore'];
								$commesse_oggi .= ($commesse_oggi != "") ? ", ".$row_presenze_oggi['descrizione_commessa'] : $row_presenze_oggi['descrizione_commessa'];
							} 
						}
					}
	
					if($ore < 8 && $n_ferie_malattie == 0){
						$verifica_correttezza++;
					}
					$costo = new Costi();
					$costo_h = $costo->costoAttuale($row['id'], $data);
					$totale_complessivo += $ore*$costo_h;
					$totale_ore += $ore;
			?>
			<tr <? if($ore < 8 && $n_ferie_malattie == 0){ echo 'class="error"'; }?>>
				<td data-title="N." class="text-center" ><?=$i?></td>
				<td data-title="Cognome" class="text-center"><?=$row['cognome']?></td>
				<td data-title="Nome" class="text-center"><?=$row['nome']?></td>
				<td data-title="Cantieri">
					<?=$commesse_oggi?>
					</td>
				<!-- <td data-title="Dettagli" class="text-center">
					<?if($e_query_presenze2->num_rows > 0){
						while($row_commessa = $e_query_presenze2->fetch_array()){
							$dettagli = ($row_commessa['dettagli'] != "") ? $row_commessa['dettagli'] : "presenza";
							?>
							(<?=$row_commessa['n_ore']?> ore <?=$dettagli?>)
							<?
						}
					} ?>
				</td> -->
				<td data-title="Costo h." class="text-center"><a href="costo_dipendenti.php?pagina=ruolino&id_dipendente=<?=$row['id']?>&data=<?=$data?>" class="btn btn-info"><?=$costo_h?> &euro; </a></td>
				<td data-title="Totale ore" class="text-center"><?=$ore?></td>
				<td data-title="Totale" class="text-center"><?=number_format($ore*$costo_h, 2, ',', '.');?> &euro;</td>
                <!-- <td data-title="Presenze">
                	<a class="btn btn-warning" style="width:100%" href="pagina_presenze.php?id_dipendente=<?=$row['id']?>&id_commessa=<?=$filtro_commessa?>&data=<?=$data?>&nome_personale=<?=$row['nome']?> <?=$row['cognome']?>"><i class="fa fa-clock-o"></i> Presenze</a>
                </td> -->
			</tr>
			<?php
				} //END WHILE
			?>
		<tr>
			<td style="text-align:right" colspan="5"><b>Totale ore:</b></td>
			<td style="text-align: center"><b><?=$totale_ore?></b></td>
		</tr>
          </tbody>
       </table>
       <? if($verifica_correttezza > 0) { ?>
       		<script>
       			$("#messaggio").hide();
				$("#messaggio_errore").html("N. utenti da compilare: <strong><?=$verifica_correttezza?></strong>");
				$("#messaggio_errore").show();
       		</script>
       <? } else { ?>
	       	<script>
	       		$("#messaggio_errore").hide();
	       	</script>
       	<? } ?>
</section>            

<?php
	}	//end if
?>