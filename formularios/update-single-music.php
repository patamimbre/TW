<?php

require_once('./../modules/gestion_usuarios.php');

//session_start();

$gestion = new GestionUsuarios;

if (isset($_POST['submit'])) {
   if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    $user =[
      "id"        => $_POST['ID'],
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

include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/header.php";

?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote><?php echo escape($_POST['email']); ?> actualizado correctamente</blockquote>
<?php endif; ?>

<h2>Edición de usuario</h2>

<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <?php foreach ($user as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'ID' ? 'readonly' : null); ?>>
      <br>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>



<button onclick="location.href='./edit-music.php'" type="button">
     Volver</button>

<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/footer.html";
?>