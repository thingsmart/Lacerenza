<?php
session_start();

class Comunicazioni
{  
   function __construct()
   {
		$this->numero = 0;   
	}
   
   //Carico gli alegati relativi ad una commessa
   public function carica($data, $a_data)
   {
	  $query = "SELECT * FROM tb_comunicazioni WHERE data >= '$data' && data <= '$a_data';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
    //Carico gli alegati relativi ad una commessa
   public function caricaByCommessa($data, $a_data, $id)
   {
	  $query = "SELECT * FROM tb_comunicazioni WHERE id_commessa='$id' AND data >= '$data' && data <= '$a_data';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
      
	 public function caricaAllegati($id_comunicazione)
   {
	  $query = "SELECT * FROM tb_allegati_comunicazioni WHERE id_comunicazione = $id_comunicazione;";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   public function caricaById($id)
   {
	  $query = "SELECT * FROM tb_comunicazioni WHERE id='$id';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   
   //inserisco un nuovo allegato
   public function inserisci($data, $id_commessa, $descrizione_commessa, $tipo_comunicazione, $destinatario, $testo, $note, $destinatario_reale)
   {
   	  $utente = $_SESSION['username'];
	  $query = "INSERT INTO tb_comunicazioni SET destinatario_reale='$destinatario_reale', data='$data', id_commessa='$id_commessa', descrizione_commessa='$descrizione_commessa', utente='$utente', tipo_comunicazione='$tipo_comunicazione', destinatario='$destinatario', testo='$testo', note='$note';";
	  $e_query = EseguiQuery($query,"inserimento");
      //return $query;
      return $e_query;
   }

   //inserisco un nuovo allegato
   public function inserisciAllegato($id_comunicazione, $link, $descrizione, $filename)
   {
   	  $utente = $_SESSION['username'];
	  $query = "INSERT INTO tb_allegati_comunicazioni SET file_name='$filename', id_comunicazione='$id_comunicazione', link='$link', descrizione='$descrizione', utente='$utente';";
	  $e_query = EseguiQuery($query,"inserimento");
      //return $query;
      return $e_query;
   }
   
   public function modifica($id, $data, $id_commessa, $descrizione_commessa, $tipo_comunicazione, $destinatario, $testo, $note, $destinatario_reale){
   	$utente = $_SESSION['username'];
	  $query = "UPDATE tb_comunicazioni SET destinatario_reale='$destinatario_reale', data='$data', id_commessa='$id_commessa', descrizione_commessa='$descrizione_commessa', utente='$utente', tipo_comunicazione='$tipo_comunicazione', destinatario='$destinatario', testo='$testo', note='$note' WHERE id='$id';";
	  $e_query = EseguiQuery($query,"inserimento");
      return $e_query;
   }
   
    //elimino un allegato
    public function elimina($id)
   {
	  $query = "DELETE FROM tb_comunicazioni WHERE id=$id;";
	  $e_query = EseguiQuery($query,"selezione");
      return $e_query;
   }
   
   //elimino un allegato
    public function eliminaAllegato($id)
   {
	  $query = "DELETE FROM tb_allegati_comunicazioni WHERE id=$id;";
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
