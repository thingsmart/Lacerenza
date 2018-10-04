<?php
session_start();

class Magazzino
{  
   function __construct()
   {
		$this->numero =0;   
	}
   
   //Carico gli alegati relativi ad una commessa
   public function carica($id_magazzino)
   {
	  $query = "SELECT * FROM tb_magazzino WHERE id_testata_magazzino='$id_magazzino';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
      
   
   public function caricaById($id)
   {
	  $query = "SELECT * FROM tb_magazzino WHERE id='$id';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   
   //inserisco un nuovo allegato
   public function inserisci($id_testata_magazzino, $materiale, $quantita)
   {
   	  $utente = $_SESSION['username'];
	  $query = "INSERT INTO tb_magazzino SET id_testata_magazzino='$id_testata_magazzino', utente='$utente', materiale='$materiale', quantita='$quantita';";
	  $e_query = EseguiQuery($query,"inserimento");
      //return $query;
      return $e_query;
   }
   
   public function modifica($id, $id_testata_magazzino, $materiale, $quantita){
   	$utente = $_SESSION['username'];
	  $query = "UPDATE tb_magazzino SET id_testata_magazzino='$id_testata_magazzino', utente='$utente', materiale='$materiale', quantita='$quantita' WHERE id='$id';";
	  $e_query = EseguiQuery($query,"inserimento");
      return $e_query;
   }
   
    //elimino un allegato
    public function elimina($id)
   {
	  $query = "DELETE FROM tb_magazzino WHERE id=$id;";
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
