<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.RevisioniContrattuali.php");

$filtro = isset($_GET['filtro_revisioni_contrattuali']) ? $_GET['filtro_revisioni_contrattuali'] : "";

$id_commessa = $_GET['id'];

//estraggo elenco commesse
$revisioniContrattuali = new RevisioniContrattuali();

if($filtro == ""){
$e_query_fattura = $revisioniContrattuali->CaricaRevisioniContrattuali($id_commessa);
} else {
    $e_query_fattura = $revisioniContrattuali->filtraRevisioniContrattuali($filtro, $id_commessa);
}
$numeroRevisioniContrattuali = $revisioniContrattuali->numeroRevisioniContrattuali();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_revisioni_contrattuali.js" type="text/javascript"></script>

<? if($numeroRevisioniContrattuali > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Tipo Documento</th>
                <th style="text-align:center">Data Documento</th>
                <th style="text-align:center">Numero Documento</th>
                <th style="text-align:center">Registrato a</th>
                <th style="text-align:center">Allegato</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
            $i=0;
				while($row = $e_query_fattura->fetch_array()){
                    $i++;
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Tipo documento"><?=$row['tipo_documento']?></td>
				<td style="text-align:center" data-title="Data Documento"><?=CapovolgiData($row['data'])?></td>
				<td style="text-align:center" data-title="Data Documento"><?=$row['numero_documento']?></td>
				<td style="text-align:center" data-title="Registrato a"><?=$row['registrato_a']?></td>
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
                 	<a style="width:100%" class="btn" href="nuova_revisione_contrattuale.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_revisione_contrattuale" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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