<?php
    include("lib/controllaSessione.php");
require_once("lib/verificaConvertiData.php");
include("databases/db_function.php");
require_once("classi/class.Commesse.php");

	
	include("header.php");
	
	$id=$_GET['id'];
	$id_commessa=$_GET['id_commessa'];
	$mezzo=$_GET['mezzo'];
	$commessa = new Commesse();
	$e_query_commessa = $commessa->caricaCommesseById($id_commessa);
	$row_commessa = $e_query_commessa->fetch_array();
	$data = isset($_GET['data']) ? $_GET['data'] : date("Y-m-d");
	$data_indietro = ($data != "") ? capovolgiData($data) : date("d-m-Y");

	$titolo =  "Aggiungi Carico";
?>


<!--SCRIPT SITO-->
<script src="js/sito/nuova_merce.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#tabella_merce").load("php/tabella_merce.php?data=<?=$data?>&id_magazzino=<?=$id?>");	
});
</script>


	<script type="text/javascript" src="http://xoxco.com/projects/code/tagsinput/jquery.tagsinput.js"></script>
	<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/themes/start/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="http://xoxco.com/projects/code/tagsinput/jquery.tagsinput.css" />

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" id="titolo_h1">
                            <?=$titolo?><br>
                           <small><?=$row_commessa['descrizione']?> <?=$row_commessa['localita']?></small>
                           <br>
                           <small>Mezzo: <?=$mezzo?></small>
                           <br>
                           <small>(<?=$data?>)</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                 <a class="btn btn-info" href="magazzino.php?data=<?=$data_indietro?>"><i class="fa fa-reply"></i> Indietro</a>
                            </li>
                            <li>
                                 <a target="_blank" class="btn btn-default" href="stampa_magazzino.php?id=<?=$id?>"><i class="fa fa-print"></i> Stampa</a>
                            </li>
                            
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <div class="col-lg-12 ">
                    	 <div class="row">
                          <div class="col-sm-2 col-lg-2">
                            <div class="form-group">
                              <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Quantit&agrave;" id="quantita" name="quantita" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-8 col-lg-8">
                            <div class="form-group">
                              <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Descrizione del materiale"  id="materiale" name="materiale"  />
                                <input type="hidden" id="id_testata_magazzino" name="id_testata_magazzino"  value="<?=$id?>"/>
                              </div>
                            </div>
                          </div>     
                          <div class="col-sm-2 col-lg-2">
                          	<div class="btn btn-success" id="aggiungi" style="width:100%">Aggiungi</div>	
                          </div>
                    </div>
                </div>
                
			</div>
			<!-- /.row -->
			
			<div class="row">
                    <div class="col-lg-12">                  	
                      
                    	<div id="tabella_merce" style="overflow:auto">
                        	<div style="text-align:center"><img src="img/load.gif"/></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <


<!--Modal elimina-->
<div class="modal <?=$fade?> bs-elimina" tabindex="-1" role="dialog" id="dialog_elimina" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Elimina</h4>
      </div>
      <div class="modal-body" id="modal_body" > Sei sicuro di voler eliminare questo dato? </div>
      <div class="modal-footer">
        <input id="id_da_eliminare" type="hidden" />
        <div id="username_da_eliminare" style="display:none"></div>
        <button type="button" class="btn btn-success" id="btn_elimina_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_elimina_conferma" class="btn btn-danger">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal elimina-->

<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
