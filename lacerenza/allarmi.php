<?php

include("databases/db_function.php");
require_once ("lib/verificaConvertiData.php");
require_once("classi/class.Mezzi.php");
require_once("lib/funzioni_sito.php");


//Numero mezzi
$mezzi = new Mezzi();
$e_query_mezzi = $mezzi->caricaMezzi();
$e_query_mezzi_spesa = $mezzi->caricaMezzi();

//variabili controllo allarmi
$controllo_tagliandi = 0;
$controllo_spese = 0;

?>
<!--SCRIPT SITO-->
<script src="js/sito/home.js" type="text/javascript"></script>

<style>
	table i {color: #894242;}
	table th, table td {text-align:center;}
</style>

<!--Allarmi-->
        <div>
            <!--CONTROLLO TAGLIANDI-->
            <? if($e_query_mezzi->num_rows > 0) {?>
            <section id="no-more-tables">
                <div class="page-title">
					<h1>Tagliandi <small> allerta tagliandi automezzi</small></h1>					
				</div>
                <table class="table-condensed cf" style="width: 100%">
                    <thead class="cf">
                        <tr style="border-left: 8px solid #185A7A">
                            <th>Allarme</th>
                            <th>Mezzo</th>
                            <th>Targa</th>
                            <th>Costo</th>
                            <th>Km Mezzo</th>
                            <th>Km Ultimo Tagliando</th>
                            <th>Km Percorsi</th>
                            <th>Elimina</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                   while($row_mezzo = $e_query_mezzi->fetch_array()){
                       $e_query_allarme  = avverti($row_mezzo['id']);
                       //controllo bollo
                       while($row = $e_query_allarme->fetch_array()){
                           //if($row['FIELD_1'] > 2000 && $row['FIELD_1'] < 3001){//tagliando ogni 30000 km, mi avvisa 1000 km prima
                           $tagliando_ogni = ($row['tagliando_prossimo'] != null) ? $row['tagliando_prossimo'] : 20000;
                           // echo $row['km_percorsi'] ." ".($tagliando_ogni - 1000)."<br>";
                           if($row['km_percorsi'] >= ($tagliando_ogni - 1000)){//tagliando ogni 3000 km, mi avvisa 1000 km prima
                               $controllo_tagliandi++;
                        ?>
                        <? if($row['colore'] != "" ){ 
                        	if($row['colore'] != "ffffff"){
                        		$colore_testo = "#ffff";
                        	} else {
                        		$colore_testo = "#000";
                        	}
                        ?>
                        <tr style="border-left: 8px solid #<?=$row['colore']?>">
                        <? } else { ?>
                        <tr >
                        <? } ?>
                            <td data-title="Allarme"><i style="color:#<?=$row['colore']?>" class="fa fa-spinner fa-spin fa-2x"></i> Fare Tagliando <?=$row['tipo_tagliando']?></td>
                            <td data-title="Mezzo"><?=$row['mezzo']?></td>
                            <td data-title="Targa"> <?=$row['targa']?></td>
                            <td data-title="Costo"> <?=number_format($row['costo'], 2, ',', '.');?> &euro;</td>
                            <td data-title="Km mezzo"><?=$row['km_percorsi']?></td>
                            <td data-title="Km tagliando"><?=$row['tagliando_ogni']?></td>
                            <td data-title="Km percorsi"> <?=$row['km_percorsi']-$row['tagliando_ogni']?></td>
                            <td data-title="Elimina"><div tabella="tb_tagliando"  id="<?=$row['id']?>" id_mezzo="<?=$row['id_mezzo']?>" class="btn btn_eseguito" style="width:100%" data-toggle="modal" data-target=".bs-eseguito"><i class="fa fa-trash fa-lg"></i></div></td>
                        </tr>
                        <?
                           }
                       }
                       
                   }
                   if($controllo_tagliandi == 0){
                        ?>
                        <tr>
                            <td colspan="7" style="text-align: center" data-title="Allarme">Nessun allarme attivo</td>
                        </tr>

                        <?}

                        ?>
                    </tbody>
                </table>
            </section>
            <? } ?>
            <!--FINE CONTROLLO TAGLIANDI-->

            <!--Controllo altre spese-->
            <? if($e_query_mezzi_spesa->num_rows > 0) { ?>
            <section id="no-more-tables">
                <div class="page-title">
					<h1>Altre Spese <small> allerta spese varie</small></h1>					
				</div>
                <table class="table-condensed cf" style="width: 100%">
                    <thead class="cf">
                        <tr>
                            <th>Allarme</th>
                            <th>Mezzo</th>
                            <th>Targa</th>
                            <th>Costo</th>
                            <th>Data ultimo pagamento</th>
                            <th>Data scadenza</th>
                            <th>Scade tra</th>
                            <th>Elimina</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                   while($row_mezzo = $e_query_mezzi_spesa->fetch_array()){
                       $e_query_allarme_spesa  = avverti($row_mezzo['id']);
                       
                       //controllo altre spese
                       $e_query_allarme_spesa  = avverti_spesa($row_mezzo['id']);
                       while($row_spesa = $e_query_allarme_spesa->fetch_array()){
                           if($row_spesa['data_scadenza'] != "0000-00-00"){
                               $scadenza_spesa = ceil(delta_tempo (date("Y-m-d"), $row_spesa['data_scadenza'],"g"));
                               if($scadenza_spesa < 15){//avvisa se mancano 15 giorni alla scadenza
                                   $controllo_spese++;
                        ?>
                        <tr <? if($scadenza_spesa < 0)?>>
                            <td data-title="Allarme"><i class="fa fa-spinner fa-spin fa-2x"></i> <?=$row_spesa['tipo']?></td>
                            <td data-title="Mezzo"><?=$row_spesa['mezzo']?></td>
                            <td data-title="Targa"><?=$row_spesa['targa']?></td>
                            <td data-title="Costo"><?=number_format($row_spesa['costo'], 2, ',', '.');?> &euro;</td>
                            <td data-title="Ultimo pagamento"><?=CapovolgiData($row_spesa['data_ultimo_pagamento'])?></td>
                            <td data-title="Data scadenza"><?=CapovolgiData($row_spesa['data_scadenza'])?></td>
                            <td data-title="Scade tra">
                                <? if($scadenza_spesa < 0) { ?>
                                    Scaduto
                                <? } else { ?>    
                                    <?=$scadenza_spesa?> giorni
                                <? } ?>
                            </td>
                            <td style="text-align: center" data-title="Elimina"><div tabella="tb_spese" id="<?=$row_spesa['id']?>" id_mezzo="<?=$row_spesa['id_mezzo']?>" class="btn btn_eseguito" style="width:100%" data-toggle="modal" data-target=".bs-eseguito"><i class="fa fa-trash fa-lg"></i></div></td>
                        </tr>
                        <?
                               }
                               
                           }
                           
                       }
                       
                   }
                   if($controllo_spese == 0){
                        ?>
                        <tr>
                            <td colspan="7" style="text-align: center" data-title="Allarme">Nessun allarme attivo</td>
                        </tr>

                        <?}
                        ?>
                    </tbody>
                </table>
            </section>
            <? } ?>
            <!--FINE Controllo altre spese-->
            <br />
            <br />
        </div>