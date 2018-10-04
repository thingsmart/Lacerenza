<?php
session_start();

class Manutenzione
{  
   function __construct()
   {
		$this->numero =0;   
	}
   
   //Carico gli alegati relativi ad una commessa
   public function carica($data)
   {
	  $query = "SELECT * FROM tb_manutenzione WHERE data='$data';";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   //Carico gli alegati relativi ad una commessa
   public function caricaUltima($id)
   {
	  $query = "SELECT * FROM tb_manutenzione WHERE id_mezzo='$id' ORDER BY data DESC LIMIT 1;";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
   
   public function caricaMese($mese, $anno, $id)
   {
   	 $data_inizio = date($anno."-".$mese."-01"); 
   	 $data_fine = date($anno."-".$mese."-31"); 
	  $query = "SELECT * FROM tb_manutenzione WHERE data >='$data_inizio' AND data <= '$data_fine' AND id_mezzo = $id;";
	  $e_query = EseguiQuery($query,"selezione");
	  $this->numero = $e_query->num_rows;
      return $e_query;
   }
   
  
   
   
   //inserisco un nuovo allegato
   public function inserisci($id_mezzo,$mezzo, $data,$libretto,$assicurazione,$olio_cambio,$olio_motore,$estintori,$pneumatici,$elettrico,$triangolo,$giubbino,$vetri,$pronto_soccorso,$carrozzeria,$freni,$luci,$tergicristalli,$indicatori,$climatizzatore,$altro,$note)
   {
   	  $utente = $_SESSION['username'];
	  $query = "INSERT INTO tb_manutenzione SET assicurazione='$assicurazione', olio_motore='$olio_motore', pneumatici='$pneumatici', vetri='$vetri', pronto_soccorso='$pronto_soccorso', altro='$altro', note='$note', climatizzatore='$climatizzatore', indicatori='$indicatori', tergicristalli='$tergicristalli', luci='$luci', freni='$freni', carrozzeria='$carrozzeria', giubbino='$giubbino', triangolo='$triangolo', elettrico='$elettrico', estintori='$estintori', olio_cambio='$olio_cambio', libretto='$libretto', utente='$utente', data='$data', mezzo='$mezzo', id_mezzo='$id_mezzo';";
	  $e_query = EseguiQuery($query,"inserimento");
      //return $query;
      return $e_query;
   }
   
   public function modifica($id, $id_mezzo,$mezzo, $data,$libretto,$assicurazione,$olio_cambio,$olio_motore,$estintori,$pneumatici,$elettrico,$triangolo,$giubbino,$vetri,$pronto_soccorso,$carrozzeria,$freni,$luci,$tergicristalli,$indicatori,$climatizzatore,$altro,$note){
   	$utente = $_SESSION['username'];
	  $query = "UPDATE tb_manutenzione SET assicurazione='$assicurazione', olio_motore='$olio_motore', pneumatici='$pneumatici', vetri='$vetri', pronto_soccorso='$pronto_soccorso', altro='$altro', note='$note', climatizzatore='$climatizzatore', indicatori='$indicatori', tergicristalli='$tergicristalli', luci='$luci', freni='$freni', carrozzeria='$carrozzeria', giubbino='$giubbino', triangolo='$triangolo', elettrico='$elettrico', estintori='$estintori', olio_cambio='$olio_cambio', libretto='$libretto', utente='$utente', data='$data', mezzo='$mezzo', id_mezzo='$id_mezzo' WHERE id='$id';";
	  $e_query = EseguiQuery($query,"inserimento");
      return $e_query;
   }
   
    //elimino un allegato
    public function elimina($id)
   {
	  $query = "DELETE FROM tb_manutenzione WHERE id=$id;";
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
