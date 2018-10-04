<?php
include("controllaSessione.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");

include("../databases/db_function.php");
require_once("../classi/class.Commesse.php");

$id=$_GET['id'];

//estraggo la commessa dall'id
$commesse = new Commesse();
$e_query_commessa = $commesse->caricaCommesseById($id);
$row = $e_query_commessa->fetch_array();

if($row['datafine'] == "0000-00-00" || $row['datafine']== null){
	$data_fine = "";
} else {
	$data_fine = CapovolgiData($row['datafine']);
}

?>

<!--SCRIPT SITO-->
<script src="js/sito/tabella_commessa.js" type="text/javascript"></script>

<form class="form-horizontal" id="formCantiere"  name="formCantiere" method="post" role="form">
    <div class="row">
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label class="col-md-4 control-label">Cantiere:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Cantiere"  id="cantiere" name="cantiere" value="<?=$row['cantiere']?>" readonly />
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label class="col-md-4 control-label">Localit&agrave;:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Localita" id="localita" name="localita" value="<?=$row['localita']?>" readonly />
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label class="col-md-4 control-label">Importo:</label>
          <div class="col-md-8">
            <input id="importo" class="form-control" placeholder="Importo" name="importo" type="text" value="<?=$row['importo']?>" readonly />
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label class="col-md-4 control-label">Lavori:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Tipologia Lavori" id="tipologia_lavori" name="tipologia_lavori" value="<?=$row['tipologia_lavori']?>" readonly />
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label class="col-md-4 control-label">Referente:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Referente" id="referente" name="referente" value="<?=$row['referente']?>" readonly/>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label class="col-md-4 control-label">Indirizzo referente:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Indirizzo referente" id="indirizzo_referente" name="indirizzo_referente" value="<?=$row['indirizzo_referente']?>" readonly/>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label class="col-md-4 control-label">PI/Codice fiscale:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Partita IVA / Codice fiscale" id="pi" name="pi" value="<?=$row['pi']?>" readonly/>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label  class="col-md-4 control-label">Telefono:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Telefono" id="telefono" name="telefono" value="<?=$row['telefono']?>" readonly/>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label class="col-md-4 control-label">Fax:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Fax" id="fax" name="fax" value="<?=$row['fax']?>" readonly/>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label for="input8" class="col-md-4 control-label">Cellulare:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Cellulare" id="cellulare" name="cellulare" value="<?=$row['cellulare']?>" readonly/>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label for="input8" class="col-md-4 control-label">Email:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Email" id="email" name="email" value="<?=$row['email']?>" readonly/>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label for="input8" class="col-md-4 control-label">PEC:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" placeholder="PEC" id="pec" name="pec" value="<?=$row['pec']?>" readonly/>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label class="col-md-4 control-label">Data Inizio:</label>
          <div class="col-md-8">
                    <input type="text" class="form-control" value="<?=CapovolgiData($row['data_inizio'])?>"  id="data_inizio" name="data_inizio" readonly>
            </div>

        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label class="col-md-4 control-label">Data Fine:</label>
          <div class="col-md-8">

            <input type="text" class="form-control data_picker" value="<?=$data_fine?>" id="data_fine" name="data_fine" >
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label class="col-md-4 control-label">Numero Dipendenti:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="numerodipendenti" value="<?=$row['numero_dipendenti']?>" name="numerodipendenti" >
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6">
        <div class="form-group">
          <label class="col-md-4 control-label">Documento:</label>
          <div class="col-md-8">
            <a class="btn btn-default btn-block" href="print_apertura.php?id=<?php echo $row['id'];?>" target="_blank">Stampa PDF</a>
          </div>
        </div>
      </div>
    </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
  </form>