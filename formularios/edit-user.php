<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/header.php";
require './../modules/gestion_usuarios.php';

$gestion = new GestionUsuarios;
$result = $gestion->registeredUsers();
?>

<h2 class="center">Editar Usuarios</h2>
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
        <td class="col-1 center"><?php echo escape($row["ID"]); ?></td>
        <td class="col-2 center"><?php echo escape($row["nombre"]); ?></td>
        <td class="col-3 center"><?php echo escape($row["apellidos"]); ?></td>
        <td class="col-2 center"><?php echo escape($row["email"]); ?></td>
        <td class="col-2 center"><?php echo escape($row["telefono"]); ?></td>
        <td class="col-1 center"><?php echo escape($row["role"]); ?> </td>
        <td class="col-1 center"><a href="update-single-user.php?id=<?php echo escape($row["ID"]); ?>">Edit</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php else : ?>
  <p>Debes ser administrador para realizar esta acción</p>

<?php endif; 
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/footer.html";?>
