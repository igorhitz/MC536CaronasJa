<?php
	//Definicao de paths
	if($_SERVER['SERVER_NAME'] == 'localhost') {
		define('PATH', 'http://localhost/web/app/');
	} elseif($_SERVER['SERVER_NAME'] == '127.0.0.1') {
		define('PATH', 'http://127.0.0.1/web/app/');
	} else {
		//Endereco online
	}
?>