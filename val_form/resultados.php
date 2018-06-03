<?php 

	echo "nombre: ".$_POST['nombre']."<br>";
	echo "apellidos: ".$_POST['apellidos']."<br>";
	echo "direccion: ".$_POST['direccion']."<br>";
	echo "nacimiento: ".$_POST['nacimiento']."<br>";
	echo "telefono: ".$_POST['telefono']."<br>";
	echo "email: ".$_POST['email']."<br>";
	echo "cc: ".$_POST['cc']."<br>";
	echo "revista: ".$_POST['revista']."<br>";
	echo "modo_pago: ".$_POST['modo_pago']."<br>";
	echo "tiempo: ".$_POST['tiempo']."<br>";
	echo "tipo_tarjeta: ".$_POST['tipo_tarjeta']."<br>";
	echo "numero_tarjeta: ".$_POST['numero_tarjeta']."<br>";
	echo "fecha_tarjeta: ".$_POST['fecha_tarjeta']."<br>";
	echo "cvc: ".$_POST['cvc']."<br>";

	echo "temas de interes: <br>";

	foreach ($_POST['intereses'] as $key => $value) {
		echo "· ".$value."<br>";
	}

	if (isset($_POST['newsletter']))
		echo "Suscrito a newsletter <br>";
	else
		echo "NO suscrito a newsletter <br>";

?>