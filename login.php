<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";
require_once "/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/gestion_usuarios.php";


$gestion = new GestionUsuarios;



if (isset($_POST['submit'])){
    if (isset($_POST['email']) && isset($_POST['pass'])){
        if($gestion->check($_POST['email'],$_POST['pass'])){
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['tipo'] = $gestion->getRole($_POST['email']);
            writeLog($_POST['email']." ha iniciado sesión"); 
        } else {
            $err = "Usuario o contraseña incorrectos";
            writeLog($_POST['email']." inicio sesión erróneo"); 
        }
    }
}




if (isset($_SESSION['email'])){
    header('Location: https://void.ugr.es/~germancastro1718/proyecto/index.php');
    exit();
  } 


?>

<form class="login" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <?php if (isset($err)) echo '<p class="err">'.$err.'</p>';  ?>

    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <label for="pass">Contraseña</label>
    <input type="password" name="pass" id="pass">
    <input type="submit" name="submit" value="Iniciar Sesión">
</form>









<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";



/*
header('Location: https://void.ugr.es/~germancastro1718/proyecto/index.php');
exit();
*/