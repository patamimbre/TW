<?php

require './../modules/gestion_discos.php';

$gestion = new GestionDiscos();
$success = "";

if (isset($_GET["id"])) {
  if ($gestion->delete($_GET["id"])){
    $success = "Disco eliminado correctamente";
  } else {
    $success = "Error al eliminar disco";
  }
}

$result = $gestion->all();

include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/header.php";
?>

  <h2 class="center">Eliminar discos</h2>

  <?php if ($success) echo $success; ?>

  <?php if ($result) : ?>
  <table class="db container">
    <thead>
      <tr class="row">
        <th class="col-2">#</th>
        <th class="col-4">Nombre</th>
        <th class="col-2">Año</th>
        <th class="col-2">Precio</th>
        <th class="col-2">Acción</th>
      </tr>
    </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr class="row">
          <td class="col-2 center"><?php echo escape($row["id"]); ?></td>
          <td class="col-4 center"><?php echo escape($row["nombre"]); ?></td>
          <td class="col-2 center"><?php echo escape($row["anio_publicacion"]); ?></td>
          <td class="col-2 center"><?php echo escape($row["precio"]); ?></td>
          <td class="col-2 center"><a href="delete-music.php?id=<?php echo escape($row["id"]); ?>">Eliminar</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
  </table>

  <?php else : ?>
    <p>Debes ser administrador para realizar esta acción</p>

  <?php endif; ?>

<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/footer.html";
?>