<?php
session_start();
class Commesse
{  
   function __construct()
   {
		$this->num_commesse =0;   
	}
   
   public function caricaCommesse()
   {
	  $query_commesse = "SELECT * FROM tb_commesse ORDER BY codice;";
	  $e_query_commesse = EseguiQuery($query_commesse,"selezione");
	  $this->num_commesse = $e_query_commesse->num_rows;
      return $e_query_commesse;
   }

   public function caricaCommesseNoOrder()
   {
      $query_commesse = "SELECT * FROM tb_commesse;";
      $e_query_commesse = EseguiQuery($query_commesse,"selezione");
      $this->num_commesse = $e_query_commesse->num_rows;
      return $e_query_commesse;
   }

   public static function getAllDate()
   {
      $query_dati = "SELECT * FROM tb_impostazioni LIMIT 1;";
      $e_query_dati = EseguiQuery($query_dati, "selezione");
      if($e_query_dati -> num_rows > 0){
         $row = $e_query_dati->fetch_array();
         $obj = $row;
      }
      $object = new self;
      $object->id = $obj["id"];
      $object->id_utente = $obj["data"];
      return $object;
   }

   public function modificaData($data, $id)
   {
      $query_dati = "UPDATE tb_impostazioni SET  data='$data' WHERE id=$id;";
      $e_query_dati = EseguiQuery($query_dati, "selezione");
      return $e_query_dati;
   }

   public function inserisciData($data)
   {
      $query_dati = "INSERT INTO tb_impostazioni SET  data='$data';";
      $e_query_dati = EseguiQuery($query_dati, "selezione");
      return $e_query_dati;
   }

   public static function caricaData() {
      $query_dati = "SELECT data FROM tb_impostazioni LIMIT 1;";
      $e_query_dati = EseguiQuery($query_dati, "selezione");
      if($e_query_dati -> num_rows > 0){
         $row = $e_query_dati->fetch_array();
         $obj = $row;
      }
      return $obj['data'];
   }

   public static function selezionaAnni() {
      $query_dati = "SELECT YEAR(data_inizio) as anno FROM `tb_commesse` GROUP BY DATE_FORMAT(data_inizio,'%Y');";
      $e_query_dati = EseguiQuery($query_dati, "selezione");
      return $e_query_dati;
   }
   
   public function caricaCommesseAttive()
   {
	  $query_commesse = "SELECT * FROM tb_commesse WHERE status IS NULL;";
	  $e_query_commesse = EseguiQuery($query_commesse,"selezione");
	  $this->num_commesse = $e_query_commesse->num_rows;
      return $e_query_commesse;
   }
   
   public function caricaCommesseRuolino()
   {
	  $query_commesse = "SELECT * FROM tb_commesse;";
	  $e_query_commesse = EseguiQuery($query_commesse,"selezione");
	  $this->num_commesse = $e_query_commesse->num_rows;
      return $e_query_commesse;
   }
   
   public function caricaCommesseById($id)
   {
	  $query_commesse = "SELECT * FROM tb_commesse WHERE id=$id;";
	  $e_query_commesse = EseguiQuery($query_commesse,"selezione");
	  $this->num_commesse = $e_query_commesse->num_rows;
      return $e_query_commesse;
   }
   
   public function filtraCommesse($filtro, $mostra, $operazione)
   {
      if($operazione == 1) {
         $and_operazione = " AND archiviato = 1";
      } else {
         //$and_operazione = " AND (archiviato = 1 OR archiviato = 0)";
         $and_operazione = " AND archiviato = 0";
      }
      $oggi = date("Y-m-d");
      $and_mostra = ($mostra != "") ? "AND (data_fine IS NULL || data_fine = '0000-00-00')  || data_fine >= '$oggi' " : "";
	  $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%' OR localita LIKE '%".$filtro."%' OR annotazioni LIKE '%".$filtro."%') $and_operazione $and_mostra;";
	  $e_query_commesse = EseguiQuery($query_commesse,"selezione");
	  $this->num_commesse = $e_query_commesse->num_rows;
      return $e_query_commesse;
   }

   public function filtraCommesseChiuse($filtro, $mostra, $operazione)
   {
      $and_mostra = ($mostra != "") ? "AND (data_fine IS NOT NULL AND data_fine != '0000-00-00'   AND data_fine != '' )" : "";
      if($operazione == 1) {
         $and_operazione = " AND archiviato = 1";
      } else {
         //$and_operazione = " AND (archiviato = 1 OR archiviato = 0)";
         $and_operazione = " AND archiviato = 0";
      }
      $oggi = date("Y-m-d");
      $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%' OR localita LIKE '%".$filtro."%' OR annotazioni LIKE '%".$filtro."%') $and_operazione AND data_fine <= '$oggi' $and_mostra;";
      $e_query_commesse = EseguiQuery($query_commesse,"selezione");
      $this->num_commesse = $e_query_commesse->num_rows;
      return $e_query_commesse;
   }

   public function filtraCommesseDate($filtro, $da_data, $a_data, $mostra, $operazione)
   {
      $oggi = date("Y-m-d");
      if($mostra != ""){
         if($mostra == "attive"){
            //$and_mostra = "AND (data_fine IS NULL || data_fine = '0000-00-00')   || data_fine >= '$oggi' ";
            $and_mostra = "AND status = 0";
         } else {
            //$and_mostra = "AND (data_fine IS NOT NULL && data_fine != '0000-00-00')  AND data_fine >= '$da_data' AND data_fine <= '$a_data'";
            $and_mostra = "AND status = 1";
         }
      } else {
         $and_mostra = "";
      }

      if($operazione == 1) {
         $and_operazione = " AND archiviato = 1";
         if($mostra == "chiuse") {
            $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%" . $filtro . "%' OR descrizione LIKE '%" . $filtro . "%' OR localita LIKE '%" . $filtro . "%' OR annotazioni LIKE '%" . $filtro . "%') $and_operazione AND data_fine >= '$da_data' AND data_fine <= '$a_data' $and_mostra;";
         } else {
            $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%" . $filtro . "%' OR descrizione LIKE '%" . $filtro . "%' OR localita LIKE '%" . $filtro . "%' OR annotazioni LIKE '%" . $filtro . "%') $and_operazione AND data_fine >= '$da_data' AND data_fine <= '$a_data' $and_mostra;";
         }
      } else {
         //$and_operazione = " AND (archiviato = 1 OR archiviato = 0)";
         if($filtro == "") {
            $and_operazione = " AND archiviato = 0";
         } else {
            $and_operazione = " AND (archiviato = 1 OR archiviato = 0)";
         }
         if($mostra == "chiuse") {
            $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%" . $filtro . "%' OR descrizione LIKE '%" . $filtro . "%' OR localita LIKE '%" . $filtro . "%' OR annotazioni LIKE '%" . $filtro . "%') $and_operazione AND data_inizio >= '$da_data' AND data_inizio <= '$a_data' $and_mostra;";
         } else {
            $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%" . $filtro . "%' OR descrizione LIKE '%" . $filtro . "%' OR localita LIKE '%" . $filtro . "%' OR annotazioni LIKE '%" . $filtro . "%') $and_operazione AND data_inizio >= '$da_data' AND data_inizio <= '$a_data' $and_mostra;";
         }
      }

//      if($mostra == "chiuse") {
//         $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%" . $filtro . "%' OR descrizione LIKE '%" . $filtro . "%' OR localita LIKE '%" . $filtro . "%' OR annotazioni LIKE '%" . $filtro . "%') $and_operazione AND data_inizio >= '$da_data' AND data_inizio <= '$a_data' $and_mostra;";
//      } else {
//         $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%" . $filtro . "%' OR descrizione LIKE '%" . $filtro . "%' OR localita LIKE '%" . $filtro . "%' OR annotazioni LIKE '%" . $filtro . "%') $and_operazione AND data_inizio >= '$da_data' AND data_inizio <= '$a_data' $and_mostra;";
//      }
      $e_query_commesse = EseguiQuery($query_commesse,"selezione");
      $this->num_commesse = $e_query_commesse->num_rows;
      return $e_query_commesse;
   }

   public function filtraCommesseAData($filtro, $a_data, $mostra, $operazione)
   {
      $oggi = date("Y-m-d");
//      $and_mostra = ($mostra != "") ? "AND (data_fine IS NULL || data_fine = '0000-00-00')   || data_fine >= '$oggi' " : "";
      if($mostra != ""){
         if($mostra == "attive"){
            $and_mostra = "AND (data_fine IS NULL || data_fine = '0000-00-00')   || data_fine >= '$oggi' ";
         } else {
            $and_mostra = "AND (data_fine IS NOT NULL && data_fine != '0000-00-00') AND data_fine <= '$a_data'";
         }
      } else {
         $and_mostra = "";
      }

      if($operazione == 1) {
         $and_operazione = " AND archiviato = 1";
         $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%' OR localita LIKE '%".$filtro."%' OR annotazioni LIKE '%".$filtro."%') $and_operazione AND data_fine <= '$a_data' $and_mostra;";

      } else {
         //$and_operazione = " AND (archiviato = 1 OR archiviato = 0)";
         $and_operazione = " AND archiviato = 0";
         $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%' OR localita LIKE '%".$filtro."%' OR annotazioni LIKE '%".$filtro."%') $and_operazione AND data_inizio <= '$a_data' $and_mostra;";

      }

//      $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%' OR localita LIKE '%".$filtro."%' OR annotazioni LIKE '%".$filtro."%') $and_operazione AND data_inizio <= '$a_data' $and_mostra;";
      $e_query_commesse = EseguiQuery($query_commesse,"selezione");
      $this->num_commesse = $e_query_commesse->num_rows;
      return $e_query_commesse;
   }

   public function filtraCommesseDaData($filtro, $da_data, $mostra, $operazione)
   {
      $oggi = date("Y-m-d");
//      $and_mostra = ($mostra != "") ? "AND (data_fine IS NULL || data_fine = '0000-00-00' || data_fine >= '$oggi')  " : "";
      if($mostra != ""){
         if($mostra == "attive"){
            $and_mostra = "AND (data_fine IS NULL || data_fine = '0000-00-00')   || data_fine >= '$oggi' ";
         } else {
            $and_mostra = "AND (data_fine IS NOT NULL && data_fine != '0000-00-00') AND data_fine >= '$da_data'";
         }
      } else {
         $and_mostra = "";
      }

      if($operazione == 1) {
         $and_operazione = " AND archiviato = 1";
         if($mostra == "chiuse") {
            $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%" . $filtro . "%' OR descrizione LIKE '%" . $filtro . "%' OR localita LIKE '%" . $filtro . "%' OR annotazioni LIKE '%" . $filtro . "%') $and_operazione $and_mostra;";
         } else {
            $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%" . $filtro . "%' OR descrizione LIKE '%" . $filtro . "%' OR localita LIKE '%" . $filtro . "%' OR annotazioni LIKE '%" . $filtro . "%') $and_operazione AND data_fine >= '$da_data'  $and_mostra;";
         }
      } else {
         //$and_operazione = " AND (archiviato = 1 OR archiviato = 0)";
         $and_operazione = " AND archiviato = 0";
         if($mostra == "chiuse") {
            $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%" . $filtro . "%' OR descrizione LIKE '%" . $filtro . "%' OR localita LIKE '%" . $filtro . "%' OR annotazioni LIKE '%" . $filtro . "%') $and_operazione $and_mostra;";
         } else {
            $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%" . $filtro . "%' OR descrizione LIKE '%" . $filtro . "%' OR localita LIKE '%" . $filtro . "%' OR annotazioni LIKE '%" . $filtro . "%') $and_operazione AND data_inizio >= '$da_data'  $and_mostra;";
         }
      }

//      if($mostra == "chiuse") {
//         $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%" . $filtro . "%' OR descrizione LIKE '%" . $filtro . "%' OR localita LIKE '%" . $filtro . "%' OR annotazioni LIKE '%" . $filtro . "%') $and_operazione $and_mostra;";
//      } else {
//         $query_commesse = "SELECT * FROM tb_commesse WHERE (codice LIKE '%" . $filtro . "%' OR descrizione LIKE '%" . $filtro . "%' OR localita LIKE '%" . $filtro . "%' OR annotazioni LIKE '%" . $filtro . "%') $and_operazione AND data_inizio >= '$da_data'  $and_mostra;";
//      }
      $e_query_commesse = EseguiQuery($query_commesse,"selezione");
      $this->num_commesse = $e_query_commesse->num_rows;
      return $e_query_commesse;
   }



   public function modRuolinoDescrizione($id, $testo){
      $query_commesse = "UPDATE tb_ruolino SET descrizione_commessa = '$testo' WHERE id_commessa = $id";
      $e_query_commesse = EseguiQuery($query_commesse,"selezione");
      return $e_query_commesse;
   }

   public function modProgrammazioneDescrizione($id, $testo){
      $query_commesse = "UPDATE tb_programmazione_cantiere SET descrizione_commessa = '$testo' WHERE id_commessa = $id";
      $e_query_commesse = EseguiQuery($query_commesse,"selezione");
      return $e_query_commesse;
   }

   public function modMagazzinoDescrizione($id, $testo){
      $query_commesse = "UPDATE tb_testata_magazzino SET descrizione_commessa = '$testo' WHERE id_commessa = $id";
      $e_query_commesse = EseguiQuery($query_commesse,"selezione");
      return $e_query_commesse;
   }

   public function modificaCommessaCantiere($id, $cantiere, $localita, $importo, $tipologia_lavori, $referente, $telefono, $fax, $cellulare, $data_inizio, $data_fine, $email, $indirizzo_referente, $pi, $pec)
   {
   	$utente = $_SESSION['username'];
	   $insert_data_fine = ($data_fine != "") ? ", data_fine = '$data_fine', status=1" : ", data_fine = null, status=0";
	  $query_commesse = "UPDATE tb_commesse SET utente='$utente', cantiere = '$cantiere', localita = '$localita', importo = '$importo', tipologia_lavori = '$tipologia_lavori', pec='$pec', pi='$pi', indirizzo_referente='$indirizzo_referente', email='$email', referente = '$referente' , telefono = '$telefono', fax = '$fax', cellulare = '$cellulare', data_inizio = '$data_inizio' $insert_data_fine  WHERE id=$id;";
	  $e_query_commesse = EseguiQuery($query_commesse,"selezione");
      return $e_query_commesse;
   }

    public function modificaCommessaCantiereFull($id, $cantiere, $localita, $importo, $tipologia_lavori, $referente, $telefono, $fax, $cellulare, $data_inizio, $data_fine, $email, $indirizzo_referente, $pi, $pec, $numero_dipendenti, $datafine, $aperturacantiere)
    {
        $utente = $_SESSION['username'];
        $insert_data_fine = ($data_fine != "") ? ", data_fine = '$data_fine', status=1" : ", data_fine = null, status=0";
        $query_commesse = "UPDATE tb_commesse SET utente='$utente', cantiere = '$cantiere', localita = '$localita', importo = '$importo', tipologia_lavori = '$tipologia_lavori', pec='$pec', pi='$pi', indirizzo_referente='$indirizzo_referente', email='$email', referente = '$referente' , telefono = '$telefono', fax = '$fax', cellulare = '$cellulare', numero_dipendenti = '$numero_dipendenti', datafine = '$datafine', apertura_cantiere = '$aperturacantiere', data_inizio = '$data_inizio' $insert_data_fine  WHERE id=$id;";
        $e_query_commesse = EseguiQuery($query_commesse,"selezione");
        return $e_query_commesse;
    }

   public function eliminaCommessa($id)
   {
	  $query_commesse = "DELETE FROM tb_commesse WHERE id=$id;";
	  $e_query_commesse = EseguiQuery($query_commesse,"selezione");
      return $e_query_commesse;
   }
   
   public function inserisciCommessa($codice, $localita, $data_inizio, $data_fine, $descrizione, $annotazioni, $campo1, $campo2, $campo3, $campo4, $campo5, $campo6)
   {
   		$utente = $_SESSION['username'];
	   $insert_data_fine = ($data_fine != "") ? ", data_fine = '$data_fine', status=1" : ", data_fine = null, status=0";
	  $query_commesse = "INSERT INTO tb_commesse SET cantiere='$descrizione', utente='$utente', codice = '$codice', localita='$localita', campo1='$campo1', campo2='$campo2', campo6='$campo6', campo3='$campo3', campo4='$campo4', campo5='$campo5', data_inizio='$data_inizio', descrizione='$descrizione', annotazioni='$annotazioni' $insert_data_fine;";
	  $e_query_commesse = EseguiQuery($query_commesse,"inserimento");
      return $e_query_commesse;
   }
   
   public function modificaCommessa($id, $codice, $localita, $data_inizio, $data_fine, $descrizione, $annotazioni, $campo1, $campo2, $campo3, $campo4, $campo5, $campo6)
   {
   	$utente = $_SESSION['username'];
	   $insert_data_fine = ($data_fine != "") ? ", data_fine = '$data_fine', status=1" : ", data_fine = null, status=0";
	  $query_commesse = "UPDATE tb_commesse SET cantiere='$descrizione', utente='$utente',  codice = '$codice', localita='$localita', campo1='$campo1', campo2='$campo2', campo3='$campo3', campo6='$campo6', campo4='$campo4', campo5='$campo5', data_inizio='$data_inizio', descrizione='$descrizione', annotazioni='$annotazioni' $insert_data_fine WHERE id = $id;";
	  $e_query_commesse = EseguiQuery($query_commesse,"selezione");
      return $e_query_commesse;
   }

   public function modificaArchiviazione($id, $valore_archiviazione) {
      $query_commesse = "UPDATE tb_commesse SET archiviato = $valore_archiviazione WHERE id = $id;";
      $e_query_commesse = EseguiQuery($query_commesse,"selezione");
      return $e_query_commesse;
   }
   
   
   public function numeroCommesse()
   {
      return $this->num_commesse;
   }
   
}

?>
