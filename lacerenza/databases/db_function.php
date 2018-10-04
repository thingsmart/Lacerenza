<?php
function connectIIS(){
$serverName = "192.168.0.1, 1433"; //serverName\instanceName, portNumber (default is 1433)
$connectionInfo = array( "Database"=>"lacerenza", "UID"=>"jetbit", "PWD"=>"J3tbit15");

$conn = sqlsrv_connect( $serverName, $connectionInfo);

return $conn;
}

function EseguiQuery ($query, $tipo ='sp', $nomeDB = "my_lacerenza")
	{
		
		$serverDB = "localhost";
		$usernameDB = "root";
		$passwordDB = "root";

		// $serverDB = "54.149.36.188";
		// $usernameDB = "root";
        // $passwordDB = "20Jetbit14";

		/*$serverDB = "54.149.36.188";	
		$usernameDB = "root";
        $passwordDB = "20Jetbit14";*/
		//mysqli_set_charset("utf8", $query);
		
		//$query = utf8_decode($query);  //aggiunta per la gestione degli accenti in ambienti con charset iso-8859-1
		
		$mysqli = new mysqli($serverDB, $usernameDB, $passwordDB, $nomeDB);
		// switch ($tipo) {
		// case 'selezione':
			// $RecordsetRisultati = $mysqli -> query($query);
			// if ($RecordsetRisultati == FALSE) {return "Errore sulla query: <br> $query <br> ";exit;}
			// return $RecordsetRisultati;
			// $RecordsetRisultati -> close();
		// break;
		// case 'inserimento':
			// if ($mysqli -> query($query) == FALSE) {$errore = $mysqli -> error;return $errore;exit;}
			// $id = $mysqli -> insert_id;
			// return $id;
			// $id -> close();
		// break;
		// case 'update':
			// if ($mysqli -> query($query) == FALSE) {$errore = $mysqli -> error;return $errore;exit;}
			// $affected_rows = $mysqli -> affected_rows;
			// return $affected_rows;
			// $affected_rows -> close();
		// break;
		// case 'sp':
			// $RecordsetRisultati =  $mysqli->query("CALL $query");
			// if ($RecordsetRisultati == FALSE) 
				// {
				// $errore = $mysqli -> errno;
				// $errore .= ": ".$mysqli -> error;
				// return $errore;
				// exit;
				// }
			// return $RecordsetRisultati;
			// $RecordsetRisultati -> close();
		// break;
		// case 'multi_query':
			// $query = "START TRANSACTION;".$query;
			// $query .="COMMIT;";
			// $res = $mysqli -> multi_query($query);
			// $lastID = "";
			// do { 
				// if ($lastID == ""){$lastID = $mysqli-> insert_id;}
			// } while ($mysqli->next_result());
			// if ($mysqli -> errno > 0) {return "errore: ".$mysqli -> errno.": ".$mysqli -> error;exit;}
			// return $lastID;
			// $res -> close();
		// break;
		switch ($tipo) {
			case 'selezione':
				$RecordsetRisultati = $mysqli->query($query);
				if ($RecordsetRisultati == FALSE) {
					return "Errore sulla query: <br> $query <br> ";
					exit;
				}
				return $RecordsetRisultati;
				$RecordsetRisultati->close();
				break;
			case 'inserimento':
				if ($mysqli->query($query) == FALSE) {
					$errore = $mysqli->error;
					return $errore;
					exit;
				}
				$id = $mysqli->insert_id;
				return $id;
				$id->close();
				break;
			case 'update':
				if ($mysqli->query($query) == FALSE) {
					$errore = $mysqli->error;
					return $errore;
					exit;
				}
				$affected_rows = $mysqli->affected_rows;
				return $affected_rows;
				$affected_rows->close();
				break;
			case 'sp':
				$RecordsetRisultati = $mysqli->query("CALL $query");
				if ($RecordsetRisultati == FALSE) {
					$errore = $mysqli->errno;
					$errore .= ": " . $mysqli->error;
					return $errore;
					exit;
				}
				return $RecordsetRisultati;
				$RecordsetRisultati->close();
				break;
			case 'multi_query':
				$query = "START TRANSACTION;" . $query;
				$query .= "COMMIT;";
				$res = $mysqli->multi_query($query);
				$lastID = "";
				do {
					if ($lastID == "") {
						$lastID = $mysqli->insert_id;
					}
				} while ($mysqli->next_result());
				if ($mysqli->errno > 0) {
					return "errore: " . $mysqli->errno . ": " . $mysqli->error;
					exit;
				}
				return $lastID;
				$res->close();
				break;
		}
		$mysqli->close();

		
		
	}
?>