<?php
session_start();
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Manutenzione.php");

$filtro = isset($_GET['filtro_mezzo']) ? $_GET['filtro_mezzo'] : "";
$data = isset($_GET['data']) ? $_GET['data'] : "";
$mese = isset($_GET['mese']) ? $_GET['mese'] : "";
$anno = isset($_GET['anno']) ? $_GET['anno'] : "";
$id_mezzo = isset($_GET['id']) ? $_GET['id'] : "";
// $data_select = CapovolgiData($data);
$autista = $_SESSION['username'];
//estraggo elenco commesse
$manutenzione = new Manutenzione();

$e_query = $manutenzione->caricaMese($mese, $anno, $id_mezzo);

$numero = $manutenzione->numero();

if($numero > 0){
	$data_query = CapovolgiData($data);
	$data_inizio = date($anno."-".$mese."-01"); 
   	 $data_fine = date($anno."-".$mese."-31"); 
	$query_operatore = "SELECT utente FROM tb_manutenzione WHERE data >='$data_inizio' AND data <= '$data_fine' GROUP BY data;";
	$e_query_operatore = EseguiQuery($query_operatore, 'selezione');
	$row_operatore = $e_query_operatore->fetch_array();
	$autista = $row_operatore['utente'];
	
	$row = $e_query->fetch_array();
	$mezzo = $row['id_mezzo']."-".$row['mezzo'];
	$id = $row['id'];
}

$query_mezzi = "SELECT * FROM tb_mezzi WHERE id = '$id_mezzo';";
    $e_query_lista = EseguiQuery($query_mezzi,"selezione");
	$row_mezzo = $e_query_lista->fetch_array();
?>

<!--SCRIPT SITO-->
<link href="css/demo.css" rel="stylesheet">
<script src="js/jquery-ui.min.js" ></script>
<script src="js/sito/tabella_manutenzione.js" type="text/javascript"></script>

                       <br>
<? if($numero == 0){?>
<input id="msg_non_salvato" style="background:red; color:white" class="form-control" value="Verifica ancora non effettuata per questa data" readonly>
<br>
<script>
	$("#div_clona").show();
</script>
<? } else { ?>
<script>
	$("#div_clona").hide();
</script>	
<? } ?>

 
<div class="row">
	<div class="col-lg-12">
		<div class="row">
		  <div class="col-lg-4">
			<input id="autista" class="form-control" value="Autista: <?=$autista?>" readonly>
			<br>
		  </div>
		  <div class="col-lg-6">
			<input name = "dettagli_mezzo" id="dettagli_mezzo" class="form-control" readonly placeholder="Mezzo" value="<?=$row_mezzo['id']?>-<?=$row_mezzo['mezzo']?>">
			<br>
		  </div>
		  <div class="col-lg-2">
			<? if($numero == 0){ ?>
			<div class="btn btn-default btn-block" id="btn_nuovo"><i class="fa fa-save"></i> Salva</div>
			<div class="btn btn-default btn-block" id="btn_modifica" style="display:none"><i class="fa fa-save"></i> Salva</div>
			<? } else { ?>
			<div class="btn btn-default btn-block" id="btn_modifica" ><i class="fa fa-save"></i> Salva</div>
			<? } ?>
		  </div>
	   </div>

	</div>
</div>

<br>

<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Descrizione</th>
                <th style="text-align:center">Verifica</th>
           </tr>
        </thead>
        <tbody>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">1</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Verifica presenza mezzo libretto di circolazione</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['libretto'] == 1 && $row['libretto'] != null){ echo "checked";}?> type="radio" id="libretto" name="libretto" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['libretto'] == 0 && $row['libretto'] != null){ echo "checked";}?> type="radio" id="libretto" name="libretto" value="0"/>
				</td>
			</tr>	
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">2</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Verifica scadenza assicurazione</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['assicurazione'] == 1 && $row['assicurazione'] != null){ echo "checked";}?> type="radio" id="assicurazione" name="assicurazione" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['assicurazione'] == 0 && $row['assicurazione'] != null){ echo "checked";}?> type="radio" id="assicurazione" name="assicurazione" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">3</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Verifica olio cambio</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['olio_cambio'] == 1 && $row['olio_cambio'] != null){ echo "checked";}?> type="radio" id="olio_cambio" name="olio_cambio" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['olio_cambio'] == 0 && $row['olio_cambio'] != null){ echo "checked";}?> type="radio" id="olio_cambio" name="olio_cambio" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">4</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Verifica olio motore</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI  <input <? if($row['olio_motore'] == 1 && $row['olio_motore'] != null){ echo "checked";}?> type="radio" id="olio_motore" name="olio_motore" value="1" style="margin-right:30px"/>
				        NO  <input <? if($row['olio_motore'] == 0 && $row['olio_motore'] != null){ echo "checked";}?> type="radio" id="olio_motore" name="olio_motore" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">5</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Controllo presenza estintori</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['estintori'] == 1 && $row['estintori'] != null){ echo "checked";}?> type="radio" id="estintori" name="estintori" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['estintori'] == 0 && $row['estintori'] != null){ echo "checked";}?> type="radio" id="estintori" name="estintori" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">6</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Controllo pneumatici (battistrada e pressione)</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <input <? if($row['pneumatici'] == 1 && $row['pneumatici'] != null){ echo "checked";}?> type="radio" id="pneumatici" name="pneumatici" value="1" style="margin-right:30px"/>
				        NO <input <input <? if($row['pneumatici'] == 0 && $row['pneumatici'] != null){ echo "checked";}?> type="radio" id="pneumatici" name="pneumatici" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">7</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Controllo elettrico (luci e direzioni)</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['elettrico'] == 1 && $row['elettrico'] != null){ echo "checked";}?> type="radio" id="elettrico" name="elettrico" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['elettrico'] == 0 && $row['elettrico'] != null){ echo "checked";}?> type="radio" id="elettrico" name="elettrico" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">8</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Verifica presenza triangolo</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['triangolo'] == 1 && $row['triangolo'] != null){ echo "checked";}?> type="radio" id="triangolo" name="triangolo" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['triangolo'] == 0 && $row['triangolo'] != null){ echo "checked";}?> type="radio" id="triangolo" name="triangolo" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">9</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Verifica presenza giubbino catarifrangente</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['giubbino'] == 1 && $row['giubbino'] != null){ echo "checked";}?> type="radio" id="giubbino" name="giubbino" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['giubbino'] == 0 && $row['giubbino'] != null){ echo "checked";}?> type="radio" id="giubbino" name="giubbino" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">10</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Verifica stato vetri auto</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['vetri'] == 1 && $row['vetri'] != null){ echo "checked";}?> type="radio" id="vetri" name="vetri" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['vetri'] == 0 && $row['vetri'] != null){ echo "checked";}?> type="radio" id="vetri" name="vetri" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">11</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Verifica presenza cassetta pronto soccorso</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['pronto_soccorso'] == 1 && $row['pronto_soccorso'] != null){ echo "checked";}?> type="radio" id="pronto_soccorso" name="pronto_soccorso" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['pronto_soccorso'] == 0 && $row['pronto_soccorso'] != null){ echo "checked";}?> type="radio" id="pronto_soccorso" name="pronto_soccorso" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">12</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Verifica carrozzeria</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['carrozzeria'] == 1 && $row['carrozzeria'] != null){ echo "checked";}?> type="radio" id="carrozzeria" name="carrozzeria" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['carrozzeria'] == 0 && $row['carrozzeria'] != null){ echo "checked";}?> type="radio" id="carrozzeria" name="carrozzeria" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">13</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Verifica corretto funzionamento freni</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['freni'] == 1 && $row['freni'] != null){ echo "checked";}?> type="radio" id="freni" name="freni" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['freni'] == 0 && $row['freni'] != null){ echo "checked";}?> type="radio" id="freni" name="freni" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">14</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Controllo stop e luci retromarcia</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['luci'] == 1 && $row['luci'] != null){ echo "checked";}?> type="radio" id="luci" name="luci" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['luci'] == 0 && $row['luci'] != null){ echo "checked";}?> type="radio" id="luci" name="luci" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">15</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Verifica funzionalit&agrave; tergicristalli</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['tergicristalli'] == 1 && $row['tergicristalli'] != null){ echo "checked";}?> type="radio" id="tergicristalli" name="tergicristalli" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['tergicristalli'] == 0 && $row['tergicristalli'] != null){ echo "checked";}?> type="radio" id="tergicristalli" name="tergicristalli" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">16</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Quadro strumenti e indicatori (presenza spie non corretto funzionamento)</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['indicatori'] == 1 && $row['indicatori'] != null){ echo "checked";}?>  type="radio" id="indicatori" name="indicatori" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['indicatori'] == 0 && $row['indicatori'] != null){ echo "checked";}?>  type="radio" id="indicatori" name="indicatori" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">17</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Funzionamento climatizzatore</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <? if($row['climatizzatore'] == 1 && $row['climatizzatore'] != null){ echo "checked";}?> type="radio" id="climatizzatore" name="climatizzatore" value="1" style="margin-right:30px"/>
				        NO <input <? if($row['climatizzatore'] == 0 && $row['climatizzatore'] != null){ echo "checked";}?> type="radio" id="climatizzatore" name="climatizzatore" value="0"/>
				</td>
			</tr>
			<tr>
				<td class="centra" style="text-align:center" data-title="N.">18</td>
                <td class="centra" style="text-align:center" data-title="Descrizione">Altro: (segnalare eventuali anomalie e scrivere nelle note)</td>
				<td class="centra" style="text-align:center" data-title="Verifica">
				        SI <input <input <? if($row['altro'] == 1 && $row['altro'] != null){ echo "checked";}?> type="radio" id="altro" name="altro" value="1" style="margin-right:30px"/>
				        NO <input <input <? if($row['altro'] == 0 && $row['altro'] != null){ echo "checked";}?> type="radio" id="altro" name="altro" value="0"/>
				</td>
			</tr>
	  	</tbody>
   </table>
</section>
<br>
<h2>Note</h2>
<br>
<div class="" style="margin-bottom:30px">
	<textarea id="note" name="note" class="form-control"><?=$row['note']?></textarea>
</div>

<input type="hidden" value="<?=$id?>" id="id_modifica" name="id_modifica" />
<input type="hidden" value="<?=$id_mezzo?>" id="id_mezzo" name="id_mezzo" />
