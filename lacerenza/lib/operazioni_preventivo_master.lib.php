<?php
include("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.PreventivoMaster.php");
require_once("../classi/class.Modello.php");
require_once("../classi/class.Log.php");
//session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){

    case "elimina" :
		
        $id = $_POST['id'];
		
        $preventivo_master = new PreventivoMaster();
        $preventivo_master->id = $id;

        $res = $preventivo_master->delete();
		
        if($res >= 0){
            $dir = "../uploads/prevmaster/".$id."/";
			if (is_dir($dir)) {
				rmdir_recursive($dir);
			}
        }

        echo $res;

    break;

    case "save" :

        $id_post = $_POST['id'];
        $numpreventivo_post = $_POST['numpreventivo'];
		$datapreventivo_post = CapovolgiData($_POST['datapreventivo']);
		$cliente_post = $_POST['cliente'];
		$indirizzo_post = $_POST['indirizzo'];
		$idmodellomaster_post = $_POST['idmodellomaster'];
		$descrizione_post = $_POST['descrizione'];
		$titololavoro_post = $_POST['titololavoro'];
		$iniziolavori_post = $_POST['iniziolavori'];
		$finelavori_post = $_POST['finelavori'];
		$condizionipagamento_post = $_POST['condizionipagamento'];
		
        $preventivo_master = new PreventivoMaster();
        $preventivo_master->id = $id_post;
        $preventivo_master->numpreventivo = $numpreventivo_post;
        $preventivo_master->datapreventivo = $datapreventivo_post;
        $preventivo_master->cliente = $cliente_post;
		$preventivo_master->indirizzo = $indirizzo_post;
        $preventivo_master->idmodellomaster = $idmodellomaster_post;
		$preventivo_master->descrizione = $descrizione_post;
		$preventivo_master->titololavoro = $titololavoro_post;
		$preventivo_master->iniziolavori = $iniziolavori_post;
		$preventivo_master->finelavori = $finelavori_post;
		$preventivo_master->condizionipagamento = $condizionipagamento_post;
		
        $res = $preventivo_master->save();
		
		if($res > 0) {
			
			if($id_post == '') {
				$id_post = $res;
			}
			
	        $target_path = "../uploads/prevmaster/" . $id_post . "/allegato/";
	        $target_path_salva = "uploads/prevmaster/" . $id_post . "/allegato/";

	        $filename = $_FILES['files']['name'];
	        $filename = str_replace("-", "_", $filename);
					
	        if ($filename != "") {
	
				if (!is_dir($target_path)) { 
					$crea = mkdir($target_path, 0777, true);
				}
	            $link_file = "../uploads/prevmaster/" . $id_post . "/allegato/" . $filename;
	            if (file_exists($link_file)) {
	                $filename = date("d_m_Y_h_i_s") . $filename;
	                $link_file = "../uploads/prevmaster/" . $id_post . "/allegato/" . $filename;
	            }
				
				move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
		
				$preventivo_master->id = $id_post;
	            $preventivo_master->link_file = $target_path_salva;
	            $preventivo_master->filename = $filename;
				$res_pdf = $preventivo_master->insert_img();
									
	        }
						
		}
		
        echo $res;
		
    break;
	
    case "elimina_allegato" :
		
        $id = $_POST['id'];
		
        $preventivo_master = new PreventivoMaster();
        $preventivo_master->id = $id;
		$preventivo_master->filename = "";
		$preventivo_master->link_file = "";

		$res = $preventivo_master->insert_img();
		
        if($res >= 0){
            $dir = "../uploads/prevmaster/".$id."/";
			rmdir_recursive($dir);
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

function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
        else unlink("$dir/$file");
    }
    rmdir($dir);
}


?>