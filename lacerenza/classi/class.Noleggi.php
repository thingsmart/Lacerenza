<?php

class Noleggi
{  
   function __construct()
   {
		$this->num_noleggi = 0;   
	}
   
   public function caricaNoleggi($id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_noleggi WHERE id_commessa = $id_commessa;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_noleggi = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function eliminaNoleggio($id)
   {
       $query_fatture = "DELETE FROM tb_noleggi WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function inserisciNoleggio($id_commessa, $numero, $descrizione, $importo, $fornitore, $data)
   {
       $query_fatture = "INSERT INTO tb_noleggi SET id_commessa = '$id_commessa', numero='$numero', descrizione='$descrizione', importo='$importo', fornitore = '$fornitore', data = '$data';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaNoleggioById($id)
   {
       $query_fatture = "SELECT * FROM tb_noleggi WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_noleggi = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtraNoleggio($filtro, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_noleggi WHERE id_commessa LIKE '$id_commessa' AND (numero LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%' OR fornitore LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_noleggi = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function modificaNoleggio($id, $id_commessa, $numero, $descrizione, $importo, $fornitore, $data)
   {
       $query_fatture = "UPDATE tb_noleggi SET numero = '$numero', descrizione = '$descrizione', importo = '$importo', fornitore = '$fornitore', data='$data' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
  
   public function numeroNoleggi()
   {
      return $this->num_noleggi;
   }
   
}

?>
