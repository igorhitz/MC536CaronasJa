<?php
	//campos vindos do formulario
	$campos = array(
		'nome',
		'genero',
		'email',
		'foto',
		'nascimento',
		'celular'
		);

	//campos de preenchimento obrigatorio
	$camposObrigatorios = array(
		'nome',
		'genero',
		'email',
		'foto',
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
		header("Location: ../Config/stat=campos-vazios");
		exit;
	}

	$usuario = new Usuario;
/** --------------------------------------- **/
	
	//salva os atributos
	$usuario->setAttributes($itens['email'], null, $itens['nome'], $itens['genero'], $itens['nascimento'], $itens['celular']);
	
	if($usuario->update()) {
		header("Location: ../Config/query=".$usuario->encodeQuery());
		exit;
	}

?>