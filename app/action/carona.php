<?php
	//campos vindos do formulario
	$campos = array(
		'email',
		'origem',
		'destino',
		'data',
		'hora',
		'descricao',
		'preco',
		'qtd_passageiros',
		'bagagem',
		'grupo'
		);

	//campos de preenchimento obrigatorios
	$camposObrigatorios = array(
		'email',
		'origem',
		'destino',
		'data',
		'hora',
		'preco',
		'qtd_passageiros'
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
	if(!Carona::checkAttributes($itensObrigatorios)) {
		header("Location: ../registraCaronas/stat=campos-vazios");
		exit;
	}

	
/** --------------------------------------- **/
	$carona = new Carona;

	//salva os atributos
	$carona->setAttributes($itens['email'], $itens['id_grupo'], $itens['origem'], $itens['destino'], $itens['descricao'], $itens['data'], $itens['hora'], $itens['qtd_passageiros'], $itens['bagagem'], $itens['preco']);
	
	if($carona->insert()) {
		header("Location: ../registraCaronas/query=".$carona->encodeQuery());
		exit;
	} else {
		//header("Location: ../registraCaronas/stat=falha-insercao");
		exit;
	}

?>