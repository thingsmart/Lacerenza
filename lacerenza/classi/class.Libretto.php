<?php

class Libretto
{  
   function __construct()
   {
		$this->num_spese = 0;   
	}
   
   public function carica($id_mezzo)
   {
	  $query_spese = "SELECT * FROM tb_libretto WHERE id_mezzo = $id_mezzo;";
	  $e_query_spese = EseguiQuery($query_spese,"selezione");
	  $this->num_spese = $e_query_spese->num_rows;
      return $e_query_spese;
   }
   
   public function caricaByData($id_mezzo, $data_inizio , $data_fine)
   {
	  $query_spese = "SELECT * FROM tb_libretto WHERE id_mezzo = $id_mezzo AND data >= '$data_inizio' AND data <= '$data_fine';";
	  $e_query_spese = EseguiQuery($query_spese,"selezione");
	  $this->num_spese = $e_query_spese->num_rows;
      return $e_query_spese;
   }
   
   public function filtraByData($id_mezzo, $filtro, $data_inizio , $data_fine)
   {
       $query_spese = "SELECT * FROM tb_libretto WHERE id_mezzo = $id_mezzo AND data >= '$data_inizio' AND data <= '$data_fine' AND tipo LIKE '%".$filtro."%';";
       $e_query_spese = EseguiQuery($query_spese,"selezione");
       $this->num_spese = $e_query_spese->num_rows;
       return $e_query_spese;
   }
   
   public function filtra($filtro)
   {
       $query_spese = "SELECT * FROM tb_libretto WHERE tipo LIKE '%".$filtro."%';";
       $e_query_spese = EseguiQuery($query_spese,"selezione");
       $this->num_spese = $e_query_spese->num_rows;
       return $e_query_spese;
   }
   
   public function elimina($id)
   {
       $query_spese = "DELETE FROM tb_libretto WHERE id=$id;";
       $e_query_spese = EseguiQuery($query_spese,"selezione");
       return $e_query_spese;
   }
   
   public function inserisci($id_mezzo, $descrizione, $data, $filename)
   {
       $query_spese = "INSERT INTO tb_libretto SET id_mezzo = '$id_mezzo', descrizione='$descrizione', data='$data', allegato='$filename' ;";
       $e_query_spese = EseguiQuery($query_spese,"inserimento");
       return $e_query_spese;
   }
   
   public function caricaById($id)
   {
       $query_spese = "SELECT * FROM tb_libretto WHERE id='$id';";
       $e_query_spese = EseguiQuery($query_spese,"selezione");
       $this->num_spese = $e_query_spese->num_rows;
       return $e_query_spese;
   }
   
   public function eliminaAllegato($id)
   {
       $query_spese = "UPDATE tb_libretto SET allegato = '' WHERE id=$id;";
       $e_query_spese = EseguiQuery($query_spese,"inserimento");
       return $e_query_spese;
   }
   
   public function modifica($id, $descrizione, $data, $filename)
   {
	  $insert_filename = ($filename != "") ? ", allegato='$filename'" : "";
	  $query_spese = "UPDATE tb_libretto SET descrizione = '$descrizione', data='$data' $insert_filename WHERE id=$id;";
	  $e_query_spese = EseguiQuery($query_spese,"inserimento");
      return $e_query_spese;
   }
   
   public function numero()
   {
      return $this->num_spese;
   }
   
}

?>
