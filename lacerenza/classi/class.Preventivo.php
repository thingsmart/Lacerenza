<?php 	class Preventivo {

		public $id;
		public $idpreventivomaster;
		public $idmodello;
		public $costo;
		public $quantita;
		public $descrizioneaggiornata;

		//ESTRAI TUTTI I DATI
		public static function getAll() {
			$query_dati = "SELECT * FROM tb_preventivo;";
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
			$query_dati = "SELECT * FROM tb_preventivo WHERE id_preventivo_master LIKE '%".$filtro."%' OR id_modello LIKE '%".$filtro."%' OR costo LIKE '%".$filtro."%';";
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
		public static function getById($id) {
			$query_dati = "SELECT * FROM tb_preventivo WHERE id=$id;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			if($e_query_dati -> num_rows > 0){
				$row = $e_query_dati->fetch_array();
					$obj = $row;
			}
			$object = new self;
			$object->id = $obj["id"];
			$object->idpreventivomaster = $obj["id_preventivo_master"];
			$object->idmodello = $obj["id_modello"];
			$object->costo = $obj["costo"];
			$object->quantita = $obj["quantita"];
			$object->descrizioneaggiornata = $obj["descrizione_aggiornata"];
			return $object;
		}

		//ESTRAI BY ID
		public static function getByPreventivo($idprev, $idmod) {
			$query_dati = "SELECT * FROM tb_preventivo WHERE id_preventivo_master=$idprev AND id_modello = $idmod;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			if($e_query_dati -> num_rows > 0){
				$row = $e_query_dati->fetch_array();
					$obj = $row;
			}
			$object = new self;
			$object->id = $obj["id"];
			$object->idpreventivomaster = $obj["id_preventivo_master"];
			$object->idmodello = $obj["id_modello"];
			$object->costo = $obj["costo"];
			$object->quantita = $obj["quantita"];
			$object->descrizioneaggiornata = $obj["descrizione_aggiornata"];
			return $object;
		}
		
		//ESTRAI BY ID
		public static function getByIdJoin($id) {
			$query_dati = "SELECT tb_preventivo.id, tb_preventivo.id_preventivo_master, tb_preventivo.id_modello, tb_preventivo.costo, tb_preventivo.quantita, tb_preventivo.descrizione_aggiornata, tb_modello_master.id as newId, tb_modello_master.titolo FROM tb_preventivo LEFT JOIN tb_modello_master ON tb_preventivo.id_modello_master = tb_modello_master.id WHERE tb_preventivo.id=$id;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			if($e_query_dati -> num_rows > 0){
				$row = $e_query_dati->fetch_array();
			}

			return $row;
		}
		//ELIMINA
		public function delete() {
			$query_dati = "DELETE FROM tb_preventivo WHERE id=$this->id;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			return $e_query_dati;
		}

		//INSERISCI (CONTROLLA I CAMPI DI INSERIMENTO)
		public function insert() {
	        $query_dati = "INSERT INTO tb_preventivo SET id_preventivo_master = '$this->idpreventivomaster', id_modello = '$this->idmodello', costo = '$this->costo', quantita = '$this->quantita', descrizione_aggiornata = '$this->descrizioneaggiornata';";
            $e_query_dati = EseguiQuery($query_dati, "inserimento");
            return $e_query_dati;
        }

		//MODIFICA (CONTROLLA I CAMPI DI MODIFICA)
        public function update_costo() {
            $query_dati = "UPDATE tb_preventivo SET id_preventivo_master = '$this->idpreventivomaster', id_modello = '$this->idmodello', costo = '$this->costo' WHERE id=$this->id;";
            $e_query_dati = EseguiQuery($query_dati, "selezione");
            return $e_query_dati;
        }

		//MODIFICA (CONTROLLA I CAMPI DI MODIFICA)
        public function update_quantita() {
            $query_dati = "UPDATE tb_preventivo SET id_preventivo_master = '$this->idpreventivomaster', id_modello = '$this->idmodello', quantita = '$this->quantita' WHERE id=$this->id;";
            $e_query_dati = EseguiQuery($query_dati, "selezione");
            return $e_query_dati;
        }

		//MODIFICA (CONTROLLA I CAMPI DI MODIFICA)
        public function update_descrizione() {
            $query_dati = "UPDATE tb_preventivo SET id_preventivo_master = $this->idpreventivomaster, id_modello = $this->idmodello, descrizione_aggiornata = '$this->descrizioneaggiornata' WHERE id=$this->id;";
            $e_query_dati = EseguiQuery($query_dati, "selezione");
            return $e_query_dati;
        }
        
		// //SALVA
        // public function save($operazione) {
			// // Check object for id
			// if (isset($this->id) && $this->id != "") {
				// if($operazione == 'costo') {
					// return $this->update_costo();
				// } else if($operazione == 'quantita') {
					// return $this->update_quantita();
				// } else if($operazione == 'descrizione') {
					// return $this->update_descrizione();
				// } 
			// } else {
				// // Return insert when id does not exists
				// return $this->insert;
			// }
		// }
        
		//SALVA
        public function save() {
			// Check object for id
			if (isset($this->id) && $this->id != "") {
					return $this->update_costo();

			} else {
				// Return insert when id does not exists
				return $this->insert;
			}
		}
		
		
	}

?>
		