<?php
	//campos vindos do formulario
	$campos = array(
		'idpreferencia',
		'email'
		);

	//campos de preenchimento obrigatorio
	$camposObrigatorios = array(
		'idpreferencia',
		'email'
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
	if(!UsuarioPreferencias::checkAttributes($itensObrigatorios)) {
		header("Location: ../preferencia/stat=campos-vazios");
		exit;
	}

	$usuariopreferencia = new UsuarioPreferencias;
/** --------------------------------------- **/
	
	//salva os atributos
	$usuariopreferencia->setAttributes($itens['idpreferencia'], $itens['email']);
	
	if($usuariopreferencia->insert()) {
		header("Location: ../preferencia/query=".$usuariopreferencia->encodeQuery());
		exit;
	} else {
		header("Location: ../preferencia/stat=falha-insercao");
		exit;
	}

?>