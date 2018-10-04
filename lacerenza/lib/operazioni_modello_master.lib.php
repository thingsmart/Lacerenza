<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.ModelloMaster.php");
require_once("../classi/class.Log.php");
//session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){

    case "elimina" :
		
        $id = $_POST['id'];
		
        $modello = new ModelloMaster();
        $modello->id = $id;

        $res = $modello->delete();

        echo $res;

    break;

    case "save" :

        $id_post = StringInputCleaner($_POST['id']);
        $titolo_post = StringInputCleaner($_POST['titolosezione']);
		
        $modello = new ModelloMaster();
        $modello->id = $id_post;
        $modello->titolo = $titolo_post;
		
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