<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/gestion_discos.php');





// RELLENAR ARRAY CON LOS DISTINTOS TIPOS DE ERRORES
function conformidad($datos)
{

  $errores = array();
  if($datos['nombre']== "")
    array_push($errores,'nombre');
  if($datos['caratula']=="")
    array_push($errores,'caratula');

  if($datos['anio_publicacion']!='')
    if(!preg_match("#([0-9]{1,2}[-|/]){2}[0-9]{1,2}#", $datos['anio_publicacion']))
      array_push($errores,'anio_publicacion');

  if($datos['anio_publicacion']=="")
      array_push($errores,'anio_publicacion');


  if($datos['precio']=="")
    array_push($errores,'precio');

  return $errores;
}

function check($err_array){
  return (in_array('nombre',$err_array) or in_array('anio_publicacion',$err_array) or in_array('caratula',$err_array) or in_array('precio',$err_array));
}


# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [1,2];
$tipo = is_valid_user($permisos);     #common.php

$gestion = new GestionDiscos;
$statement = false;
$err_array = [];

if(isset($_POST) && count($_POST)>0){

 $err_array = conformidad($_POST);
}


if (isset($_POST['submit']) && empty($err_array)) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  //nuevo disco 
  $disco = array(
    "nombre"            => $_POST['nombre'],
    "anio_publicacion"  => $_POST['anio_publicacion'],
    "caratula"          => $_POST['caratula'],
    "precio"            => $_POST['precio']
  );

  $canciones = [];
  foreach ($_POST as $key=>$value){
    if (strpos($key, 'nombre-cancion') !== false){
      $id = str_replace('nombre-cancion-','',$key);
      $cancion = [
        "nombre" => $_POST["nombre-cancion-$id"],
        "duracion" => $_POST["duracion-cancion-$id"]
      ];
      $canciones []= $cancion;
    }
  }

  $statement = $gestion->add($disco, $canciones);
  writeLog($_SESSION['email']." ha insertado el disco ".$_POST['nombre']);
}

?>


  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote class="center"><?php echo escape($_POST['nombre']); ?> successfully added.</blockquote>
  <?php endif; ?>

  <h2>Insertar disco</h2>


  <?php

    // si hay errores
    if((isset($err_array) && count($err_array>0)) or (count($_GET)==0 && count($_POST)==0)):?>

  <form class="nuevo-disco" method="post">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">


    <label for="nombre">Nombre</label>
      <input type="text" name="nombre" id="nombre"
          <?php if(in_array('nombre',$err_array))
                  echo 'class="error"';
                else if(isset($_GET['nombre']))
                  echo 'value="'.$_GET["nombre"].'"';
                else if(isset($_POST['nombre']))
                  echo 'value="'.$_POST["nombre"].'"'; 
                ?>>
                <br>

    <label for="anio_publicacion">Año de publicación</label>
      <input type="date" name="anio_publicacion" id="anio_publicacion"
          <?php if(in_array('anio_publicacion',$err_array))
                  echo 'class="error"';
                else if(isset($_GET['anio_publicacion']))
                  echo 'value="'.$_GET["anio_publicacion"].'"';
                else if(isset($_POST['anio_publicacion']))
                  echo 'value="'.$_POST["anio_publicacion"].'"'; 
                ?>>
                <br>


    <label for="caratula">URL carátula</label>
     <input type="text" name="caratula" id="caratula"
            <?php if(in_array('caratula',$err_array))
              echo 'class="error"';
            else if(isset($_GET['caratula']))
              echo 'value="'.$_GET["caratula"].'"';
            else if(isset($_POST['caratula']))
              echo 'value="'.$_POST["caratula"].'"'; 
            ?>>
            <br>

    <label for="precio">Precio</label>
    <input type="text" name="precio" id="precio"
            <?php if(in_array('precio',$err_array))
              echo 'class="error"';
            else if(isset($_GET['precio']))
              echo 'value="'.$_GET["precio"].'"';
            else if(isset($_POST['precio']))
              echo 'value="'.$_POST["precio"].'"'; 
            ?>>
            <br>


    <div class="canciones container">
      <div class="row cabecera-canciones">
      <h5 class="col center">Canciones en el disco</h5>
      <button class="col center" id="btnAddSong">
        Añadir canción
      </button>
      </div>


    </div>




  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
      $(document).ready(function() {
          var max_fields      = 20; //maximum input boxes allowed
          var wrapper         = $(".canciones"); //Fields wrapper
          var add_button      = $("#btnAddSong"); //Add button ID
          var x = 1; //initlal text box count
             
          $(add_button).click(function(e){ //on add input button click
              e.preventDefault();
              if(x < max_fields){ //max input box allowed
                  var newSong = '<div class="cancion row"><label for="nombre">Nombre</label><input type="text" name="nombre-cancion-'+x+'"><label for="duracion">Duración</label><input type="text" name="duracion-cancion-'+x+'" placeholder="hh:mm:ss"></div>';
                  x++; //text box increment
                  $(wrapper).append(newSong); //add input box
              }
          });
        
          $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
              e.preventDefault(); $(this).parent('div').remove(); x--;
          })
      });
  </script>


 <?php if (check($err_array)) echo "<span class='mensaje-error'> DATOS INSUFICIENTES </span>"; ?>

</fieldset>

<input type="submit" name="submit" value="Submit">



</form>


<?php endif; ?>

  <?php
  include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";
  ?>