<?php
	function conectar(){
		try {
			$con = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
		} catch (PDOException $e) {
			die("Não foi possível conectar no banco de dados");
		}
		return $con;
	}