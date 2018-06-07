<?php

include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/gestion_usuarios.php');

# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [1];
$tipo = is_valid_user($permisos);     #common.php

$gestion = new GestionUsuarios();
$success = "";
$statement = false;


if (isset($_GET["id"])) {
  if ($statement = $gestion->deleteUser($_GET["id"])){
    $success = "Usuario eliminado correctamente";
    writeLog($_SESSION['email']." ha eliminado el usuario id:".$_GET['id']);
  } else {
    $success = "Error al eliminar usuario";
  }
}

$result = $gestion->registeredUsers();
?>

<h2 class="center">Borrar usuario</h2>

<?php if ($statement) : ?>
	<blockquote class="center"><?php echo $success;?></blockquote>
<?php endif; ?>

<?php if ($result) : ?>
<table class="db container">
  <thead>
    <tr class="row">
      <th class="col-1">#</th>
      <th class="col-2">Nombre</th>
      <th class="col-3">Apellidos</th>
      <th class="col-2">Email</th>
      <th class="col-2">Teléfono</th>
      <th class="col-1">Rol</th>
      <th class="col-1">Acción</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr class="row">
        <td class="col-1 center"><?php echo escape($row["id"]); ?></td>
        <td class="col-2 center"><?php echo escape($row["nombre"]); ?></td>
        <td class="col-3 center"><?php echo escape($row["apellidos"]); ?></td>
        <td class="col-2 center"><?php echo escape($row["email"]); ?></td>
        <td class="col-2 center"><?php echo escape($row["telefono"]); ?></td>
        <td class="col-1 center"><?php echo escape($row["role"]); ?> </td>
        <td class="col-1 center"><a href="delete-user.php?id=<?php echo escape($row["id"]); ?>">Eliminar</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php else : ?>
  <p>Debes ser administrador para realizar esta acción</p>

<?php endif; 
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";
?>
