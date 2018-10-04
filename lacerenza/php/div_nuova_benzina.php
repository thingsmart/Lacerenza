<?php
include("controllaSessione.php");
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
require_once("../classi/class.Benzine.php");

$id = isset($_GET['id']) ? $_GET['id'] : "";
$id_mezzo = isset($_GET['id_mezzo']) ? $_GET['id_mezzo'] : "";
$targa = isset($_GET['targa']) ? $_GET['targa'] : "";

if($id != ""){
    $benzina = new Benzine();
    $e_query_benzina = $benzina->caricaBenzinaById($id);
    $row = $e_query_benzina->fetch_array();
    $data = CapovolgiData($row['data']);	
    $targa = $row['targa'];
	$aliquota = $row['aliq_iva'];
} else {
    $data = date('d-m-Y');	
	$aliquota ='22';
}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuova_benzina.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewBenzina" name="formNewBenzina" enctype="multipart/form-data" action='lib/operazioni_benzina.lib.php' method='POST'>

    <div class="row">
        <div class="col-sm-6 col-lg-6">
            <div class="form-group">
                <label class="col-md-4 control-label">Data*:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control data_picker" value="<?=$data?>" id="data" name="data" readonly>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6">
            <div class="form-group">
                <label class="col-md-4 control-label">Targa:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Targa"  id="targa" name="targa"  value="<?=$targa?>" readonly/>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6" style="display:none">
            <div class="form-group">
                <label class="col-md-4 control-label">N. Carta:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="N.Carta"  id="numero_carta" name="numero_carta"  value="<?=$row['numero_carta']?>"/>
                    <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                    <input type="hidden" id="tipo" name="tipo" value="inserimento" />
                    <input type="hidden" id="id_mezzo" name="id_mezzo"  value="<?=$id_mezzo?>"/>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6">
            <div class="form-group">
                <label class="col-md-4 control-label">Titolare Carta:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Titolare carta"  id="titolare_carta" name="titolare_carta"  value="<?=$row['titolare_carta']?>"/>

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6">
            <div class="form-group">
                <label class="col-md-4 control-label">Localit&agrave;:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Localita"  id="localita" name="localita"  value="<?=$row['localita']?>"/>
                </div>
            </div>
        </div>
        
        <div style="display:none" class="col-sm-6 col-lg-6">
            <div class="form-group">
                <label class="col-md-4 control-label">Codice autista:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Codice autista"  id="codice_autista" name="codice_autista"  value="<?=$row['codice_autista']?>"/>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-lg-6" >
            <div class="form-group">
                <label class="col-md-4 control-label">Km veicolo*:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Km veicolo"  id="km_veicolo" name="km_veicolo"  value="<?=$row['km_veicolo']?>"/>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-lg-6" style="display:none">
            <div class="form-group">
                <label class="col-md-4 control-label">Quantit&agrave; (litri)*:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Quantit&agrave; (litri)"  id="quantita_litri" name="quantita_litri"  value="<?=$row['quantita_litri']?>"/>
                </div>
            </div>
        </div>
       
        <div class="col-sm-6 col-lg-6">
            <div class="form-group">
                <label class="col-md-4 control-label">Prezzo pompa(100 L):</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Prezzo pompa"  id="prezzo_pompa" name="prezzo_pompa"  value="<?=$row['prezzo_pompa']?>"/>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6" style="display:none">
            <div class="form-group">
                <label class="col-md-4 control-label">Aliq. IVA:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Aliq. IVA"  id="aliq_iva" name="aliq_iva"  value="<?=$aliquota?>"/>
                </div>
            </div>
        </div>
         <div class="col-sm-6 col-lg-6" style="display:none">
            <div class="form-group">
                <label class="col-md-4 control-label">Importo ticket*:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Importo tiket"  id="importo_ticket" name="importo_ticket"  value="<?=$row['importo_ticket']?>"/>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6" style="display:none">
            <div class="form-group">
                <label class="col-md-4 control-label">Sconto:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Sconto"  id="sconto" name="sconto"  value="<?=$row['sconto']?>"/>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6" style="display:none">
            <div class="form-group">
                <label class="col-md-4 control-label">Pr.Unit.escl.IVA:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Pr.Unit.escl.IVA"  id="prezzo_escluso_iva" name="prezzo_escluso_iva"  value="<?=$row['prezzo_escluso_iva']?>"/>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6" style="display:none">
            <div class="form-group">
                <label class="col-md-4 control-label">Importo netto:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Importo netto"  id="importo_netto" name="importo_netto"  value="<?=$row['importo_netto']?>"/>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-lg-6" style="display:none">
            <div class="form-group">
                <label class="col-md-4 control-label">Importo IVA:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Importo IVA"  id="importo_iva" name="importo_iva"  value="<?=$row['importo_iva']?>"/>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6">
            <div class="form-group">
                <label class="col-md-4 control-label">Totale IVA esclusa*:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Totale IVA esclusa"  id="totale_iva_inclusa" name="totale_iva_inclusa"  value="<?=$row['totale_iva_inclusa']?>"/>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6" style="display:none">
            <div class="form-group">
                <label class="col-md-4 control-label">Prodotto/Servizio:</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" placeholder="Prodotto/Servizio"  id="prodotto_servizio" name="prodotto_servizio"  value="<?=$row['prodotto_servizio']?>"/>
                </div>
            </div>
        </div>


    </div>
    <!-- /.row this actually does not appear to be needed with the form-horizontal -->
    <input type="hidden" id="id_benzina_modifica" value="<?=$id?>"/>
    <input type="hidden" id="targa_da_modifica" value="<?=$targa?>"/>
</form>

