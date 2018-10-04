<?php

class Attivita
{  
   function __construct()
   {
		$this->num_attivita = 0;   
	}
   
   public function caricaAttivita($id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_attivita WHERE id_commessa = $id_commessa;";
	  $e_query_fatture = EseguiQuery($query_fatture,"selezione");
	  $this->num_attivita = $e_query_fatture->num_rows;
      return $e_query_fatture;
   }
   
   public function eliminaAttivita($id)
   {
       $query_fatture = "DELETE FROM tb_attivita WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       return $e_query_fatture;
   }
   
   
   public function inserisciAttivita($id_commessa, $importo, $impresa_fornitrice, $lavoro, $registrato_a, $numero, $data_del, $data_il)
   {
       $query_fatture = "INSERT INTO tb_attivita SET importo='$importo', id_commessa = '$id_commessa', impresa_fornitrice='$impresa_fornitrice', lavoro='$lavoro', registrato_a='$registrato_a', numero = '$numero', data_del = '$data_del', data_il = '$data_il';";
	  $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
      return $e_query_fatture;
   }
   
   public function caricaAttivitaById($id)
   {
       $query_fatture = "SELECT * FROM tb_attivita WHERE id='$id';";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_attivita = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function filtraAttivita($filtro, $id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_attivita WHERE id_commessa LIKE '$id_commessa' AND (numero LIKE '%".$filtro."%' OR impresa_fornitrice LIKE '%".$filtro."%' OR lavoro LIKE '%".$filtro."%');";
       $e_query_fatture = EseguiQuery($query_fatture,"selezione");
       $this->num_attivita = $e_query_fatture->num_rows;
       return $e_query_fatture;
   }
   
   public function modificaAttivita($id, $id_commessa,$importo, $impresa_fornitrice, $lavoro, $registrato_a, $numero, $data_del, $data_il)
   {
       $query_fatture = "UPDATE tb_attivita SET importo = '$importo', impresa_fornitrice = '$impresa_fornitrice', lavoro = '$lavoro', registrato_a = '$registrato_a', numero='$numero', data_del='$data_del', data_il='$data_il' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
  
   public function numeroAttivita()
   {
      return $this->num_attivita;
   }
   
}

?>
