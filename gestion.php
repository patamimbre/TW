<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";

# Comprueba que el usuario tiene permisos para acceder a esta página
$permisos = [1,2];
$tipo = is_valid_user($permisos);     #common.php

  
?>


    <div class="main container">
      <div class="acciones container ">
        <h5 class="row center usuarios titulo">Usuarios</h5>
        <div class="row usuarios">
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/edit-user.php'" type="button">
            Editar</button>
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/insert-user.php'" type="button">
            Añadir</button>
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/delete-user.php'" type="button">
           Eliminar</button>
        </div>
        <h5 class="row center concierto titulo">Conciertos</h5>
        <div class="row concierto">
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/edit-show.php'" type="button">
            Editar</button>
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/insert-show.php'" type="button">
            Añadir</button>
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/delete-show.php'" type="button">
           Eliminar</button>
        </div>
        <h5 class="row center discografia titulo">Discografía</h5>
        <div class="row discografia">
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/edit-music.php'" type="button">
            Editar</button>
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/insert-music.php'" type="button">
            Añadir</button>
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/gestion/form/delete-music.php'" type="button">
           Eliminar</button>
        </div>
        <h5 class="row center db titulo">DB</h5>
        <div class="row db">
          <button class="col center action" onclick="location.href=''" type="button">
            Importar</button>
          <button class="col center action" onclick="location.href=''" type="button">
            Exportar</button>
          <button class="col center action" onclick="location.href=''" type="button">
            Eliminar</button>
        </div>
        <h5 class="row center compras titulo">Compras</h5>
        <div class="row compras">
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/compras/peticiones.php'" type="button">
            Consultar solicitudes</button>         
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/compras/historico.php'" type="button">
            Histórico</button>
        </div>
        <h5 class="row center eventos titulo">Eventos</h5>
        <div class="row eventos usuarios">
          <button class="col center action" onclick="location.href='/~germancastro1718/proyecto/log.php'" type="button">
            Visualizar log de eventos</button>
        </div>
      </div>
    </div>


<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";
?>
