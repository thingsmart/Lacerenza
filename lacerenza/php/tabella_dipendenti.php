<?php
/****
  *** Tabella contenente la lista degli utenti mostrata nella pagina home
****/
include("controllaSessione.php");

include("../databases/db_function.php");
require_once("../classi/class.Dipendenti.php");
require_once("../classi/class.Costi.php");
require_once("../classi/class.AllegatiDipendente.php");


$filtro_dipendenti = isset($_GET['filtro_dipendente']) ? $_GET['filtro_dipendente'] : "";
$operazione = $_GET["op"];

$dataattuale = date("Y-m-d");
$datainizio = date('Y-m-d',(strtotime ( '-15 days' , strtotime ( $dataattuale) ) ));
$datafine = date('Y-m-d',(strtotime ( '15 days' , strtotime ( $dataattuale) ) ));

//estraggo elenco utenti
$dipendenti = new Dipendenti();

if($filtro_dipendenti == ""){
$e_query_dipendenti = $dipendenti->caricaDipendenti();
} else {
$e_query_dipendenti = $dipendenti->filtraDipendenti($filtro_dipendenti);
}
$numeroDipendenti = $dipendenti->numeroDipendenti();
?>


<!--SCRIPT SITO-->
<script src="js/sito/tabella_dipendenti.js" type="text/javascript"></script>

<?php
	if($numeroDipendenti <= 0){
?>
	<div><strong>Nessun dipendente presente</strong></div>
<?php	
	} else {
?>



<section id="no-more-tables">	
	<div class="filter pull-right">				
		<ul class="filter-list">
			<? if($operazione == '') { ?>
				<li><input type="radio" class="group" name="group" value="tutto" checked> TUTTI</li>
				<li><input type="radio" class="group" name="group" value="attivo"> SOLO ATTIVI</li>
				<li><input type="radio" class="group" name="group" value="impiegati"> IMPIEGATI</li>
				<li><input type="radio" class="group" name="group" value="terzi"> TERZI</li>
				<li><input type="radio" class="group" name="group" value="non_attivi"> NON ATTIVI</li>
				<input type="hidden" value="tutto" id="valore_filtro" name="valore_filtro" class="form-control">
			<? } else { ?>
				<li><input type="radio" class="group" name="group" value="tutto" <? if($operazione == 'tutto') { echo "checked"; }?>> TUTTI</li>
				<li><input type="radio" class="group" name="group" value="attivo" <? if($operazione == 'attivo') { echo "checked"; }?>> SOLO ATTIVI</li>
				<li><input type="radio" class="group" name="group" value="impiegati" <? if($operazione == 'impiegati') { echo "checked"; }?>> IMPIEGATI</li>
				<li><input type="radio" class="group" name="group" value="terzi" <? if($operazione == 'terzi') { echo "checked"; }?>> TERZI</li>
				<li><input type="radio" class="group" name="group" value="non_attivi" <? if($operazione == 'non_attivi') { echo "checked"; }?>> NON ATTIVI</li>
				<input type="hidden" value="<?=$operazione?>" id="valore_filtro" name="valore_filtro" class="form-control">

			<? } ?>
		</ul>
	</div>
	<div class="clearfix"></div>
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
              <th class="text-center">N.</th>
              <th class="text-center">Cognome</th>
              <th class="text-center">Nome</th>    
              <th class="text-center">Attivo</th>    
              <th class="text-center">Costo attuale</th>      
              <th class="text-center">Costo all'ora</th>      
              <th class="text-center">Certificati</th>
				<th class="text-center">Scad. Certificati</th>
				<th class="text-center">Modifica</th>
              <th class="text-center">Elimina</th>   
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
				while($row = $e_query_dipendenti->fetch_array()){
                    $i++;
                    $costo = new Costi();
					$costo_attuale = $costo->costoAttuale($row['id'], date("Y-m-d"));
			?>
			<tr class="<?=$row['attivo']?>">
				<td data-title="N." class="text-center"><?=$i?></td>
				<td data-title="Cognome" class="text-center"><?=$row['cognome']?></td>
				<td data-title="Nome'" class="text-center"><?=$row['nome']?></td>
				<td data-title="Attivo'" class="text-center"><?=$row['attivo']?></td>
				<td data-title="Costo attuale'" class="text-center"><?=$costo_attuale?> &euro;</td>
				<td data-title="Certificati">
<!--                	<a class="btn btn_costo_dipendenti" style="width:100%" href="costo_dipendenti.php?id_dipendente=--><?//=$row['id']?><!--" id_dipendente = "--><?//=$row['id']?><!--"><i class="fa fa-euro fa-lg"></i></a>-->
					<a class="btn btn_costo_dipendenti" style="width:100%" id_dipendente = "<?=$row['id']?>"><i class="fa fa-euro fa-lg"></i></a>
                </td>
                <td data-title="Certificati">
<!--					<a class="btn" style="width:100%" href="pagina_allegati_dipendenti.php?id_dipendente=--><?//=$row['id']?><!--" id_dipendente = "--><?//=$row['id']?><!--"><i class="fa fa-file-text fa-lg"></i></a>-->
                	<a class="btn btn_certificati_dipendenti" style="width:100%" id_dipendente = "<?=$row['id']?>"><i class="fa fa-file-text fa-lg"></i></a>
                </td>
				<td data-title="Alert Scadenza">
					<?php $allegati_dipendente = new AllegatiDipendente(); $allegatiScadenza = $allegati_dipendente->caricaAllegatiScadenza($row['id'], $datainizio, $datafine); $numeroScadenza = $allegati_dipendente->numeroAllegati();?>
					<?php if($numeroScadenza > 0) {?>
						<a class="btn" style="width:100%" title="Ci sono certificati in scadenza" ><i class="fa fa-check fa-lg"></i></a>
					<?php } else {?>
						<a class="btn" style="width:100%" title="Non ci sono certificati in scadenza" ><i class="fa fa-square-o fa-lg"></i></a>
					<?php } ?>
				</td>
				<td data-title="Modifica">
                	<a target="_blank" class="btn modifica_utente btn_modifica"  href="nuovo_dipendente.php?id=<?=$row['id']?>" id_dipendente = "<?=$row['id']?>"><i class="fa fa-edit fa-lg"></i></a>
                </td>
				<td data-title="Elimina">
                	<div class="btn elimina_utente btn_elimina" username="<?=$row['username']?>" id_dipendente="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></div>
                </td>
			</tr>
			<?php
				} //END WHILE
			?>
          </tbody>
       </table>
</section>            

<?php
	}	//end if
?>

<script>

	$(document).ready(function() {

		$(".group").click(function(){
			var valore = $(this).val();
			$("#valore_filtro").val(valore);
			if(valore == "tutto"){
				$(".ATTIVO").show();
				$(".NON_ATTIVO").show();
				$(".TERZI").show();
				$(".IMPIEGATO").show();
			} else if(valore == "attivo"){
				$(".ATTIVO").show();
				$(".NON_ATTIVO").hide();
				$(".TERZI").hide();
				$(".IMPIEGATO").hide();
			} else if(valore == "impiegati"){
				$(".ATTIVO").hide();
				$(".NON_ATTIVO").hide();
				$(".TERZI").hide();
				$(".IMPIEGATO").show();
			} else if(valore == "terzi"){
				$(".ATTIVO").hide();
				$(".NON_ATTIVO").hide();
				$(".TERZI").show();
				$(".IMPIEGATO").hide();
			} else if(valore == "non_attivi"){
				$(".ATTIVO").hide();
				$(".NON_ATTIVO").show();
				$(".TERZI").hide();
				$(".IMPIEGATO").hide();
			}
		});


		<? if($operazione != '') { ?>

			var valorefiltro = $("#valore_filtro").val();
			if(valorefiltro == "tutto"){
				$(".ATTIVO").show();
				$(".NON_ATTIVO").show();
				$(".TERZI").show();
				$(".IMPIEGATO").show();
			} else if(valorefiltro == "attivo"){
				$(".ATTIVO").show();
				$(".NON_ATTIVO").hide();
				$(".TERZI").hide();
				$(".IMPIEGATO").hide();
			} else if(valorefiltro == "impiegati"){
				$(".ATTIVO").hide();
				$(".NON_ATTIVO").hide();
				$(".TERZI").hide();
				$(".IMPIEGATO").show();
			} else if(valorefiltro == "terzi"){
				$(".ATTIVO").hide();
				$(".NON_ATTIVO").hide();
				$(".TERZI").show();
				$(".IMPIEGATO").hide();
			} else if(valorefiltro == "non_attivi"){
				$(".ATTIVO").hide();
				$(".NON_ATTIVO").show();
				$(".TERZI").hide();
				$(".IMPIEGATO").hide();
			}

		<? } ?>

		$(".btn_costo_dipendenti").unbind("click");
		$(".btn_costo_dipendenti").click(function(){

			var id_utente = $(this).attr("id_dipendente");
			var valore_filtro = $("#valore_filtro").val();

			var link = "costo_dipendenti.php?id_dipendente="+id_utente+"&op="+valore_filtro;

			//window.location = link;

			window.open( link, '_blank');

		});

		$(".btn_certificati_dipendenti").unbind("click");
		$(".btn_certificati_dipendenti").click(function(){

			var id_utente = $(this).attr("id_dipendente");
			var valore_filtro = $("#valore_filtro").val();

			var link = "pagina_allegati_dipendenti.php?id_dipendente="+id_utente+"&op="+valore_filtro;

			//window.location = link;

			window.open( link, '_blank');

		});

	});

</script>