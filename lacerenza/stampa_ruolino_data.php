<?php
session_start();
include ("header.php");
require_once ("classi/class.Commesse.php");
require_once ("databases/db_function.php");
$mese = date("m");
?>

<!--SCRIPT SITO-->
<script src="js/sito/stampa_ruolino_data.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Stampa ruolino");
});
</script>

<style>
	.chosen-single{
		border-radius: 0 !important;
		background: #fff !important;
		color:#000;
		padding: 3px !important;
		height: 30px !important;
	}
	.chosen-single>span{
		color:#000;
	}
</style>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            
            <!-- TITOLO -->
        	<div class="col-lg-12">
				<div class="page-title">
					<h1>Stampa <small> stampa ruolino</small></h1>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-print fa-lg"></i> Stampa
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
                      
                <div class="col-sm-12 col-lg-12">
                    <div class="form-group">
                        <label class="control-label">Dal:</label>
                        <div>
                        	<input id="da_data" type="text" class="form-control data_picker" readonly/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12">
                    <div class="form-group">
                        <label class=" control-label">Al:</label>
                        <div>
                        	<input id="a_data" type="text" class="form-control data_picker" readonly/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12">
                	<div class="form-group">
                     <label class="control-label">Commesse:</label>
	                	 <div class="">
							 <select id="cerca_commessa" style="width:100% !important;" id="articolo" name="articolo"  data-placeholder="Articolo..." class="chosen-select"   style="width:350px;" tabindex="4">

	                    		<option  value="-1_tutte">Tutte le commesse</option>
	                    	 	<?
									$commesse = new Commesse();
									$e_query_commessa = $commesse->caricaCommesse();
									while($row_commessa = $e_query_commessa->fetch_array()){
								?>
									<option  value="<?=$row_commessa['id']?>_<?=$row_commessa['cantiere']?>"><?=$row_commessa['codice']?> <?=$row_commessa['descrizione']?> <?=$row_commessa['localita']?></option>
								<?
									}
	                    	 	?>
	                    	</select>
	                	</div>
                	</div>
             </div>
              <div class="col-sm-12 col-lg-12">
                	<div class="form-group">
                     <label class="control-label">Tipologia Lavoro:</label>
	                	 <div class="">
	                		<select class="form-control" id="tl" name="tl">
                              		<option  value="tutti">Tutti</option>
                              		<option  value="cap">cap</option>
                              		<option  value="fv">fv</option>
                              		<option  value="cg">cg</option>
                              		<option  value="imp">imp</option>
                              		<option  value="om">om</option>
                              	</select>
	                	</div>
                	</div>
             </div>
               
                </div>
                <br>
                <div class="row">
                  <div class="col-sm-12 col-lg-12">
                  	<div class="">
                  	<a href="stampa_ruolino_per_data.php" target="_blank" id="btn_stampa" class="btn btn-info" style="width:100%"><i class="fa fa-print"></i> Stampa</a>
                  	<br><br>
                  	<a href="stampa_ruolino_per_data_economia.php" target="_blank" id="btn_stampa_economia" class="btn btn-info" style="width:100%"><i class="fa fa-print"></i> Stampa economia</a>
                  	</div>
                  </div>
        </div>

</div>
<!-- /#page-wrapper -->

</div>
    <!-- /#wrapper -->



<!-- footer -->
<?php
include ("footer.php");
?>


<script>
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
