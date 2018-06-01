<?php

include_once "configuracion.inc";
include_once "./../common.php";

class GestionDiscos{
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

    public function all(){
        $sql = "SELECT * FROM discos";
        try {
            $state = $this->connection->prepare($sql);
            $state->execute();

            return $state->fetchAll();
        } catch (PDOException $e) {
            return false;
        } catch (PDOStatement $e) {
            return false;
        }
    }

    public function add($disco, $array_canciones){

    }

    public function delete($id){

    }

    public function get($id){

    }

    public function modify($disco){
        
    }



}