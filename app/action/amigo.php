<?php
	echo $_SERVER['QUERY_STRING']; 
	if(isset($_GET['id']) && isset($_GET['email'])) {
		$email1 = $_GET['id'];
		$email2 = $_GET['email'];
	}
	
	
	$amizade = new Amizade;

	//salva os atributos
	$amizade->setAttributes($email1, $email2);
	
	if($amizade->insert()) {
		header("Location: ../../../Home/query=".$amizade->encodeQuery());
		exit;
	} else {
		header("Location: ../../../Home/stat=falha-insercao");
		exit;
	}

?>