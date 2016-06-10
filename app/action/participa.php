<?php
	if(isset($_GET['email']) && isset($_GET['id'])) {
		$email = $_GET['email'];
		$id_grupo = $_GET['id'];
	}
	
	$participa = new Participa;

	

	//salva os atributos
	$participa->setAttributes($id_grupo, $email);
	
	if($participa->insert()) {
		header("Location: ../../../meusGrupos/query=".$participa->encodeQuery());
		exit;
	} else {
		header("Location: ../../../meusGrupos/stat=falha-insercao");
		exit;
	}

?>