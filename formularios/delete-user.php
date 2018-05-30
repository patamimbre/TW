<?php

require './../modules/gestion_usuarios.php';
//require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/mysite/php/includes/dbconn.inc');
include ("./../test.php");

$gestion = new GestionUsuarios();
$success = "";

if (isset($_GET["id"])) {
  if ($gestion->deleteUser($_GET["id"])){
    $success = "Usuario eliminado correctamente";
  } else {
    $success = "Error al eliminar usuario";
  }
}

$result = $gestion->registeredUsers();

//echo "<br>".."<br>";

?>

<h2>Delete users</h2>

<?php if ($success) echo $success; ?>

<?php if ($result) : ?>
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Email</th>
      <th>Teléfono</th>
      <th>Pass</th>
      <th>Rol</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["ID"]); ?></td>
        <td><?php echo escape($row["nombre"]); ?></td>
        <td><?php echo escape($row["apellidos"]); ?></td>
        <td><?php echo escape($row["email"]); ?></td>
        <td><?php echo escape($row["telefono"]); ?></td>
        <td><?php echo escape($row["pass"]); ?></td>
        <td><?php echo escape($row["role"]); ?> </td>
        <td><a href="delete-user.php?id=<?php echo escape($row["ID"]); ?>">Remove</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php else : ?>
  <p>Debes ser administrador para realizar esta acción</p>

<?php endif; ?>
