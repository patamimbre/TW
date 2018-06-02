<?php

require_once('./../modules/gestion_conciertos.php');

$gestion = new GestionConciertos();

$concierto =[
  "id"    => $_GET['id'],
  "fecha" => "2018-07-03",
  "hora"  => "17:00:00",
  "localizacion" => "París"
];

$gestion->modify($concierto);


if (isset($_POST['submit'])) {
   if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    $concierto =[
      "id"    => $_POST['id'],
      "fecha" => $_POST['fecha'],
      "hora"  => $_POST['hora'],
      "localizacion" => $_POST['localizacion']
    ];

    $statement = $gestion->modify($concierto);

}

if (isset($_GET['id'])) {
  $concierto = $gestion->get($_GET['id']);

} else {
    echo "Something went wrong!";
    exit;
}

include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/header.php";
?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote><?php echo escape($_POST['id']); ?> actualizado correctamente</blockquote>
<?php endif; ?>

<h2>Edición de Concierto</h2>

<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <?php foreach ($concierto as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
      <br>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>



<button onclick="location.href='./edit-show.php'" type="button">
     Volver</button>

<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/footer.html";
?>