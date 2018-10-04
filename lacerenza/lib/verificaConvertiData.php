<?php

//converte la data al formato voluto (dd-mm-yyyy)
function CapovolgiData($data){
	
	$separatori = array(":", ";", ",", "-"," ");
	$data = str_replace($separatori, "/", $data);
	$data = explode("/", $data);

	$data=$data[2]."-".$data[1]."-".$data[0];
	return $data;
}
?>