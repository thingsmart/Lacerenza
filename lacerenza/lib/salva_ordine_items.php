<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Modello.php");
require_once("../classi/class.Log.php");

$list = $_POST['listaItem'];
$iddettaglio = $_POST['iddettaglio'];

// $list = "item[]=31&item[]=29";
// $iddettaglio = "1";

$output = array();
$list = parse_str($list, $output);

$a = implode(",", $output['item']);

//echo $a;

$esplodo_id = explode(",", $a);

$pos = 0;

$modello = new Modello();
$lista_modelli = $modello->getAllModelloMaster($iddettaglio);
foreach ($lista_modelli as $dett_mod) {
	
	for ($i=0; $i < count($esplodo_id); $i++) {
		if($dett_mod->id == $esplodo_id[$i]) {
			$modello->updatePosizione($dett_mod->id, $i);
			//echo "<br>".$pos = $i. "<br> id = ".$dett_mod->id;
			break;
		} 
		//$pos = $i; echo $pos;
	}
	//echo $dett_mod->id;	
}

echo $a;
// for ($i=0; $i < count($esplodo_id); $i++) { 
	// $pos = $i; echo $pos;
// }
//print_r($output);

//echo $list;

?>