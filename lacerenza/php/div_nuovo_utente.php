<?php
session_start();
    include("controllaSessione.php");
	//include("../lib/controllaAutorizzazioni.php");
	include("../databases/db_function.php");

	require_once("../classi/class.Utenti.php");
	
	$id=$_GET['id'];
	
	//estraggo elenco utenti
	$utenti = new Utenti();
	$query_utente = $utenti->caricaUtenteById($id);
	if($utenti->numeroUtenti() != 0){
		$row = $query_utente->fetch_array();
	}
?>
<!--SCRIPT SITO-->
<script src="js/sito/div_nuovo_utente.js" type="text/javascript"></script>

<form class="form-horizontal" id="formNewUser"  name="formNewUser" method="post" role="form">
                        <div class="row">
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Username*:</label>
                              <div class="col-md-8">
                                <input <?if($_SESSION['ruolo'] != "ADMIN" || $_SESSION['ruolo'] != "SUPERADMIN"){ echo "readonly"; }?> type="text" class="form-control" placeholder="Username"  id="username_utente" name="username_utente"  value="<?=$row['username']?>"/>
                                <input type="hidden" id="id_da_modificare" name="id_da_modificare"  value="<?=$id?>"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Password*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Password" id="password_utente" name="password_utente" value="<?=$row['password']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Nome*:</label>
                              <div class="col-md-8">
                                <input <?if($_SESSION['ruolo'] != "ADMIN" || $_SESSION['ruolo'] != "SUPERADMIN"){ echo "readonly"; }?> id="nome_utente" class="form-control" placeholder="Nome" name="nome_utente" type="text" value="<?=$row['nome']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Cognome*:</label>
                              <div class="col-md-8">
                                <input <?if($_SESSION['ruolo'] != "ADMIN" || $_SESSION['ruolo'] != "SUPERADMIN"){ echo "readonly"; }?> type="text" class="form-control" placeholder="Cognome" id="cognome_utente" name="cognome_utente" value="<?=$row['cognome']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Email*:</label>
                              <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Email" id="email_utente" name="email_utente" value="<?=$row['email']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label  class="col-md-4 control-label">Mansione*:</label>
                              <div class="col-md-8">
                                <input <?if($_SESSION['ruolo'] != "ADMIN" || $_SESSION['ruolo'] != "SUPERADMIN"){ echo "readonly"; }?> type="text" class="form-control" placeholder="Mansione" id="mansione_utente" name="mansione_utente" value="<?=$row['mansione']?>" />
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                              <label class="col-md-4 control-label">Ruolo*:</label>
                              <div class="col-md-8">
                               
                                <select <?if($_SESSION['ruolo'] != "ADMIN" || $_SESSION['ruolo'] != "SUPERADMIN"){ echo "readonly"; }?> id="ruolo_utente" name="ruolo_utente"  <? if($row['username'] == $_SESSION['username']){echo 'disabled';}?>>
                                    <option <?if($row['ruolo'] == "ADMIN"){ echo "selected";} ?>>ADMIN</option>
                                    <option <?if($row['ruolo'] == "MAGAZZINIERE"){ echo "selected";} ?>>MAGAZZINIERE</option>
                                    <!-- <option <?if($row['ruolo'] == "MEZZI"){ echo "selected";} ?>>MEZZI</option>
                                    <option <?if($row['ruolo'] == "RUOLINO"){ echo "selected";} ?>>RUOLINO</option>
                                    <option <?if($row['ruolo'] == "PERSONALE_RUOLINO"){ echo "selected";} ?>>PERSONALE_RUOLINO</option>
                                    <option <?if($row['ruolo'] == "COMMESSA"){ echo "selected";} ?>>COMMESSA</option> -->
                                </select>
                               
                              </div>
                            </div>
                          </div>
                          
                        </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
                      </form>