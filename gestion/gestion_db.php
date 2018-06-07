<?php
include_once "configuracion.inc";

class DB{
    private $connection;
    private $currentUser;

	public function __construct(){
		try {
			#Conecta a la DB
			$this->connection = new PDO(DB_DSN, DB_USUARIO, DB_PASS);
		} catch (PDOException $error) {
			echo "<br>Error <br> " . $error->getMessage();
		}
    }
}