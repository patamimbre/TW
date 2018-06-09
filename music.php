<?php
include "header.php";
require 'gestion/gestion_discos.php';

$gestion = new GestionDiscos();
$discos = $gestion->all();


if (isset($_POST['submit'])){
  $coincidencias = [];
  if (!empty($_POST['search_string'])){
    $string = strtolower(escape($_POST['search_string']));

    foreach($discos as $disco){
      if (strpos(strtolower($disco['nombre']), $string) !== false){
        $coincidencias []= $disco;
      }
      else{
        # Si no coincide en el nombre, se comprueban los nombres de canciones
        $canciones = $gestion->getSongs($disco['id']);    

        foreach($canciones as $cancion){
          if (strpos(strtolower($cancion['nombre']), $string) !== false){
            $coincidencias []= $disco;
            break;
          }
        }
      }
    }
  }

  if (isset($_POST['fecha1']) && isset($_POST['fecha2'])){
    $mayor = strtotime($_POST['fecha1']);
    $menor = strtotime($_POST['fecha2']);    
    
    if ($menor > $mayor)
      swap($mayor,$menor);
    
    foreach($discos as $disco){
      if ( $disco['anio_publicacion'] >= date('Y',$menor) &&
           $disco['anio_publicacion'] <= date('Y',$mayor) ) {
        $coincidencias []= $disco;  
      }

    }
    
    if (!empty($coincidencias))
      $discos = array_unique($coincidencias, SORT_REGULAR);
  }

}

?>

    <form class="buscador" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
      <div class="row barra-busqueda">
        <input  name="search_string" type="text" placeholder="Título o canción">
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

    <?php foreach ($discos as $disco): ?>

    <form class="discos row container" action="compras/form/compra.php" method="POST">
      <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">

      <div class="disco container">
        <div class="row">
          <div class="col-9 center titulo">
            <h4><?php echo escape($disco['nombre']);?></h4>
          </div>
          <div class="col-3 center anio">
            <p><?php echo escape($disco['anio_publicacion']);?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-5 caratula">
            <img src='<?php echo escape($disco["caratula"]);?>' alt="">
          </div>
          <div class="col-7 container lista-canciones">


          <?php
          $canciones = $gestion->getSongs($disco['id']); 
          foreach ($canciones as $cancion): ?>

            <div class="row cancion">
              <div class="col-10 nombre">
                <p><?php echo escape($cancion["nombre"]);?></p>
              </div>
              <div class="col-2 duracion">
                <p><?php echo escape($cancion["duracion"]);?></p>
              </div>
            </div>

          <?php endforeach; 
          
          echo '<input type="hidden" name="id" value="'.$disco['id'].'" >';
          
          ?>

          

          </div>
        </div>
        <div class="row center submit">
          <button class="submit" type="submit" value="submit">Comprar</button>
        </div>
      </div>
    </form>


    <?php endforeach; ?>

  </div>


<?php
include "footer.html";
?>