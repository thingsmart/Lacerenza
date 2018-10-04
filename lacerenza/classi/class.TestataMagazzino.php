<?php
session_start();

class TestataMagazzino
{  
   function __construct()
   {
		$this->numero =0;   
	}
   
   //Carico gli alegati relativi ad una commessa
   public function carica($data, $a_data)
   {
	  $query = "SELECT * FROM tb_testata_magazzino WHERE data >= '$data' AND data <= '$a_data';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }

   //Carico gli alegati relativi ad una commessa
   public function caricaNew($data)
   {
      $query = "SELECT * FROM tb_testata_magazzino WHERE data >= '$data';";
      $e_query = EseguiQuery($query,"selezione");
      $this->numero = $e_query->num_rows;
      return $e_query;
   }



   public function caricaById($id)
   {
	  $query = "SELECT * FROM tb_testata_magazzino WHERE id='$id';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   
   //inserisco un nuovo allegato
   public function inserisci($data, $mezzo, $id_mezzo, $id_commessa, $descrizione_commessa)
   {
   	  $utente = $_SESSION['username'];
	  $query = "INSERT INTO tb_testata_magazzino SET data='$data', mezzo='$mezzo', id_mezzo='$id_mezzo', id_commessa='$id_commessa', descrizione_commessa='$descrizione_commessa', utente='$utente';";
	  $e_query = EseguiQuery($query,"inserimento");
      //return $query;
      return $e_query;
   }
   
   public function modifica($id, $data, $mezzo, $id_mezzo, $id_commessa, $descrizione_commessa){
   	$utente = $_SESSION['username'];
	  $query = "UPDATE tb_testata_magazzino SET data='$data', mezzo='$mezzo', id_mezzo='$id_mezzo', id_commessa='$id_commessa', descrizione_commessa='$descrizione_commessa', utente='$utente' WHERE id='$id';";
	  $e_query = EseguiQuery($query,"inserimento");
      return $e_query;
   }
   
    //elimino un allegato
    public function elimina($id)
   {
	  $query = "DELETE FROM tb_testata_magazzino WHERE id=$id;";
	  $e_query = EseguiQuery($query,"selezione");
      return $e_query;
   }
   
   //ritorno il numero degli allegati
   public function numero()
   {
      return $this->numero;
   }
   
}

?>
