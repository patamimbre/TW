<?php

//require_once "./modules/gestion_usuarios.php";

$normal_user = array(
	"nombre" => 'Antonio',
	"apellidos"  => 'Gómez',
	"email"     => 'gomeza@ugr.es',
	"pass"       => '12341234',
);

$admin_user = array(
	"nombre" => 'Manolo',
	"apellidos"  => 'Carrasco',
	"email"     => 'macarra@ugr.es',
	"pass"       => 'motorista1',
);


$gestion = new GestionUsuarios();

//$gestion->login('juan@ugr.es','gato');
//$gestion->logout();

$gestion->login($admin_user['email'], $admin_user['pass']);
/*
$gestion->printUsers();

$gestion->addUser($normal_user);
$gestion->setUserRole($normal_user['email'], 1);


$gestion->printUsers();

$gestion->deleteUser($normal_user['email']);

$gestion->printUsers();

$gestion->logout();
*/



/*
$gestion->deleteUser($user['email']);
$gestion->addUser($user);
*/

/*
if ($gestion->login($user['email'], $user['pass'])){
	echo "sesion iniciada correctamente";
} else {
	echo "no fue bien";
}
echo "<br>";
*/

/*
if ($gestion->logout()){
	echo "sesion cerrada";
} else {
	echo "el usuario no había iniciado sesion";
}
echo "<br>";
*/
