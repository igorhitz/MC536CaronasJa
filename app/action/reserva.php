<?php
	if(isset($_GET['email']) && isset($_GET['id'])) {
		$email = $_GET['email'];
		$id_carona = $_GET['id'];
	}
	
	$reserva = new Reserva;

	//salva os atributos
	$reserva->setAttributes($id_carona, $email);
	
	if($reserva->insert()) {
		header("Location: ../../../Home/query=".$reserva->encodeQuery());
		exit;
	} else {
		header("Location: ../../../Home/stat=falha-insercao");
		exit;
	}

?>