<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/gestion_conciertos.php');

# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [1];
$tipo = is_valid_user($permisos);     #common.php


$conciertos = new GestionConciertos();
$result = $conciertos->all();
?>

<h2 class="center">Editar Conciertos</h2>
<?php if ($result) : ?>
<table class="db container">
  <thead>
    <tr class="row">
      <th class="col-2">#</th>
      <th class="col-3">Fecha</th>
      <th class="col-2">Hora</th>
      <th class="col-3">Localización</th>
      <th class="col-2">Acción</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr class="row">
        <td class="col-2 center"><?php echo escape($row["id"]); ?></td>
        <td class="col-3 center"><?php echo escape($row["fecha"]); ?></td>
        <td class="col-2 center"><?php echo escape($row["hora"]); ?></td>
        <td class="col-3 center"><?php echo escape($row["localizacion"]); ?></td>
        <td class="col-2 center"><a href="update-single-show.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php endif; 
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";?>
