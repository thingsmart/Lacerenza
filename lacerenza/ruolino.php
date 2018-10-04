<?php 
session_start();
if ($_SESSION['ruolo'] != "ADMIN" && $_SESSION['ruolo'] != "RUOLINO" && $_SESSION['ruolo'] != "PERSONALE_RUOLINO" && $_SESSION['ruolo'] != "SUPERADMIN") {
header('Location: index.php'); 
exit();
} ?>
<?php
    include("lib/controllaSessione.php");
	//include("lib/controllaAutorizzazioni.php");
	require_once("lib/verificaConvertiData.php");
	require_once("classi/class.Commesse.php");
	require_once("databases/db_function.php");
	
	include("header.php");
	
	$fade = ($browser == 0) ? "fade" : "";
$data = isset($_GET['data']) ? CapovolgiData($_GET['data']) : date("d-m-Y");
$a_data = isset($_GET['a_data']) ? CapovolgiData($_GET['a_data']) : date("d-m-Y");
	$filtro_commessa = isset($_GET['id_commessa']) ? $_GET['id_commessa'] : "-1";
	
?>

<!--SCRIPT SITO-->
<script src="js/sito/ruolino.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#tabella_ruolino").load("php/tabella_ruolino.php?data=<?=$data?>&a_data=<?=$a_data?>&id_commessa=<?=$filtro_commessa?>");
});
</script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Presenze");
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                   <br>
                                       
                        <!-- TITOLO -->
			        	<div class="col-lg-12">
							<div class="page-title">
								<h1>Presenze <small> presenze da ruolino</small></h1>
								<ol class="breadcrumb">
									<li class="active">
										<i class="fa fa-check-square fa-lg"></i> Presenze
									</li>
									<li class="pull-right">
			
									</li>
								</ol>
							</div>
						</div>
			            <!-- / END: TITOLO  -->  
                        
                   
                </div>
                <!-- /.row -->

               

                <div class="row">
                    <div class="col-lg-12 ">
                    	 <div class="row">
                    	 	<div class="col-lg-2" style="margin-bottom:10px">
                    	 	 	<input type="text" id="data_giorno" class="form-control data_picker" readonly value="<?=$data?>"/>
                    	 	</div>
							 <div class="col-lg-2" style="margin-bottom:10px">
								 <input type="text" id="a_data_giorno" class="form-control data_picker" readonly value="<?=$a_data?>"/>
							 </div>
                    	 	<div class="col-lg-4" style="margin-bottom:10px; display:none">
                    	 		<select class="form-control" id="cerca_commessa">
                    	 			<option <? if($filtro_commessa == -1){ echo "selected"; } ?> value="-1">Tutte le commesse attive</option>
                    	 			<?
                    	 				$commesse = new Commesse();
										$e_query_commessa = $commesse->caricaCommesseAttive();
										while($row_commessa = $e_query_commessa->fetch_array()){
									?>
									<option <? if($filtro_commessa == $row_commessa['id']){ echo "selected"; } ?> value="<?=$row_commessa['id']?>"><?=$row_commessa['id']?>-<?=$row_commessa['cantiere']?></option>
									<?
										}
                    	 			?>
                    	 		</select>
                    	 	</div>
		                    <div class="col-lg-8">
		                    	<div class="input-group">
		                      		<input type="text" id="testo_cerca_ruolino" placeholder="Cerca per nome o cognome" class="form-control">
		                      		<span class="input-group-btn">
		                        		<button class="btn btn-default" id="cerca_ruolino" type="button">cerca</button>
		                      		</span>
		                    	</div><!-- /input-group -->
		                    </div>
                    	</div>
                        <br>
                    	<div id="tabella_ruolino">
                        	<div style="text-align:center"><img src="img/load.gif"/></div>
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



<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
