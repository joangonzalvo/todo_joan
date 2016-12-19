<?php
function conecta($host,$usr,$pw,$db){

	try{
		$mysqli = new mysqli($host,$usr,$pw,$db);
		$connected = true;

	}catch(mysqli_sql_exception $e){
		throw $e;

	}
	return $db;
}

?>