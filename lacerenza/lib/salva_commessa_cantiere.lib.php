<?php
	include("../lib/controllaSessione.php");
	require_once("../classi/class.Allegati.php");
	require_once("../databases/db_function.php");
	require_once("../lib/verificaConvertiData.php");
	require_once("../classi/class.Commesse.php");
	include("../lib/funzioni_sito.php");
	require_once("../classi/class.Log.php");
	
	$log = new Log();


	//estraggo la commessa dall'id
	$commesse = new Commesse();

	$id=$_POST['id'];
	$cantiere= StringInputCleaner($_POST['cantiere']);
	$localita= StringInputCleaner($_POST['localita']);
	$importo=$_POST['importo'];
	$importo = str_replace(",", ".", $importo);
	$tipologia_lavori = StringInputCleaner($_POST['tipologia_lavori']);
	$referente = StringInputCleaner($_POST['referente']);
	$telefono = $_POST['telefono'];
	$fax = $_POST['fax'];
	$cellulare = $_POST['cellulare'];
	$email = trim($_POST['email']);
	$indirizzo_referente = StringInputCleaner($_POST['indirizzo_referente']);
	$pi = $_POST['pi'];
	$pec = $_POST['pec'];
	$data_inizio = $_POST['data_inizio'];
	$data_fine = $_POST['data_fine'];
	$data_inizio = CapovolgiData($data_inizio);

    $numero_dipendenti = StringInputCleaner($_POST['numerodipendenti']);
    $datafine = CapovolgiData( $_POST['datafine'] );
    $apertura_cantiere = StringInputCleaner($_POST['aperturacantiere']);
	
	if($data_fine != ""){
		$data_fine = CapovolgiData($data_fine);
		$risultato = delta_tempo($data_inizio, $data_fine, 'g');
		
		if($risultato >= 0){	
			$res = $commesse->modificaCommessaCantiereFull($id, $cantiere, $localita, $importo, $tipologia_lavori, $referente, $telefono, $fax, $cellulare, $data_inizio, $data_fine, $email, $indirizzo_referente, $pi, $pec, $numero_dipendenti, $datafine, $apertura_cantiere);
			$log->inserisciLog("Modifica Cantiere", $_SESSION['username'], "blu");
			echo $res;
		} else {
			echo "ERRORE_TEMPO";
		}
	} else {
        $res = $commesse->modificaCommessaCantiereFull($id, $cantiere, $localita, $importo, $tipologia_lavori, $referente, $telefono, $fax, $cellulare, $data_inizio, $data_fine, $email, $indirizzo_referente, $pi, $pec, $numero_dipendenti, $datafine, $apertura_cantiere);
        $log->inserisciLog("Modifica Cantiere", $_SESSION['username'], "blu");
        echo $res;
	}


//To SANITIZE String value use
function StringInputCleaner($data) {
	//remove space bfore and after
	$data = trim($data);
	//remove slashes
	$data = stripslashes($data);
	$data = (filter_var($data, FILTER_SANITIZE_STRING));
	$data = utf8_encode($data);
	return $data;
}
?>