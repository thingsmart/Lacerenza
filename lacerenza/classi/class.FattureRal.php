<?php
session_start();
class FattureRal
{  
   function __construct()
   {
		$this->num_fatture_ral = 0;   
	}
   
   public function caricaFattureRal($id_ral)
   {
       $query_ral = "SELECT * FROM tb_fatture_ral WHERE id_ral = $id_ral;";
	  $e_query_ral = EseguiQuery($query_ral,"selezione");
	  $this->num_fatture_ral = $e_query_ral->num_rows;
      return $e_query_ral;
   }
   
   public function filtraFattureRal($filtro, $id_ral)
   {
       $query_ral = "SELECT * FROM tb_fatture_ral WHERE descrizione LIKE '%".$filtro."%' AND id_ral LIKE $id_ral;";
       $e_query_ral = EseguiQuery($query_ral,"selezione");
       $this->num_fatture_ral = $e_query_ral->num_rows;
       return $e_query_ral;
   }
   
   public function eliminaRal($id)
   {
       $query_ral = "DELETE FROM tb_fatture_ral WHERE id=$id;";
       $e_query_ral = EseguiQuery($query_ral,"selezione");
       return $e_query_ral;
   }
   
   
   public function inserisciRal($id_ral, $descrizione, $importo, $filename, $target_path_salva, $note, $data)
   {
   		$utente = $_SESSION['username'];
       $query_ral = "INSERT INTO tb_fatture_ral SET utente='$utente', id_ral = '$id_ral', descrizione='$descrizione', note='$note', data='$data', importo='$importo', nome_allegato='$filename', link_allegato = '$link_file';";
	  $e_query_ral = EseguiQuery($query_ral,"inserimento");
      return $e_query_ral;
   }
   
   public function caricaFatturaRalById($id)
   {
       $query_ral = "SELECT * FROM tb_fatture_ral WHERE id='$id';";
       $e_query_ral = EseguiQuery($query_ral,"selezione");
       $this->num_fatture_ral = $e_query_ral->num_rows;
       return $e_query_ral;
   }
   
   public function eliminaAllegato($id)
   {
       $query_ral = "UPDATE tb_fatture_ral SET nome_allegato = '', link_allegato = '' WHERE id=$id;";
       $e_query_ral = EseguiQuery($query_ral,"inserimento");
       return $e_query_ral;
   }
   
   public function modificaRal($id, $descrizione, $importo, $filename, $target_path_salva, $note, $data)
   {
   		$utente = $_SESSION['username'];
       $insert_filename = ($filename != "") ? ", nome_allegato='$filename', link_allegato='$target_path_salva'" : "";
       $query_ral = "UPDATE tb_fatture_ral SET utente='$utente', descrizione = '$descrizione', importo = '$importo', note='$note', data='$data' $insert_filename WHERE id=$id;";
       $e_query_ral = EseguiQuery($query_ral,"inserimento");
       return $e_query_ral;
   }
   
   
  
   public function numeroFattureRal()
   {
      return $this->num_fatture_ral;
   }
   
}

?>
