	<?php
	$mensagem = new Mensagem;

	//obtem lista de mensagens
	if(isset($_GET['s']) && !empty($_GET['s'])) {	
		$lista = $mensagem->findById($_GET['s']);
		$mensagem->updateStatus($_GET['s'], 1);
	}



	//define a linha única de retorno da matriz como resultado
	$item = $lista[0];

	SiteHandler::getQueryAlert(Mensagem::$query);
	?>
	<br>
	<?php if($mensagem->rows > 0) { ?>
	<div class="totalbusca"><span ><h1>Mensagem de <?= $item['nome_remetente'] ?></h1></div>
	<?php } else { ?>
	<div class="totalbusca"><h1>Nenhuma mensagem foi encontrada.</h1></div>
	<?php 
	}
	?>
	<div class="show-unique-result">
		<figure>
			<img src="<?= $item['foto_remetente'] ?>">
		</figure>
		<div class="show-info">
			<h3>De <?= $item['nome_remetente'].' ('.$item['email_remetente'].')' ?></h3>
			<p>Em <?= date('d/m/Y', strtotime($item['data'])) ?></p>
		</div>
		<div class="content">
			<p><?= $item['conteudo'] ?></p>
		</div>
	</div>