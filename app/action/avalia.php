<?php

	$date = date('Y-m-d H:i:s');
	$campos = array( 'conteudo', 'email_avaliador', 'email_avaliado', 'nota');
	$camposObrigatorios = array( 'conteudo', 'email_avaliador', 'email_avaliado', 'nota' );
	
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
	if(!Avalia::checkAttributes($itensObrigatorios)) {
		header("Location: ../enviarAvaliacao/stat=campos-vazios");
		exit;
	}
	
/** --------------------------------------- **/	
	$avalia = new Avalia;

	//salva os atributos
	 $avalia->setAttributes($itens['email_avaliador'], $itens['email_avaliado'], $date, $itens['nota'], $itens['conteudo']);
	
	if($avalia->insert()) {
		header("Location: ../enviarAvaliacao/query=".$avalia->encodeQuery());
		exit;
	} else {
		header("Location: ../enviarAvaliacao/stat=falha-insercao");
		exit;
	}

?>