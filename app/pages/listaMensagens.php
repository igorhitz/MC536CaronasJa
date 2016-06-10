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
	<table class="show-results">
		<tr height="30">
			<th>Status</th>
			<th>Nome do remetente</th>
			<th>E-mail do remetente</th>
			<th>Data de envio</th>
		</tr>
		<?php 
		foreach($lista as $item) {
		if($item['status'] == 1){ $view = 'class="viewed"'; $status = 'Lida';}
		else{ $view = 'class="new"'; $status = 'Não Lida';}
		?>

		<tr height="30" <?php echo $view ?>>
			<td>
				<a href="<?= PATH_HREF.'/mostraMensagem/'.$item['id'] ?>" ><?= $status ?></a>
			</td>
			<td>
				<a href="<?= PATH_HREF.'/mostraMensagem/'.$item['id'] ?>" ><?= $item['nome_remetente'] ?></a>
			</td>
			<td>
				<a href="<?= PATH_HREF.'/mostraMensagem/'.$item['id'] ?>" ><?= $item['email_remetente'] ?></a>
			</td>
			<td>
				<a href="<?= PATH_HREF.'/mostraMensagem/'.$item['id'] ?>" ><?= date('d/m/Y', strtotime($item['data'])) ?></a>
			</td>
		</tr>
		<?php
		}
		?>
	</table>
	</div>
