<?php
include_once "configuracion.inc";
include_once "./../common.php";

class Conciertos{
  private $connection;

	public function __construct(){
		try {
			#Conecta a la DB
			$this->connection = new PDO(DB_DSN, DB_USUARIO, DB_PASS);

			if (session_status() == PHP_SESSION_NONE) {
    		session_start();
			}
		} catch (PDOException $error) {
			echo "<br>Error <br> " . $error->getMessage();
		}
	}

  public function añadir($concierto){

  }

  public function eliminar(){

  }

  public function editar(){

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

?>
