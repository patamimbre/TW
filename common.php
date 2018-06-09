<?php

# Debe crearse la sesión en cada página para poder
# acceder a $_SESSION desde cualquiera
	session_start();

	if (empty($_SESSION['csrf'])) {
		if (function_exists('random_bytes')) {
			$_SESSION['csrf'] = bin2hex(random_bytes(32));
		} else if (function_exists('mcrypt_create_iv')) {
			$_SESSION['csrf'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
		} else {
			$_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));
		}
	}




# Escapa HTML para la salida
function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

# Intercambia 2 variables
function swap(&$x,&$y) {
    $tmp=$x;
    $x=$y;
    $y=$tmp;
}

# busca recursivamente un elemento en un array multidimensional
function in_array_r($item , $array){
    return preg_match('/"'.preg_quote($item, '/').'"/i' , json_encode($array));
}

# Devuelve en un array cada linea del log
# [ [fecha1,linea1], [fecha2,linea2] ... ]
function viewLog(){
	$log_file = "/home/alumnos/1718/germancastro1718/public_html/proyecto/log.txt";
	$handle = fopen($log_file, "r");
	$data = [];
	if ($handle) {
		while (($line = fgets($handle)) !== false) {
			$data []= explode('|', $line);
		}
		fclose($handle);
		return $data;
	}
	return false;
}

function writeLog($line){
	$log_file = "/home/alumnos/1718/germancastro1718/public_html/proyecto/log.txt";
	$text = '['.date("d/m/Y H:i:s").']| '.$line."\n";
	#[fecha] $line
	file_put_contents($log_file, $text, FILE_APPEND);
   
}


function logout(){
	if (isset($_SESSION['email'])){
		//Unset session variables
		$email = $_SESSION['email'];
		$_SESSION = array();
		//Delete cookie if exist
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		// Destroy the session
		session_destroy();
		
		writeLog($email." ha cerrado sesión");
		return true;
	} else {
		return false;
	}
}

function is_valid_user($permisos){
	if( isset( $_SESSION['tipo']) && in_array($_SESSION['tipo'],$permisos) ){
		return $_SESSION['tipo'];
	  } else {
		header('Location: https://void.ugr.es/~germancastro1718/proyecto/index.php');
		exit();
	  }
}
