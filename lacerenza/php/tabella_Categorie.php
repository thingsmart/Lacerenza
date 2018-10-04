<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Categorie.php");

$filtro = isset($_GET['filtro_categoria']) ? $_GET['filtro_categoria'] : "";

$id_verbale = $_GET['id_verbale'];
$id_commessa = $_GET['id_commessa'];

//estraggo elenco commesse
$categorie = new Categorie();

if($filtro == ""){
    $e_query_categoria = $categorie->caricaCategorie($id_verbale);
} else {
    $e_query_categoria = $categorie->filtraCategorie($filtro, $id_verbale);
}
$numeroCategorie = $categorie->numeroCategorie();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_categorie.js" type="text/javascript"></script>

<? if($numeroCategorie > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">N.</th>
            	<th style="text-align:center">descrizione</th>
                <th style="text-align:center">Importo</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
           $i=0;
				while($row = $e_query_categoria->fetch_array()){
                    $i++;
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$i?></td>
				<td style="text-align:center" data-title="Descrizione"><?=$row['descrizione']?></td>
				<td style="text-align:center" data-title="Importo"><?=$row['importo']?> &euro;</td>
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuova_categoria.php?id=<?=$row['id']?>&id_commessa=<?=$id_commessa?>&id_verbale=<?=$id_verbale?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina_categoria"  id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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
<input type="hidden" value="<?=$id_verbale?>" id="id_verbale"/>