<?php

class AllegatiAttivita
{  
   function __construct()
   {
		$this->num_allegati = 0;   
	}
   
   public function caricaAllegati($id_attivita)
   {
       $query_fatture = "SELECT * FROM tb_allegati_attivita WHERE id_attivita = $id_attivita;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_allegati = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function eliminaAllegato($id)
   {
       $query_fatture = "DELETE FROM tb_allegati_attivita WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function inserisciAllegato($id_attivita, $descrizione, $data_ricevuto, $data_inviato, $inviato_a, $target_path_inserimento, $filename)
   {
       $query_fatture = "INSERT INTO tb_allegati_attivita SET id_attivita = '$id_attivita', descrizione='$descrizione', data_ricevuto='$data_ricevuto', data_inviato='$data_inviato', inviato_a='$inviato_a', link_allegato='$target_path_inserimento', nome_allegato='$filename';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaAllegatoById($id)
   {
       $query_fatture = "SELECT * FROM tb_allegati_attivita WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_allegati = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtraAllegati($filtro, $id_attivita)
   {
       $query_fatture = "SELECT * FROM tb_allegati_attivita WHERE id_attivita LIKE '$id_attivita' AND (nome_allegato LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%' OR inviato_a LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_allegati = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   
  
   public function numeroAllegati()
   {
      return $this->num_allegati;
   }
   
}

?>
