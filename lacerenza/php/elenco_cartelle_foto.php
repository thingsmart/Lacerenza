<?php

$id_commessa = $_GET['id'];
?>

<!--SCRIPT SITO-->
<script src="js/sito/elenco_cartelle_foto.js" type="text/javascript"></script>
<div class="row">
		<div class='list-group gallery' style="width:100%">
				<?
				$dir = "../uploads/commesse/".$id_commessa."/foto/";
				$dh  = opendir($dir);
				?>
				<section id="no-more-tables">
			<table class="table-striped table-condensed cf" style="width:100%">
        	
				<? while (false !== ($filename = readdir($dh))) {
					if($filename != "." AND $filename != ".." AND is_dir($dir.$filename)){
				 ?>
				 <tr>
				 	<td class="text-center"><i class="fa fa-folder fa-3x"></i></td>
				 	<td class="text-center"><b><?=$filename?></b></td>
				 	<td class="text-center"><a href="foto.php?cartella=<?=str_replace(" ", "_",$filename)?>&id=<?=$id_commessa?>">Apri</a></td>
				 	<td class="text-center">
						<i data-toggle="modal" data-target=".bs-modifica" id_commessa="<?=$id_commessa?>"  percorso="<?=$dir?>" nome="<?=$filename?>" class="btn fa fa-edit  fa-2x btn_modifica"></i>
					</td>
					 <td class="text-center"><i data-toggle="modal" data-target=".bs-elimina" class="fa fa-trash fa-2x btn elimina_cartella" id_commessa="<?=$id_commessa?>" cartella="<?=$filename?>"></i></td>
				 </tr>
				 <?
					}
				}
				?>
				</table>
				</section>
				</div> <!-- list-group / end -->
				</div> <!-- row / end -->
<input type="hidden" value="<?=$id_commessa?>" id="id_commessa"/>