<?php

class Utenti
{  
   function __construct()
   {
		$this->num_utenti =0;   
	}
   
   public function caricaUtenti()
   {
	  $query_utenti = "SELECT * FROM tb_users ORDER BY cognome;";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_utenti = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }
   
   public function caricaUtenteById($id)
   {
	  $query_utenti = "SELECT * FROM tb_users WHERE id=$id;";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_utenti = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }
   
    public function caricaUtenteByUser($username)
   {
	  $query_utenti = "SELECT * FROM tb_users WHERE username LIKE '$username';";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_utenti = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }
   
   public function filtraUtenti($filtro)
   {
	  $query_utenti = "SELECT * FROM tb_users WHERE username LIKE '%".$filtro."%' OR ruolo LIKE '%".$filtro."%' OR nome LIKE '%".$filtro."%' OR cognome LIKE '%".$filtro."%' OR mansione LIKE '%".$filtro."%' OR email LIKE '%".$filtro."%' ORDER BY cognome;";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_utenti = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }
   
   public function inserisciUtente($username, $password, $ruolo, $nome, $cognome, $mansione, $email)
   {
	  $query_utenti = "INSERT INTO tb_users SET username = '$username', password='$password', ruolo='$ruolo', nome='$nome', cognome='$cognome', mansione='$mansione', email='$email';";
	  $e_query_utenti = EseguiQuery($query_utenti,"inserimento");
      return $e_query_utenti;
   }
   
   public function eliminaUtente($id)
   {
	  $query_utenti = "DELETE FROM tb_users WHERE id=$id;";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
      return $e_query_utenti;
   }
   
   public function modificaUtente($username, $password, $ruolo, $id, $nome, $cognome, $mansione, $email)
   {
	  $query_utenti = "UPDATE tb_users SET username = '$username', password='$password', ruolo='$ruolo', nome='$nome', cognome='$cognome', email='$email', mansione='$mansione' WHERE id=$id;";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
      return $e_query_utenti;
   }
   
   
   public function numeroUtenti()
   {
      return $this->num_utenti;
   }
   
}

?>
