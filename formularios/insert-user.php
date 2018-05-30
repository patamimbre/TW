<?php

require_once('./../modules/gestion_usuarios.php');

//session_start();

$gestion = new GestionUsuarios;
$statement = false;

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  $new_user = array(
    "nombre" => $_POST['nombre'],
    "apellidos"  => $_POST['apellidos'],
    "email"     => $_POST['email'],
    "telefono"       => $_POST['telefono'],
    "pass"  => $_POST['pass']
  );

  $statement = $gestion->addUser($new_user);

}
?>


  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['email']); ?> successfully added.</blockquote>
  <?php endif; ?>

  <h2>Add a user</h2>

  <form method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre">
    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" id="apellidos">
    <label for="email">Email</label>
    <input type="text" name="email" id="email">
    <label for="telefono">Teléfono</label>
    <input type="text" name="telefono" id="telefono">
    <label for="pass">Contraseña</label>
    <input type="password" name="pass" id="pass">
    <input type="submit" name="submit" value="Submit">
  </form>

  <a href="index.php">Back to home</a>
