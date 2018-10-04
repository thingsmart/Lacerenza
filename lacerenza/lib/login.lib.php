<?php
session_start();
include("GetSQLValueString.php");
include('../databases/db_function.php');

$username = $_POST["username"];
$password = $_POST["password"];

$query = sprintf("SELECT * FROM tb_users WHERE username = %s AND MD5(CONCAT(tb_users.password)) = %s",
				GetSQLValueString($username,"text"),
				GetSQLValueString($password,"text"));				

$res = EseguiQuery($query,"selezione");

if (($res -> num_rows) == 1){	//se la query ritorna una riga vuol dire che i dati sono corretti
	
		$row = $res -> fetch_array();
		
		$_SESSION['username'] = $row['username'];
		$_SESSION['id_utente'] = $row['id'];
		$_SESSION['ruolo'] = $row['ruolo'];
		
		$home = "home.php";
		echo $home;
		exit;
			
}//end if
else{
	echo "ERROR";
}
?>