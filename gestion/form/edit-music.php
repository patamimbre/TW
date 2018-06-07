<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/gestion_discos.php');

# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [1,2];
$tipo = is_valid_user($permisos);     #common.php

$gestion = new GestionDiscos;
$result = $gestion->all();

?>

<h2 class="center">Editar discos</h2>

  <?php if ($result) : ?>
  <table class="db container">
    <thead>
      <tr class="row">
        <th class="col-2">#</th>
        <th class="col-4">Nombre</th>
        <th class="col-2">Año</th>
        <th class="col-2">Precio</th>
        <th class="col-2">Acción</th>
      </tr>
    </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
        <tr class="row">
          <td class="col-2 center"><?php echo escape($row["id"]); ?></td>
          <td class="col-4 center"><?php echo escape($row["nombre"]); ?></td>
          <td class="col-2 center"><?php echo escape($row["anio_publicacion"]); ?></td>
          <td class="col-2 center"><?php echo escape($row["precio"]); ?></td>
          <td class="col-2 center"><a href="update-single-music.php?id=<?php echo escape($row["id"]); ?>">Editar</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
  </table>

</div>
<?php endif; 
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";?>
