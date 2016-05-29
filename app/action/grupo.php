<?php
	//campos vindos do formulario
	$campos = array(
		'nome',
		'categoria',
		'email_criador'
		);

	//campos de preenchimento obrigatorio
	$camposObrigatorios = array(
		'nome',
		'categoria',
		'email_criador'
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
	if(!Grupo::checkAttributes($itensObrigatorios)) {
		header("Location: ../Home/stat=campos-vazios");
		exit;
	}

	$grupo = new Grupo;
/** --------------------------------------- **/
	
	//salva os atributos
	$grupo->setAttributes($itens['email_criador'], $itens['nome'], $itens['categoria']);
	
	if($grupo->insert()) {
		header("Location: ../Home/query=".$grupo->encodeQuery());
		exit;
	}

?>