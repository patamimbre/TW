<?php

include_once "configuracion.inc";
include_once "./../common.php";

class GestionConciertos{
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
        $sql = "SELECT * FROM conciertos";
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

    public function add($concierto){
        $sql = "INSERT INTO conciertos
		(fecha,hora,localización)
		VALUES
		(:fecha, :hora, :localizacion);";

		# No es necesario validar los datos introducidos,
		# PDO se encarga de hacerlo automáticamente
		try{
			$state = $this->connection->prepare($sql);
			$state->bindParam(':fecha',$concierto['fecha']);
			$state->bindParam(':hora',$concierto['hora']);
			$state->bindParam(':localizacion',$concierto['localizacion']);
			$state->execute();
            return true;
            
		} catch (PDOException $error){
			return false;
		}
    }

    public function delete($id){
        $sql = "DELETE FROM conciertos where id = :id";
        try{
            $state = $this->connection->prepare($sql);
            $state->bindParam(':id',$id);
            $state->execute();
            return true;
        } catch (PDOException $error){
            return false;
        }
    }

    public function get($id){
        try {
            $sql = "SELECT * FROM conciertos WHERE id = :id";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);

        } catch(PDOException $error) {
            return false;
        }
    }

    public function modify($concierto){
        $sql = "UPDATE conciertos
                SET
                    fecha = :fecha,
                    hora = :hora,
                    localizacion = :localizacion
                WHERE id = :id";
        try{
            $statement = $this->connection->prepare($sql);
            return $statement->execute($concierto);
        } catch(PDOException $error) {
            return false;
        }
    }

    public function search($param){
        $sql = "SELECT * FROM conciertos
                WHERE fecha LIKE '%:param%'
                OR localizacion LIKE '%:param%'";
    
        try{
          $state = $this->connection->prepare($sql);
          $state->bindParam(':param', $param);
          $state->execute();
    
          $result = $state->fetchAll();
          print_r($result);
    
        } catch (PDOException $error){
          echo "<br>Error <br> " . $error->getMessage();
        }
    
      }
    
    public function to_array(){
    $sql = "SELECT * FROM conciertos
            ORDER BY fecha ASC";

    try{
        $state = $this->connection->prepare($sql);
        $state->execute();

        return $state->fetchAll();

    } catch (PDOException $error){
        echo "<br>Error <br> " . $error->getMessage();
    }

    }



}