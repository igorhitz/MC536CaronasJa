<?php
	//Definicao de paths
	if($_SERVER['SERVER_NAME'] == 'localhost') {
		define('PATH', 'http://localhost/MC536CaronasJa/app/');
		define('PATH_HREF', 'http://localhost/MC536CaronasJa/');
	} elseif($_SERVER['SERVER_NAME'] == '127.0.0.1') {
		define('PATH', 'http://127.0.0.1/MC536CaronasJa/app/');
		define('PATH_HREF', 'http://127.0.0.1/MC536CaronasJa/');
	} else {
		//Endereco online
	}

	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASS', '');
	define('DB', 'caronasja');
?>
