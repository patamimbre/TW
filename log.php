<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";

# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [1];
$tipo = is_valid_user($permisos);     #common.php

$log = viewLog();

foreach ($log as $line):
?>
    <div class="row log linea">
        <p class="col center fecha"><?php echo $line[0];?></p>
        <p class="col center texto"><?php echo $line[1];?></p>
    </div>


<?php
endforeach;
?>