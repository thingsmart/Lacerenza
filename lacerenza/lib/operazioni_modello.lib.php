<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Modello.php");
require_once("../classi/class.Log.php");
//session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){

    case "elimina" :
		
        $id = $_POST['id'];
		
        $modello = new Modello();
        $modello->id = $id;

        $res = $modello->delete();

        echo $res;

    break;

    case "save" :

        $id_post = StringInputCleaner($_POST['id']);
        $idmodellomaster_post = StringInputCleaner($_POST['idmodellomaster']);
		$idsezione_post = StringInputCleaner($_POST['idsezioni']);
		$posizione_post = StringInputCleaner($_POST['posizione']);
				
        $modello = new Modello();
		
		$lista_modelli = $modello->getAll();
		$numero_modelli = count($lista_modelli);
		
		$pos_max = $modello->getMax($idmodellomaster_post);
		$posizione_max = $pos_max['max'];
		
		if($numero_modelli >= 1) {
			
			if($posizione_max >= 0) {
				$posizione_post = $posizione_max+1;
			} 
			
		} else {
					
			$posizione_post = 0;
			
		}

		
        $modello->id = $id_post;
        $modello->idmodellomaster = $idmodellomaster_post;
        $modello->idsezione = $idsezione_post;
        $modello->posizione = $posizione_post;
		
        $res = $modello->save();

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