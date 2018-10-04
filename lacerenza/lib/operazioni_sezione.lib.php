<?php
require_once("../databases/db_function.php");
require_once("../lib/verificaConvertiData.php");
include("../lib/funzioni_sito.php");
require_once("../classi/class.Sezione.php");
require_once("../classi/class.Preventivo.php");
require_once("../classi/class.Log.php");
//session_start();

$tipo = $_POST['tipo'];
$log = new Log();

switch($tipo){

    case "elimina" :
		
        $id = $_POST['id'];
		
        $sezione_preventivi = new Sezione();
        $sezione_preventivi->id = $id;

        $res = $sezione_preventivi->delete();
		
        if($res >= 0){
            $dir = "../uploads/sezioni/".$id."/";
			if (is_dir($dir)) {
				rmdir_recursive($dir);
			}
        }

        echo $res;

    break;

    case "save" :

        $id_post = $_POST['id'];
        $titolo_post = $_POST['titolosezione'];
		$oscuratitolo_post = $_POST['oscuratitolo'];
		$testo_post = $_POST['testosezione'];
		
		$testo_post = str_replace("sans',", '', $testo_post);
		$testo_post = str_replace("justify;'", '', $testo_post);
		$testo_post = str_replace('=""', '', $testo_post);
		
		$testo_post = str_replace("'", '"', $testo_post);
		
        $tipologia_post = $_POST['tipologiasezione'];
        $costo_post = $_POST['costosezione'];
        $tipologiacosto_post = $_POST['tipologiacosto'];
		
        $sezione_preventivi = new Sezione();
        $sezione_preventivi->id = $id_post;
        $sezione_preventivi->titolo = $titolo_post;
		$sezione_preventivi->oscuratitolo = $oscuratitolo_post;
        $sezione_preventivi->tipologia = $tipologia_post;
		$sezione_preventivi->testo = $testo_post;
        $sezione_preventivi->costo = $costo_post;
		$sezione_preventivi->tipologiacosto = $tipologiacosto_post;
		
        $res = $sezione_preventivi->save();
		
		if($res > 0) {
			
			if($id_post == '') {
				$id_post = $res;
			}
			
	        $target_path = "../uploads/sezioni/" . $id_post . "/img/";
	        $target_path_salva = "uploads/sezioni/" . $id_post . "/img/";

	        $filename = $_FILES['files']['name'];
	        $filename = str_replace("-", "_", $filename);
					
	        if ($filename != "") {
	
				if (!is_dir($target_path)) { 
					$crea = mkdir($target_path, 0777, true);
				}
	            $link_file = "../uploads/sezioni/" . $id_post . "/img/" . $filename;
	            if (file_exists($link_file)) {
	                $filename = date("d_m_Y_h_i_s") . $filename;
	                $link_file = "../uploads/sezioni/" . $id_post . "/img/" . $filename;
	            }
	
				move_uploaded_file($_FILES["files"]["tmp_name"], $link_file);
				
				$sezione_preventivi->id = $id_post;
	            $sezione_preventivi->link_file = $target_path_salva;
	            $sezione_preventivi->filename = $filename;
				$res_preventivo = $sezione_preventivi->insert_img();		
					
	        }
						
		}
		
        echo $res;
		
    break;

    case "elimina_allegato" :
		
        $id = $_POST['id'];
		
        $sezione_preventivi = new Sezione();
        $sezione_preventivi->id = $id;
		$sezione_preventivi->filename = "";
		$sezione_preventivi->link_file = "";

        //$res = $sezione_preventivi->delete();
		$res = $sezione_preventivi->insert_img();
		
        if($res >= 0){
            $dir = "../uploads/sezioni/".$id."/";
			//unlink($dir);
			rmdir_recursive($dir);
            //rmdir($dir);
        }

        echo $res;

    break;
	
    case "update_testo" :
		
        $id_preventivo = $_POST['idpreventivo'];
		$id_modello = $_POST['idmodello'];
		$id_preventivo_master = $_POST['idpreventivomaster'];
		$testo_sezione = $_POST['testosezione'];
		
		$testo_sezione = str_replace("sans',", '', $testo_sezione);
		$testo_sezione = str_replace("justify;'", '', $testo_sezione);
		$testo_sezione = str_replace('=""', '', $testo_sezione);
		
		$testo_sezione = str_replace("'", '"', $testo_sezione);
		
		$preventivo = new Preventivo();
		
		$preventivo->id = $id_preventivo;
		$preventivo->idpreventivomaster = $id_preventivo_master;
		$preventivo->idmodello = $id_modello;
		$preventivo->descrizioneaggiornata = $testo_sezione;
		
		
		
		
		if($id_preventivo == '') {
			$res_salva = $preventivo->insert();
		} else {
			$res_salva = $preventivo->update_descrizione();
		}

        echo $id_preventivo;

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