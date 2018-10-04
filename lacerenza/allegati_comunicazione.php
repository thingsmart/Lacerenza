<?php
    include("lib/controllaSessione.php");
require_once("lib/verificaConvertiData.php");
include("databases/db_function.php");
require_once("classi/class.Comunicazioni.php");
require_once("lib/verificaConvertiData.php");
	
	include("header.php");
	
	$id=$_GET['id'];
	$id_commessa=$_GET['id_commessa'];
	$data = isset($_GET['data']) ? $_GET['data'] : date("Y-m-01");
	$data_indietro = ($data != "") ? capovolgiData($data) : date("01-m-Y");
	$a_data = isset($_GET['a_data']) ? $_GET['a_data'] : date("Y-m-31");
	$a_data_indietro = ($a_data != "") ? capovolgiData($a_data) : date("31-m-Y");
	
	//estraggo elenco allegati
$allegati = new Comunicazioni();
$e_query_callegati = $allegati->caricaAllegati($id);
	
?>



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                	
                	<!-- TITOLO -->
						<div class="col-lg-12">
							<div class="page-title">
								<h1>Allegati <a class="close pull-right" href="pagina_comunicazioni.php?id=<?=$id_commessa?>&data=<?=$data_indietro?>&a_data=<?=$a_data_indietro?>"><i class="fa fa-backward"></i> Indietro</a></h1>
								<div class="clearfix"></div>
								<ol class="breadcrumb">
								<li class="active">
									
								</li>
									<li class="pull-right">
								</li>
								</ol>
							</div>
						</div>
				
                </div>
                <!-- /.row -->               

                <div class="row">
                    <div class="col-lg-12 ">
                    	<?php if($allegati->numero() > 0){ ?>
<!--Tabella Allegato-->  
<div>      
<section id="no-more-tables">
	<table class="table-striped table-condensed cf" style="width:100%; margin-top:10px; margin-bottom:10px">
  <thead>
    <tr >
      <th style="text-align:center">N.</th>
      <th style="text-align:center">Descrizione</th>
      <th style="text-align:center">Allegato</th>
    </tr>
  </thead>
  <tbody>
  <? 
  	$i=0;
	while($row_allegati = $e_query_callegati->fetch_array()){
	  $i++;
  ?>
  	<tr>
    	<td style="text-align:center" data-title="N."><?=$i?></td>
    	<td style="text-align:center" data-title="Descrizione">
        	<? if($row_allegati['descrizione'] != "") { 
            	echo $row_allegati['descrizione'];
             } else {?>
             	Nessuna
             <? } ?>
        </td>
    	<td style="text-align:center" data-title="Allegato">
        	<a href="<?=$row_allegati['link']?>" target="_blank">Apri allegato</a>
        </td>
    </tr>
    <? } ?>
  </tbody>
 </table>
 </td>
 </div>
 <?php } ?>
                    </div>
                </div>
                <!-- /.row -->
                
                 
				
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
