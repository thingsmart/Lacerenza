<?php
include("lib/controllaSessione.php");

	include("header.php");
	
	$id=$_GET['id'];
include ("classi/class.Commesse.php");
include ("databases/db_function.php");
$c = new Commesse();
$e_query_c = $c->caricaCommesseById($_SESSION['id_commessa']);
$row_c = $e_query_c->fetch_array();
?>
<script>
$(document).ready(function() {
	$("#nome_commessa").html("<?=$row_c['descrizione']?>");
});
</script>

<!--SCRIPT SITO-->
<script src="js/sito/allega_file.js" type="text/javascript"></script>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Allega File
                           
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                 <a class="btn btn-warning" href="dettaglio_commessa.php?id=<?=$id?>"><i class="fa fa-reply"></i> Indietro</a>
                            <div class="btn btn-success" id="allega_file" valore_id="<?=$id?>"><i class="fa fa-paperclip"></i> Allega</div>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

               

                <div class="row">
                    
                    <div class="container-fluid">
						<form class="form-horizontal" id="formUpdate" name="formUpdate" enctype="multipart/form-data" action='lib/allega_file.lib.php' method='POST'>
                        <div class="row">
                          <div class="col-sm-6 col-lg-4">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Descrizione:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Descrizione"  id="descrizione" name="descrizione" />
                              </div>
                            </div>
                          </div>
                          <!-- <div class="col-sm-6 col-lg-4">
                            <div class="form-group">
                              <label class="col-md-4 control-label">N.:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="N." id="verbale_n" name="verbale_n"  />
                              </div>
                            </div>
                          </div> -->
                          <div class="col-sm-6 col-lg-4">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Verbale del:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control data_picker" placeholder="Verbale del" id="data" name="data" value="<?=date("d-m-Y")?>" readonly />
                              </div>
                            </div>
                          </div>
                          
                           <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                              <label class="col-md-4 control-label"></label>
                              <div class="col-md-8">
 								<input class="btn btn-info" type="file" id="files" name="files"/>
                              	<input  type="hidden" name="id" id="id" value="<?=$id?>"/>
                              	<input  type="hidden" name="tipo" id="tipo" value="cantiere"/>
                              	<input  type="hidden" name="cartella" id="cartella" value="commesse"/>
                               </div>
                            </div>
                          </div>
                          
                           
                         
                              
                        
                      </form>

                    </div><!-- /.container -->
                </div>
                <!-- /.row -->
				<br><br>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<!-- footer -->
<?php
	include("footer.php");
?>

 <div id="id_commessa" style="display:none"><?=$id?></div>
</body>

</html>
