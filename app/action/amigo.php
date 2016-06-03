<?php
	if(isset($_GET['email1']) && isset($_GET['email2'])) {
		$email_amigo1 = $_GET['email1'];
		$email_amigo2 = $_GET['email2'];
	}
	
	$amizade = new Amizade;

	//salva os atributos
	$amizade->setAttributes($email_amigo1, $email_amigo2);
	
	if($amizade->insert()) {
		header("Location: ../../../Home/query=".$amizade->encodeQuery());
		exit;
	} else {
		header("Location: ../../../Home/stat=falha-insercao");
		exit;
	}

?>