<?php
	include("header.php");
?>

<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Preventivi");
});
</script>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <!-- TITOLO -->
        	<div class="col-lg-12">
				<div class="page-title">
					<h1>Preventivi <small> sezioni, modelli e preventivi</small></h1>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-file-pdf-o fa-lg"></i> Preventivi
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
                    
                    <!--PANEL-->
                    <div class="col-lg-4 col-sm-4">
                        <div class="circle-tile">
                            <a href="pagina_sezioni.php">
                                <div class="circle-tile-heading blue-light">
                                    <i class="fa fa-arrow-circle-right fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content blue-light">
                                <div class="circle-tile-description text-faded">
                                    Sezioni
                                </div>
                                <div class="circle-tile-number text-faded">
                                                                    
                                </div>
                                <a href="pagina_sezioni.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>                  
                    
                    <!--PANEL-->
                    <div class="col-lg-4 col-sm-4">
                        <div class="circle-tile">
                            <a href="pagina_modelli.php">
                                <div class="circle-tile-heading blue-light">
                                    <i class="fa fa-arrow-circle-right fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content blue-light">
                                <div class="circle-tile-description text-faded">
                                    Modelli
                                </div>
                                <div class="circle-tile-number text-faded">
                                                                      
                                </div>
                                <a href="pagina_modelli.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>       
                    
                    <!--PANEL-->
                    <div class="col-lg-4 col-sm-4">
                        <div class="circle-tile">
                            <a href="pagina_riepilogo_preventivi.php">
                                <div class="circle-tile-heading blue-light">
                                    <i class="fa fa-arrow-circle-right fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content blue-light">
                                <div class="circle-tile-description text-faded">
                                    Preventivi
                                </div>
                                <div class="circle-tile-number text-faded">
                                                                      
                                </div>
                                <a href="pagina_riepilogo_preventivi.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>   
                    
                    <!-- / END: PANELS -->
                    
                </div>
                <!-- /.row -->
				<br><br>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<input type="hidden" value="<?=$id?>" id="id"/>

<!-- footer -->
<?php
	include("footer.php");
?>


</body>

</html>
