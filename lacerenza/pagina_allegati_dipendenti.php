<?php
include("header.php");

$fade = ($browser == 0) ? "fade" : "";	

$id_dipendente = $_GET['id_dipendente'];
$operazione = $_GET['op'];

include("classi/class.Dipendenti.php");
include ("databases/db_function.php");

$dipendente_mod = new Dipendenti();
$query_nome_dipendente = $dipendente_mod->caricaDipendenteById($id_dipendente);
$row_nome_dipendente = $query_nome_dipendente->fetch_array();
$nome_dipendente = $row_nome_dipendente['nome']." ".$row_nome_dipendente['cognome'];
?>

<!--SCRIPT SITO-->
<script src="js/sito/pagina_allegati_dipendenti.js" type="text/javascript"></script>

<script>
    $(document).ready(function () {
        $("#titolo_page").html("Dipendente <?php echo $nome_dipendente;?>");
        $("#tabella_allegati_dipendenti").load("php/tabella_allegati_dipendenti.php?id_dipendente=<?=$id_dipendente?>");
    });
</script>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
            	
            	<div class="page-title">
					<h1>Certificati dipendenti <small></small>  <a class="close pull-right" href="pagina_dipendenti.php?op=<?=$operazione?>"><i class="fa fa-backward"></i> Indietro</a></h1>
					<div class="clearfix"></div>
					<ol class="breadcrumb">
						<li class="active"></li>
						<li class="pull-right"></li>
					</ol>
				</div>           	
             
            </div>
        </div>
        <!-- /.row -->



        <div class="row">
            <form class="form-horizontal" id="formNewAllegato" name="formNewAllegato" enctype="multipart/form-data" action='lib/operazioni_dipendente.lib.php' method='POST'>
				<div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label"> Descrizione*:</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" placeholder="Descrizione" id="descrizione" name="descrizione">
                                <input type="hidden" id="tipo" name="tipo" value="inserisci_allegato" />
                                <input type="hidden" id="id_commessa" name="id_commessa"  value="<?=$id_commessa?>"/>
                                <input type="hidden" id="id_dipendente" name="id_dipendente"  value="<?=$id_dipendente?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Controlla Scadenza:</label>
                            <div class="col-lg-8">
                                <select class="form-control" id="controlla" name="controlla">
                                    <option <? if($row['controlla'] == "1"){ echo "selected"; } ?> value="1">SI, CONTROLLA</option>
                                    <option <? if($row['controlla'] == "0"){ echo "selected"; } ?> value="0">NO, NON CONTROLLARE</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label"> Data*:</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control data_picker" placeholder="Data" value="<?=date("d-m-Y");?>" id="data" name="data">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-lg-4 control-label"> Data Scadenza*:</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control data_picker" placeholder="Data Scadenza" value="<?=date("d-m-Y");?>" id="scadenza" name="scadenza">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">

                	              
	                <div class="col-sm-6 col-lg-6">                  
	                     <div class="form-group">
	                     	<div class="form-group">
	                        <label class="col-lg-4 control-label"> Allegato:</label>
	                          <div class="col-lg-8">
	                          	<div class="col-lg-6">
	                         		<input style="margin-top:8px;" type="file" id="files" name="files" />
	                         		<br>                       
	                         	</div>	                         	
	                         	<div class="col-lg-6">
	                         		<div class="btn btn-default btn-block" id="nuovo_allegato" type="button"><i class="fa fa-paperclip"></i> Allega Certificato</div>
	                          	</div>
	                          	<div class="clearfix"></div>
	                           </div>
	                     </div> 
	                     </div>                   
	                </div>
                </div>
            </form>
            
            <br>
         
            <div class="col-lg-12 " style="margin-top:10px">
                <div id="tabella_allegati_dipendenti">
                    <div style="text-align: center">
                        <img src="img/load.gif" style="width: 100px" />
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <br>
        <br>
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
            <div class="modal-body" id="modal_body">Sei sicuro di voler eliminare l'allegato? </div>
            <div class="modal-footer">
                <input id="id_da_eliminare" type="hidden" />
                <input id="nome_da_eliminare" type="hidden" />
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
