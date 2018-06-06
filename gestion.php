<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";

# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [1,2];
$tipo = is_valid_user($permisos);     #common.php

  
?>


    <div class="main container">
      <div class="acciones container ">
        <h5 class="row center titulo">Usuarios</h5>
        <div class="row usuarios">
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/edit-user.php'" type="button">
            Editar</button>
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/insert-user.php'" type="button">
            Añadir</button>
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/delete-user.php'" type="button">
           Eliminar</button>
        </div>
        <h5 class="row center titulo">Conciertos</h5>
        <div class="row usuarios">
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/edit-show.php'" type="button">
            Editar</button>
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/insert-show.php'" type="button">
            Añadir</button>
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/delete-show.php'" type="button">
           Eliminar</button>
        </div>
        <h5 class="row center titulo">Discografía</h5>
        <div class="row usuarios">
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/edit-music.php'" type="button">
            Editar</button>
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/insert-music.php'" type="button">
            Añadir</button>
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/delete-music.php'" type="button">
           Eliminar</button>
        </div>
        <h5 class="row center titulo">DB</h5>
        <div class="row usuarios">
          <button class="col center action" onclick="location.href=''" type="button">
            Importar</button>
          <button class="col center action" onclick="location.href=''" type="button">
            Exportar</button>
        </div>
        <h5 class="row center titulo">Compras</h5>
        <div class="row usuarios">
          <button class="col center action" onclick="location.href=''" type="button">
            Solicitudes de compra</button>
        </div>
        <h5 class="row center titulo">Eventos</h5>
        <div class="row usuarios">
          <button class="col center action" onclick="location.href=''" type="button">
            Visualizar log de eventos</button>
        </div>
      </div>
    </div>


<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";
?>
