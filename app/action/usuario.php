<?php
	//campos vindos do formulario
	$campos = array(
		'nome',
		'genero',
		'email',
		'senha',
		'foto',
		'nascimento',
		'celular'
		);

	//campos de preenchimento obrigatorio
	$camposObrigatorios = array(
		'nome',
		'genero',
		'email',
		'senha',
		'nascimento',
		'celular'
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
		header("Location: ../SignUp/stat=campos-vazios");
		exit;
	}

	$usuario = new Usuario;
/** --------------------------------------- **/
	
	if(empty($itens['foto']) || $itens['foto'] == '') $itens['foto'] =  PATH.'resources/default-photo.png';

	//salva os atributos
	$usuario->setAttributes($itens['email'], $itens['senha'], $itens['nome'], $itens['genero'], $itens['nascimento'], $itens['foto'], $itens['celular']);
	
	if($usuario->insert()) {
		header("Location: ../SignIn/query=".$usuario->encodeQuery());
		exit;
	} else {
		header("Location: ../SignUp/stat=falha-insercao");
		exit;
	}

?>