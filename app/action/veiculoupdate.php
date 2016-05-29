<?php
	//campos vindos do formulario
	$campos = array(
		'email',
		'modelo',
		'cor',
		'categoria',
		'conforto'
		);

	//campos de preenchimento obrigatorios
	$camposObrigatorios = array(
		'email',
		'modelo',
		'cor',
		'categoria',
		'conforto'
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
	if(!Veiculo::checkAttributes($itensObrigatorios)) {
		header("Location: ../config/stat=campos-vazios");
		exit;
	}

	
/** --------------------------------------- **/
	$veiculo = new Veiculo;

	//salva os atributos
	$veiculo->setAttributes($itens['modelo'], $itens['conforto'], $itens['categoria'], $itens['cor'], $itens['email']);
	
	if($veiculo->update()) {
		header("Location: ../config/query=".$veiculo->encodeQuery());
		exit;
	} else {
		header("Location: ../config/stat=falha-insercao");
		exit;
	}

?>