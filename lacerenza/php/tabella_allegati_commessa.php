<?php
//Verifico se ho effettuato il login
include("controllaSessione.php");

include("../databases/db_function.php");
require_once("../classi/class.Allegati.php");
require_once("../lib/verificaConvertiData.php");


$id=$_GET['id'];

//estraggo elenco allegati
$allegati = new Allegati();
$e_query_callegati = $allegati->caricaAllegati($id);

?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_allegati_commessa.js" type="text/javascript"></script>

<?php if($allegati->numeroAllegati() > 0){ ?>
<!--Tabella Allegato-->  
<div>      
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%; margin-top:10px; margin-bottom:10px">
  <thead>
    <tr >
      <th style="text-align:center">N.</th>
      <th style="text-align:center">Descrizione</th>
      <!-- <th style="text-align:center">N.</th> -->
      <th style="text-align:center">Data</th>
      <th style="text-align:center">Allegato</th>
    </tr>
  </thead>
  <tbody>
  <? 
  	$i=0;
	while($row_allegati = $e_query_callegati->fetch_array()){
	  $i++;
  ?>
  	<tr>
    	<td style="text-align:center" data-title="N."><?=$i?></td>
    	<td style="text-align:center" data-title="Descrizione">
        	<? if($row_allegati['descrizione'] != "") { 
            	echo $row_allegati['descrizione'];
             } else {?>
             	Nessuna
             <? } ?>
        </td>
    	<!-- <td style="text-align:center" data-title="Verbale n."><?=$row_allegati['verbale_n']?></td> -->
    	<td style="text-align:center" data-title="data"><?=CapovolgiData($row_allegati['data'])?></td>
    	<td style="text-align:center" data-title="Allegato">
        	<a href="<?=$row_allegati['link_allegato']?>" target="_blank">Apri allegato</a>
        	<button  style="margin-left:3px;" type="button" class="close elimina_allegato" id_allegato="<?=$row_allegati['id']?>" id_commessa="<?=$row_allegati['id_commessa']?>" nome="<?=$row_allegati['file_name']?>" data-toggle="modal" data-target=".bs-elimina"> &times;</button>
        </td>
    </tr>
    <? } ?>
  </tbody>
 </table>
 </td>
 </div>
 <?php } ?>
 
 
<!--Modal elimina-->
<div class="modal <?=$fade?> bs-elimina" tabindex="-1" role="dialog" id="dialog_elimina" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Elimina</h4>
      </div>
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare l'allegato? </div>
      <div class="modal-footer">
        <div id="id_allegato_da_eliminare" style="display:none"></div>
        <div id="id_commessa_da_eliminare" style="display:none"></div>
        <div id="nome_da_eliminare" style="display:none"></div>
        <button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_elimina_conferma" class="btn btn-danger">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->