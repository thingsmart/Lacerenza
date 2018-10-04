<?php
//INCLUDE
include("controllaSessione.php");
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
require_once("../classi/class.Contabilita.php");

//GET DATA
$id = isset($_GET['id']) ? $_GET['id'] : "";
$id_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "";

//NEW O MODIFY
if($id != ""){
    $contabilita = new Contabilita();
    $e_query = $contabilita->caricaById($id);
    $row = $e_query->fetch_array();
}

?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuova_contabilita.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNew" name="formNew" enctype="multipart/form-data" action='lib/operazioni_contabilita.lib.php' method='POST'>

  <div class="row">

    <!--Descrizione-->
    <div class="col-sm-12 col-lg-12">
      <div class="form-group">
        <label class="col-md-12 control-label" style="text-align:left">Descrizione lavori*:</label>
        <div class="col-md-12">
          <input type="text" class="form-control" placeholder="Descrizione lavori"  id="descrizione_lavori" name="descrizione_lavori"  value="<?=$row['descrizione_lavori']?>"/>
          <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
          <input type="hidden" id="tipo" name="tipo"  value="inserimento"/>
          <input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>
        </div>
      </div>
    </div>

    <!--P=-->
    <div class="col-sm-2 col-lg-2">
      <div class="form-group">
        <label class="col-md-12 control-label" style="text-align:left">P=:</label>
        <div class="col-md-12">
          <input type="text" class="form-control" value="<?=$row['p1']?>" id="p1" name="p1">
        </div>
      </div>
    </div>

    <!--B-->
    <div class="col-sm-2 col-lg-2">
      <div class="form-group">
        <label class="col-md-12 control-label" style="text-align:left">B:</label>
        <div class="col-md-12">
          <input type="text" class="form-control" value="<?=$row['b']?>" id="b" name="b">
        </div>
      </div>
    </div>

    <!--L-->
    <div class="col-sm-2 col-lg-2">
      <div class="form-group">
        <label class="col-md-12 control-label" style="text-align:left">L:</label>
        <div class="col-md-12">
          <input type="text" class="form-control" value="<?=$row['l']?>" id="l" name="l">
        </div>
      </div>
    </div>

    <!--A-->
    <div class="col-sm-2 col-lg-2">
      <div class="form-group">
        <label class="col-md-12 control-label" style="text-align:left">A:</label>
        <div class="col-md-12">
          <input type="text" class="form-control" value="<?=$row['a']?>" id="a" name="a">
        </div>
      </div>
    </div>

    <!--P-->
    <div class="col-sm-2 col-lg-2">
      <div class="form-group">
        <label class="col-md-12 control-label" style="text-align:left">P:</label>
        <div class="col-md-12">
          <input type="text" class="form-control" value="<?=$row['p']?>" id="p" name="p">
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-lg-12">
    </div>

    <!--Prezzo-->
    <div class="col-sm-2 col-lg-2">
      <div class="form-group">
        <label class="col-md-12 control-label" style="text-align:left">Prezzo:</label>
        <div class="col-md-12">
          <input type="text" class="form-control" value="<?=$row['prezzo']?>" id="prezzo" name="prezzo">
        </div>
      </div>
    </div>

    <!--Importo-->
    <div class="col-sm-2 col-lg-2">
      <div class="form-group">
        <label class="col-md-12 control-label" style="text-align:left">Importo:</label>
        <div class="col-md-12">
          <input type="text" class="form-control" value="<?=$row['importo']?>" id="importo" name="importo">
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-lg-12">
      <br>
    </div>

    <div class="col-sm-12 col-lg-12">
      <div class="form-group">
        <? if($row['nome_allegato'] == "") { ?>
        <label class="col-md-4 control-label"></label>
        <div class="col-md-8">
              <input  type="file" id="files" name="files"/>
         </div>
        <? } else { ?>
          <label class="col-md-4 control-label">Allegato:</label>
          <div class="col-md-8">
            <a href="<?=$row['link_allegato']?><?=$row['nome_allegato']?>" target="_blank" class="btn btn-info">
                <?=$row['nome_allegato']?>
            </a>
            <div class="btn btn-danger" data-toggle="modal" data-target=".bs-elimina"  id_commessa="<?=$id_commessa?>" nome="<?=$row['nome_allegato']?>" id_contabilita="<?=$row['id']?>" id="btn_elimina_allegato">Elimina Allegato</div>
          </div>
        <? } ?>
      </div>
    </div>

  </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
  <input type="hidden" id="id_contabilita" value="<?=$id?>"/>
</form>
                      
                      