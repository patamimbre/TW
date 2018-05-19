<?php

require './../modules/gestion_usuarios.php';
//require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/mysite/php/includes/dbconn.inc');
include ("./../test.php");

$result = $gestion->registeredUsers();

?>

<h2>Update users</h2>
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
        <td><a href="update-single.php?id=<?php echo escape($row["ID"]); ?>">Edit</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php else : ?>
  <p>Debes ser administrador para realizar esta acción</p>

<?php endif; ?>
