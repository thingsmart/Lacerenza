<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.Modello.php");
require_once("../classi/class.Sezione.php");

$id_modello = $_GET['model'];

$modello = new Modello();
$lista_modelli = $modello->getAllModelloMasterOrder($id_modello);

$numero = count($lista_modelli);

?>
<style>
.ribbon-container {
	position: relative;
	display: inline-block;
	line-height: 1;
}
.ribbon-container img {
	vertical-align: middle;
}
.ribbon {
	position: absolute;
	bottom: 1em;
	left: 0;
	margin-right: 1em;
	padding: .75em 1.25em .75em .75em;
	border-radius: 0 .5em .5em 0;
	background-color: #529ec1;
	background-image: linear-gradient(to right, rgba(0,0,0,0) 0%, rgba(0,0,0,.1) 100%);
	box-shadow: inset 0 .062em 0 rgba(255,255,255,.6), 0 .125em .25em rgba(0,0,0,.2);
	color: #fff;
	text-shadow: 0 -.062em 0 rgba(0,0,0,.2);
	white-space: nowrap;
	transition: background-color .2s ease-in-out;
}
.ribbon:before,
.ribbon:after {
	position: absolute;
	background-color: inherit;
	content: "";
}
.ribbon:before {
	bottom: 0;
	left: -.5em;
	width: .5em;
	height: 3em;
	border-radius: 0 0 0 .5em;
	background-image: linear-gradient(to right, rgba(0,0,0,.2) 0%, rgba(0,0,0,0) 100%);
}
.ribbon:after {
	top: -1em;
	left: -.5em;
	width: .5em;
	height: 1em;
	border-radius: .5em 0 0 .5em;
	background-image: linear-gradient(to right, rgba(0,0,0,0) 0%, rgba(0,0,0,.2) 100%);
	box-shadow: 0 .062em 0 rgba(255,255,255,.6);
}

/* CSS used here will be applied after bootstrap.css */
.sortable-placeholder {
    margin-left: 0 !important;
    border: 1px solid #ccc;
    background-color: yellow;
    -webkit-box-shadow: 0px 0px 10px #888;
    -moz-box-shadow: 0px 0px 10px #888;
    box-shadow: 0px 0px 10px #888;
}

.img-personalizzata {
    width: 352px;
    min-height: 264px;
}

@media only screen and (max-width: 500px) {
	.img-personalizzata {
    	width: 182px;
    	min-height: 137px;
   	}
}
</style>

<!--SCRIPT SITO-->
<script src="js/sito/modelli/tabella_dettagli_modello.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
       $('.ricontatti_tooltip').tooltip();
    });
</script>


<br>

<input type="hidden" id="iddettagliomaster" name="iddettagliomaster" value="<?=$id_modello?>" />

<? if($numero > 0){ ?>	
	
		<div class="container-fluid">

			<div class="row">
				<div class="col-lg-12">

					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="panel-title" style="color: #fff">SEZIONI PREVENTIVO</h1>
						</div>
						<div class="panel-body">

							<div class="row">
								
								<div id="rigaSpostabile">
								
								<? foreach($lista_modelli as $new_modello) { ?>
									
									<div class="col-md-3 thumb" id="item_<?=$new_modello->id?>">
										<div><a class="btn pull-right btn_elimina_box" id="<?=$new_modello->id?>" idmodello="<?=$id_modello?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o"></i></a></div>
										<? $sezione = new Sezione(); $dati_sezione = $sezione->getById($new_modello->id_sezione); ?>
										<a class="thumbnail" href="#"> <img class="img-responsive" src="img/placeholder.png" alt=""><span class="ribbon"><small>sez: <?=custom_echo(strtoupper($dati_sezione->titolo), 35);?></small></span></a>
										<!-- <? if($dati_sezione->filename == '') {?>
											<a class="thumbnail" href="#"> <img class="img-responsive" src="img/placeholder.png" alt=""><span class="ribbon"><?=$new_modello->id?> - sez: <?=$dati_sezione->titolo?></span></a>
										<? } else { ?>
											<a class="thumbnail" href="#"> <img class="img-responsive img-personalizzata" src="<?=$dati_sezione->link_file?><?=$dati_sezione->filename?>" alt="" ><span class="ribbon"><?=$new_modello->id?> - sez: <?=$dati_sezione->titolo?></span></a>
										<? } ?> -->
									</div>
									
								<? } ?>
	
							</div>

						</div>

					</div>
				</div>
			</div>

		</div>
	
<? } else {?>
	<p class="text-center">Nessun dato trovato</p>
<? } ?>
        
<?
function custom_echo($x, $length) {
	
	if(strlen($x)<=$length) {
    	echo $x;
  	} else {
    	$y=substr($x,0,$length) . '...';
    	echo $y;
  	}
}
?>

