<?php
	if(isset($_GET['email_1']) && isset($_GET['email_2'])) {
		$email_amigo1 = $_GET['email'];
		$email_amigo2 = $_GET['email'];
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