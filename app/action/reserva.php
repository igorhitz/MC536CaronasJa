<?php
	$email = $_GET['email'];
	$id_carona = $_GET['id'];
	
	$reserva = new Reserva;
/** --------------------------------------- **/
	
	//salva os atributos
	$reserva->setAttributes($id_carona, $email);
	
	if($reserva->insert()) {
		header("Location: ../listaCaronas/query=".$reserva->encodeQuery());
		exit;
	} else {
		header("Location: ../listaCaronas/stat=falha-insercao");
		exit;
	}

?>