<?php

require './../modules/gestion_conciertos.php';

$conciertos = new GestionConciertos();
$result = $conciertos->to_array();

include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/header.php";
?>

    <div class="main container">

      <div class="buscador container center">
        <input id="searchInput" onKeyUp="search()" type="text" placeholder="ej:2018-06-12">
      </div>

      <div class="conciertos container">
        <div class="row">
          <div class="col center fecha">
            <p>Fecha</p>
          </div>
          <div class="col center hora">
            <p>Hora</p>
          </div>
          <div class="col center lugar">
            <p>Ciudad</p>
          </div>
        </div>

        <?php foreach ($result as $row): ?>
        <div class="row concierto">
          <div class="col center fecha">
            <p>
              <?php echo escape($row['fecha']); ?>
            </p>
          </div>
          <div class="col center hora">
            <p>
              <?php echo escape($row['hora']); ?>
            </p>
          </div>
          <div class="col center lugar">
            <p>
              <?php echo escape($row['localizacion']); ?>
            </p>
          </div>
        </div>
        <?php endforeach; ?>

      </div>
    </div>

    </div>

  <script src="./../js/shows.js"></script>

  <?php 
  include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/footer.html";
  ?>
