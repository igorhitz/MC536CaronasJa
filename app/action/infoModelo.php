<?php
	//campos vindos do formulario
	$campos = array(
		'marca',
		'modelo',
		'lugares'
		);

	//campos de preenchimento obrigatorios
	$camposObrigatorios = array(
		'marca',
		'modelo',
		'lugares'
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
	if(!InfoModelo::checkAttributes($itensObrigatorios)) {
		header("Location: ../infoModelo/stat=campos-vazios");
		exit;
	}

	
/** --------------------------------------- **/
	$infoModelo = new InfoModelo;

	//salva os atributos
	$infoModelo->setAttributes($itens['modelo'], $itens['marca'], $itens['lugares']);
	
	if($infoModelo->insert()) {
		header("Location: ../infoModelo/query=".$infoModelo->encodeQuery());
		exit;
	} else {
		header("Location: ../infoModelo/stat=falha-insercao");
		exit;
	}

?>