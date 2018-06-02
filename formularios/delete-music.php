<?php

require './../modules/gestion_discos.php';
//require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/mysite/php/includes/dbconn.inc');
//include ("./../test.php");

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


  <h2>Eliminar discos</h2>

  <?php if ($success) echo $success; ?>

  <?php if ($result) : ?>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Año</th>
        <th>Precio</th>
      </tr>
    </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?php echo escape($row["id"]); ?></td>
          <td><?php echo escape($row["nombre"]); ?></td>
          <td><?php echo escape($row["anio_publicacion"]); ?></td>
          <td><?php echo escape($row["precio"]); ?></td>
          <td><a href="delete-music.php?id=<?php echo escape($row["id"]); ?>">Remove</a></td>
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