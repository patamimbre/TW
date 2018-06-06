<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/gestion_usuarios.php');

# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [1];
$tipo = is_valid_user($permisos);     #common.php


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
    <blockquote class="center"><?php echo escape($_POST['email']); ?> añadido correctamente.</blockquote>
  <?php endif; ?>

  <h2>Añadir un usuario</h2>

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

<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";?>