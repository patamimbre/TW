<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/header.php";
?>


    <div class="main container">
      <div class="acciones container ">
        <h5 class="row center titulo">Usuarios</h5>
        <div class="row usuarios">
          <button class="col center action" onclick="location.href='./../formularios/edit-user.php'" type="button">
            Editar</button>
          <button class="col center action" onclick="location.href='./../formularios/insert-user.php'" type="button">
            Añadir</button>
          <button class="col center action" onclick="location.href='./../formularios/delete-user.php'" type="button">
           Eliminar</button>
        </div>
        <h5 class="row center titulo">Conciertos</h5>
        <div class="row usuarios">
          <button class="col center action" onclick="location.href='./../formularios/edit-show.php'" type="button">
            Editar</button>
          <button class="col center action" onclick="location.href='./../formularios/insert-show.php'" type="button">
            Añadir</button>
          <button class="col center action" onclick="location.href='./../formularios/delete-show.php'" type="button">
           Eliminar</button>
        </div>
        <h5 class="row center titulo">Discografía</h5>
        <div class="row usuarios">
          <button class="col center action" onclick="location.href='./../formularios/edit-music.php'" type="button">
            Editar</button>
          <button class="col center action" onclick="location.href='./../formularios/insert-music.php'" type="button">
            Añadir</button>
          <button class="col center action" onclick="location.href='./../formularios/delete-music.php'" type="button">
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
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/html/footer.html";
?>
