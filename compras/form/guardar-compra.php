<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/common.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/compras/gestion_compras.php');
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/gestion_discos.php');


if (!isset($_POST['submit'])) die();

$compras = new GestionCompras;
$gest_discos = new GestionDiscos;

if (isset($_POST['id'])){
    $disco = $gest_discos->get($_POST['id']);
}

$compra =[
    'id_disco' => $disco['id'],
    'precio' => $disco['precio'],
    'email' => $_POST['email']
];

$compras->add($compra);

header('Location: https://void.ugr.es/~germancastro1718/proyecto/index.php');
exit();
?>