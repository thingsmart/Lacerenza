<?php 	class Modello {

		public $id;
		public $idmodellomaster;
		public $idsezione;
		public $posizione;

		//ESTRAI TUTTI I DATI
		public static function getAll() {
			$query_dati = "SELECT * FROM tb_modello;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			$obj = array();
			if($e_query_dati -> num_rows > 0){
				while($row = $e_query_dati->fetch_object()){
					$obj[] = $row;
				}
			}
			return $obj;
		}
		
		//ESTRAI TUTTI I DATI
		public static function getAllModelloMasterOrder($id_modello) {
			$query_dati = "SELECT * FROM tb_modello WHERE id_modello_master = '$id_modello' ORDER BY posizione;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			$obj = array();
			if($e_query_dati -> num_rows > 0){
				while($row = $e_query_dati->fetch_object()){
					$obj[] = $row;
				}
			}
			return $obj;
		}
		
		//ESTRAI TUTTI I DATI
		public static function getAllModelloMasterOrderJoin($id_modello) {
			$query_dati = "SELECT tb_modello.id, tb_modello.id_modello_master, tb_modello.id_sezione, tb_modello.posizione, tb_sezione.id AS newId, tb_sezione.titolo, tb_sezione.testo, tb_sezione.oscura_titolo, tb_sezione.costo, tb_sezione.tipologia_costo, tb_sezione.link_file, tb_sezione.filename FROM tb_modello LEFT JOIN tb_sezione ON tb_modello.id_sezione = tb_sezione.id WHERE tb_modello.id_modello_master = '$id_modello' ORDER BY tb_modello.posizione;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			$obj = array();
			if($e_query_dati -> num_rows > 0){
				while($row = $e_query_dati->fetch_object()){
					$obj[] = $row;
				}
			}
			return $obj;
		}
		
		//ESTRAI TUTTI I DATI
		public static function getAllModelloMasterOrderJoinContabili($id_modello) {
			$query_dati = "SELECT tb_modello.id, tb_modello.id_modello_master, tb_modello.id_sezione, tb_modello.posizione, tb_sezione.id AS newId, tb_sezione.titolo, tb_sezione.testo, tb_sezione.oscura_titolo, tb_sezione.costo, tb_sezione.tipologia_costo, tb_sezione.link_file, tb_sezione.filename FROM tb_modello LEFT JOIN tb_sezione ON tb_modello.id_sezione = tb_sezione.id WHERE tb_modello.id_modello_master = '$id_modello' AND tb_sezione.costo != '' ORDER BY tb_modello.posizione;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			$obj = array();
			if($e_query_dati -> num_rows > 0){
				while($row = $e_query_dati->fetch_object()){
					$obj[] = $row;
				}
			}
			return $obj;
		}
		
		//ESTRAI TUTTI I DATI
		public static function getAllModelloOrderJoin($id_modello) {
			$query_dati = "SELECT tb_modello.id, tb_modello.id_modello_master, tb_modello.id_sezione, tb_modello.posizione, tb_sezione.id AS newId, tb_sezione.titolo, tb_sezione.testo, tb_sezione.oscura_titolo, tb_sezione.costo, tb_sezione.tipologia_costo, tb_sezione.link_file, tb_sezione.filename FROM tb_modello LEFT JOIN tb_sezione ON tb_modello.id_sezione = tb_sezione.id WHERE tb_modello.id_modello = '$id_modello' ORDER BY tb_modello.posizione;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			$obj = array();
			if($e_query_dati -> num_rows > 0){
				while($row = $e_query_dati->fetch_object()){
					$obj[] = $row;
				}
			}
			return $obj;
		}
		
		//ESTRAI TUTTI I DATI
		public static function getModelloOrderJoin($id_modello) {
			$query_dati = "SELECT tb_modello.id, tb_modello.id_modello_master, tb_modello.id_sezione, tb_modello.posizione, tb_sezione.id AS newId, tb_sezione.titolo, tb_sezione.testo, tb_sezione.oscura_titolo, tb_sezione.costo, tb_sezione.tipologia_costo, tb_sezione.link_file, tb_sezione.filename FROM tb_modello LEFT JOIN tb_sezione ON tb_modello.id_sezione = tb_sezione.id WHERE tb_modello.id = '$id_modello' ORDER BY tb_modello.posizione;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			if($e_query_dati -> num_rows > 0){
				$row = $e_query_dati->fetch_array();
			}
			return $row;
		}
		
		//ESTRAI TUTTI I DATI
		public static function getAllModelloMaster($id_modello) {
			$query_dati = "SELECT * FROM tb_modello WHERE id_modello_master = '$id_modello';";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			$obj = array();
			if($e_query_dati -> num_rows > 0){
				while($row = $e_query_dati->fetch_object()){
					$obj[] = $row;
				}
			}
			return $obj;
		}
		
		//PERSONALIZZA I CAMPI DI RICERCA
		public static function getFilter($filtro) {
			$query_dati = "SELECT * FROM tb_modello WHERE id_modello_master LIKE '%".$filtro."%' OR id_sezione LIKE '%".$filtro."%' OR posizione LIKE '%".$filtro."%';";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			$obj = array();
			if($e_query_dati -> num_rows > 0){
				while($row = $e_query_dati->fetch_object()){
					$obj[] = $row;
				}
			}
			return $obj;
		}
		
		//ESTRAI BY ID
		public static function getMax($idmodellomaster_post) {
			$query_dati = "SELECT MAX(posizione) as max FROM tb_modello WHERE id_modello_master=$idmodellomaster_post;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			if($e_query_dati -> num_rows > 0){
				$row = $e_query_dati->fetch_array();
			}
			return $row;
		}
		
		//ESTRAI BY ID
		public static function getById($id) {
			$query_dati = "SELECT * FROM tb_modello WHERE id=$id;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			if($e_query_dati -> num_rows > 0){
				$row = $e_query_dati->fetch_array();
					$obj = $row;
			}
			$object = new self;
			$object->id = $obj["id"];
			$object->idmodellomaster = $obj["id_modello_master"];
			$object->idsezione = $obj["id_sezione"];
			$object->posizione = $obj["posizione"];
			return $object;
		}

		//ELIMINA
		public function delete() {
			$query_dati = "DELETE FROM tb_modello WHERE id=$this->id;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			return $e_query_dati;
		}

		//INSERISCI (CONTROLLA I CAMPI DI INSERIMENTO)
		public function insert() {
	        $query_dati = "INSERT INTO tb_modello SET id_modello_master = '$this->idmodellomaster', id_sezione = '$this->idsezione', posizione = '$this->posizione';";
            $e_query_dati = EseguiQuery($query_dati, "inserimento");
            return $e_query_dati;
        }

		//MODIFICA (CONTROLLA I CAMPI DI MODIFICA)
        public function update() {
            $query_dati = "UPDATE tb_modello SET id_modello_master = '$this->idmodellomaster', id_sezione = '$this->idsezione', posizione = '$this->posizione' WHERE id=$this->id;";
            $e_query_dati = EseguiQuery($query_dati, "selezione");
            return $e_query_dati;
        }

		//MODIFICA (CONTROLLA I CAMPI DI MODIFICA)
        public function updatePosizione($id, $posizione) {
            $query_dati = "UPDATE tb_modello SET posizione = '$posizione' WHERE id=$id;";
            $e_query_dati = EseguiQuery($query_dati, "selezione");
            return $e_query_dati;
        }
		
		//SALVA
        public function save() {
			// Check object for id
			if (isset($this->id) && $this->id != "") {
				// Return update when id exists
				return $this->update();
			} else {
				// Return insert when id does not exists
				return $this->insert();
			}
		}
	}

?>
		