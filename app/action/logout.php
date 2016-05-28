<?php
	
	$login = new Login;

	$login->logout();
	header("Location: ../Home");
	exit;
	
?>