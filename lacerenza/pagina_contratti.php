<?php
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
<script src="js/sito/pagina_contratti.js?2" type="text/javascript"></script>
<script>
$(document).ready(function() {
	$("#titolo_page").html("Lacerenza | Contratti");
});
</script>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <!-- TITOLO -->
        	<div class="col-lg-12">
				<div class="page-title">
					<h1>Contratti <small> scrivania contratti</small></h1>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-legal fa-lg"></i> Contratto
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
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                            <a href="pagina_revisioni_contrattuali.php?id=<?=$id?>">
                                <div class="circle-tile-heading default">
                                    <i class="fa fa-refresh fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content default">
                                <div class="circle-tile-description text-faded">
                                    Contratti / Preventivi
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?=$num_commesse?>                                    
                                </div>
                                <a href="pagina_revisioni_contrattuali.php?id=<?=$id?>" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>

                    <!--PANEL-->
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                            <a href="pagina_contabilita_new.php?id=<?=$id?>">
                                <div class="circle-tile-heading default">
                                    <i class="fa fa-euro fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content default">
                                <div class="circle-tile-description text-faded">
                                    Contabilit&agrave;
                                </div>
                                <div class="circle-tile-number text-faded">

                                </div>
                                <a href="pagina_contabilita_new.php?id=<?=$id?>" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>

                    <!--PANEL-->
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                            <a href="pagina_polizze.php?id=<?=$id?>">
                                <div class="circle-tile-heading default">
                                    <i class="fa fa-arrow-circle-right fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content default">
                                <div class="circle-tile-description text-faded">
                                    Gestione delle Polizze Fidejussorie
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?=$num_commesse?>                                    
                                </div>
                                <a href="pagina_polizze.php?id=<?=$id?>" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>       
                   
                    <!--PANEL-->
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                             <a href="pagina_verbali.php?id=<?=$id?>">
                                <div class="circle-tile-heading default">
                                    <i class="fa fa-folder-open fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content default">
                                <div class="circle-tile-description text-faded">
                                    Verbali Lavori
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?=$num_commesse?>                                    
                                </div>
                                 <a href="pagina_verbali.php?id=<?=$id?>" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>    
                
                    <!--PANEL-->
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                            <a href="pagina_fatture.php?id=<?=$id?>">
                                <div class="circle-tile-heading default">
                                    <i class="fa fa-file-text fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content default">
                                <div class="circle-tile-description text-faded">
                                    Gestione Fatture
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?=$num_commesse?>                                    
                                </div>
                                <a href="pagina_fatture.php?id=<?=$id?>" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>    
             
                    <!--PANEL-->
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                            <a href="pagina_documenti_cliente.php?id=<?=$id?>">
                                <div class="circle-tile-heading default">
                                    <i class="fa fa-users fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content default">
                                <div class="circle-tile-description text-faded">
                                    Gestione Documenti forniti dal cliente
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?=$num_commesse?>                                    
                                </div>
                                <a href="pagina_documenti_cliente.php?id=<?=$id?>" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>    
                   
                    <!--PANEL-->
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                            <a href="pagina_documentazioni.php?id=<?=$id?>">
                                <div class="circle-tile-heading default">
                                    <i class="fa fa-suitcase fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content default">
                                <div class="circle-tile-description text-faded">
                                    Gestione documentazione tecnica presente in cantiere
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?=$num_commesse?>                                    
                                </div>
                                <a href="pagina_documentazioni.php?id=<?=$id?>" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>    
                   
                    <!--PANEL-->
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                           <a href="pagina_noleggi.php?id=<?=$id?>">
                                <div class="circle-tile-heading default">
                                    <i class="fa fa-sign-out fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content default">
                                <div class="circle-tile-description text-faded">
                                   Noleggi attrezzature e mezzi
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?=$num_commesse?>                                    
                                </div>
                                 <a href="pagina_noleggi.php?id=<?=$id?>" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>    
                   
                    <!--PANEL-->
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                             <a href="pagina_ordini.php?id=<?=$id?>">
                                <div class="circle-tile-heading default">
                                    <i class="fa fa-hand-o-right fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content default">
                                <div class="circle-tile-description text-faded">
                                    Ordini direzione lavori
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?=$num_commesse?>                                    
                                </div>
                                 <a href="pagina_ordini.php?id=<?=$id?>" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>    
                  
                    <!--PANEL-->
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                           <a href="pagina_riserve.php?id=<?=$id?>">
                                <div class="circle-tile-heading default">
                                    <i class="fa fa-archive fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content default">
                                <div class="circle-tile-description text-faded">
                                    Riserve
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?=$num_commesse?>                                    
                                </div>
                               <a href="pagina_riserve.php?id=<?=$id?>" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>    
               
                    <!--PANEL-->
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                          <a href="pagina_attivita.php?id=<?=$id?>">
                                <div class="circle-tile-heading default">
                                    <i class="fa fa-exchange fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content default">
                                <div class="circle-tile-description text-faded">
                                    Attivit&agrave; affidate a terzi
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?=$num_commesse?>                                    
                                </div>
                               <a href="pagina_attivita.php?id=<?=$id?>" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>    
                   
                    <!--PANEL-->
                    <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                             <a href="pagina_regolarita.php?id=<?=$id?>">
                                <div class="circle-tile-heading default">
                                    <i class="fa fa-thumbs-o-up fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content default">
                                <div class="circle-tile-description text-faded">
                                   Regolarit&agrave; contributiva
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <?=$num_commesse?>                                    
                                </div>
                                 <a href="pagina_regolarita.php?id=<?=$id?>" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
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
