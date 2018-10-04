<?php

class Log
{  
   function __construct()
   {
	   $this->caricaLogIeri();
	   if($this->num_log > 0){
		   $this->eliminaLog();
        }
		$this->num_log =0;   		
	}
   
   //Carico gli alegati relativi ad una commessa
   public function caricaLog($data, $domani)
   {
       
       $query_log = "SELECT * from tb_log WHERE data_inserimento >= '$data' AND data_inserimento < '$domani' ORDER BY id DESC;";
	  $e_query_log = EseguiQuery($query_log,"selezione");
	  $this->num_log = $e_query_log->num_rows;
      return $e_query_log;
   }
   
   //Carico gli alegati relativi ad una commessa
   public function caricaLogHome()
   {
       
       $query_log = "SELECT * from tb_log ORDER BY id DESC;";
       $e_query_log = EseguiQuery($query_log,"selezione");
       $this->num_log = $e_query_log->num_rows;
       return $e_query_log;
   }
   

   
   
   public function caricaLogIeri()
   {
	  $data = date("Y-m-28");
	  $query_log = "SELECT * from tb_log WHERE data_inserimento > '$data';";
	  $e_query_log = EseguiQuery($query_log,"selezione");
	  $this->num_log = $e_query_log->num_rows;
      return $e_query_log;
   }
   
   //Carico gli alegati relativi ad una commessa
   public function caricaLogLimit()
   {
	  $data = date("Y-m-d");
	  $query_log = "SELECT * from tb_log WHERE data_inserimento >= '$data' ORDER by id DESC LIMIT 5;";
	  $e_query_log = EseguiQuery($query_log,"selezione");
	  $this->num_log = $e_query_log->num_rows;
      return $e_query_log;
   }
   
   
   //inserisco un nuovo allegato
   public function inserisciLog($operazione, $utente, $colore)
   {
	  $query_log = "INSERT INTO tb_log SET operazione = '$operazione', utente = '$utente', colore = '$colore';";
	  $e_query_log = EseguiQuery($query_log,"inserimento");
      return $query_log;
   }
   
    //elimino un allegato
    public function eliminaLog()
   {
	  $data = date("Y-m-28");
	  $query_log = "DELETE FROM tb_log WHERE data_inserimento < '$data'";
	  $e_query_log = EseguiQuery($query_log,"selezione");
      return $e_query_log;
   }
   
    public function filtraLog($filtro, $data, $domani)
   {
	  $query_log = "SELECT * from tb_log WHERE (utente LIKE '%".$filtro."%' || operazione LIKE '%".$filtro."%') AND data_inserimento >= '$data' AND data_inserimento < '$domani';";
	  $e_query_log = EseguiQuery($query_log,"selezione");
	  $this->num_log = $e_query_log->num_rows;
      return $e_query_log;
   }
   
   //ritorno il numero degli allegati
   public function numeroLog()
   {
      return $this->num_log;
   }
   
}

?>
