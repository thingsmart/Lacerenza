<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Mezzi.php");
require_once("../classi/class.Log.php");
require_once("../classi/class.Tagliandi.php");
session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){
	case "inserimento":
		$mezzo_descrizione = $_POST['mezzo'];
		$targa = $_POST['targa'];
		$km_percorsi = $_POST['km_percorsi'];
		$tagliando_ogni = $_POST['tagliando_ogni'];
		$venduto = $_POST['venduto'];
		$immatricolazione = $_POST['immatricolazione'];
		
		$mezzo_descrizione = StringInputCleaner($mezzo_descrizione);
		//$mezzo_descrizione = str_replace("°", "&deg;", $mezzo_descrizione);
		
		$data_inserimento = date("Y-m-d");
		$mezzo = new Mezzi();
		$e_query_inserimento = $mezzo->inserisciMezzo($mezzo_descrizione, $targa, $km_percorsi, $data_inserimento, $tagliando_ogni, $venduto, $immatricolazione);
		
		//LOG
		$log->inserisciLog("Inserimento mezzo", $_SESSION['username'], "verde");
		echo $e_query_inserimento;
	break;
	
	case "elimina":
		$mezzo = new Mezzi();
		$id = $_POST['id'];
		$e_query_elimina = $mezzo->eliminaMezzo($id);
		if($e_query_elimina > 0){
		$dir = "../uploads/mezzi/".$id;
		function rrmdir($dir) {
		   if (is_dir($dir)) {
			 $objects = scandir($dir);
			 foreach ($objects as $object) {
			   if ($object != "." && $object != "..") {
				 if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
			   }
			 }
			 reset($objects);
			 rmdir($dir);
		   }
		 } 
		 rrmdir($dir);

		}
		//LOG
		$log->inserisciLog("Eliminazione mezzo", $_SESSION['username'], "rosso");
		echo $e_query_elimina;
		
	break;	
	
	case "modifica":
		$id = $_POST['id'];
		$mezzo_descrizione = $_POST['mezzo'];
		$targa = $_POST['targa'];
		$km_percorsi = $_POST['km_percorsi'];
		$km_percorsi_vecchi = $_POST['km_percorsi_vecchi'];
		$data_inserimento = date("Y-m-d");
        $tagliando_ogni = $_POST['tagliando_ogni'];
		$venduto = $_POST['venduto'];
		$immatricolazione = $_POST['immatricolazione'];
		
		$mezzo_descrizione = StringInputCleaner($mezzo_descrizione);
		//$mezzo_descrizione = str_replace("°", "&deg;", $mezzo_descrizione);
		
		
		if($km_percorsi == $km_percorsi_vecchi){
			$data_inserimento = "";
		}
		
		$mezzo = new Mezzi();
		$e_query_inserimento = $mezzo->modificaMezzo($id,$mezzo_descrizione, $targa, $km_percorsi, $data_inserimento, $tagliando_ogni, $venduto, $immatricolazione);
		
		//LOG
		if($km_percorsi == $km_percorsi_vecchi){
			$log->inserisciLog("Modifica mezzo", $_SESSION['username'], "blu");
		} else {
			$log->inserisciLog("Modifica km mezzo", $_SESSION['username'], "arancione");
		}
		echo $e_query_inserimento;
	break;


	case "ottienidettagli":

		$id = $_POST['id'];

		$tagliando = new Tagliandi();
		$e_query_tagliando = $tagliando->caricaUltimi5Tagliandi( $id );

		$dettagliPassati = "";

		while($row = $e_query_tagliando->fetch_array()){

			if($row['eseguito'] == 1) {
				$dettagliPassati .= "<p style='color: #185a7a'>" . $row['tipo_tagliando'] . "<br>DEL: " . CapovolgiData($row['data_tagliando']) . " | COSTO: <small>" . $row['costo'] . " €</small></p>";
			} else {
				$dettagliPassati .= "<p style='color: #ff0000'>" . $row['tipo_tagliando'] . "<br>DEL: " . CapovolgiData($row['data_tagliando']) . " | COSTO: <small>" . $row['costo'] . " €</small></p>";
			}

		}

		echo $dettagliPassati;

		break;
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