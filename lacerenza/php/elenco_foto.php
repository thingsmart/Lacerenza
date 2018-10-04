<?php
include("controllaSessione.php");

$filtro = isset($_GET['filtro_verbale']) ? $_GET['filtro_verbale'] : "";

$id_commessa = $_GET['id'];
$cartella = str_replace("_", " ",$_GET['cartella']);
?>
<script src="js/sito/elenco_foto.js" type="text/javascript"></script>

<div class="row">
		<div class='list-group gallery' style="width:100%">
				<?
				$dir = "../uploads/commesse/".$id_commessa."/foto/".$cartella."/";
				$dh  = opendir($dir);
				while (false !== ($filename = readdir($dh))) {
					if($filename != "." AND $filename != ".."){
				 ?>
				 	<div  class='col-sm-4 col-xs-12 col-md-3 col-lg-3'>
                <a class="thumbnail fancybox" rel="ligthbox" href="uploads/commesse/<?=$id_commessa?>/foto/<?=$cartella?>/<?=$filename?>">
                    <img class="img-responsive" style="width:300px; height: 200px" src="uploads/commesse/<?=$id_commessa?>/foto/<?=$cartella?>/<?=$filename?>" />
                    <div class='text-right'>
                        <small class='text-muted'><?=$filename?></small>
                    </div> <!-- text-right / end -->
                </a>
                <div  data-toggle="modal" data-target=".bs-elimina" class="btn btn-danger elimina_foto" style="margin-top:-20px; margin-bottom:30px; width:100%" nome_file="<?=$filename?>"><i class="fa fa-trash"></i> Elimina</div>

            </div> <!-- col-6 / end -->
				 <?
					}
				}
				?>
				</div> <!-- list-group / end -->
				</div> <!-- row / end -->
<input type="hidden" value="<?=$id_commessa?>" id="id_commessa"/>
<input type="hidden" value="<?=$cartella?>" id="cartella_cancella"/>
