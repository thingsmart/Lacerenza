<?php 
session_start();
require_once("classi/class.Dipendenti.php");
if ($_SESSION['ruolo'] != "ADMIN" && $_SESSION['ruolo'] != "PERSONALE_RUOLINO" && $_SESSION['ruolo'] != "SUPERADMIN") {
header('Location: index.php'); 
exit();
}
$operazione = $_GET["op"];
?>
<?php
//include("lib/controllaAutorizzazioni.php");
	include("header.php");
	include("databases/db_function.php");
		
	
	$fade = ($browser == 0) ? "fade" : "";	
	$id_dipendente = $_GET['id_dipendente'];
	$pagina = (isset( $_GET['pagina'])) ?  $_GET['pagina'] : "";
	$data = (isset( $_GET['data'])) ?  $_GET['data'] : "";
	$mese = ($data != "") ? substr($data, 5, 2) : "";
	$anno = ($data != "") ? substr($data, 0, 4) : "";
	$dipendente_mod = new Dipendenti();
	$query_nome_dipendente = $dipendente_mod->caricaDipendenteById($id_dipendente);
	$row_nome_dipendente = $query_nome_dipendente->fetch_array();
	$nome_dipendente = $row_nome_dipendente['nome']." ".$row_nome_dipendente['cognome'];


//Estraggo strumenti
$query_commesse = "SELECT * FROM tb_commesse;";
$e_query_commesse = EseguiQuery($query_commesse, "selezione");
?>

<!--SCRIPT SITO-->
<script src="js/sito/costo_dipendenti.js" type="text/javascript"></script>
<script src="js/plugins/chosen/chosen.jquery.js"></script>
<link href="css/plugins/chosen/chosen.css" rel="stylesheet">

<style>
    .chosen-single > span{
        color:black !important;
    }
</style>

<script>
$(document).ready(function() {
    $("#titolo_page").html("Dipendente <?php echo $nome_dipendente;?>");
    $("#tabella_costi").load("php/tabella_costi.php?id_dipendente=<?=$id_dipendente?>");
});
</script>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
	                   <div class="page-title">
						<h1> Costo all'ora del dipendente <small><?=$nome_dipendente?></small><? if($pagina == ""){ ?>
                                 <a class="close pull-right" href="pagina_dipendenti.php?op=<?=$operazione?>"><i class="fa fa-backward"></i> Indietro</a>
                                 <? } else { ?>
                                 <a class="close pull-right" href="ruolino.php?data=<?=$data?>"><i class="fa fa-backward"></i> Indietro</a>
                                 <? } ?></h1>
                        <div class="clearfix"></div>				
						<ol class="breadcrumb">
						<li class="active">
							
						</li>
						<li class="pull-right">

						</li>
					</ol>
					</div>                       
                    </div>
                </div>
                <!-- /.row -->

               

                <div class="row">
			
                  <form class="form-horizontal" id="formNewCosto" name="formNewCosto" enctype="multipart/form-data" action='lib/operazioni_costo.lib.php' method='POST'>
                      <div class="col-lg-4">
                          <div class="form-group">
                              <div class="col-md-12">
                                  <input  type="hidden" class="form-control"  id="id_commessa" name="id_commessa"  />
                                  <select style="width:100%" id="id_commessa2" name="id_commessa2"  data-placeholder="" class="chosen-select form-control"   style="width:350px;" tabindex="4">
                                      <option style=""  value="" >Tutte</option>
                                      <? while($row_commessa = $e_query_commesse->fetch_array()){ ?>
                                          <option style=""  value="<?=$row_commessa['id']?>" ><?=$row_commessa['codice']?> - <?=$row_commessa['descrizione']?></option>
                                      <? } ?>
                                  </select>
                              </div>
                          </div>
                      </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <div class="col-md-12">
                        	<select class="form-control" id="mese" name="mese">
                        		<option <?if($mese == "01"){echo "selected";} ?> value="GENNAIO">GENNAIO</option>
                        		<option <?if($mese == "02"){echo "selected";} ?> value="FEBBRAIO">FEBBRAIO</option>
                        		<option <?if($mese == "03"){echo "selected";} ?> value="MARZO">MARZO</option>
                        		<option <?if($mese == "04"){echo "selected";} ?> value="APRILE">APRILE</option>
                        		<option <?if($mese == "05"){echo "selected";} ?> value="MAGGIO">MAGGIO</option>
                        		<option <?if($mese == "06"){echo "selected";} ?> value="GIUGNO">GIUGNO</option>
                        		<option <?if($mese == "07"){echo "selected";} ?> value="LUGLIO">LUGLIO</option>
                        		<option <?if($mese == "08"){echo "selected";} ?> value="AGOSTO">AGOSTO</option>
                        		<option <?if($mese == "09"){echo "selected";} ?> value="SETTEMBRE">SETTEMBRE</option>
                        		<option <?if($mese == "10"){echo "selected";} ?> value="OTTOBRE">OTTOBRE</option>
                        		<option <?if($mese == "11"){echo "selected";} ?> value="NOVEMBRE">NOVEMBRE</option>
                        		<option <?if($mese == "12"){echo "selected";} ?> value="DICEMBRE">DICEMBRE</option>
                        		<option <?if($mese == "13"){echo "selected";} ?> value="ANNUALE">ANNUALE</option>
                        	</select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <div class="col-md-12">
                            <select  class="form-control" id="anno" name="anno">
                            	<? for($i=2000; $i<=2060; $i++){?>
                            		<? if($i == date("Y") && $data == ""){?>
                            		<option value="<?=$i?>" selected><?=$i?></option>
                            		<? } else if($data != "" && $i == $anno){ ?>
                            			<option value="<?=$i?>" selected><?=$i?></option>
                            		<? } else { ?>
                            		<option value="<?=$i?>" ><?=$i?></option>
                            		<? } ?>
                            	<? } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Costo" id="costo" name="costo">
                            <input type="hidden" id="tipo" name="tipo" value="inserimento" />
                            <input type="hidden" id="id_dipendente" name="id_dipendente"  value="<?=$id_dipendente?>"/>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-lg-2">
                    <div>                      
                            <div class="btn btn-success btn-block" id="btn_nuovo_costo" type="button">Inserisci costo <i class="fa fa-plus-circle fa-lg"></i></div>
                    </div>
                </div>
                
            </form>
            <br><br />
         
                    <div class="col-lg-12">
                    	<div id="tabella_costi">
                        	<div style="text-align:center"><img src="img/load.gif" style="width:100px"/></div>

                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<br><br>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


<!--Modal elimina-->
<div class="modal <?=$fade?> bs-elimina" tabindex="-1" role="dialog" id="dialog_elimina" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Elimina</h4>
      </div>
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare il costo? </div>
      <div class="modal-footer">
        <input id="id_da_eliminare" type="hidden" />
        <input id="nome_da_eliminare" type="hidden" />
        <button type="button" class="btn btn-default" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_elimina_conferma" class="btn btn-primary">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->


<!--Modal elimina-->
<div class="modal <?=$fade?> bs-modifica" tabindex="-1" role="dialog" id="dialog_modifica" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modifica</h4>
      </div>
      <div class="modal-body" id="modal_body" >
      	<input type="text" id="costo_modifica" name="costo_modifica" class="form-control" placeholder="Costo"/>
      </div>
      <div class="modal-footer">
        <input id="id_da_modificare" type="hidden" />
        <input id="nome_da_eliminare" type="hidden" />
        <button type="button" class="btn btn-default" id="btn_modifica_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_modifica_conferma" class="btn btn-primary">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->

<input type="hidden" id="data_reload" value="<?=$data?>"/>
<!-- footer -->
<?php
	include("footer.php");
?>

<script>
    $(document).ready(function(){



    });
    var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }



</script>

</body>

</html>
