<?php

	include("header.php");
    
    $data = date('d-m-Y');
    
?>
<!--SCRIPT SITO-->
<script src="js/sito/pagina_log.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#tabella_log").load("php/tabella_log.php?data=<?=$data?>");	
});

</script>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                  
                    	<!-- TITOLO -->
			        	<div class="col-lg-12">
							<div class="page-title">
								<h1>Log <small> registrazione operazioni</small></h1>
								<ol class="breadcrumb" style="height:50px;">
									<li class="active" style="margin-top: 6px;">
										<i class="fa fa-dashboard fa-lg"></i> Log
									</li>
									<li class="pull-right">
										<input type="text" class="form-control data_picker" value="<?=$data?>" id="data"  readonly>
									</li>
								</ol>
							</div>
						</div>
			            <!-- / END: TITOLO  -->                      
                   
                </div>
                <!-- /.row -->

             
                <div class="row">
                    <div class="col-lg-12 ">
                    	<div>
                        	<div class="input-group">
                      		<input type="text" id="testo_cerca_log" placeholder="Cerca per utente o operazione" class="form-control">
                      		<span class="input-group-btn">
                        		<button class="btn btn-default" id="cerca_log" type="button">cerca</button>
                      		</span>
                    	</div><!-- /input-group -->
                        <br>
						<div id="tabella_log">
                        	<div style="text-align:center"><img src="img/load.gif"/></div>
                        </div>
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
