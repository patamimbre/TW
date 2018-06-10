<?php

include_once "configuracion.inc";

class GestionBiografia{

	private $connection;

	public function __construct(){
		try {
			#Conecta a la DB
			$this->connection = new PDO(DB_DSN, DB_USUARIO, DB_PASS);
		} catch (PDOException $error) {
			echo "<br>Error <br> " . $error->getMessage();
		}
    }
    
    public function all(){
        $sql = "SELECT * FROM biografia";
        try {
            $state = $this->connection->prepare($sql);
            $state->execute();

            return $state->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        } catch (PDOStatement $e) {
            return false;
        }
    }

	public function add($text){
	
		$sql = "INSERT INTO biografia (parrafo)
		VALUES
		(:parrafo);";

		# No es necesario validar los datos introducidos,
		# PDO se encarga de hacerlo automáticamente
		try{
			$state = $this->connection->prepare($sql);
			$state->bindParam(':parrafo',$text);
			return $state->execute();
		} catch (PDOException $error){
			return false;
		}
	}


	public function delete($id){
		$sql = "DELETE FROM biografia where id = :id";
		try{
			$state = $this->connection->prepare($sql);
			$state->bindParam(':id',$id);
			return $state->execute();
		} catch (PDOException $error){
			return false;
		}
	}

	public function get($id){
		try {
            $sql = "SELECT * FROM biografia WHERE id = :id";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();

		return $statement->fetch(PDO::FETCH_ASSOC);
		} catch(PDOException $error) {
			return false;
		}
	}
	
	public function modify($id, $texto){
		$sql = "UPDATE biografia
			SET
				parrafo = :parrafo
			WHERE id = :id";
		try{
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->bindValue(':parrafo', $texto);
            return $statement->execute();
		} catch(PDOException $error) {
		    return false;
		}	
	}
}


?>
