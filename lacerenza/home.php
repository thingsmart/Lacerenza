<?php
session_start();
include("header.php");

include("databases/db_function.php");
require_once("classi/class.Commesse.php");
require_once("classi/class.Utenti.php");
require_once("classi/class.Log.php");
require_once("classi/class.Mezzi.php");
require_once("classi/class.Dipendenti.php");
require_once("lib/funzioni_sito.php");

//Numero commesse
$commesse = new Commesse();
$e_query_commessa = $commesse->CaricaCommesse();
$num_commesse = $commesse->numeroCommesse();

//Numero utenti
$utenti = new Utenti();
$e_query_utenti = $utenti->CaricaUtenti();
$num_utenti = $utenti->numeroUtenti();	

//Numero log giornalieri
$log = new Log();
$e_query_log = $log->caricaLog(date("Y-m-d 00.00.00"),date("Y-m-d 23.59.00"));
$num_log = $log->numeroLog();

//Numero mezzi
$mezzi = new Mezzi();
$e_query_mezzi = $mezzi->caricaMezzi();
$e_query_mezzi_spesa = $mezzi->caricaMezzi();
$num_mezzi = $mezzi->numeroMezzi();	

//Numero dipendenti
$dipendenti = new Dipendenti();
$e_query_dipendenti = $dipendenti->caricaDipendenti();
$num_dipendenti = $dipendenti->numeroDipendenti();	

?>
<!--SCRIPT SITO-->
<script src="js/sito/home.js" type="text/javascript"></script>


<script>
$(document).ready(function() {
    $("#allarmi").load("allarmi.php");	
	$("#titolo_page").html("Lacerenza | Dashboard");
});
</script>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
        	
        	<!-- TITOLO -->
        	<div class="col-lg-12">
				<div class="page-title">
					<h1>Dashboard <small>scrivania operativa</small></h1>
					<ol class="breadcrumb">
						<li class="active">
							<i class="fa fa-dashboard fa-lg"></i> Dashboard
						</li>
						<li class="pull-right">

						</li>
					</ol>
				</div>
			</div>
			<!-- / TITOLO -->
           
			<? if($esito_ip == "NO") { ?>
				
		            <!--Ruolino-->
		             <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="ruolino_giornaliero.php">
                                <div class="circle-tile-heading brown">
                                    <i class="fa fa fa-cubes fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content brown">
                                <div class="circle-tile-description text-faded">
                                   Ruolino giornaliero
                                </div>
                                <div class="circle-tile-number text-faded">
                                   <p></p>
                                </div>
                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="ruolino_giornaliero.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>  
		            
	               <!--Programmazione-->
	                <div class="col-lg-4 col-sm-6">
                        <div class="circle-tile">
                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_programmazione_cantiere.php">
                                <div class="circle-tile-heading red">
                                    <i class="fa fa fa-clock-o fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content red">
                                <div class="circle-tile-description text-faded">
                                   Programmazione cantiere
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <p></p>
                                </div>
                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_programmazione_cantiere.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
                            </div>
                        </div>
                    </div>    
		            
		            
	               <!--Preventivi-->
	                <div class="col-lg-4 col-sm-6">
	                    <div class="circle-tile">
	                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_preventivi.php">
	                            <div class="circle-tile-heading blue-light">
	                                <i class="fa fa fa-file-pdf-o fa-fw fa-3x"></i>
	                            </div>
	                        </a>
	                        <div class="circle-tile-content blue-light">
	                            <div class="circle-tile-description text-faded">
	                               Preventivi
	                            </div>
	                            <div class="circle-tile-number text-faded">
	                                <p></p>
	                            </div>
	                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_preventivi.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
	                        </div>
	                    </div>
	                </div> 
                        
			<? } else { ?>
				
		        	<? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN" || $_SESSION['ruolo'] == "COMMESSA"){?>
		        		
		        	<div class="col-lg-4 col-sm-6">
		                        <div class="circle-tile">
		                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="commesse.php">
		                                <div class="circle-tile-heading dark-blue">
		                                    <i class="fa fa fa-tasks fa-fw fa-3x"></i>
		                                </div>
		                            </a>
		                            <div class="circle-tile-content dark-blue">
		                                <div class="circle-tile-description text-faded">
		                                    Commesse
		                                </div>
		                                <div class="circle-tile-number text-faded">
		                                    <?=$num_commesse?>                                    
		                                </div>
		                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="commesse.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
		                            </div>
		                        </div>
		                    </div>      		
		        		
		        		
		          
		            <? } ?>
		            
		            <? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN" || $_SESSION['ruolo'] == "MEZZI"){?>
		           <div class="col-lg-4 col-sm-6">
		                        <div class="circle-tile">
		                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_mezzi.php">
		                                <div class="circle-tile-heading green">
		                                    <i class="fa fa fa-truck fa-fw fa-3x"></i>
		                                </div>
		                            </a>
		                            <div class="circle-tile-content green">
		                                <div class="circle-tile-description text-faded">
		                                   Anagrafica Mezzi
		                                </div>
		                                <div class="circle-tile-number text-faded">
		                                    <?=$num_mezzi?>
		                                </div>
		                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_mezzi.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
		                            </div>
		                        </div>
		                    </div>  	
		        
		            <? } ?>
		            
		            <? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN" ){ ?>
		            	<div class="col-lg-4 col-sm-6">
		                        <div class="circle-tile">
		                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_log.php">
		                                <div class="circle-tile-heading blue">
		                                    <i class="fa fa fa-list fa-fw fa-3x"></i>
		                                </div>
		                            </a>
		                            <div class="circle-tile-content blue">
		                                <div class="circle-tile-description text-faded">
		                                   Log
		                                </div>
		                                <div class="circle-tile-number text-faded">
		                                    <?=$num_log?>
		                                </div>
		                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_log.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
		                            </div>
		                        </div>
		                    </div>             
		            <? } ?>
		                        
		            
		           
		            	
		            <div class="col-lg-4 col-sm-6">
		                        <div class="circle-tile">
		                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="utenti.php">
		                                <div class="circle-tile-heading orange">
		                                    <i class="fa fa fa-users fa-fw fa-3x"></i>
		                                </div>
		                            </a>
		                            <div class="circle-tile-content orange">
		                                <div class="circle-tile-description text-faded">
		                                   <? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN" ){?>
		                                   		Utenti
		                                   	<? } else { ?>
		                                   		Profilo
		                                   	<? } ?>
		                                </div>
		                                <div class="circle-tile-number text-faded">
		                                	 <? if($_SESSION['ruolo'] == "ADMIN" || $_SESSION['ruolo'] == "SUPERADMIN" ){?>
		                                    <?=$num_utenti?>
		                                    <? } else { ?>
		                                    	&nbsp;
		                                    <? } ?>
		                                </div>
		                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="utenti.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
		                            </div>
		                        </div>
		                    </div>
		            
		            
		               <!--Programmazione-->
		                <div class="col-lg-4 col-sm-6">
		                        <div class="circle-tile">
		                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_programmazione_cantiere.php">
		                                <div class="circle-tile-heading red">
		                                    <i class="fa fa fa-clock-o fa-fw fa-3x"></i>
		                                </div>
		                            </a>
		                            <div class="circle-tile-content red">
		                                <div class="circle-tile-description text-faded">
		                                   Programmazione cantiere
		                                </div>
		                                <div class="circle-tile-number text-faded">
		                                    <p></p>
		                                </div>
		                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_programmazione_cantiere.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
		                            </div>
		                        </div>
		                    </div>  
		                
			            
		               <!--Preventivi-->
		                <div class="col-lg-4 col-sm-6">
		                    <div class="circle-tile">
		                        <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_preventivi.php">
		                            <div class="circle-tile-heading blue-light">
		                                <i class="fa fa fa-file-pdf-o fa-fw fa-3x"></i>
		                            </div>
		                        </a>
		                        <div class="circle-tile-content blue-light">
		                            <div class="circle-tile-description text-faded">
		                               Preventivi
		                            </div>
		                            <div class="circle-tile-number text-faded">
		                                <p></p>
		                            </div>
		                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_preventivi.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
		                        </div>
		                    </div>
		                </div>  
		            
		            <? if($_SESSION['ruolo'] != "MAGAZZINIERE"){?>
		            <div class="col-lg-4 col-sm-6">
		                        <div class="circle-tile">
		                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_dipendenti.php">
		                                <div class="circle-tile-heading purple">
		                                    <i class="fa fa fa-users fa-fw fa-3x"></i>
		                                </div>
		                            </a>
		                            <div class="circle-tile-content purple">
		                                <div class="circle-tile-description text-faded">
		                                   Dipendenti
		                                </div>
		                                <div class="circle-tile-number text-faded">
		                                    <?=$num_dipendenti?>
		                                </div>
		                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_dipendenti.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
		                            </div>
		                        </div>
		                    </div>
		              <? } ?>
		        
		      
		        
		        
		        
		            
		            <!--Ruolino-->
		             <div class="col-lg-4 col-sm-6">
		                        <div class="circle-tile">
		                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="ruolino_giornaliero.php">
		                                <div class="circle-tile-heading brown">
		                                    <i class="fa fa fa-cubes fa-fw fa-3x"></i>
		                                </div>
		                            </a>
		                            <div class="circle-tile-content brown">
		                                <div class="circle-tile-description text-faded">
		                                   Ruolino giornaliero
		                                </div>
		                                <div class="circle-tile-number text-faded">
		                                   <p></p>
		                                </div>
		                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="ruolino_giornaliero.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
		                            </div>
		                        </div>
		                    </div>             
		      
		            <? if($_SESSION['ruolo'] != "MAGAZZINIERE"){?>
		            <!--TECNICA-->
		            <div class="col-lg-4 col-sm-6">
		                        <div class="circle-tile">
		                            <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_tecnica_prima.php">
		                                <div class="circle-tile-heading aqua">
		                                    <i class="fa fa fa-suitcase fa-fw fa-3x"></i>
		                                </div>
		                            </a>
		                            <div class="circle-tile-content aqua">
		                                <div class="circle-tile-description text-faded">
		                                   Tecnica
		                                </div>
		                                <div class="circle-tile-number text-faded">
		                                    <p></p>
		                                </div>
		                                <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_tecnica_prima.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
		                            </div>
		                        </div>
		                    </div>       
		           
		            <!--//END: TECNICA-->
		            <? } ?>
		            
		            <? if($_SESSION['ruolo'] != "MAGAZZINIERE"){?>
		            <!--MONTAGGIO-->
		             <div class="col-lg-4 col-sm-6">
					      <div class="circle-tile">
					           <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_lavori.php">
					           <div class="circle-tile-heading octane">
					                <i class="fa fa fa-wrench fa-fw fa-3x"></i>
					           </div>
					           </a>
					  <div class="circle-tile-content octane">
					       <div class="circle-tile-description text-faded">
					            Scheda di montaggio
					       </div>
					       <div class="circle-tile-number text-faded">
					            <p></p>
					       </div>
					  	    <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_lavori.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
					       </div>
					  </div>
					  </div>
		            <!--//END: MONTAGGIO-->
		          <? } ?>
		            <!--MAGAZZINO-->
		             <div class="col-lg-4 col-sm-6">
					      <div class="circle-tile">
					           <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="magazzino.php">
					           <div class="circle-tile-heading light-brown">
					                <i class="fa fa fa-building fa-fw fa-3x"></i>
					           </div>
					           </a>
					  <div class="circle-tile-content light-brown">
					       <div class="circle-tile-description text-faded">
					            Carico Giornaliero
					       </div>
					       <div class="circle-tile-number text-faded">
					            <p></p>
					       </div>
					  	    <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="magazzino.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
					       </div>
					  </div>
					  </div> 
		            <!--//END: MAGAZZINO-->
		            
		            
		            <? if($_SESSION['ruolo'] != "MAGAZZINIERE"){?>
		            <!--COMUNICAZIONI-->
		             <div class="col-lg-4 col-sm-6">
					      <div class="circle-tile">
					           <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="comunicazioni.php">
					           <div class="circle-tile-heading default">
					                <i class="fa fa fa-envelope fa-fw fa-3x"></i>
					           </div>
					           </a>
					  <div class="circle-tile-content default">
					       <div class="circle-tile-description text-faded">
					            Comunicazioni
					       </div>
					       <div class="circle-tile-number text-faded">
					        <p></p>
					       </div>
					  	    <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="comunicazioni.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
					       </div>
					  </div>
					  </div>       
		             
		            <!--//END: COMUNICAZIONI-->
		            <? } ?>
		            
		            <? if($_SESSION['ruolo'] != "MAGAZZINIERE"){?>
		            <!-- PRESENZE -->
		             <div class="col-lg-4 col-sm-6">
					      <div class="circle-tile">
					           <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="ruolino.php">
					           <div class="circle-tile-heading prof">
					                <i class="fa fa fa-check-square fa-fw fa-3x"></i>
					           </div>
					           </a>
					  <div class="circle-tile-content prof">
					       <div class="circle-tile-description text-faded">
					            Presenze
					       </div>
					       <div class="circle-tile-number text-faded">
					          <p></p>
					       </div>
					  	    <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="ruolino.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
					       </div>
					  </div>
					  </div>       
		             
		            <!--//END: PRESENZE-->
		           <? } ?>
		         
		           	<? if($_SESSION['ruolo'] != "MAGAZZINIERE"){?>
		           	 <!--STAMPA RUOLINO-->
		             <div class="col-lg-4 col-sm-6">
					      <div class="circle-tile">
					           <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="stampa.php">
					           <div class="circle-tile-heading stamp">
					                <i class="fa fa fa-print fa-fw fa-3x"></i>
					           </div>
					           </a>
					  <div class="circle-tile-content stamp">
					       <div class="circle-tile-description text-faded">
					            Costi monodopera 
					       </div>
					       <div class="circle-tile-number text-faded">
					           <p></p>
					       </div>
					  	    <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="stampa.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
					       </div>
					  </div>
					  </div>       
		             
		            <!--//END: STAMPA RUOLINO-->      	
		            <? } ?>
		            
		            <? if($_SESSION['ruolo'] != "MAGAZZINIERE"){?>
		            <!--STAMPA RUOLINO-->
		             <div class="col-lg-4 col-sm-6">
					      <div class="circle-tile">
					           <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="stampa_ruolino_data.php">
					           <div class="circle-tile-heading stamp">
					                <i class="fa fa fa-print fa-fw fa-3x"></i>
					           </div>
					           </a>
					  <div class="circle-tile-content stamp">
					       <div class="circle-tile-description text-faded">
					            Stampa Ruolino 
					       </div>
					       <div class="circle-tile-number text-faded">
					           <p></p>
					       </div>
					  	    <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="stampa_ruolino_data.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
					       </div>
					  </div>
					  </div>       
		             
		            <!--//END: STAMPA RUOLINO-->    
		            <? } ?>
		            
		            <? if($_SESSION['ruolo'] != "MAGAZZINIERE"){?>
		            <!--MANUTENZIONE-->
		             <div class="col-lg-4 col-sm-6">
					      <div class="circle-tile">
					           <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_manutenzione.php">
					           <div class="circle-tile-heading prugna">
					                <i class="fa fa fa-gears fa-fw fa-3x"></i>
					           </div>
					           </a>
					  <div class="circle-tile-content prugna">
					       <div class="circle-tile-description text-faded">
					            Manutenzione
					       </div>
					       <div class="circle-tile-number text-faded">
					         <p></p>
					       </div>
					  	    <a <? if($verifica == -1){ echo 'target="_blank"'; } ?> href="pagina_manutenzione.php" class="circle-tile-footer"><i class="fa fa-play fa-lg fa-inverse"></i></a>
					       </div>
					  </div>
					  </div>       
		             
		            <!--//END: MANUTENZIONE -->
		            <? } ?>
		             </div>
		             
             <? } ?>
            
        
            <!-- END: TERZA RIGA -->
        <div class="col-lg-12">
        	<hr style="border-bottom: 1px solid #ddd;"/>
        <div>
        
             
        <!-- /.row -->
        <? if($ruolo == "ADMIN" || $ruolo == "MEZZI" || $_SESSION['ruolo'] == "SUPERADMIN" ){?>
       <div id="allarmi"></div>
		<? } ?>
		
		


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->


</div>
    <!-- /#wrapper -->



<!--Modal eseguito-->
<div class="modal <?=$fade?> bs-eseguito" tabindex="-1" role="dialog" id="dialog_eseguito" style="display:none" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Eseguito</h4>
      </div>
      <div class="modal-body" id="modal_body" >Marcando questo allarme come eseguito non verr&agrave; pi&ugrave; visualizzato nella home page. <br />Vuoi continuare? </div>
      <div class="modal-footer">
        <input id="id_da_modificare" type="hidden" />
        <input id="id_mezzo" type="hidden" />
        <input id="tabella" type="hidden" />
        <button type="button" class="btn btn-default" id="btn_eseguito_annulla" data-dismiss="modal">Annulla</button>
        <button type="submit" id="btn_eseguito_conferma" class="btn btn-primary">Conferma</button>
      </div>
    </div>
  </div>
</div>
<!--FINE modal eseguito-->


<!-- footer -->
<?php
include("footer.php");
?>

</body>

</html>
