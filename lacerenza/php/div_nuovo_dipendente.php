<?php 
session_start();
if ($_SESSION['ruolo'] != "ADMIN" && $_SESSION['ruolo'] != "SUPERADMIN" && $_SESSION['ruolo'] != "PERSONALE_RUOLINO") {
header('Location: index.php'); 
exit();
} ?>
<?php
    include("controllaSessione.php");
	include("../databases/db_function.php");

	require_once("../classi/class.Dipendenti.php");
	
	$id=$_GET['id'];
	
	//estraggo elenco utenti
	$dipendenti = new Dipendenti();
	$query_dipendenti = $dipendenti->caricaDipendenteById($id);
	if($dipendenti->numeroDipendenti() != 0){
		$row = $query_dipendenti->fetch_array();
	}
?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuovo_dipendente.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewDipendente"  name="formNewDipendente" method="post" role="form">
                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Nome*:</label>
                              <div class="col-md-8">
                                <input id="nome_utente" class="form-control" placeholder="Nome" name="nome_utente" type="text" value="<?=$row['nome']?>" />
                                <input id="id" class="form-control"  name="id" type="hidden" value="<?=$id?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Cognome*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Cognome" id="cognome_utente" name="cognome_utente" value="<?=$row['cognome']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Attivo:</label>
                              <div class="col-md-8">
                              	<select class="form-control" id="attivo" name="attivo">
                              		<option <?if($row['attivo'] == "ATTIVO"){ echo "selected"; }?> value="ATTIVO">ATTIVO</option>
                              		<option <?if($row['attivo'] == "TERZI"){ echo "selected"; }?> value="TERZI">TERZI</option>
                              		<option <?if($row['attivo'] == "IMPIEGATO"){ echo "selected"; }?> value="IMPIEGATO">IMPIEGATO</option>
                              		<option <?if($row['attivo'] == "NON_ATTIVO"){ echo "selected"; }?> value="NON_ATTIVO">NON_ATTIVO</option>                              	
                              	</select>
                              </div>
                            </div>
                          </div>
                         
                          
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                      </form>