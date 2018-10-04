<?php

class Allegati
{  
   function __construct()
   {
		$this->num_allegati =0;   
	}
   
   //Carico gli alegati relativi ad una commessa
   public function caricaAllegati($id_commessa)
   {
	  $query_allegati = "SELECT * FROM tb_allegati WHERE id_commessa=$id_commessa;";
	  $e_query_allegati = EseguiQuery($query_allegati,"selezione");
	  $this->num_allegati = $e_query_allegati->num_rows;
      return $e_query_allegati;
   }
   
   
   //inserisco un nuovo allegato
   public function inserisciAllegato($n_sospensioni, $descrizione, $verbale_n, $link_allegato, $id_commessa, $filename, $data)
   {
	  $query_allegati = "INSERT INTO tb_allegati SET n_sospensioni = $n_sospensioni, descrizione = '$descrizione',  verbale_n = '$verbale_n',  link_allegato = '$link_allegato',  id_commessa = '$id_commessa', file_name = '$filename', data = '$data';";
	  $e_query_allegati = EseguiQuery($query_allegati,"inserimento");
      //return $query_allegati;
      return $e_query_allegati;
   }
   
    //elimino un allegato
    public function eliminaAllegato($id)
   {
	  $query_allegati = "DELETE FROM tb_allegati WHERE id=$id;";
	  $e_query_allegati = EseguiQuery($query_allegati,"selezione");
      return $e_query_allegati;
   }
   
   //ritorno il numero degli allegati
   public function numeroAllegati()
   {
      return $this->num_allegati;
   }
   
}

?>
