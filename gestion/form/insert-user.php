<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/gestion_usuarios.php');





// RELLENAR ARRAY CON LOS DISTINTOS TIPOS DE ERRORES
function conformidad($datos)
{

      $errores = array();
      if($datos['nombre']== "")
        array_push($errores,'nombre');
      if($datos['apellidos']=="")
        array_push($errores,'apellidos');

      if($datos['telefono']=="")
          array_push($errores,'telefono');


      if($datos['email']!=''){
        if(!preg_match('#\w+@\w+(\.\w+)?\.\w{2,}#', $datos['email']))
          array_push($errores,'email');
      }else
        array_push($errores,'email');

      if($datos['pass']=='')
        array_push($errores,'pass');



  return $errores;
}

function check($err_array){
  return (in_array('nombre',$err_array) or in_array('apellidos',$err_array) or in_array('telefono',$err_array) or in_array('pass',$err_array) or in_array('email',$err_array));
}



# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [1];
$tipo = is_valid_user($permisos);     #common.php


$gestion = new GestionUsuarios;
$statement = false;
$err_array = [];


if(isset($_POST) && count($_POST)>0){

 $err_array = conformidad($_POST);
}


if (isset($_POST['submit']) && empty($err_array) ) {
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

  $new_user = array(
    "nombre" => $_POST['nombre'],
    "apellidos"  => $_POST['apellidos'],
    "email"     => $_POST['email'],
    "telefono"       => $_POST['telefono'],
    "pass"  => $_POST['pass']
  );

  $statement = $gestion->addUser($new_user);
  writeLog($_SESSION['email']." ha insertado el usuario ".$_POST['email']);

}
?>


  <?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote class="center"><?php echo escape($_POST['email']); ?> añadido correctamente.</blockquote>
  <?php endif; ?>

<h2 class="center">Añadir usuario</h2>


<?php

// si hay errores
    if((isset($err_array) && count($err_array>0)) or (count($_GET)==0 && count($_POST)==0)):?>

<form method="post" onSubmit="return check($err_array);">
    <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
<fieldset>

        
        <legend>INSERTAR·USUARIO</legend>

        
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

        <label for="apellidos">Apellidos</label>
         <input type="text" name="apellidos" id="apellidos"
          <?php if(in_array('apellidos',$err_array))
              echo 'class="error"';
            else if(isset($_GET['apellidos']))
              echo 'value="'.$_GET["apellidos"].'"';
            else if(isset($_POST['apellidos']))
              echo 'value="'.$_POST["apellidos"].'"'; 
            ?>>
            <br>
        

        <label for="telefono">Telefono</label>
        <input type="tel" maxlength="12" name="telefono" id="telefono"
          <?php if(in_array('telefono',$err_array))
                  echo 'class="error"';
                else if(isset($_GET['telefono']))
                  echo 'value="'.$_GET["telefono"].'"';
                else if(isset($_POST['telefono']))
                  echo 'value="'.$_POST["telefono"].'"'; 
                ?>>
                <br>


        <label for="email">Email</label>
        <input type="email" name="email" id="email"
          <?php if(in_array('email',$err_array))
              echo 'class="error"';
            else if(isset($_GET['email']))
              echo 'value="'.$_GET["email"].'"';
            else if(isset($_POST['email']))
              echo 'value="'.$_POST["email"].'"'; 
            ?>>
            <br>



        <label for="pass">Contraseña</label>
        <input type="password" minlenght="4" name="pass" id="pass"
          <?php if(in_array('pass',$err_array))
              echo 'class="error"';
            else if(isset($_GET['pass']))
              echo 'value="'.$_GET["pass"].'"';
            else if(isset($_POST['pass']))
              echo 'value="'.$_POST["pass"].'"'; 
            ?>>
            <br>


    
 <?php if (check($err_array)) echo "<span class='mensaje-error'> DATOS INSUFICIENTES </span>"; ?>




</fieldset>

<input type="submit" name="submit" value="Submit">



</form>



<?php endif; ?>


<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";
?>
