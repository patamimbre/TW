<?php

require_once('./../modules/gestion_conciertos.php');

//session_start();

$gestion = new GestionConciertos;
$statement = false;

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  $new_show = array(
    "fecha" => $_POST['fecha'],
    "hora"  => $_POST['hora'],
    "localizacion"     => $_POST['localizacion']
  );

  $statement = $gestion->add($new_show);

}
?>


  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['fecha']); ?> añadido correctamente</blockquote>
  <?php endif; ?>

  <h2>Añadir concierto</h2>

  <form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <label for="fecha">fecha</label>
    <input type="text" name="fecha" id="fecha">
    <label for="hora">hora</label>
    <input type="text" name="hora" id="hora">
    <label for="localizacion">localizacion</label>
    <input type="text" name="localizacion" id="localizacion">
    <input type="submit" name="submit" value="Submit">
  </form>

  <a href="./../html/admin_options.html">Volver a la página de admin</a>