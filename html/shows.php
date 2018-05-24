<?php

require './../modules/conciertos.php';

$conciertos = new Conciertos();
$result = $conciertos->to_array();

?>

  <!DOCTYPE html>
  <html lang="es" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Julio Iglesias</title>
    <link rel="stylesheet" href="./../css/modulos.css">
    <link rel="stylesheet" href="https://unpkg.com/wingcss" />
  </head>

  <body>
    <div class="main container">

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
        <div class="row">
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
  </body>

  </html>
