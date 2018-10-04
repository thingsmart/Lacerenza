<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.DocumentiCliente.php");

$filtro = isset($_GET['filtro_documento_cliente']) ? $_GET['filtro_documento_cliente'] : "";

$id_commessa = $_GET['id'];

//estraggo elenco commesse
$documenti_cliente = new DocumentiCliente();

if($filtro == ""){
    $e_query_documento_cliente = $documenti_cliente->CaricaDocumentiCliente($id_commessa);
} else {
    $e_query_documento_cliente = $documenti_cliente->filtraDocumentiCliente($filtro, $id_commessa);
}
$numeroDocumentiCliente = $documenti_cliente->numeroDocumentiCliente();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_documenti_cliente.js" type="text/javascript"></script>

<? if($numeroDocumentiCliente > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
            	<th style="text-align:center">Descrizione</th>
                <th style="text-align:center">Ente rilascio</th>
                <th style="text-align:center">Data</th>
                <th style="text-align:center">Validit&agrave;</th>
                <th style="text-align:center">Scadenza</th>
                <th style="text-align:center">Rinnovo</th>
                <th style="text-align:center">Allegato</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
                $i=0;
				while($row = $e_query_documento_cliente->fetch_array()){
                    $i++;
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Descrizione"><?=$row['descrizione']?></td>
				<td style="text-align:center" data-title="Ente rilascio"><?=$row['ente_rilascio']?></td>
				<td style="text-align:center" data-title="Data"><?=CapovolgiData($row['data'])?></td>
				<td style="text-align:center" data-title="Validit&agrave;"><? if($row['validita'] != "0000-00-00") { echo CapovolgiData($row['validita']);} else { echo "Nessuna";}?></td>
				<td style="text-align:center" data-title="Scadenza"><? if($row['scadenza'] != "0000-00-00") { echo CapovolgiData($row['scadenza']);} else { echo "Nessuna";} ?></td>
				<td style="text-align:center" data-title="Rinnovo"><? if($row['rinnovo'] != "0000-00-00") { echo CapovolgiData($row['rinnovo']);} else { echo "Nessuna";} ?></td>
				<td style="text-align:center" data-title="Allegato">
                	<? if($row['nome_allegato'] != "") { ?>
                        <a href="<?=$row['link_allegato'].$row['nome_allegato']?>" target="_blank">
                            Apri allegato
                        </a>
                    <? } else { ?>
                    	Nessun allegato
                    <? } ?>
                </td>
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuovo_documento_cliente.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_documento_cliente" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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

<input type="hidden" value="<?=$id_commessa?>" id="id_commessa"/>