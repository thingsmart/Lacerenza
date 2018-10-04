<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Preventivo.php");
require_once("../classi/class.Modello.php");
require_once("../classi/class.Log.php");
//session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){

    case "elimina" :
		
        $id = $_POST['id'];
		
        $preventivo = new Preventivo();
        $preventivo->id = $id;

        $res = $preventivo->delete();

        echo $res;

    break;

    case "save" :

        $id_post = StringInputCleaner($_POST['id']);
        $idpreventivomaster_post = StringInputCleaner($_POST['idpreventivomaster']);
		$idmodello_post = StringInputCleaner($_POST['idmodello']);
		$costo_post = StringInputCleaner($_POST['costo']);
				
        $preventivo = new Preventivo();
        $preventivo->id = $id_post;
        $preventivo->idpreventivomaster = $idpreventivomaster_post;
        $preventivo->idmodello = $idmodello_post;
		$preventivo->costo = $costo_post;
		$preventivo->quantita = "";
		$preventivo->descrizioneaggiornata = "";
		
		if($id_post != '') {
			$res = $preventivo->update_costo();
		} else {
			$res = $preventivo->insert();
		}

        echo $res;
		
    break;

    case "save_quantita" :

        $id_post = StringInputCleaner($_POST['id']);
        $idpreventivomaster_post = StringInputCleaner($_POST['idpreventivomaster']);
		$idmodello_post = StringInputCleaner($_POST['idmodello']);
		$quantita_post = StringInputCleaner($_POST['quantita']);
		
        $preventivo = new Preventivo();
        $preventivo->id = $id_post;
        $preventivo->idpreventivomaster = $idpreventivomaster_post;
        $preventivo->idmodello = $idmodello_post;
		$preventivo->costo = "";
		$preventivo->quantita = $quantita_post;
		$preventivo->descrizioneaggiornata = "";
		
		if($id_post != '') {
			$res = $preventivo->update_quantita();
		} else {
			$res = $preventivo->insert();
		}

        echo $res;
		
    break;

    case "save_descrizione" :

        $id_post = StringInputCleaner($_POST['id']);
        $idpreventivomaster_post = StringInputCleaner($_POST['idpreventivomaster']);
		$idmodello_post = StringInputCleaner($_POST['idmodello']);
		$descrizione_post = $_POST['descrizione'];

		$descrizione_post = str_replace("sans',", '', $descrizione_post);
		$descrizione_post = str_replace("justify;'", '', $descrizione_post);
		$descrizione_post = str_replace('=""', '', $descrizione_post);
		
		$descrizione_post = str_replace("'", '"', $descrizione_post);
		
        $preventivo = new Preventivo();
        $preventivo->id = $id_post;
        $preventivo->idpreventivomaster = $idpreventivomaster_post;
        $preventivo->idmodello = $idmodello_post;
		$preventivo->costo = "";
		$preventivo->quantita = "";
		$preventivo->descrizioneaggiornata = $descrizione_post;

		if($id_post != '') {
			$res = $preventivo->update_descrizione();
		} else {
			$res = $preventivo->insert();
		}

        echo $res;
		
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