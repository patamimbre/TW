<?php

require './../modules/gestion_conciertos.php';
//require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/mysite/php/includes/dbconn.inc');
//include ("./../test.php");

$gestion = new GestionConciertos();
$success = "";

if (isset($_GET["id"])) {
  if ($gestion->delete($_GET["id"])){
    $success = "Concierto eliminado correctamente";
  } else {
    $success = "Error al eliminar concierto";
  }
}

$result = $gestion->all();

include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/header.php";

?>

<h2>Eliminar conciertos</h2>

<?php if ($success) echo $success; ?>

<?php if ($result) : ?>
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Fecha</th>
      <th>Hora</th>
      <th>Localización</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["id"]); ?></td>
        <td><?php echo escape($row["fecha"]); ?></td>
        <td><?php echo escape($row["hora"]); ?></td>
        <td><?php echo escape($row["localizacion"]); ?></td>
        <td><a href="delete-show.php?id=<?php echo escape($row["id"]); ?>">Remove</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php else : ?>
  <p>Debes ser administrador para realizar esta acción</p>

<?php endif; 
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/footer.html";
?>
