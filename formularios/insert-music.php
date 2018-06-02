<?php

require_once('./../modules/gestion_discos.php');

//session_start();

$gestion = new GestionDiscos;
$statement = false;

if (isset($_POST['submit'])) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  //nuevo disco
  $new_disk = array(
    "nombre"            => $_POST['nombre'],
    "anio_publicacion"  => $_POST['anio_publicacion'],
    "caratura"          => $_POST['caratura'],
    "precio"            => $_POST['precio']
  );



  //lista de canciones
  $songs = array();
  for ($i=0; $i < sizeof($_POST['nombre_cancion[]']); $i++){
    echo "<br>".$_POST['nombre_cancion'][$i];
  }
  

  $statement = $gestion->add($new_disk, $songs);

}

include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/header.php";
?>


  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote><?php echo escape($_POST['nombre']); ?> successfully added.</blockquote>
  <?php endif; ?>

  <h2>Add a user</h2>

  <form class="nuevo-disco" method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre">
    <label for="anio_publicacion">Año de publicación</label>
    <input type="text" name="anio_publicacion" id="anio_publicacion">
    <label for="caratura">URL carátula</label>
    <input type="text" name="caratura" id="caratura">
    <label for="precio">Precio</label>
    <input type="text" name="precio" id="precio">
    <div class="canciones container">
      <h5>Canciones en el disco</h5>
      <button id="btnAddSong">
        Añadir otra canción
      </button>
      <div class="cancion">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre-cancion[]" id="nombre-cancion">
        <label for="duracion">Duración</label>
        <input type="text" name="duracion-cancion[]" id="duracion-cancion">
      </div>
    </div>


    <input type="submit" name="submit" value="Submit">
  </form>


  <!-- Poner en footer !!! -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
      $(document).ready(function() {
          var max_fields      = 20; //maximum input boxes allowed
          var wrapper         = $(".canciones"); //Fields wrapper
          var add_button      = $("#btnAddSong"); //Add button ID
          var newSong = '<div class="cancion"><label for="nombre">Nombre</label><input type="text" name="nombre-cancion[]" id="nombre-cancion"><label for="duracion">Duración</label><input type="text" name="duracion-cancion[]" id="duracion-cancion"></div>';
             
          var x = 1; //initlal text box count
          $(add_button).click(function(e){ //on add input button click
              e.preventDefault();
              if(x < max_fields){ //max input box allowed
                  x++; //text box increment
                  $(wrapper).append(newSong); //add input box
              }
          });
        
          $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
              e.preventDefault(); $(this).parent('div').remove(); x--;
          })
      });
  </script>



  <?php
  include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/footer.html";
  ?>