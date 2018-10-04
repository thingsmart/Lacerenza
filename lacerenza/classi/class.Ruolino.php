<?php
session_start();

class Ruolino
{  
   function __construct()
   {
		$this->numero =0;   
	}
   
   //Carico gli alegati relativi ad una commessa
   public function carica($data)
   {
	  $query = "SELECT * FROM tb_ruolino WHERE data='$data';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   public function carica_commessa($id_commessa, $data)
   {
	  $query = "SELECT * FROM tb_ruolino WHERE data='$data' AND id_commessa = $id_commessa ORDER BY data;";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
    public function carica_commessa_giornaliero($id_commessa, $data)
   {
	  $query = "SELECT * FROM tb_ruolino WHERE data='$data' AND id_commessa = $id_commessa GROUP BY data ORDER BY data;";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }

   public function carica_commessa_giornaliero_new($id_commessa, $data)
   {
      $query = "SELECT * FROM tb_ruolino WHERE data='$data' AND id_commessa = $id_commessa  ORDER BY data;";
      $e_query = EseguiQuery($query,"selezione");
      $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   
   public function conta_commesse($id_commessa, $data)
   {
	  $query = "SELECT * FROM tb_ruolino WHERE data='$data' AND id_commessa = $id_commessa;";
	  $e_query = EseguiQuery($query,"selezione");
      return $e_query->num_rows;
   }
   
   public function carica_titoli($data)
   {
	  $query = "SELECT * FROM tb_ruolino WHERE data='$data' GROUP BY id_commessa;";
	  $e_query = EseguiQuery($query,"selezione");
      return $e_query;
   }
   
   public function carica_titoli_commessa($id)
   {
	  $query = "SELECT * FROM tb_ruolino WHERE id_commessa = '$id' ORDER BY data DESC";
	  $e_query = EseguiQuery($query,"selezione");
      return $e_query;
   }

   public function carica_titoli_commessa_new($id)
   {
      $query = "SELECT * FROM tb_ruolino WHERE id_commessa = '$id' GROUP BY data ORDER BY data DESC";
      $e_query = EseguiQuery($query,"selezione");
      return $e_query;
   }

   // public function carica_titoli_commessa($data, $id)
   // {
	  // $query = "SELECT * FROM tb_ruolino WHERE data='$data' AND id_commessa = '$id' GROUP BY id_commessa;";
	  // $e_query = EseguiQuery($query,"selezione");
      // return $e_query;
   // }
   
   public function carica_titoli_per_data($da_data, $a_data)
   {
	  $query = "SELECT * FROM tb_ruolino WHERE data>='$da_data' AND data <= '$a_data' GROUP BY id_commessa, data ORDER BY data;";
	  $e_query = EseguiQuery($query,"selezione");
      return $e_query;
   }
   
   public function carica_commessaTl($id_commessa, $data, $tl)
   {
   	  $select_tl = ($tl != "tutti") ? "tipologia='$tl' AND " : "";
	  $query = "SELECT * FROM tb_ruolino WHERE $select_tl data='$data' AND id_commessa = $id_commessa;";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   public function carica_titoli_per_dataTl($da_data, $a_data, $tl)
   {
   	$select_tl = ($tl != "tutti") ? "tipologia='$tl' AND " : "";
	  $query = "SELECT * FROM tb_ruolino WHERE $select_tl data>='$da_data' AND data <= '$a_data' GROUP BY id_commessa, data ORDER BY data;";
	  $e_query = EseguiQuery($query,"selezione");
      return $e_query;
   }
   
   public function carica_titoli_per_data_commessaTl($id_commessa, $da_data, $a_data, $tl)
   {
   	$select_tl = ($tl != "tutti") ? "tipologia='$tl' AND " : "";
	  $query = "SELECT * FROM tb_ruolino WHERE $select_tl data>='$da_data' AND data <= '$a_data' AND id_commessa = '$id_commessa' GROUP BY id_commessa, data ORDER BY data;";
	  $e_query = EseguiQuery($query,"selezione");
      return $e_query;
   }
   
   public function carica_titoli_per_data_commessa($id_commessa, $da_data, $a_data)
   {
	  $query = "SELECT * FROM tb_ruolino WHERE data>='$da_data' AND data <= '$a_data' AND id_commessa = '$id_commessa' ORDER BY data;";
	  $e_query = EseguiQuery($query,"selezione");
      return $e_query;
   }
   
   public function caricaById($id)
   {
	  $query = "SELECT * FROM tb_ruolino WHERE id='$id';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   
   //inserisco un nuovo allegato
   public function inserisci($id_commessa, $cod_commessa, $descrizione_commessa, $id_lavoro, $cod_lavoro, $descrizione_lavoro, $id_dipendenti, $addetti, $note, $data, $ore, $autista, $terzi, $ore_terzi, $quantita,  $clima, $tipologia)
   {
   	  $utente = $_SESSION['username'];
	  $query = "INSERT INTO tb_ruolino SET data='$data', note='$note', id_lavoro='$id_lavoro', cod_lavoro='$cod_lavoro', id_dipendenti='$id_dipendenti', utente='$utente', autista='$autista', ore='$ore', terzi='$terzi', tipologia='$tipologia', clima='$clima',  ore_terzi='$ore_terzi', quantita='$quantita',  addetti='$addetti', descrizione_lavoro='$descrizione_lavoro', id_commessa = '$id_commessa', cod_commessa='$cod_commessa', descrizione_commessa='$descrizione_commessa';";
	  $e_query = EseguiQuery($query,"inserimento");
      //return $query;
      return $e_query;
   }
   
   public function modifica($id, $id_commessa, $cod_commessa, $descrizione_commessa, $id_lavoro, $cod_lavoro, $descrizione_lavoro, $id_dipendenti, $addetti,  $note, $data, $ore, $autista, $terzi, $ore_terzi, $quantita,  $clima, $tipologia){
   	$utente = $_SESSION['username'];
	  $query = "UPDATE tb_ruolino SET data='$data', note='$note', id_lavoro='$id_lavoro', cod_lavoro='$cod_lavoro', id_dipendenti='$id_dipendenti',  utente='$utente',  addetti='$addetti', autista='$autista', tipologia='$tipologia', clima='$clima',  ore='$ore', terzi='$terzi', ore_terzi='$ore_terzi', quantita='$quantita', descrizione_lavoro='$descrizione_lavoro', id_commessa = '$id_commessa', cod_commessa='$cod_commessa', descrizione_commessa='$descrizione_commessa' WHERE id='$id';";
	  $e_query = EseguiQuery($query,"inserimento");
      return $e_query;
   }
   
    //elimino un allegato
    public function elimina($id)
   {
	  $query = "DELETE FROM tb_ruolino WHERE id=$id;";
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
