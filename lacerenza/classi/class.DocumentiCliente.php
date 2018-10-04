<?php

class DocumentiCliente
{  
   function __construct()
   {
		$this->num_documenti_cliente = 0;   
	}
   
   public function caricaDocumentiCliente($id_commessa)
   {
       $query_documenti_cliente = "SELECT * FROM tb_documenti_cliente WHERE id_commessa = $id_commessa;";
	  $e_query_documenti_cliente = EseguiQuery($query_documenti_cliente,"selezione");
	  $this->num_documenti_cliente = $e_query_documenti_cliente->num_rows;
      return $e_query_documenti_cliente;
   }
   
   public function eliminaDocumentoCliente($id)
   {
       $query_documenti_cliente = "DELETE FROM tb_documenti_cliente WHERE id=$id;";
       $e_query_documenti_cliente = EseguiQuery($query_documenti_cliente,"selezione");
       return $e_query_documenti_cliente;
   }
   
   public function caricaDocumentoById($id)
   {
       $query_documenti_cliente = "SELECT * FROM tb_documenti_cliente WHERE id='$id';";
       $e_query_documenti_cliente = EseguiQuery($query_documenti_cliente,"selezione");
       $this->num_documenti_cliente = $e_query_documenti_cliente->num_rows;
       return $e_query_documenti_cliente;
   }
   
   public function eliminaAllegato($id)
   {
       $query_documenti_cliente = "UPDATE tb_documenti_cliente SET nome_allegato = '', link_allegato='' WHERE id=$id;";
       $e_query_documenti_cliente = EseguiQuery($query_documenti_cliente,"inserimento");
       return $e_query_documenti_cliente;
   }
   
   public function inserisciDocumentoCliente($id_commessa, $ente_rilascio, $descrizione, $data, $validita, $scadenza, $rinnovo, $target_path_inserimento, $filename)
   {
       $query_documenti_cliente = "INSERT INTO tb_documenti_cliente SET id_commessa = '$id_commessa', descrizione='$descrizione', data='$data', validita='$validita', scadenza='$scadenza', rinnovo = '$rinnovo', ente_rilascio = '$ente_rilascio', link_allegato='$target_path_inserimento', nome_allegato='$filename';";
	  $e_query_documenti_cliente = EseguiQuery($query_documenti_cliente,"inserimento");
      return $e_query_documenti_cliente;
   }
   
   public function filtraDocumentiCliente($filtro, $id_commessa)
   {
       $query_documenti_cliente = "SELECT * FROM tb_documenti_cliente WHERE id_commessa LIKE '$id_commessa' AND (ente_rilascio LIKE '%".$filtro."%' OR descrizione LIKE '%".$filtro."%');";
       $e_query_documenti_cliente = EseguiQuery($query_documenti_cliente,"selezione");
       $this->num_documenti_cliente = $e_query_documenti_cliente->num_rows;
       return $e_query_documenti_cliente;
   }

   public function modificaDocumnetoCliente($id, $id_commessa, $ente_rilascio, $descrizione, $data, $validita, $scadenza, $rinnovo, $target_path_modifica, $filename)
   {
       $insert_filename = ($filename != "") ? ", nome_allegato='$filename', link_allegato='$target_path_modifica'" : "";
       $insert_validita = ($validita != "") ? ", validita='$validita'" : "";
       $insert_scadenza = ($scadenza != "") ? ", scadenza='$scadenza'" : "";
       $insert_rinnovo = ($rinnovo != "") ? ", rinnovo='$rinnovo'" : "";
       $query_documenti_cliente = "UPDATE tb_documenti_cliente SET ente_rilascio = '$ente_rilascio', descrizione = '$descrizione', data = '$data' $insert_validita $insert_scadenza $insert_rinnovo $insert_filename WHERE id=$id;";
       $e_query_documenti_cliente = EseguiQuery($query_documenti_cliente,"inserimento");
       return $e_query_documenti_cliente;
   }
   
   public function numeroDocumentiCliente()
   {
      return $this->num_documenti_cliente;
   }
   
}

?>
