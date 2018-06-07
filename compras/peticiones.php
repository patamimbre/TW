<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/compras/gestion_compras.php');

# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [2];
$tipo = is_valid_user($permisos);     #common.php

$gestion = new GestionCompras();

if (isset($_POST['submit']) && isset($_POST['id'])) {
    if ($_POST['estado'] == "rechazado"){
        $gestion->rechazar($_POST['id'], $_SESSION['email'],$_POST['info']);
        writeLog($_SESSION['email']." ha aceptado el pedido ".$_POST['id']);
    } else {
        $gestion->aceptar($_POST['id'], $_SESSION['email']);
        writeLog($_SESSION['email']." ha rechazado el pedido ".$_POST['id']);

    }
}


$result = $gestion->esperando();
?>
<?php foreach ($result as $row): 
    echo '<form class="container pedido" action="'.htmlentities($_SERVER['PHP_SELF']).'" method="post">';
    foreach ($row as $key=>$col):?>
        <div class="row">
            <p class="col center"><?php echo ucfirst(str_replace('_',' ',escape($key))); ?></p> 
            <?php
            if($key == "estado"){
                echo '<select class="col center" name="estado" id="estado">
                    <option value="aceptado" selected>Aceptar</option>
                    <option value="rechazado" >Rechazar</option>
                </select>';
            }
            elseif ($key == "info") {
                echo '<input class="col center" type="text" name="info" id="info">';
            }       
            else {
              echo '<input type="text" class="col center" name="'.escape($key).'" value="'.escape($col).'" readonly>';  
            }
            ?>
        </div>
    <?php 
    endforeach;
    echo '<div class="row center"><input type="submit" name="submit" value="Procesar">'; 
    echo "</div></form>";
endforeach; ?>
      
<?php 
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";
?>
