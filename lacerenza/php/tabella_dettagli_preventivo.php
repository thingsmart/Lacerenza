<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");

include("../databases/db_function.php");
require_once("../classi/class.PreventivoMaster.php");
require_once("../classi/class.Preventivo.php");
require_once("../classi/class.ModelloMaster.php");
require_once("../classi/class.Modello.php");
require_once("../classi/class.Sezione.php");

$id = $_GET['id'];

$preventivo_master = new PreventivoMaster();
$dati_preventivo = $preventivo_master->getByIdJoin($id);

$id_modello_master = $dati_preventivo['newId'];

$modello = new Modello();
$lista_preventivi_master = $modello->getAllModelloMasterOrderJoin($id_modello_master);

$numero = count($lista_preventivi_master);

?>
<style>
span{
	color: #000;
}
.bs-calltoaction{
    position: relative;
    width:auto;
    padding: 15px 25px;
    border: 1px solid black;
    margin-top: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
}

    .bs-calltoaction > .row{
        display:table;
        width: calc(100% + 30px);
    }
     
        .bs-calltoaction > .row > [class^="col-"],
        .bs-calltoaction > .row > [class*=" col-"]{
            float:none;
            display:table-cell;
            vertical-align:middle;
        }

            .cta-contents{
                padding-top: 10px;
                padding-bottom: 10px;
            }

                .cta-title{
                    margin: 0 auto 15px;
                    padding: 0;
                }

                .cta-desc{
                    padding: 0;
                }

                .cta-desc p:last-child{
                    margin-bottom: 0;
                }

            .cta-button{
                padding-top: 10px;
                padding-bottom: 10px;
            }

@media (max-width: 991px){
    .bs-calltoaction > .row{
        display:block;
        width: auto;
    }

        .bs-calltoaction > .row > [class^="col-"],
        .bs-calltoaction > .row > [class*=" col-"]{
            float:none;
            display:block;
            vertical-align:middle;
            position: relative;
        }

        .cta-contents{
            text-align: center;
        }
}



.bs-calltoaction.bs-calltoaction-default{
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}

.imgnew {
    margin: auto;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}


</style>
<!--SCRIPT SITO-->
<script src="js/sito/preventivi/tabella_dettagli_preventivo.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
       $('.ricontatti_tooltip').tooltip();
    });
</script>
<? if($numero > 0){ ?>
	
	<div class="container">
	
		<div class="col-lg-12">

			<? foreach($lista_preventivi_master as $prev_master) { ?>
				
	            <div class="bs-calltoaction bs-calltoaction-default">
	                <div class="row">
	                	<div class="col-lg-3 cta-contents">
	                		<? if($prev_master->link_file == '') { ?>
	                			<img src="img/placeholder.png" style="width: 180px; height: 120px" class="img-responsive imgnew"/>
	                		<? } else { ?>
	                			<img src="<?=$prev_master->link_file?><?=$prev_master->filename?>" style="width: 180px; height: 120px" class="img-responsive imgnew"/>
	                		<? } ?>
	                	</div>
	                    <div class="col-lg-7 cta-contents">
	                        <h1 class="cta-title"><?=$prev_master->titolo?></h1>
	                        <div class="cta-desc">
	                        	<? $dati_prev = Preventivo::getByPreventivo($id, $prev_master->id); $costo_prev = $dati_prev->costo; $descrizione_prev = $dati_prev->descrizioneaggiornata; $quantita_prev = $dati_prev->quantita; $tipologia_costo_prev = $prev_master->tipologia_costo; ?>

	                            <p><br></p>
	                            <? if($prev_master->costo != '') { ?>
	                            	
	                            	<? $dati_prev = Preventivo::getByPreventivo($id, $prev_master->id); $costo_prev = $dati_prev->costo; $descrizione_prev = $dati_prev->descrizioneaggiornata; $quantita_prev = $dati_prev->quantita; $tipologia_costo_prev = $prev_master->tipologia_costo; ?>
	                            	<? if($costo_prev != '') { ?>
	                            		<p style="text-align: right"><?=number_format($costo_prev,2,",","."); ?> € <? if($tipologia_costo_prev == 'mq' || $tipologia_costo_prev == 'ml') { echo "/ ".$tipologia_costo_prev; }?> <? if($quantita_prev != '') { echo "<small> - totale: </small><b>"; echo number_format($costo_prev * $quantita_prev,2,",","."). " €</b>"; }?></p> 
	                            	<? } else { ?>
	                            		<p style="text-align: right"><?=number_format($prev_master->costo,2,",","."); ?> € <? if($tipologia_costo_prev == 'mq' || $tipologia_costo_prev == 'ml') { echo "/ ".$tipologia_costo_prev; }?> <? if($quantita_prev != '') { echo "<small> - totale: </small><b>"; echo number_format($prev_master->costo * $quantita_prev,2,",","."). " €</b>"; }?></p>
	                            	<? } ?>
	                            		
	                            <? } ?>	                            	
	                        </div>
	                    </div>
	                    <div class="col-lg-2 cta-button">
	                    	<? if($prev_master->costo != '') { ?>
	                    		<? $dati_prev = Preventivo::getByPreventivo($id, $prev_master->id); $costo_prev = $dati_prev->costo; $descrizione_prev = $dati_prev->descrizioneaggiornata; $quantita_prev = $dati_prev->quantita; $tipologia_costo_prev = $prev_master->tipologia_costo; ?>
		                    	
		                    	<? if($costo_prev != '') { ?>
		                    		<a style="width:100%" class="btn btn-default btn_importo" id="<?=$dati_prev->id?>" costo="<?=$costo_prev?>" idmodmaster="<?=$prev_master->id?>" idprevmaster="<?=$id?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-euro fa-xs"></i> Importo</a>
		                    	<? } else { ?>
		                    		<a style="width:100%" class="btn btn-default btn_importo" id="<?=$dati_prev->id?>" costo="<?=$prev_master->costo?>" idmodmaster="<?=$prev_master->id?>" idprevmaster="<?=$id?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-euro fa-xs"></i> Importo</a>
	                    		<? } ?>
	                    		
	                    		<? if($tipologia_costo_prev == 'mq' || $tipologia_costo_prev == 'ml') { ?>
	                    			<a style="width:100%" class="btn btn-default btn_quantita" id="<?=$dati_prev->id?>" quantita="<?=$quantita_prev?>" idmodmaster="<?=$prev_master->id?>" idprevmaster="<?=$id?>" data-toggle="modal" data-target=".bs-quantita"><i class="fa fa-calculator fa-xs"></i> Quantita</a>
	                    		<? } ?>
	                    		
	                        <? } ?>	   
	                        

	                        <? if($descrizione_prev == '') { ?>
	                        	<? if($dati_prev->id != '') { ?>
	                        		<a style="width:100%" href="edit_testo.php?id=<?=$dati_prev->id?>&model=<?=$prev_master->id?>&prev=<?=$id?>" class="btn btn-default"  ><i class="fa fa-file-text-o fa-xs"></i> Descrizione</a>
								<? } else { ?>
									<a style="width:100%" href="edit_testo.php?model=<?=$prev_master->id?>&prev=<?=$id?>" class="btn btn-default"  ><i class="fa fa-file-text-o fa-xs"></i> Descrizione</a>
								<? } ?>
							<? } else {?>	
	                        	<? if($dati_prev->id != '') { ?>
	                        		<a style="width:100%" href="edit_testo.php?id=<?=$dati_prev->id?>&model=<?=$prev_master->id?>&prev=<?=$id?>" class="btn btn-default"  ><i class="fa fa-file-text-o fa-xs"></i> Descrizione</a>
								<? } else { ?>
									<a style="width:100%" href="edit_testo.php?model=<?=$prev_master->id?>&prev=<?=$id?>" class="btn btn-default"  ><i class="fa fa-file-text-o fa-xs"></i> Descrizione</a>
								<? } ?>
							<? } ?>	               
	                    </div>
	                 </div>
	            </div>
	            
            <? } ?>


		</div>
	
	</div>    
	        
<? } else {?>
	Nessun dato trovato
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

