<?php
	
 
	$veiculo = new Veiculo;

	//salva os atributos
	$veiculo->setAttributes(null, null, null, null, null, $_GET['id']);
	
	if($veiculo->delete()) {
		header("Location: ../../veiculo/query=".$veiculo->encodeQuery());
		exit;
	} else {
		header("Location: ../../veiculo/stat=falha-delecao");
		exit;
	}

?>