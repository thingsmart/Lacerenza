<?php

class Contabilita
{
   function __construct()
   {
		$this->num = 0;
	}

   public function carica($id_commessa)
   {
       $query_fatture = "SELECT * FROM tb_contabilita WHERE id_commessa = $id_commessa;";
	  $e_query = EseguiQuery($query_fatture,"selezione");
	  $this->num = $e_query->num_rows;
      return $e_query;
   }

    public function caricaById($id)
    {
        $query_fatture = "SELECT * FROM tb_contabilita WHERE id = $id;";
        $e_query = EseguiQuery($query_fatture,"selezione");
        $this->num = $e_query->num_rows;
        return $e_query;
    }

   public function elimina($id)
   {
       $query_fatture = "DELETE FROM tb_contabilita WHERE id=$id;";
       $e_query = EseguiQuery($query_fatture,"selezione");
       return $e_query;
   }


   public function inserisci($id_commessa, $descrizione_lavori, $p1, $b, $l, $a, $p, $target_path_inserimento, $filename, $prezzo, $importo)
   {
       $query_fatture = "INSERT INTO tb_contabilita SET id_commessa = '$id_commessa', descrizione_lavori='$descrizione_lavori', prezzo='$prezzo', importo='$importo', p1='$p1', b='$b', l = '$l', a='$a', p='$p', link_allegato='$target_path_inserimento', nome_allegato='$filename';";
       $e_query = EseguiQuery($query_fatture,"inserimento");
       return $e_query;
   }


   public function eliminaAllegato($id)
   {
       $query_fatture = "UPDATE tb_contabilita SET nome_allegato = '', link_allegato='' WHERE id=$id;";
       $e_query = EseguiQuery($query_fatture,"inserimento");
       return $e_query;
   }

   public function modifica($id, $id_commessa, $descrizione_lavori, $p1, $b, $l, $a, $p, $target_path_inserimento, $filename, $prezzo, $importo)
   {
       $insert_filename = ($filename != "") ? ", nome_allegato='$filename', link_allegato='$target_path_inserimento'" : "";
       $query_fatture = "UPDATE tb_contabilita SET id_commessa = '$id_commessa', descrizione_lavori='$descrizione_lavori', prezzo='$prezzo', importo='$importo', p1='$p1', b='$b', l = '$l', a='$a', p='$p' $insert_filename WHERE id=$id;";
       $e_query = EseguiQuery($query_fatture,"inserimento");
       return $e_query;
   }


   public function numero()
   {
      return $this->num;
   }

}

?>
