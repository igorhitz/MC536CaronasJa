<?php
	//campos vindos do formulario
	$campos = array(
		'email',
		'senha'
		);

	//campos de preenchimento obrigatorio
	$camposObrigatorios = array(
		'email',
		'senha'
		);

/** 
 ** ------------ NAO EDITAR ESTE TRECHO ----------------
 **/
	$itensObrigatorios = array();
	$itens = array();

	//converte itens do array de acordo com o metodo
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		foreach($camposObrigatorios as $item) {
			$itensObrigatorios[$item] = $_POST[$item];
		}
		foreach($campos as $item) {
			$itens[$item] = $_POST[$item];
		}
	} else if($_SERVER['REQUEST_METHOD'] == 'GET') {
		foreach($camposObrigatorios as $item) {
			$itensObrigatorios[$item] = $_GET[$item];
		}
		foreach($campos as $item) {
			$itens[$item] = $_GET[$item];
		}
	}
	//verifica se os campos obrigatorios existem e foram preenchidos
	if(!Usuario::checkAttributes($itensObrigatorios)) {
		header("Location: ../Home/stat=campos-vazios");
		exit;
	}

	$usuario = new Usuario;
/** --------------------------------------- **/
	
	$login = new Login;
	$login->setAttributes($itens['email'], $itens['senha']);
	if($login->auth()) {
		header("Location: ../Home");
		exit;
	} else {
		header("Location: ../SignIn/stat=falha-login");
		exit;
	}
	
	

?>