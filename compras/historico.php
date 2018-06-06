<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/compras/gestion_compras.php');

# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [2];
$tipo = is_valid_user($permisos);     #common.php

$gestion = new GestionCompras();
$result = $gestion->historico();
?>

<?php foreach ($result as $row): 
    if ($row['estado'] == 0){
        $row['estado'] = 'Rechazado';
    }
    else if ($row['estado'] == 1){
        $row['estado'] = 'Aceptado';
    } else {
        $row['estado'] = 'Sin confirmar';
    }    
?>
    <div class="container pedido">
    <?php foreach ($row as $key=>$col):?>
        <div class="row">
            <p class="col center"><?php echo ucfirst(str_replace('_',' ',escape($key))); ?></p> 
            <p class="col center"><?php echo escape($col); ?></p>
        </div>
    <?php endforeach; ?>
    </div>
<?php endforeach; ?>
      
<?php 
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";
?>
