<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Log.php");

$log = new Log();

$filtro = isset($_GET['filtro_log']) ? $_GET['filtro_log'] : "";
$data = isset($_GET['data']) ? $_GET['data'] : "";

//giorno dopo
list($giorno,$mese,$anno) = explode("-",$data);
$new_giorno = $giorno + 1;
$domani = date("Y-m-d",mktime(0,0,0,$mese,$new_giorno,$anno));

$data = CapovolgiData($data);

if($filtro == ""){
	$e_query_log = $log->caricaLog($data, $domani);
	$numeroLog = $log->numeroLog();
} else {
	$e_query_log = $log->filtraLog($filtro, $data, $domani);
	$numeroLog = $log->numeroLog();
}
?>

<? if($numeroLog > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">Utente</th>
                <th style="text-align:center">Operazione</th>
                <th style="text-align:center">Data</th>
           </tr>
        </thead>
        <tbody>
           <?php
				while($row = $e_query_log->fetch_array()){
						$colore ="";
						switch($row['colore']){
							case "rosso":
								$colore ="label-danger";
							break;	
							case "verde":
								$colore ="label-success";
							break;	
							case "blu":
								$colore ="label-info";
							break;	
							case "arancione":
								$colore ="label-warning";
							break;	
						}
			?>
			<tr>
				<td style="text-align:center" data-title="Utente"><?=$row['utente']?></td>
				<td style="text-align:center" data-title="Operazione"><span class="label <?=$colore?>"><?=$row['operazione']?></span></td>
				<td style="text-align:center" data-title="Data'"><?=$row['data_inserimento']?></td>
				
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