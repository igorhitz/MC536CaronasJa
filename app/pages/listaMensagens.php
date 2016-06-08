	<?php
	$mensagem = new Mensagem;

	//obtem lista de mensagens
	$lista = $mensagem->findByEmail($_SESSION['email']);
	
	SiteHandler::getQueryAlert(Mensagem::$query);
	?>
	<br>
	<?php if($mensagem->rows > 0) { ?>
	<div class="totalbusca"><span ><?= $mensagem->rows ?>&nbsp;</span><h1>mensagens encontradas</h1></div>
	<?php } else { ?>
	<div class="totalbusca"><h1>Nenhuma mensagem foi encontrada.</h1></div>
	<?php 
	}
	?>
	<div class = "search-results">
		<?php 
		foreach($lista as $item) {
		?>
		<article class = "row">
			<div class = "user">	
				<img class = "photo" src = "<?= PATH.'resources/'.$item['foto_remetente'] ?>" width="72" height="72">
				<div class = "info">
					<h2 class = "username">De: <?= $item['nome_remetente'] ?></h2>
					<p>Email: <?= $item['email_remetente']; ?></p> <br>
				</div>
			</div>
			<div class = "description-box">
				<h3 class = "day-time"><?= SiteHandler::formatData($item['data']) ?></h3>
				
				<h3 class = "description"><?= $item['conteudo'] ?></h3>
			</div>
		</article>
		<?php
		}
		?>
	</div>