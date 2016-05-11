<?php
	//Definicao de paths
	if($_SERVER['SERVER_NAME'] == 'localhost') {
		define('PATH', 'http://localhost/MC536CaronasJa/web/');
	} elseif($_SERVER['SERVER_NAME'] == '127.0.0.1') {
		define('PATH', 'http://127.0.0.1/MC536CaronasJa/web/');
	} else {
		//Endereco online
	}

	define('CONTROLLERS', 'protected/controllers/');
?>