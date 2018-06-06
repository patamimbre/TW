<?php 

require './../modules/gestion_compras.php';
require './../modules/gestion_discos.php';

//if (!isset($_POST['submit'])) die();

$compras = new GestionCompras;
$gest_discos = new GestionDiscos;

if (isset($_POST['id'])){
    $disco = $gest_discos->get($_POST['id']);
}

/*
$compra =[
    'id_disco' => $disco['id'],
    'precio' => $disco['precio'],
    'email' => $_SESSION['email']
];
*/


// ¡¡PRUEBA  BORRAR!!!
$compra =[
    'id_disco' => 4,
    'precio' => 21,
    'email' => 'hambrevieja@correo.ugr.es'
];



//$ret = $compras->add($compra);
$info = "Su pedido fue rechazado porque el sistema de pago no aceptó su compra";

//$compras->aceptar( 3, ["nombre"=>"Juan", "apellidos"=>"Fernández"]);
//$compras->rechazar( 4, ["nombre"=>"Juan", "apellidos"=>"Fernández"],$info);


echo "<br>".print_r($compras->get_esperando())."<br>";
//echo "<br>".print_r($compra->get_peticiones())."<br>";
//echo "<br>".print_r($compra)."<br>";


//echo "<br>".print_r($compra)."<br>";



?>