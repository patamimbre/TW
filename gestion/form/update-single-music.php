<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/gestion_discos.php');

# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [1,2];
$tipo = is_valid_user($permisos);     #common.php

$gestion = new GestionDiscos;

if (isset($_POST['submit'])) {
   if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    $disco =[
      "id"        => $_POST['id'],
      "nombre" => $_POST['nombre'],
      "anio_publicacion"  => $_POST['anio_publicacion'],
      "caratula"  => $_POST['caratula'],
      "precio"     => $_POST['precio']
    ];
    
    //array de canciones limpio
    $canciones = [];

    foreach ($_POST as $key=>$value){
      if (strpos($key, 'id_cancion') !== false){
        $id = str_replace('id_cancion-','',$key);
        $cancion = [
          "id_cancion" => $_POST["id_cancion-$id"],
          "id_disco" => $_POST["id_disco-$id"],
          "nombre" => $_POST["nombre-$id"],
          "duracion" => $_POST["duracion-$id"]
        ];

        $canciones []= $cancion;  
      }
    }
    
    $statement = $gestion->modify($disco, $canciones);
    writeLog($_SESSION['email']." ha editado el disco id:".$_POST['id']);

}

if (isset($_GET['id'])) {
  $disco = $gestion->get($_GET['id']);
  $canciones = $gestion->getSongs($_GET['id']);
} else {
    echo "Something went wrong!";
    exit;
}

?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote class="center"><?php echo escape($_POST['nombre']); ?> actualizado correctamente</blockquote>
<?php endif; ?>

<h2>Edición de Discos</h2>

<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <?php foreach ($disco as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
        <br>
      <?php endforeach; ?>
      <h3 class="center">Canciones</h3>
      <?php 
        foreach ($canciones as $cancion) : 
          echo '<div class="cancion_editar">';
          foreach ($cancion as $key => $value):
      ?>
          <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
          <input type="text" name="<?php echo $key."-cancion".$cancion['id_cancion']; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo (strpos($key, 'id') !== false ? 'readonly' : null); ?>>
          <br>  
      <?php 
          endforeach; 
          echo '</div>';
        endforeach;
      ?>




    <input type="submit" name="submit" value="Submit">
</form>

<button onclick="location.href='/~germancastro1718/proyecto/admin.php'" type="button">
     Volver</button>

<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";
?>