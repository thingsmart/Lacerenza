<?php
session_start();

class Tecnica
{  
   function __construct()
   {
		$this->numero =0;   
	}
   
   //Carico gli alegati relativi ad una commessa
   public function carica()
   {
	  $query = "SELECT * FROM tb_tecnica;";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   public function filtra($mese, $anno)
   {
   	  $data_inizio = date($anno.'-'.$mese.'-01');
	  $giorni = date("t",strtotime("01/$mese/$anno"));
	  $data_fine = date($anno.'-'.$mese.'-'.$giorni);
	  $query = "SELECT * FROM tb_tecnica WHERE data >= '$data_inizio' AND data <= '$data_fine' ;";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   public function caricaById($id)
   {
	  $query = "SELECT * FROM tb_tecnica WHERE id='$id';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   
   //inserisco un nuovo allegato
   public function inserisci($num_preventivo, $cliente, $sopraluogo, $data, $offerta, $operatore, $ricontatti, $esito, $tipo_cliente, $tipo_sede, $motivazione, $data_acquisizione, $modalita, $link_file)
   {
   	  $utente = $_SESSION['username'];
	  $insert_data_acquisizione = ($data_acquisizione != "" && $data_acquisizione != "--") ? ", data_acquisizione='$data_acquisizione'" : "";
	  $query = "INSERT INTO tb_tecnica SET num_preventivo='$num_preventivo', cliente='$cliente', sopraluogo='$sopraluogo', motivazione='$motivazione', link_file='$link_file', modalita='$modalita' $insert_data_acquisizione , tipo_sede='$tipo_sede', tipo_cliente='$tipo_cliente', esito='$esito', data='$data', offerta='$offerta', operatore='$utente', ricontatti='$ricontatti';";
	  $e_query = EseguiQuery($query,"inserimento");
      //return $query;
      return $e_query;
   }
   
   public function modifica($id, $num_preventivo, $cliente, $sopraluogo, $data, $offerta, $operatore, $ricontatti, $esito, $tipo_cliente, $tipo_sede, $motivazione, $data_acquisizione, $modalita, $link_file){
   	$utente = $_SESSION['username'];
	$insert_filename = ($link_file != "") ? ", link_file='$link_file'" : "";
	  $query = "UPDATE tb_tecnica SET num_preventivo='$num_preventivo', cliente='$cliente', sopraluogo='$sopraluogo', motivazione='$motivazione' $insert_filename, modalita='$modalita', data_acquisizione='$data_acquisizione', tipo_sede='$tipo_sede', tipo_cliente='$tipo_cliente', esito='$esito', data='$data', offerta='$offerta', operatore='$utente', ricontatti='$ricontatti' WHERE id='$id';";
	  $e_query = EseguiQuery($query,"inserimento");
      return $e_query;
   }

public function eliminaAllegato($id)
   {
       $query_fatture = "UPDATE tb_tecnica SET link_file='' WHERE id=$id;";
       $e_query_fatture = EseguiQuery($query_fatture,"inserimento");
       return $e_query_fatture;
   }
   
public function modificaLink($id, $link_file){
   	$utente = $_SESSION['username'];
	  $query = "UPDATE tb_tecnica SET link_file='$link_file' WHERE id='$id';";
	  $e_query = EseguiQuery($query,"inserimento");
      return $e_query;
   }
   
    //elimino un allegato
    public function elimina($id)
   {
	  $query = "DELETE FROM tb_tecnica WHERE id=$id;";
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
