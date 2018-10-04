<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Lavori.php");


$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : "";

//estraggo elenco commesse
$lavori = new Lavori();

if($filtro == ""){
$e_query = $lavori->carica();
} else {
    $e_query = $lavori->filtra($filtro);
}
$numero = $lavori->numero();
?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_lavori.js" type="text/javascript"></script>

<? if($numero > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
                <th style="text-align:center">Lavorazione</th>
                <th style="text-align:center">Codice attivit&agrave;</th>
                <th style="text-align:center">Attivit&agrave;</th>
                <th style="text-align:center">Modalit&agrave; operative</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php
            $i=0;
				while($row = $e_query->fetch_array()){
                    $i++;
			?>
			<tr>
				<td style="text-align:center" data-title="Lavorazione"><?=$row['lavorazione']?></td>
				<td style="text-align:center" data-title="Codice attivit&agrave;"><?=$row['cod_lavoro']?></td>
				<td style="text-align:center" data-title="Attivit&agrave;"><?=$row['attivita']?></td>
				<td style="text-align:center" data-title="Modalit&agrave; operative"><?=$row['descrizione']?></td>
				
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuovo_lavoro.php?id=<?=$row['id']?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina" nome="<?=$row['nome_allegato']?>" id="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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

