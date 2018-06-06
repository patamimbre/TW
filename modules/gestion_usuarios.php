<?php

include_once "configuracion.inc";

class GestionUsuarios{

	private $connection;

	public function __construct(){
		try {
			#Conecta a la DB
			$this->connection = new PDO(DB_DSN, DB_USUARIO, DB_PASS);
		} catch (PDOException $error) {
			echo "<br>Error <br> " . $error->getMessage();
		}
	}

	public function check($email, $pass){
		$sql = "SELECT pass FROM usuarios
						WHERE email = :email";

		try{
			$state = $this->connection->prepare($sql);
			$state->bindParam(':email', $email, PDO::PARAM_STR);
			$state->execute();

			$result = $state->fetchColumn();

			if (password_verify($pass,$result)){
				return true;
			} else {
				return false;
			}


		} catch (PDOException $error){
			return false;
		}

	}


/* LAS FUNCIONES DESCRITAS A CONTINUACIÓN SOLO
	 PUEDEN SER USADAS POR ADMINISTRADORES */

	public function addUser($user){

		$user['pass'] = password_hash($user['pass'], PASSWORD_DEFAULT);
		if (empty($user['telefono'])){
			$user['telefono'] = 0;
		}


		$sql = "INSERT INTO usuarios
		(nombre,apellidos,email,telefono,pass,role)
		VALUES
		(:nombre, :apellidos, :email, :telefono, :pass, 0);";

		# No es necesario validar los datos introducidos,
		# PDO se encarga de hacerlo automáticamente
		try{
			$state = $this->connection->prepare($sql);
			$state->bindParam(':nombre',$user['nombre']);
			$state->bindParam(':apellidos',$user['apellidos']);
			$state->bindParam(':email',$user['email']);
			$state->bindParam(':telefono',$user['telefono']);
			$state->bindParam(':pass',$user['pass']);
			$state->execute();


			return true;
		} catch (PDOException $error){
			return false;
		}
	}


	public function deleteUser($id){
		$sql = "DELETE FROM usuarios where ID = :id";
		try{
			$state = $this->connection->prepare($sql);
			$state->bindParam(':id',$id);
			$state->execute();
		return true;
		} catch (PDOException $error){
			return false;
		}
	}

	public function registeredUsers(){
		$sql = "SELECT * FROM usuarios";
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

	public function printUsers(){
		if ($result = $this->registeredUsers()){

			echo <<<HTML
				<table>
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Email</th>
						<th>Pass</th>
						<th>Role</th>
					</tr>
				</thead>
				<tbody>
HTML;
			foreach ($result as $row) {
				echo "<tr>";
				echo "<td>".escape($row["ID"])."</td>";
				echo "<td>".escape($row["nombre"])."</td>";
				echo "<td>".escape($row["apellidos"])."</td>";
				echo "<td>".escape($row["email"])."</td>";
				echo "<td>".escape($row["pass"])."</td>";
				echo "<td>".escape($row["role"])."</td>";
				echo "</tr>";
			}
			echo "</tbody></table>";

		} else {
			echo "<br> Error al mostrar la información <br>";
		}


	}

	public function setUserRole($email, $role){
		$sql = "UPDATE usuarios
						SET role = :role
						WHERE email = :email";

		try {
			$status = $this->connection->prepare($sql);
			$status->bindParam(':email', $email);
			$status->bindParam(':role', $role);
			$status->execute();
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}

	public function getUser($id){
		try {
		$sql = "SELECT * FROM usuarios WHERE ID = :id";
		$statement = $this->connection->prepare($sql);
		$statement->bindValue(':id', $id);
		$statement->execute();

		return $statement->fetch(PDO::FETCH_ASSOC);
		} catch(PDOException $error) {
			return false;
		}
	}


	public function modifyUser($user){
		$user['pass'] = password_hash($user['pass'], PASSWORD_DEFAULT);
		$sql = "UPDATE usuarios
			SET
				nombre = :nombre,
				apellidos = :apellidos,
				email = :email,
				telefono = :telefono,
				pass = :pass,
				role = :role
			WHERE id = :id";
		try{
		$statement = $this->connection->prepare($sql);
		return $statement->execute($user);
		} catch(PDOException $error) {
		return false;
		}	
	}

	/*
		Los usuarios del tipo 2 son Gestores de compras
		Los usuarios del tipo 1 son ADMINISTRADORES
		Los usuarios del tipo 0 son usuarios normales
	*/
	public function getRole($email){

		$sql = "SELECT role from usuarios
						WHERE email = :email";

		try {
			$status = $this->connection->prepare($sql);
			$status->bindParam(':email', $email);
			$status->execute();
			return $status->fetchColumn();
		} catch (PDOException $e) {
			echo 'Exception' . $e->getMessage();
		}
	}

}


?>
