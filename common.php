<?php

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


/**
 * Escapes HTML for output
 */

function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

function logout(){
	if (isset($_SESSION['email'])){
		//Unset session variables
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

		return true;
	} else {
		return false;
	}
}
