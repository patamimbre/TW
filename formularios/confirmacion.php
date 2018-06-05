<?php

if (!isset($_POST['submit'])) die();

array_pop($_POST);


include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/header.php";
?>

<form action="guardar-compra.php" method="post">
    <?php foreach($_POST as $key=>$val): ?>
    <div class="row">
        <label for="" class="col clave">
        <?=ucwords(str_replace('_',' ',escape($key)))?>
        </label>
        <input type="text" class="col valor" name="<?=escape($key)?>" value="<?=escape($val)?>" readonly>
    </div>
    <?php endforeach; 
        echo '<input type="hidden" name="id_disco" value="'.$_POST['id'].'" >';
    ?>

    <div class="row center">
        <input class="col" type="submit" name="submit" value="Realizar Pedido">
    </div>

</form>

<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/footer.html";
?>