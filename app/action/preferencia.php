<?php
	//campos vindos do formulario
	$campos = array(
		'id',
		'descricao'
		);

	//campos de preenchimento obrigatorio
	$camposObrigatorios = array(
		'id',
		'descricao'
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

	$preferencia = new Preferencia;
/** --------------------------------------- **/
	
	//salva os atributos
	$preferencia->setAttributes($itens['descricao']);
	
	if($preferencia->insert()) {
		header("Location: ../SignIn/query=".$preferencia->encodeQuery());
		exit;
	} else {
		header("Location: ../SignUp/stat=falha-insercao");
		exit;
	}

?>