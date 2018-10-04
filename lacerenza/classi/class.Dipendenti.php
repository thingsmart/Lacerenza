<?php

class Dipendenti
{  
   function __construct()
   {
		$this->num_dipendenti =0;   
	}
   
   public function caricaDipendenti()
   {
	  $query_utenti = "SELECT * FROM tb_dipendenti ORDER BY cognome;";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_dipendenti = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }
   
   public function caricaDipendentiRuolino()
   {
	  $query_utenti = "SELECT * FROM tb_dipendenti WHERE attivo = 'ATTIVO' ORDER BY cognome;";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_dipendenti = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }

    public function caricaDipendentiRuolinoNew()
    {
        $query_utenti = "SELECT * FROM tb_dipendenti WHERE attivo = 'ATTIVO' OR attivo = 'IMPIEGATO' ORDER BY cognome;";
        $e_query_utenti = EseguiQuery($query_utenti,"selezione");
        $this->num_dipendenti = $e_query_utenti->num_rows;
        return $e_query_utenti;
    }


    public function caricaDipendentiRuolinoAllCosti()
    {
        $query_utenti = "SELECT * FROM tb_dipendenti;";
        $e_query_utenti = EseguiQuery($query_utenti,"selezione");
        $this->num_dipendenti = $e_query_utenti->num_rows;
        return $e_query_utenti;
    }


   public function caricaDipendentiRuolinoAll()
   {
	  $query_utenti = "SELECT * FROM tb_dipendenti WHERE attivo = 'ATTIVO'  OR attivo = 'TERZI' OR attivo = 'IMPIEGATO';";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_dipendenti = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }

    public function caricaDipendentiRuolinoAllNEW()
    {
        $query_utenti = "SELECT * FROM tb_dipendenti WHERE attivo = 'ATTIVO'  OR  attivo = 'NON_ATTIVO'  OR attivo = 'TERZI' OR attivo = 'IMPIEGATO';";
        $e_query_utenti = EseguiQuery($query_utenti,"selezione");
        $this->num_dipendenti = $e_query_utenti->num_rows;
        return $e_query_utenti;
    }
   
   public function caricaDipendentiRuolinoCommesse($id_commessa, $data)
   {
	  $query_utenti = "SELECT 
  `tb_dipendenti`.`id`,
  `tb_dipendenti`.`nome`,
  `tb_dipendenti`.`cognome`,
  `tb_dipendenti`.`attivo`,
  `tb_presenze`.`n_ore`,
  `tb_presenze`.`data`,
  `tb_presenze`.`id_commessa`,
  `tb_commesse`.`cantiere`,
  `tb_commesse`.`data_inizio`,
  `tb_commesse`.`data_fine`
FROM
  `tb_presenze`
  INNER JOIN `tb_dipendenti` ON (`tb_presenze`.`id_dipendente` = `tb_dipendenti`.`id`)
  INNER JOIN `tb_commesse` ON (`tb_presenze`.`id_commessa` = `tb_commesse`.`id`)
  WHERE  `tb_dipendenti`.`attivo` = 'ATTIVO' AND `tb_presenze`.`id_commessa` = $id_commessa AND `tb_presenze`.`data` = '$data';";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_dipendenti = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }
   
   public function filtraDipendentiRuolinoCommessa($filtro, $id_commessa, $data)
   {
	  $query_utenti = "SELECT 
  `tb_dipendenti`.`id`,
  `tb_dipendenti`.`nome`,
  `tb_dipendenti`.`cognome`,
  `tb_dipendenti`.`attivo`,
  `tb_presenze`.`n_ore`,
  `tb_presenze`.`data`,
  `tb_presenze`.`id_commessa`,
  `tb_commesse`.`cantiere`,
  `tb_commesse`.`data_inizio`,
  `tb_commesse`.`data_fine`
FROM
  `tb_presenze`
  INNER JOIN `tb_dipendenti` ON (`tb_presenze`.`id_dipendente` = `tb_dipendenti`.`id`)
  INNER JOIN `tb_commesse` ON (`tb_presenze`.`id_commessa` = `tb_commesse`.`id`)
  WHERE  `tb_dipendenti`.`attivo` = 'ATTIVO' AND `tb_presenze`.`id_commessa` = $id_commessa AND `tb_presenze`.`data` = '$data' AND (nome LIKE '%".$filtro."%' OR cognome LIKE '%".$filtro."%');";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_dipendenti = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }

    public function filtraDipendentiRuolinoCommessaDaData($filtro, $id_commessa, $data, $da_data)
    {
        $query_utenti = "SELECT
  `tb_dipendenti`.`id`,
  `tb_dipendenti`.`nome`,
  `tb_dipendenti`.`cognome`,
  `tb_dipendenti`.`attivo`,
  `tb_presenze`.`n_ore`,
  `tb_presenze`.`data`,
  `tb_presenze`.`id_commessa`,
  `tb_commesse`.`cantiere`,
  `tb_commesse`.`data_inizio`,
  `tb_commesse`.`data_fine`
FROM
  `tb_presenze`
  INNER JOIN `tb_dipendenti` ON (`tb_presenze`.`id_dipendente` = `tb_dipendenti`.`id`)
  INNER JOIN `tb_commesse` ON (`tb_presenze`.`id_commessa` = `tb_commesse`.`id`)
  WHERE  `tb_dipendenti`.`attivo` = 'ATTIVO' AND `tb_presenze`.`id_commessa` = $id_commessa AND `tb_presenze`.`data` >= '$data' AND `tb_presenze`.`data` <= '$da_data' AND (nome LIKE '%".$filtro."%' OR cognome LIKE '%".$filtro."%');";
        $e_query_utenti = EseguiQuery($query_utenti,"selezione");
        $this->num_dipendenti = $e_query_utenti->num_rows;
        return $e_query_utenti;
    }

    public function filtraDipendentiRuolinoCommessaDaDataNew($filtro, $id_commessa, $data, $da_data)
    {
        $query_utenti = "SELECT
  `tb_dipendenti`.`id`,
  `tb_dipendenti`.`nome`,
  `tb_dipendenti`.`cognome`,
  `tb_dipendenti`.`attivo`,
  `tb_presenze`.`n_ore`,
  `tb_presenze`.`data`,
  `tb_presenze`.`id_commessa`,
  `tb_commesse`.`cantiere`,
  `tb_commesse`.`data_inizio`,
  `tb_commesse`.`data_fine`
FROM
  `tb_presenze`
  INNER JOIN `tb_dipendenti` ON (`tb_presenze`.`id_dipendente` = `tb_dipendenti`.`id`)
  INNER JOIN `tb_commesse` ON (`tb_presenze`.`id_commessa` = `tb_commesse`.`id`)
  WHERE  (`tb_dipendenti`.`attivo` = 'ATTIVO' OR `tb_dipendenti`.`attivo` = 'IMPIEGATO') AND `tb_presenze`.`id_commessa` = $id_commessa AND `tb_presenze`.`data` >= '$data' AND `tb_presenze`.`data` <= '$da_data' AND (nome LIKE '%".$filtro."%' OR cognome LIKE '%".$filtro."%');";
        $e_query_utenti = EseguiQuery($query_utenti,"selezione");
        $this->num_dipendenti = $e_query_utenti->num_rows;
        return $e_query_utenti;
    }
   
   public function filtraDipendentiRuolino($filtro)
   {
	  $query_utenti = "SELECT * FROM tb_dipendenti WHERE (attivo = 'ATTIVO' || attivo = 'TERZI') AND (nome LIKE '%".$filtro."%' OR cognome LIKE '%".$filtro."%');";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_dipendenti = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }

    public function filtraDipendentiRuolinoNew($filtro)
    {
        $query_utenti = "SELECT * FROM tb_dipendenti WHERE (attivo = 'ATTIVO' || attivo = 'TERZI' || attivo = 'IMPIEGATO') AND (nome LIKE '%".$filtro."%' OR cognome LIKE '%".$filtro."%');";
        $e_query_utenti = EseguiQuery($query_utenti,"selezione");
        $this->num_dipendenti = $e_query_utenti->num_rows;
        return $e_query_utenti;
    }

   public function caricaDipendenteById($id)
   {
	  $query_utenti = "SELECT * FROM tb_dipendenti WHERE id=$id;";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_dipendenti = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }
   
   public function filtraDipendenti($filtro)
   {
	  $query_utenti = "SELECT * FROM tb_dipendenti WHERE nome LIKE '%".$filtro."%' OR cognome LIKE '%".$filtro."%' ORDER BY cognome;";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
	  $this->num_dipendenti = $e_query_utenti->num_rows;
      return $e_query_utenti;
   }
   
   public function inserisciDipendente($nome, $cognome, $attivo)
   {
	  $query_utenti = "INSERT INTO tb_dipendenti SET attivo='$attivo', nome='$nome', cognome='$cognome';";
	  $e_query_utenti = EseguiQuery($query_utenti,"inserimento");
      return $e_query_utenti;
   }
   
   public function eliminaDipendente($id)
   {
	  $query_utenti = "DELETE FROM tb_dipendenti WHERE id=$id;";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
      return $e_query_utenti;
   }
   
   public function modificaDipendente($id, $nome, $cognome, $attivo)
   {
	  $query_utenti = "UPDATE tb_dipendenti SET attivo='$attivo', nome='$nome', cognome='$cognome' WHERE id=$id;";
	  $e_query_utenti = EseguiQuery($query_utenti,"selezione");
      return $e_query_utenti;
   }
   
   
   public function numeroDipendenti()
   {
      return $this->num_dipendenti;
   }
   
}

?>
