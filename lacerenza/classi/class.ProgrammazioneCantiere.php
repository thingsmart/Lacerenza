<?php
session_start();

class ProgrammazioneCantiere
{  
   function __construct()
   {
		$this->numero =0;   
	}
   
   //Carico gli alegati relativi ad una commessa
   public function carica($data)
   {
	  $query = "SELECT * FROM tb_programmazione_cantiere WHERE data='$data';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   public function caricaById($id)
   {
	  $query = "SELECT * FROM tb_programmazione_cantiere WHERE id='$id';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   
   //inserisco un nuovo allegato
   public function inserisci($id_commessa, $cod_commessa, $descrizione_commessa, $id_lavoro, $cod_lavoro, $descrizione_lavoro, $id_dipendenti, $addetti, $id_mezzo, $mezzo, $note, $data, $tipologia_lavoro="")
   {
   	  $utente = $_SESSION['username'];
	  $query = "INSERT INTO tb_programmazione_cantiere SET tipologia_lavoro='$tipologia_lavoro', data='$data', note='$note', id_lavoro='$id_lavoro', cod_lavoro='$cod_lavoro', id_dipendenti='$id_dipendenti', id_mezzo='$id_mezzo', utente='$utente', mezzo='$mezzo', addetti='$addetti', descrizione_lavoro='$descrizione_lavoro', id_commessa = '$id_commessa', cod_commessa='$cod_commessa', descrizione_commessa='$descrizione_commessa';";
	  $e_query = EseguiQuery($query,"inserimento");
      //return $query;
      return $e_query;
   }
   
   public function modifica($id, $id_commessa, $cod_commessa, $descrizione_commessa, $id_lavoro, $cod_lavoro, $descrizione_lavoro, $id_dipendenti, $addetti, $id_mezzo, $mezzo, $note, $data, $tipologia_lavoro){
   	$utente = $_SESSION['username'];
	  $query = "UPDATE tb_programmazione_cantiere SET tipologia_lavoro='$tipologia_lavoro', data='$data', note='$note', id_lavoro='$id_lavoro', cod_lavoro='$cod_lavoro', id_dipendenti='$id_dipendenti', id_mezzo='$id_mezzo', utente='$utente', mezzo='$mezzo', addetti='$addetti', descrizione_lavoro='$descrizione_lavoro', id_commessa = '$id_commessa', cod_commessa='$cod_commessa', descrizione_commessa='$descrizione_commessa' WHERE id='$id';";
	  $e_query = EseguiQuery($query,"inserimento");
      return $e_query;
   }
   
    //elimino un allegato
    public function elimina($id)
   {
	  $query = "DELETE FROM tb_programmazione_cantiere WHERE id=$id;";
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
