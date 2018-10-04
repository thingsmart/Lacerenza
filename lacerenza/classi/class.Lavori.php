<?php
session_start();

class Lavori
{  
   function __construct()
   {
		$this->numero =0;   
	}
   
   //Carico gli alegati relativi ad una commessa
   public function carica()
   {
	  $query = "SELECT * FROM tb_lavoro;";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   public function filtra($filtro)
   {
	  $query = "SELECT * FROM tb_lavoro WHERE attivita LIKE '%$filtro%';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   public function caricaById($id)
   {
	  $query = "SELECT * FROM tb_lavoro WHERE id='$id';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   
   //inserisco un nuovo allegato
   public function inserisci($cod_lavoro, $descrizione, $attivita, $lavorazione)
   {
   	  $utente = $_SESSION['username'];
	  $query = "INSERT INTO tb_lavoro SET cod_lavoro='$cod_lavoro', descrizione='$descrizione', attivita='$attivita', lavorazione='$lavorazione';";
	  $e_query = EseguiQuery($query,"inserimento");
      //return $query;
      return $e_query;
   }
   
   public function modifica($id, $cod_lavoro, $descrizione, $attivita, $lavorazione){
   	$utente = $_SESSION['username'];
	  $query = "UPDATE tb_lavoro SET  cod_lavoro='$cod_lavoro', descrizione='$descrizione', attivita='$attivita', lavorazione='$lavorazione' WHERE id='$id';";
	  $e_query = EseguiQuery($query,"inserimento");
      return $e_query;
   }
   
    //elimino un allegato
    public function elimina($id)
   {
	  $query = "DELETE FROM tb_lavoro WHERE id=$id;";
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
