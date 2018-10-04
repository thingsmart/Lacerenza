<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Verbali.php");

$filtro = isset($_GET['filtro_verbale']) ? $_GET['filtro_verbale'] : "";

$id_commessa = $_GET['id'];

//estraggo elenco commesse
$verbali = new Verbali();

if($filtro == ""){
$e_query_verbale = $verbali->caricaVerbali($id_commessa);
} else {
    $e_query_verbale = $verbali->filtraVerbali($filtro, $id_commessa);
}
$numeroVerbali = $verbali->numeroVerbali();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_verbali.js" type="text/javascript"></script>

<? if($numeroVerbali > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
                <th style="text-align:center">Descrizione</th>
                <th style="text-align:center">Importo</th>
                <th style="text-align:center">Data</th>
                <th style="text-align:center">Categorie</th>
                <th style="text-align:center">Allegato</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
				while($row = $e_query_verbale->fetch_array()){
                    $i++;
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Descrizione"><?=$row['descrizione']?></td>
				<td style="text-align:center" data-title="Importo"><?=$row['importo']?> &euro;</td>
				<td style="text-align:center" data-title="Data"><?=CapovolgiData($row['data'])?></td>
				<td data-title="Categorie" style="text-align:center">
                 	<a style="width:100%" class="btn" href="pagina_categorie.php?id_verbale=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-list-ul fa-lg"></i></a>
				</td>
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
                 	<a style="width:100%" class="btn" href="nuovo_verbale.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_verbale" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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