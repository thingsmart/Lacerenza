<?php
session_start();

class Gare
{  
   function __construct()
   {
		$this->numero =0;   
	}
   
   //Carico gli alegati relativi ad una commessa
   public function carica()
   {
	  $query = "SELECT * FROM tb_gara;";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   public function filtra($mese, $anno)
   {
   	  $data_inizio = date($anno.'-'.$mese.'-01');
	  $giorni = date("t",strtotime("01/$mese/$anno"));
	  $data_fine = date($anno.'-'.$mese.'-'.$giorni);
	  $query = "SELECT * FROM tb_gara WHERE (data_emissione >= '$data_inizio' AND data_emissione <= '$data_fine') || (data_scadenza >= '$data_inizio' AND data_scadenza <= '$data_fine') ;";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   public function caricaById($id)
   {
	  $query = "SELECT * FROM tb_gara WHERE id='$id';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   public function caricaAllegati($id_gara)
   {
	  $query = "SELECT * FROM tb_allegati_gare WHERE id_gara='$id_gara';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   public function eliminaAllegati($id)
   {
	  $query = "DELETE FROM tb_allegati_gare WHERE id=$id;";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   
   
   
   
   //inserisco un nuovo allegato
   public function inserisci($descrizione, $data_emissione, $data_scadenza, $polizze, $avcp, $passoe)
   {
   	  $utente = $_SESSION['username'];
	  $query = "INSERT INTO tb_gara SET descrizione='$descrizione', data_emissione='$data_emissione', data_scadenza='$data_scadenza', polizze='$polizze', avcp='$avcp', passoe='$passoe', utente='$utente';";
	  $e_query = EseguiQuery($query,"inserimento");
      return $e_query;
   }
   
   //inserisco un nuovo allegato
   public function inserisci_allegato($descrizione, $link_file, $filename, $id_gara)
   {
   	  $utente = $_SESSION['username'];
	  $query = "INSERT INTO tb_allegati_gare SET id_gara='$id_gara', descrizione='$descrizione', link_file='$link_file', filename='$filename', utente='$utente';";
	  $e_query = EseguiQuery($query,"inserimento");
      return $e_query;
   }
   
   public function modifica($id, $descrizione, $data_emissione, $data_scadenza, $polizze, $avcp, $passoe){
   	$utente = $_SESSION['username'];
	  $query = "UPDATE tb_gara SET descrizione='$descrizione', data_emissione='$data_emissione', data_scadenza='$data_scadenza', polizze='$polizze', avcp='$avcp', passoe='$passoe', utente='$utente' WHERE id='$id';";
	  $e_query = EseguiQuery($query,"inserimento");
      return $e_query;
   }


   

   
    //elimino un allegato
    public function elimina($id)
   {
	  $query = "DELETE FROM tb_gara WHERE id=$id;";
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
