<?php

include_once "/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/configuracion.inc";

class GestionCompras{
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
        $sql = "SELECT * FROM pedidos";
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

    public function add($compra){
        $sql = "INSERT INTO pedidos
		(id_disco,precio,email_cliente)
		VALUES
		(:id_disco, :precio, :email_cliente);";

		# No es necesario validar los datos introducidos,
		# PDO se encarga de hacerlo automáticamente
		try{
			$state = $this->connection->prepare($sql);
			$state->bindParam(':id_disco',$compra['id_disco']);
			$state->bindParam(':precio',$compra['precio']);
			$state->bindParam(':email_cliente',$compra['email']);
			$state->execute();
            return true;
            
		} catch (PDOException $error){
			return false;
		}
    }

    # al aceptarla se pone timestamp actual
    # y el estado a 1 (+otros valores)
    public function aceptar($id,$gestor){
        $sql = "UPDATE pedidos
                SET
                    estado = 1,
                    fecha = CURRENT_TIMESTAMP,
                    nombre_gestor = :nombre,
                    apellidos_gestor = :apellidos
                WHERE id = :id";
        try{
            $state = $this->connection->prepare($sql);
            $state->bindParam(':id',$id);
            $state->bindParam(':nombre',$gestor['nombre']);
            $state->bindParam(':apellidos',$gestor['apellidos']);
            return $state->execute();
        } catch (PDOException $error){
            return false;
        }
    }


    # al rechazarla se pone el timestamp actual 
    # y el estado a 0 (+otros valores)
    public function rechazar($id,$gestor,$info){
        # al aceptarla se pone el timestamp actual
        $sql = "UPDATE pedidos
                SET
                    estado = 0,
                    fecha = CURRENT_TIMESTAMP,
                    nombre_gestor = :nombre,
                    apellidos_gestor = :apellidos,
                    info = :info
                WHERE id = :id";
        try{
            $state = $this->connection->prepare($sql);
            $state->bindParam(':id',$id);
            $state->bindParam(':nombre',$gestor['nombre']);
            $state->bindParam(':apellidos',$gestor['apellidos']);
            $state->bindParam(':info',$info);
            return $state->execute();
        } catch (PDOException $error){
            return false;
        }
    }

    public function get($id){
        try {
            $sql = "SELECT * FROM pedidos WHERE id = :id";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);

        } catch(PDOException $error) {
            return false;
        }
    }

    # devuelve compras con estado a null
    public function get_esperando(){
        try {
            $sql = "SELECT * FROM pedidos WHERE estado IS NULL ";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $error) {
            return false;
        }
    }

    public function historico(){
        try {
            $sql = "SELECT * FROM pedidos 
                    WHERE estado = 0 OR estado = 1
                    ORDER BY estado DESC, fecha DESC";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $error) {
            return false;
        }
    }
    

    # Devuelve array con compras aceptadas
    public function get_aceptados(){
        try {
            $sql = "SELECT * FROM pedidos 
                    WHERE estado = 1
                    ORDER BY fecha DESC";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $error) {
            return false;
        }
    }

    # Devuelve array con compras rechazadas
    public function get_rechazados(){
        try {
            $sql = "SELECT * FROM pedidos 
                    WHERE estado = 0
                    ORDER BY fecha DESC";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $error) {
            return false;
        }
    }

}