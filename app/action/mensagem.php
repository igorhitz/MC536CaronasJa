<?php

	$date = date('Y-m-d H:i:s');
	$campos = array( 'conteudo', 'email_remetente', 'email_destinatario'	);
	$camposObrigatorios = array( 'conteudo', 'email_remetente', 'email_destinatario' );
	
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
	if(!Mensagem::checkAttributes($itensObrigatorios)) {
		header("Location: ../enviarMensagem/stat=campos-vazios");
		exit;
	}
	
/** --------------------------------------- **/	
	$mensagem = new Mensagem;

	//salva os atributos
	 $mensagem->setAttributes($itens['email_destinatario'], $itens['email_remetente'], $date, $itens['conteudo']);
	
	if($mensagem->insert()) {
		header("Location: ../enviarMensagem/query=".$mensagem->encodeQuery());
		exit;
	} else {
		header("Location: ../enviarMensagem/stat=falha-insercao");
		exit;
	}

?>