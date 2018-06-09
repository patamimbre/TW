<?php
include "header.php";
require 'gestion/gestion_conciertos.php';

$gestion = new GestionConciertos();
$conciertos = $gestion->to_array();

if (isset($_POST['submit'])){
  $resultados = [];
  if (!empty($_POST['lugares'])){
   
    foreach($conciertos as $concierto){
      if (in_array($concierto['localizacion'], $_POST['lugares'])){
        $resultados []= $concierto;
      }
   }
  
  }

  if (isset($_POST['fecha1']) && isset($_POST['fecha2'])){
    $mayor = strtotime($_POST['fecha1']);
    $menor = strtotime($_POST['fecha2']);    
    
    if ($menor > $mayor)
      swap($mayor,$menor);
    
    foreach($conciertos as $concierto){
      if ( strtotime($concierto['fecha']) >= $menor &&
           strtotime($concierto['fecha']) <= $mayor ) {
        $coincidencias []= $concierto;  
      }

    }
    
    if (!empty($coincidencias))
      $resultados = array_unique($coincidencias, SORT_REGULAR);
  }

} else {
  $resultados = $conciertos;
}


?>

    <form class="buscador" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
      
      <h7 class="center">Buscar por lugar</h7>
      <div class="row lugar">
        <?php 
          foreach ($conciertos as $concierto){
            $lugar = escape($concierto['localizacion']);
            echo '<input type="checkbox" name="lugares[]" value="'.$lugar.'" ';
            if(isset($_POST['submit']) && in_array($lugar, $_POST['lugares'])){
              echo 'checked';
            }
            echo '/>'.$lugar;
          }
        ?>
      </div>

      <h7 class="center">Busca entre 2 fechas</h7>
      <div class="row fechas">
        <div class="col center">
          <input type="date" name="fecha1" id="fecha1">
        </div>
        <div class="col center">
        <input type="date" name="fecha2" id="fecha2">
        </div>
      </div>
      <div class="row center submit">
        <input type="submit" name="submit" value="Buscar">
      </div>
    </form>

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

        <?php foreach ($resultados as $concierto): ?>
        <div class="row concierto">
          <div class="col center fecha">
            <p>
              <?php echo escape($concierto['fecha']); ?>
            </p>
          </div>
          <div class="col center hora">
            <p>
              <?php echo escape($concierto['hora']); ?>
            </p>
          </div>
          <div class="col center lugar">
            <p>
              <?php echo escape($concierto['localizacion']); ?>
            </p>
          </div>
        </div>
        <?php endforeach; ?>

      </div>
    </div>


  <?php 
  include "footer.html";
  ?>
