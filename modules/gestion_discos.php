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
        $sql = "DELETE from canciones 
                WHERE id_disco = :id;
                DELETE from discos 
                WHERE id = :id;";
        
        try {
            $state = $this->connection->prepare($sql);
            $state->bindParam(':id', $id);
            $state->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        } catch (PDOStatement $e) {
            return false;
        }        
    }

    public function get($id){
        $sql = "SELECT * FROM discos
                WHERE id = :id";

        try {
            $state = $this->connection->prepare($sql);
            $state->bindParam(':id', $id);
            $state->execute();
            return $state->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        } catch (PDOStatement $e) {
            return false;
        }        
    }

    public function modify($disco){
        
    }

    public function to_array(){
        $sql = "SELECT * FROM discos
                ORDER BY anio_publicacion DESC";
    
        try{
          $state = $this->connection->prepare($sql);
          $state->execute();
    
          $discos = $state->fetchAll();
    
          $sql = "SELECT * FROM canciones
                  WHERE id_disco=:id
                  ORDER BY posicion ASC";
          foreach ($discos as &$disk) {
            $state = $this->connection->prepare($sql);
            $state->bindParam(":id", $disk['id']);
            $state->execute();
    
            $disk['canciones'] = $state->fetchAll();
          }
    
          return $discos;
    
    
    
        } catch (PDOException $error){
          return false;
        }
    
      }



}