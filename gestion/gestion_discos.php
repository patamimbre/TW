<?php

include_once "configuracion.inc";

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
        $sql = "SELECT * FROM discos
                ORDER BY id";
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

    public function add($disco, $canciones){
        $correcto = false;
        $sql_disco = "INSERT INTO discos
                    (nombre, anio_publicacion, caratula, precio)
                    VALUES
                    (:nombre, :anio_publicacion, :caratula, :precio)";
        try{
            $statement = $this->connection->prepare($sql_disco);
            $correcto = $statement->execute($disco);
        } catch(PDOException $error) {
            return false;
        }

        $id_disco = $this->getLastID();
        
        foreach($canciones as $c){
            $c['id_disco'] = $id_disco;
            $sql_canciones = " INSERT INTO canciones
                            (id_disco, nombre, duracion) VALUES
                            (:id_disco, :nombre, :duracion)";

            try{
                $statement = $this->connection->prepare($sql_canciones);
                $correcto = $statement->execute($c);
            } catch(PDOException $error) {
                return false;
            }
        }
        return true;
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

    public function getLastID(){
        $sql = "SELECT MAX(id) FROM discos";

        try {
            $state = $this->connection->prepare($sql);
            $state->execute();
            return $state->fetchColumn();
        } catch (PDOException $e) {
            return false;
        } catch (PDOStatement $e) {
            return false;
        }        
    }

    public function getSongs($id_disco){
        $sql = "SELECT * FROM canciones
                WHERE id_disco = :id_disco
                ORDER BY id_disco, id_cancion";

        try {
            $state = $this->connection->prepare($sql);
            $state->bindParam(':id_disco', $id_disco);
            $state->execute();
            return $state->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        } catch (PDOStatement $e) {
            return false;
        }        
    }

    public function modify($disco, $canciones){
        $correcto = false;
        foreach($canciones as $c){
            $sql = " UPDATE canciones SET
                        id_disco = :id_disco,
                        nombre = :nombre,
                        duracion = :duracion
                    WHERE id_cancion = :id_cancion";
            try{
                $statement = $this->connection->prepare($sql);
                $correcto = $statement->execute($c);
            } catch(PDOException $error) {
                return false;
            }
        }
        
        $sql = " UPDATE discos SET
                        nombre = :nombre,
                        anio_publicacion = :anio_publicacion,
                        caratula = :caratula,
                        precio = :precio
                    WHERE id = :id";
        try{
            $statement = $this->connection->prepare($sql);
            $correcto = $statement->execute($disco);
        } catch(PDOException $error) {
            return false;
        }

        return $correcto;
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