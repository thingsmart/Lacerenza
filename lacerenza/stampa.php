<?php
session_start();
include ("header.php");
require_once ("classi/class.Commesse.php");
require_once ("databases/db_function.php");
$mese = date("m");
?>

<!--SCRIPT SITO-->
<script src="js/sito/stampa.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Costi manodopera");
});
</script>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            
            <!-- TITOLO -->
        	<div class="col-lg-12">
				<div class="page-title">
					<h1>Costi manodopera <small> stampa costi mensili</small></h1>
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
                        <label class="control-label">Mese:</label>
                        <div class="">
                        	<select class="form-control" id="mese" name="mese" multiple style="height:220px">
                        		<option <?
								if ($mese == "01") {echo "selected";
								}
 ?> value="GENNAIO">GENNAIO</option>
                        		<option <?
									if ($mese == "02") {echo "selected";
									}
 ?> value="FEBBRAIO">FEBBRAIO</option>
                        		<option <?
									if ($mese == "03") {echo "selected";
									}
 ?> value="MARZO">MARZO</option>
                        		<option <?
									if ($mese == "04") {echo "selected";
									}
 ?> value="APRILE">APRILE</option>
                        		<option <?
									if ($mese == "05") {echo "selected";
									}
 ?> value="MAGGIO">MAGGIO</option>
                        		<option <?
									if ($mese == "06") {echo "selected";
									}
 ?> value="GIUGNO">GIUGNO</option>
                        		<option <?
									if ($mese == "07") {echo "selected";
									}
 ?> value="LUGLIO">LUGLIO</option>
                        		<option <?
									if ($mese == "08") {echo "selected";
									}
 ?> value="AGOSTO">AGOSTO</option>
                        		<option <?
									if ($mese == "09") {echo "selected";
									}
 ?> value="SETTEMBRE">SETTEMBRE</option>
                        		<option <?
									if ($mese == "10") {echo "selected";
									}
 ?> value="OTTOBRE">OTTOBRE</option>
                        		<option <?
									if ($mese == "11") {echo "selected";
									}
 ?> value="NOVEMBRE">NOVEMBRE</option>
                        		<option <?
									if ($mese == "12") {echo "selected";
									}
 ?> value="DICEMBRE">DICEMBRE</option>
                        	</select>
                        </div>
                    </div>
                </div>

	<div class="col-sm-12 col-lg-6">
		<div class="form-group">
			<label class=" control-label">Dal giorno:</label>
			<div class="">
				<select  class="form-control" id="dal" name="dal">
					<option value="">Dal giorno</option>
					<? for($i=1; $i<=31; $i++){?>
							<option ><?=$i ?></option>
					<? } ?>
				</select>
			</div>
		</div>
	</div>

	<div class="col-sm-12 col-lg-6">
		<div class="form-group">
			<label class=" control-label">Al giorno:</label>
			<div class="">
				<select  class="form-control" id="al" name="al">
					<option value="">Al giorno</option>
					<? for($i=1; $i<=31; $i++){?>
						<option ><?=$i ?></option>
					<? } ?>
				</select>
			</div>
		</div>
	</div>

	<div class="col-sm-12 col-lg-12">
                    <div class="form-group">
                        <label class=" control-label">Anno:</label>
                        <div class="">
                            <select  class="form-control" id="anno" name="anno">
                            	<? for($i=2000; $i<=2060; $i++){?>
                            		<? if($i == date("Y") && $data == ""){?>
                            		<option value="<?=$i ?>" selected><?=$i ?></option>
                            		<? } else if($data != "" && $i == $anno){ ?>
                            			<option value="<?=$i ?>" selected><?=$i ?></option>
                            		<? } else { ?>
                            		<option value="<?=$i ?>" ><?=$i ?></option>
                            		<? } ?>
                            	<? } ?>
                            </select>
                        </div>
                    </div>
                </div>
                
              
                <div class="col-sm-12 col-lg-12">
                	<div class="form-group">
                     <label class="control-label">Commesse:</label>
	                	 <div class="">
	                		<select class="form-control" id="cerca_commessa">
	                    		<option  value="-1_tutte">Tutte le commesse</option>
	                    	 	<?
									$commesse = new Commesse();
									$e_query_commessa = $commesse->caricaCommesseNoOrder();
									while($row_commessa = $e_query_commessa->fetch_array()){
								?>
									<option  value="<?=$row_commessa['id']?>_<?=$row_commessa['cantiere']?>"><?=$row_commessa['codice']?>-<?=$row_commessa['cantiere']?></option>
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
							<a href="stampa_ruolino.php" target="_blank" id="btn_stampa" class="btn btn-info" style="width:100%"><i class="fa fa-print"></i> Stampa</a>
						</div>
						<br>
						<div class="">
							<a href="stampa_ruolino_economia.php" target="_blank" id="btn_stampa_economia" class="btn btn-info" style="width:100%"><i class="fa fa-print"></i> Stampa ore in economia</a>
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

</body>

</html>
