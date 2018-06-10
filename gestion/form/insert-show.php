<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/gestion_conciertos.php');


// RELLENAR ARRAY CON LOS DISTINTOS TIPOS DE ERRORES
function conformidad($datos)
{

  $errores = array();
  if($datos['hora']== "")
    array_push($errores,'hora');
  if($datos['localizacion']=="")
    array_push($errores,'localizacion');

  if($datos['fecha']!='')
    if(!preg_match("#([0-9]{1,2}[-|/]){2}[0-9]{1,2}#", $datos['fecha']))
      array_push($errores,'fecha');

  if($datos['fecha']=="")
      array_push($errores,'fecha');



  return $errores;
}

function check($err_array){
  return (in_array('hora',$err_array) or in_array('fecha',$err_array) or in_array('localizacion',$err_array));
}

# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [1];
$tipo = is_valid_user($permisos);     #common.php

$gestion = new GestionConciertos;
$statement = false;
$err_array = [];


if(isset($_POST) && count($_POST)>0){

 $err_array = conformidad($_POST);
}

if (isset($_POST['submit']) && empty($err_array) ) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  $new_show = array(
    "fecha" => date_create($_POST['fecha']),
    "hora"  => $_POST['hora'],
    "localizacion"     => $_POST['localizacion']
  );

  $statement = $gestion->add($new_show);    
  writeLog($_SESSION['email']." ha añadido concierto el día ".$_POST['fecha']);

}

?>


  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote class="center"><?php echo escape($_POST['fecha']); ?> añadido correctamente</blockquote>
  <?php endif; ?>

  <h2 class="center">Añadir concierto</h2>

<?php
// si hay errores
if((isset($err_array) && count($err_array>0)) or (count($_GET)==0 && count($_POST)==0)):?>

<form method="post" onSubmit="return check($err_array);">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
<fieldset>
        <legend>Datos</legend>

        
        <label for="hora">Hora</label>
         <input type="time" name="hora" id="hora"
          <?php if(in_array('hora',$err_array))
                  echo 'class="error"';
                else if(isset($_GET['hora']))
                  echo 'value="'.$_GET["hora"].'"';
                else if(isset($_POST['hora']))
                  echo 'value="'.$_POST["hora"].'"'; 
                ?>>
                <br>

        <label for="localizacion">Localizacion</label>
         <input type="text" name="localizacion" id="localizacion"
          <?php if(in_array('localizacion',$err_array))
              echo 'class="error"';
            else if(isset($_GET['localizacion']))
              echo 'value="'.$_GET["localizacion"].'"';
            else if(isset($_POST['localizacion']))
              echo 'value="'.$_POST["localizacion"].'"'; 
            ?>>
            <br>
        
        <label for="fecha">Fecha:</label>
         <input type="date" name="fecha" id="fecha"
          <?php if(in_array('fecha',$err_array))
                echo 'class="error"';
              else if(isset($_GET['fecha']))
                echo 'value="'.$_GET["fecha"].'"';
              else if(isset($_POST['fecha']))
                echo 'value="'.$_POST["fecha"].'"'; 
              ?>>


    
 <?php if (check($err_array)) echo "<span class='mensaje-error'> DATOS INSUFICIENTES </span>"; ?>




</fieldset>

<input type="submit" name="submit" value="Submit">



</form>
 <script src="./../js/shows.js"></script>


<?php endif; ?>


<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";
?>