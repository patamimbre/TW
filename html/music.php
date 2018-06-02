<?php

require './../modules/gestion_discos.php';

$gestion = new GestionDiscos();
$result = $gestion->to_array();

include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/header.php";
?>

    <div class="buscador container center">
      <input id="searchInput" onKeyUp="search()" type="text" placeholder="Título o canción">
    </div>

    <?php foreach ($result as $disco): ?>

    <form class="discos container" action="./../formularios/compra.php" method="POST">
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


          <?php foreach ($disco['canciones'] as $cancion): ?>

            <div class="row cancion">
              <div class="col nombre">
                <p><?php echo escape($cancion["nombre"]);?></p>
              </div>
              <div class="col duracion">
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
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/footer.html";
?>