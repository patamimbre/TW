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
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/header.php";
?>


  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote class="center"><?php echo escape($_POST['fecha']); ?> añadido correctamente</blockquote>
  <?php endif; ?>

  <h2 class="center">Añadir concierto</h2>

  <form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <label for="fecha">Fecha</label>
    <input type="text" name="fecha" id="fecha">
    <label for="hora">Hora</label>
    <input type="text" name="hora" id="hora">
    <label for="localizacion">Localización</label>
    <input type="text" name="localizacion" id="localizacion">
    <input type="submit" name="submit" value="Submit">
  </form>

<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/footer.html";
?>