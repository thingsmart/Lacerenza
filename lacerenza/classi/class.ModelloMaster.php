<?php 	class ModelloMaster {

		public $id;
		public $titolo;

		//ESTRAI TUTTI I DATI
		public static function getAll() {
			$query_dati = "SELECT * FROM tb_modello_master;";
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
			$query_dati = "SELECT * FROM tb_modello_master WHERE titolo LIKE '%".$filtro."%';";
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
			$query_dati = "SELECT * FROM tb_modello_master WHERE id=$id;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			if($e_query_dati -> num_rows > 0){
				$row = $e_query_dati->fetch_array();
					$obj = $row;
			}
			$object = new self;
			$object->id = $obj["id"];
			$object->titolo = $obj["titolo"];
			return $object;
		}

		//ELIMINA
		public function delete() {
			$query_dati = "DELETE FROM tb_modello_master WHERE id=$this->id;";
			$e_query_dati = EseguiQuery($query_dati, "selezione");
			return $e_query_dati;
		}

		//INSERISCI (CONTROLLA I CAMPI DI INSERIMENTO)
		public function insert() {
	        $query_dati = "INSERT INTO tb_modello_master SET titolo = '$this->titolo';";
            $e_query_dati = EseguiQuery($query_dati, "inserimento");
            return $e_query_dati;
        }

		//MODIFICA (CONTROLLA I CAMPI DI MODIFICA)
        public function update() {
            $query_dati = "UPDATE tb_modello_master SET titolo = '$this->titolo' WHERE id=$this->id;";
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
		