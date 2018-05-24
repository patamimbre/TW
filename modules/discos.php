<?php
include_once "configuracion.inc";
include_once "./../common.php";

class Discos{
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
//solo el precio por el gestor de ventas
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
      echo "<br>Error <br> " . $error->getMessage();
    }

  }

}

?>
