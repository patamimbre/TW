<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/gestion_discos.php');

# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [1];
$tipo = is_valid_user($permisos);     #common.php

$gestion = new GestionDiscos;

if (isset($_POST['submit'])) {
   if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    $user =[
      "id"        => $_POST['id'],
      "nombre" => $_POST['nombre'],
      "apellidos"  => $_POST['apellidos'],
      "email"     => $_POST['email'],
      "telefono"       => $_POST['telefono'],
      "pass"  => $_POST['pass'],
      "role"      => $_POST['role']
    ];

    $statement = $gestion->modifyUser($user);

}

if (isset($_GET['id'])) {
  $user = $gestion->getUser($_GET['id']);

} else {
    echo "Something went wrong!";
    exit;
}

?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote class="center"><?php echo escape($_POST['email']); ?> actualizado correctamente</blockquote>
<?php endif; ?>

<h2>Edición de Discos</h2>

<?php
include "list.php";
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";
?>