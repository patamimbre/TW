<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/gestion_conciertos.php');

# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [1];
$tipo = is_valid_user($permisos);     #common.php

$gestion = new GestionConciertos();


if (isset($_POST['submit'])) {
   if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    $data =[
      "id"    => $_POST['id'],
      "fecha" => date_create($_POST['fecha']),
      "hora"  => $_POST['hora'],
      "localizacion" => $_POST['localizacion']
    ];

    $statement = $gestion->modify($data);
    writeLog($_SESSION['email']." ha editado el concierto id:".$_POST['id']);

}

if (isset($_GET['id'])) {
  $data = $gestion->get($_GET['id']);

} else {
    echo "Something went wrong!";
    exit;
}

?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote  class="center"><?php echo escape($_POST['id']); ?> actualizado correctamente</blockquote>
<?php endif; ?>

<h2>Edición de Concierto</h2>

<?php
include "list.php";
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";
?>