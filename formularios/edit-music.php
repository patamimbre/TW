<?php

require './../modules/gestion_discos.php';
//require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/mysite/php/includes/dbconn.inc');
//include ("./../test.php");
$gestion = new GestionDiscos;
$result = $gestion->all();

include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/header.php";
?>
<div class="container center">
<h2>Editar discos</h2>
<?php if ($result) : ?>
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Nombre</th>
      <th>Año</th>
      <th>Precio</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["id"]); ?></td>
        <td><?php echo escape($row["nombre"]); ?></td>
        <td><?php echo escape($row["anio_publicacion"]); ?></td>
        <td><?php echo escape($row["precio"]); ?></td>
        <td><a href="update-single-music.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php else : ?>
  <p>Debes ser administrador para realizar esta acción</p>

<?php endif; 
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/footer.html";?>
