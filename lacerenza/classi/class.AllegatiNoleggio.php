<?php

class AllegatiNoleggio
{  
   function __construct()
   {
		$this->num_allegati = 0;   
	}
   
   public function caricaAllegati($id_noleggio)
   {
       $query_fatture = "SELECT * FROM tb_allegati_noleggi WHERE id_noleggio = $id_noleggio;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_allegati = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function eliminaAllegato($id)
   {
       $query_fatture = "DELETE FROM tb_allegati_noleggi WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function inserisciAllegato($id_noleggio, $descrizione, $target_path_inserimento, $filename)
   {
       $query_fatture = "INSERT INTO tb_allegati_noleggi SET id_noleggio = '$id_noleggio', descrizione='$descrizione', link_allegato='$target_path_inserimento', nome_allegato='$filename';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaAllegatoById($id)
   {
       $query_fatture = "SELECT * FROM tb_allegati_noleggi WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_allegati = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtraAllegati($filtro, $id_noleggio)
   {
       $query_fatture = "SELECT * FROM tb_allegati_noleggi WHERE id_noleggio LIKE '$id_noleggio' AND (nome_allegato LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%');";
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
