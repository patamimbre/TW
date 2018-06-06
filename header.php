<?php

    include_once '/home/alumnos/1718/germancastro1718/public_html/proyecto/common.php';

    if (isset($_GET['logout'])){
        logout();
    }
?>




<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Julio Iglesias</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/~germancastro1718/proyecto/css/main.css">
  <link rel="stylesheet" href="https://unpkg.com/wingcss" />
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

  
</head>
<body>
<header>
    <h1 class="center">Julio Iglesias</h1>
    <nav class="nav center">
        <a href="/~germancastro1718/proyecto/index.php" class="nav-item">Home</a>
        <a href="/~germancastro1718/proyecto/bio.php" class="nav-item">Bio</a>
        <a href="/~germancastro1718/proyecto/music.php" class="nav-item">Music</a>
        <a href="/~germancastro1718/proyecto/shows.php" class="nav-item">Shows</a>
        <a href="/~germancastro1718/proyecto/gestion.php" class="nav-item"
        <?php if (!isset($_SESSION['tipo']) || ($_SESSION['tipo'] != 1 && $_SESSION['tipo'] != 2 )) echo 'style="display: none;"';?> >Gestión</a>
        <?php
            if (!isset($_SESSION['email']))
                echo '<a class="identificacion nav-item" href="https://void.ugr.es/~germancastro1718/proyecto/form/login.php">Iniciar Sesión</a>';
            else {
                echo '<a href="https://void.ugr.es/~germancastro1718/proyecto/index.php?logout" class="identificacion nav-item">'.$_SESSION['email']. '<i class="icon-remove"></i></a>';
            }
        ?>

    </nav>
</header>


<div class="main container">
