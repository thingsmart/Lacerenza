<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Sezione.php");

$filtro = $_GET['q'];


$sezione = new Sezione();

if($filtro == ""){
	$lista_sezioni = $sezione->getAll();
} else {
    $lista_sezioni = $sezione->getFilter($filtro);
}

$numero = count($lista_sezioni);

?>
<style>

span {
    color: #000;
}

</style>
<!--SCRIPT SITO-->
<script src="js/sito/tabella_sezioni.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
       $('.ricontatti_tooltip').tooltip();
    });
</script>
<? if($numero > 0){ ?>
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%">
    	<thead class="cf">
        	<tr>
            	<th style="text-align:center">Titolo</th>
            	<th style="text-align:center">Oscurato</th>
                <th style="text-align:center">Immagine</th>
                <th style="text-align:center">Costo</th>
                <th style="text-align:center">Modifica</th>
                <th style="text-align:center">Elimina</th>
           </tr>
        </thead>
        <tbody>
           <?php foreach ($lista_sezioni as $sezione) {
               
			?>
			<tr>
				<td style="text-align:center" data-title="N."><?=$sezione->titolo?></td>
				
				<td style="text-align:center;" data-title="Cliente">
					<? if($sezione->oscura_titolo == 1) { ?>
						<i class="fa fa-check" title="Titolo Oscurato"></i>
					<? } else { ?>
						<i class="fa fa-ban" title="Titolo Non Oscurato"></i>
					<? } ?>
				</td>
								
				<td style="text-align:center" data-title="Cliente">
					<? if($sezione->link_file == '') { ?>
						<span class="label label-default">Non Impostata</span>
					<? } else { ?>
						<a href="<?=$sezione->link_file?><?=$sezione->filename?>" class="btn" target="_blank"><i class="fa fa-file-image-o"></i></a>
					<? } ?>
				</td>
				<td style="text-align:center" data-title="Cliente">
					<? if($sezione->costo == '') { ?>
						<span class="label label-default">Non Impostato</span>
					<? } else { ?>
						<?=$sezione->costo?> € <? if($sezione->tipologia_costo == 'mq') { echo "al mq"; } ?>
					<? } ?>
				</td>
                <td data-title="Modifica" style="text-align:center">
                 	<a style="width:100%" class="btn" href="nuova_sezione.php?id=<?=$sezione->id?>"><i class="fa fa-edit fa-lg"></i></a>
				</td>
                <td data-title="Elimina" style="text-align:center">
                 	<a style="width:100%" class="btn btn_elimina" id="<?=$sezione->id?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></a>
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

