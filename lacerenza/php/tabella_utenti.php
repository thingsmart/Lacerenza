<?php
	session_start();
	/****
	  *** Tabella contenente la lista degli utenti mostrata nella pagina home
	****/
	include("controllaSessione.php");

	include("../databases/db_function.php");
	require_once("../classi/class.Utenti.php");

	$filtro_utenti = isset($_GET['filtro_utente']) ? $_GET['filtro_utente'] : "";

	//estraggo elenco utenti
	$utenti = new Utenti();

	if($filtro_utenti == ""){

		if($_SESSION['ruolo'] == "SUPERADMIN" || $_SESSION['ruolo'] == "ADMIN"){
			$e_query_utenti = $utenti->CaricaUtenti();
		} else {
			$e_query_utenti = $utenti->CaricaUtenteById($_SESSION['id_utente']);
		}

	} else {
		$e_query_utenti = $utenti->filtraUtenti($filtro_utenti);
	}

	$numeroUtenti = $utenti->numeroUtenti();

?>

	<script src="js/sito/tabella_utenti.js" type="text/javascript"></script>

	<?php
		if($numeroUtenti <= 0){
	?>
		<div><strong>Nessun utente presente</strong></div>
	<?php
		} else {
	?>

		<section id="no-more-tables">
			<table class="table-striped table-condensed cf" style="width:100%">
				<thead class="cf">
					<tr>
					  <th>Username</th>
					  <th>Cognome</th>
					  <th>Nome</th>
					  <th>Email</th>
					  <th>Mansion</th>
					  <th>Ruolo</th>
					  <th>Modifica</th>
					  <? if($_SESSION['ruolo'] == "SUPERADMIN"){ ?>
					  	<th>Elimina</th>
					  <? } ?>
				   </tr>
				</thead>
				<tbody>
				   <?php
						while($row = $e_query_utenti->fetch_array()){
					?>
						<tr>
							<td data-title="Username"><?=$row['username']?></td>
							<td data-title="Cognome"><?=$row['cognome']?></td>
							<td data-title="Nome'"><?=$row['nome']?></td>
							<td data-title="Email"><?=$row['email']?></td>
							<td data-title="Mansione"><?=$row['mansione']?></td>
							<td data-title="Ruolo"><?=$row['ruolo']?></td>
							<td data-title="Modifica">
								<a class="btn modifica_utente btn_modifica"  href="modifica_utente.php?id=<?=$row['id']?>" <? if($_SESSION['id_utente'] != $row["id"] && $_SESSION["ruolo"] != "SUPERADMIN") { echo "disabled";} ?>><i class="fa fa-edit fa-lg"></i> </a>
							</td>
							<? if($_SESSION['ruolo'] == "SUPERADMIN"){ ?>
							<td data-title="Elimina">
								<div class="btn elimina_utente btn_elimina" username="<?=$row['username']?>" id_utente="<?=$row['id']?>" data-toggle="modal" data-target=".bs-elimina"><i class="fa fa-trash-o fa-lg"></i></div>
							</td>
							<? } ?>
						</tr>
					<?php
						} //END WHILE
					?>
				  </tbody>
			   </table>
		</section>

	<?php } ?>