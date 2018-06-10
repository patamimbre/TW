<?php 
include "header.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/gestion_bio.php');

$tipo = 0;
if( isset( $_SESSION['tipo']))
    $tipo = $_SESSION['tipo'];     #common.php

$bio = new GestionBiografia;
$result = "";
$parrafos = $bio->all();

if (isset($_POST['submit'])){
    $accion = $_POST['submit'];

    if ($accion == "add"){
        if (isset($_POST['new_p']) && !empty($_POST['new_p'])){
            if($bio->add(escape($_POST['new_p']))){
                $result = "Parrafo añadido correctamente";
                writeLog($_SESSION['email']." ha insertado un párrafo");
            } else {
                $result = "Error al añadir párrafo";
            }

        }
    }

    elseif ($accion == "delete"){
        if (isset($_POST['seleccionados']) && !empty($_POST['seleccionados'])){
            
            # Si algún parrafo esta seleccionado lo borra
            foreach ($parrafos as $p){
                if (in_array($p['id'], $_POST['seleccionados'])){
                    $bio->delete($p['id']);
                    writeLog($_SESSION['email']." ha eliminado el párrafo".$p['id']);
                }
            }
            $result = "Párrafos eliminados";
        } else {
            $result = "No se seleccionó ningún párrafo";
        }
    }

    elseif ($accion == "save"){
        # Si es un párrafo lo sobreescribo en la db
        foreach($_POST as $k => $v){
            if (strpos($k,'p-') !== false){
                $id = str_replace('p-','', $k);
                $bio->modify($id, escape($v));
                writeLog($_SESSION['email']." ha modificado el párrafo".$id);
            }
        }
        $result = "Editado correctamente";
    } 
    


}



$parrafos = $bio->all();

if (!empty($result)){
    echo '<blockquote class="center">'.escape($result).'</blockquote>';
}


echo <<<HTML
    <div class="container cabecera ">
    <h2 class="center">Un poco de su vida</h2>
    <div class="img container center">
    <img class="" src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/ef/Julio_Iglesias09.jpg/245px-Julio_Iglesias09.jpg" alt="Julio Iglesias">
    </div>
HTML;

echo '<form class="bio" action="'.escape($_SERVER['PHP_SELF']).'" method="post">';

#muestra los párrafos como input al admin
if ($tipo == 1){
    foreach($parrafos as $p){
        $text = $p['parrafo'];
        echo '<div class="parrafo row">';
        echo '<input class="col-11" type="text" name="p-'.$p['id'].'" value="'.escape($text).'" ';
        if ($tipo!=1) echo 'readonly'; 
        echo '/><input class="col-1" name="seleccionados[]" value="'.$p['id'].'" ';
        if ($tipo!=1) echo 'type="hidden"';
        else echo 'type="checkbox"'; 
        echo ' /></div>';
    }
} else {
    foreach($parrafos as $p){
        $text = $p['parrafo'];
        echo '<div class="parrafo row">';
        echo '<p>'.escape($text).'</p></div>';
    }
}

if ($tipo == 1){
    echo '<div class="row"><input type="text" name="new_p"></div>';
    echo '<div class="controles row">
        <button class="col" type="submit" name="submit" value="delete">Borrar seleccionados</button>
        <button class="col" type="submit" name="submit" value="add">Añadir texto</button>
        <button class="col" type="submit" name="submit" value="save">Guardar cambios</button>
        </div>';
}

echo " </form>";




echo <<<HTML

    <section id="records" class"container">
        <h2 class="center">Algunos de sus muchos récords</h2>
        <table >
            <tr>
                <th>Año</th>
                <th>Récord batido</th>
            </tr>
            <tbody>
                <tr>
                    <td> 2013</td>
                    <td>El Guinness World Records le otorga el Récord Mundial Guinness por ser el artista latino que más discos ha vendido en el mundo</td>
                </tr>
                <tr>
                    <td> 2011</td>
                    <td> El 22 de noviembre, se publica en España el disco Julio Iglesias "1", que llega a número 1 en iTunes, nada más salir a la venta. El álbum obtuvo el disco de platino en Brasil y el disco de diamante en Colombia, por las ventas logradas.</td>
                </tr>
                <tr>
                    <td>2010 </td>
                    <td>Actualmente, Julio Iglesias es  el artista latino que más álbumes ha vendido en la historia (300 millones).</td>
                </tr>
            </tbody>
        </table>
    </section>
<?php
include "footer.html";
?>
HTML;

?>
    
        
   