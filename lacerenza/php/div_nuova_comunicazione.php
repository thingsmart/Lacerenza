<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Comunicazioni.php");
	
	$id = isset($_GET['id']) ? $_GET['id'] : "";
		$data = date("Y-m-d");
		$data = ($data != "") ? capovolgiData($data) : date("d-m-Y");
		
	if($id != ""){
		$magazzino = new Comunicazioni();
		$e_query = $magazzino->caricaById($id);
		$row = $e_query->fetch_array();
		$quantita = $row['quantita'];
		$data = $row['data'];
		$data = capovolgiData($data);
        if($row['descrizione_commessa'] != "") {
            $dettagli_commessa = $row['id_commessa'] . "-" . $row['descrizione_commessa'];
        }
		
		
		
	}


	
	$query = "SELECT * FROM tb_commesse;";
$e_query_lista = EseguiQuery($query,"selezione");
?>
<!--SCRIPT SITO-->
<link href="css/demo.css" rel="stylesheet">
<script src="js/jquery-ui.min.js" ></script>
<script src="js/bootstrap/bootstrap-datepicker.min.js"></script>
    <script src="js/bootstrap/locales/bootstrap-datepicker.it.js"></script>

    <script src="js/bootstrap.min.js"></script>
<link href="css/datepicker.css" rel="stylesheet">
    <link href="less/datepicker.less" rel="stylesheet" type="text/css" />
<script src="js/sito/div_nuova_comunicazione.js" type="text/javascript"></script>

    <script>
    $(function () {

        var availableTags = [
            <?while($row_lista = $e_query_lista->fetch_array()){?>
          "<?=$row_lista['id']?>-<?=$row_lista['descrizione']?>",
          <? } ?>
          
        ];


        $("#dettagli_commessa").autocomplete({
            source: availableTags,
            appendTo: $("form:first")
        });

        $("#dettagli_commessa").data("ui-autocomplete")._renderMenu = function (ul, items) {
            var that = this;
            ul.attr("class", "nav nav-pills nav-stacked");
            $.each(items, function (index, item) {
                that._renderItemData(ul, item);
            });
        };

    });
    
   
</script>

<? if($id  != ""){ ?>
<script>
$(document).ready(function() {
	$("#tabella_allegati_comunicazioni").load("php/tabella_allegati_comunicazioni.php?id=<?=$id?>");
});
</script>
<? } ?>
	
<form class="form-horizontal" id="formNew"  name="formNew" method="post" role="form">
                        <div class="row">
                        	<div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Data:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" id="data" name="data" value="<?=$data?>" />
                              </div>
                            </div>
                          </div>
                          
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Descrizione commessa:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Descrizione commessa"  id="dettagli_commessa" name="dettagli_commessa"  value="<?=$dettagli_commessa?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                              </div>
                            </div>
                          </div>                          
                            
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Tipo Comunicazione*:</label>
                              <div class="col-md-8">
								<select class="form-control" id = "tipo_comunicazione" name = "tipo_comunicazione" >
									<option <? if($row['tipo_comunicazione'] == "EMAIL"){ echo "selected"; } ?> value="EMAIL">EMAIL</option>
									<option <? if($row['tipo_comunicazione'] == "PEC"){ echo "selected"; } ?> value="PEC">PEC</option>
									<option <? if($row['tipo_comunicazione'] == "FAX"){ echo "selected"; } ?> value="FAX">FAX</option>
									<option <? if($row['tipo_comunicazione'] == "RACCOMANDATA"){ echo "selected"; } ?> value="RACCOMANDATA">RACCOMANDATA</option>
								</select>
                              </div>
                            </div>
                          </div>
                              <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Mittente*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Mittente"  id="destinatario" name="destinatario"  value="<?=$row['destinatario']?>"/>                              	
                              </div>
                            </div>
                          </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Destinatario:</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" placeholder="Destinatario"  id="destinatario_reale" name="destinatario_reale"  value="<?=$row['destinatario_reale']?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Comunicazioni*:</label>
                              <div class="col-md-8">
                                <textarea class="form-control" placeholder="Comunicazioni" id="testo" name="testo"><?=$row['testo']?></textarea>
                              </div>
                            </div>
                          </div>    
                          
                          
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              	<label class="col-md-4 control-label">Note:</label>
                              <div class="col-md-8">
                                <textarea class="form-control" placeholder="Note" id="note" name="note"><?=$row['note']?></textarea>
                              </div>
                            </div>
                          </div> 
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                      </form>
                      
<? if($id != ""){ ?>
<div class="row">
	
	<!-- TITOLO -->
<div class="col-lg-12">
	<div class="page-title">
		<h1>Allegati <small></small></h1>
		<ol class="breadcrumb">
		<li class="active">
			
		</li>
			<li class="pull-right">
		</li>
		</ol>
	</div>
</div>
<!-- / TITOLO -->
	
	
                    <div class="col-lg-12 ">
                    	<div id="div_allegati">
                    		<!--ALLEGATI-->
                        
                          <div class="col-sm-12 col-lg-12" style="margin-top:20px; margin-bottom:100px">
                           <form class="form-horizontal" id="formAllega" name="formAllega" enctype="multipart/form-data" action='lib/operazioni_comunicazioni.lib.php' method='POST'>
                           
                            <div class="form-group">
                                <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Descrizione" id="descrizione_allegato" name="descrizione_allegato"  />
                                <input type="hidden" id="id_per_allegato" name="id_per_allegato"  value="<?=$id?>"/>
                                <input type="hidden" id="tipo" name="tipo"  value="allega"/>
                              </div>
                              <div class="col-md-3">
                                <input class="btn"  type="file" id="files" name="files"/>
                              </div>
                            
                              <div class="col-md-3">
                                <div class="btn "  id="inserisci_allegato" style="width:100%"><i class="fa fa-paperclip"></i> Allega</div>
                              </div>
                            </div>
                            </form>
                            <!--tabella mezzi-->
                          	<div id="tabella_allegati_comunicazioni">
                          		
                         	</div>
                          <!--FINE tabella mezzi-->
                          
                          </div>
                          
                          <!--FINE ALLEGATI-->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
                
<? } ?>